<?php
// 1. INTEGRASI TERAS PHPRUNNER & ZON MASA
require_once("include/dbcommon.php");
date_default_timezone_set('Asia/Kuala_Lumpur');

if(!isLogged()){
    header("Location: login.php");
    exit();
}

$current_page = basename($_SERVER['PHP_SELF']);
$login_user = $_SESSION["UserID"];
$message = "";
$message_type = "";

// --- RBAC PENGGUNA (GUNA COLUMN 'role' DARI TABLE users) ---
$strUser = "SELECT id, full_name, role FROM users WHERE username = " . db_prepare_string($login_user);
$rsUser = DB::Query($strUser);

$user_db_id = 0; 
$nama_pegawai = $login_user;
$group_id = 1; // Default: 1 (Pemohon)

if($rsUser && $dataUser = $rsUser->fetchAssoc()){
    $user_db_id = $dataUser['id'];
    $nama_pegawai = ucwords(strtolower($dataUser['full_name']));
    
    // Baca 'role' dari pangkalan data
    $raw_role = strtolower(trim($dataUser['role']));
    
    if ($raw_role === '3' || $raw_role === 'admin' || $raw_role === 'pentadbir') {
        $group_id = 3;
    } elseif ($raw_role === '2' || $raw_role === 'supervisor' || $raw_role === 'penyelia') {
        $group_id = 2;
    } else {
        $group_id = 1;
    }
}

// Label untuk paparan
if ($group_id == 3) { $role_pengguna = "Pentadbir"; } 
elseif ($group_id == 2) { $role_pengguna = "Penyelia"; } 
else { $role_pengguna = "Pemohon"; }

// --- KAWALAN AKSES KETAT ---
if($group_id == 1) {
    die("<div style='display:flex; height:100vh; align-items:center; justify-content:center; background:#f8fafc; font-family:sans-serif;'>
            <div style='text-align:center; padding:40px; background:white; border-radius:20px; box-shadow:0 10px 25px rgba(0,0,0,0.05);'>
                <div style='font-size:50px; color:#ef4444; margin-bottom:10px;'>🔒</div>
                <h2 style='color:#0f172a; margin:0 0 10px 0;'>Akses Ditolak</h2>
                <p style='color:#64748b; margin-bottom:20px;'>Hanya Penyelia dan Admin yang dibenarkan mengakses halaman ini.</p>
                <a href='menu.php' style='background:#4f46e5; color:white; padding:10px 20px; text-decoration:none; border-radius:8px; font-weight:bold;'>Kembali ke Dashboard</a>
            </div>
         </div>");
}

// 2. PROSES KELULUSAN / PENOLAKAN TEMPAHAN
if(isset($_POST['proses_tempahan'])) {
    $booking_id = intval($_POST['booking_id']);
    $status_keputusan = $_POST['keputusan']; // 'Approved' atau 'Rejected'
    $catatan_penyelia = trim($_POST['catatan']);
    
    $sqlUpdate = "UPDATE bookings 
                  SET approval_status = " . db_prepare_string($status_keputusan) . ", 
                      supervisor_remarks = " . db_prepare_string($catatan_penyelia) . " 
                  WHERE id = $booking_id";
                  
    if(DB::Exec($sqlUpdate)) {
        $status_my = ($status_keputusan == 'Approved') ? "diluluskan" : "ditolak";
        $message = "Tempahan #".str_pad($booking_id, 4, '0', STR_PAD_LEFT)." telah berjaya $status_my.";
        $message_type = "success";
    } else {
        $message = "Ralat semasa mengemaskini: " . DB::LastError();
        $message_type = "error";
    }
}

// 3. AMBIL SEMUA REKOD TEMPAHAN (Susun 'Pending' di atas)
$senarai_permohonan = [];
$strSQL = "SELECT b.id, b.purpose, b.start_datetime, b.end_datetime, b.approval_status, b.supervisor_remarks, b.created_at, 
                  h.hall_name, u.full_name as pemohon 
           FROM bookings b 
           LEFT JOIN halls h ON b.hall_id = h.hall_id 
           LEFT JOIN users u ON b.user_id = u.id 
           ORDER BY 
                CASE WHEN b.approval_status = 'Pending' THEN 1 ELSE 2 END, 
                b.start_datetime ASC";

$rs = DB::Query($strSQL);
if($rs) {
    while($data = $rs->fetchAssoc()) {
        $senarai_permohonan[] = $data;
    }
} else {
    die("Ralat Pangkalan Data: " . DB::LastError());
}

function formatTarikhMasa($datetime) {
    return date("d/m/Y, h:i A", strtotime($datetime));
}
?>

<!DOCTYPE html>
<html lang="ms" 
      x-data="{ 
        darkMode: $persist(false), 
        sidebarOpen: window.innerWidth > 1024,
        userMenu: false,
        
        // Pembolehubah Modal Tindakan
        actionModal: false,
        a_id: '', a_dewan: '', a_tujuan: '', a_mula: '', a_tamat: '', a_pemohon: ''
      }" 
      :class="darkMode ? 'dark' : ''">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelulusan Tempahan - SmartDewan</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = { 
            darkMode: 'class',
            theme: {
                extend: {
                    animation: { blob: "blob 10s infinite alternate" },
                    keyframes: {
                        blob: {
                            "0%": { transform: "translate(0px, 0px) scale(1)", filter: "hue-rotate(0deg)" },
                            "50%": { transform: "translate(40px, -60px) scale(1.2)", filter: "hue-rotate(45deg)" },
                            "100%": { transform: "translate(0px, 0px) scale(1)", filter: "hue-rotate(0deg)" },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .dark body { background-color: #030712; }
        .font-outfit { font-family: 'Outfit', sans-serif; }
        [x-cloak] { display: none !important; }
        
        .table-container::-webkit-scrollbar { height: 6px; }
        .table-container::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
        .dark .table-container::-webkit-scrollbar-thumb { background-color: #475569; }
    </style>
</head>

<body class="flex min-h-screen transition-colors duration-500 text-slate-800 dark:text-slate-200">

    <?php include('sidebar.php'); ?>

    <main class="flex-1 flex flex-col min-w-0 ml-0 lg:ml-64 transition-all duration-300">
        
        <?php 
        $page_title = "Tindakan Kelulusan"; 
        include('header.php'); 
        ?>

        <div class="p-4 sm:p-8 max-w-7xl mx-auto w-full relative z-10">
            
            <?php if($message): ?>
            <div class="mb-6 p-4 rounded-2xl border flex items-center gap-3 animate-in fade-in slide-in-from-top-4 <?php echo $message_type == 'success' ? 'bg-emerald-50 dark:bg-emerald-500/10 border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400' : 'bg-rose-50 dark:bg-rose-500/10 border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-400'; ?>">
                <i class="fas <?php echo $message_type == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?> text-xl"></i>
                <p class="font-bold text-sm"><?php echo $message; ?></p>
            </div>
            <?php endif; ?>

            <div class="relative bg-black rounded-[2.5rem] p-8 sm:p-10 mb-8 overflow-hidden shadow-2xl border border-slate-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-50 z-0"></div>
                <div class="absolute top-0 -right-10 w-64 h-64 bg-fuchsia-600 rounded-full mix-blend-screen filter blur-[80px] opacity-40 z-0 animate-blob"></div>
                
                <div class="relative z-10">
                    <h2 class="text-3xl sm:text-4xl font-outfit font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 tracking-tight">Pengurusan Tempahan</h2>
                    <p class="text-sm font-medium text-fuchsia-200 mt-2">Sila semak permohonan dan berikan kelulusan mengikut jadual dewan.</p>
                </div>
            </div>

            <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] shadow-xl border border-slate-100 dark:border-slate-800 overflow-hidden transform-gpu">
                <div class="table-container overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-800/50 text-[10px] uppercase tracking-[0.2em] font-black text-slate-400 border-b border-slate-100 dark:border-slate-800">
                                <th class="px-6 py-5"># ID</th>
                                <th class="px-6 py-5">Pemohon & Tujuan</th>
                                <th class="px-6 py-5">Fasiliti / Dewan</th>
                                <th class="px-6 py-5">Tarikh & Masa</th>
                                <th class="px-6 py-5 text-center">Status</th>
                                <th class="px-6 py-5 text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-50 dark:divide-slate-800/50">
                            
                            <?php if(empty($senarai_permohonan)): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center opacity-60">
                                        <i class="fas fa-clipboard-check text-4xl mb-3"></i>
                                        <p class="font-bold text-base">Tiada Permohonan</p>
                                        <p class="text-xs">Sistem kini kosong daripada sebarang permohonan tempahan.</p>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                
                                <?php foreach($senarai_permohonan as $row): 
                                    $status = $row['approval_status'];
                                    if($status == 'Approved') {
                                        $badge = 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800';
                                        $icon = 'fa-check-circle';
                                        $status_text = 'LULUS';
                                    } elseif($status == 'Rejected') {
                                        $badge = 'bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 border-rose-200 dark:border-rose-800';
                                        $icon = 'fa-times-circle';
                                        $status_text = 'DITOLAK';
                                    } else {
                                        $badge = 'bg-amber-100 dark:bg-amber-500/20 text-amber-700 dark:text-amber-400 border-amber-300 dark:border-amber-800 shadow-sm';
                                        $icon = 'fa-hourglass-half animate-pulse';
                                        $status_text = 'TINDAKAN';
                                    }
                                ?>
                                <tr class="hover:bg-fuchsia-50/30 dark:hover:bg-fuchsia-900/10 transition-colors group <?php echo ($status == 'Pending') ? 'bg-amber-50/20 dark:bg-amber-900/5' : ''; ?>">
                                    <td class="px-6 py-4 font-black text-slate-400">
                                        #<?php echo str_pad($row['id'], 4, '0', STR_PAD_LEFT); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-slate-800 dark:text-white"><?php echo htmlspecialchars($row['pemohon'] ?? 'Pengguna'); ?></p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate max-w-[200px] mt-0.5"><?php echo htmlspecialchars($row['purpose']); ?></p>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-slate-700 dark:text-slate-200">
                                        <?php echo htmlspecialchars($row['hall_name']); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-slate-700 dark:text-slate-200 text-xs"><?php echo date("d M Y", strtotime($row['start_datetime'])); ?></p>
                                        <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest mt-0.5">
                                            <?php echo date("h:i A", strtotime($row['start_datetime'])) . ' - ' . date("h:i A", strtotime($row['end_datetime'])); ?>
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border <?php echo $badge; ?>">
                                            <i class="fas <?php echo $icon; ?>"></i> <?php echo $status_text; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <?php if($status == 'Pending'): ?>
                                            <button @click="actionModal = true; 
                                                            a_id = '<?php echo $row['id']; ?>';
                                                            a_dewan = '<?php echo addslashes($row['hall_name']); ?>';
                                                            a_tujuan = '<?php echo addslashes($row['purpose']); ?>';
                                                            a_mula = '<?php echo formatTarikhMasa($row['start_datetime']); ?>';
                                                            a_tamat = '<?php echo formatTarikhMasa($row['end_datetime']); ?>';
                                                            a_pemohon = '<?php echo addslashes($row['pemohon'] ?? 'Pengguna'); ?>';"
                                                    class="bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-fuchsia-500/30 dark:shadow-none transition-all hover:-translate-y-0.5">
                                                Semak
                                            </button>
                                        <?php else: ?>
                                            <span class="text-[10px] font-bold text-slate-300 dark:text-slate-600 uppercase italic">Selesai</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="fixed top-40 -left-20 w-64 h-64 bg-indigo-500/5 rounded-full blur-[80px] pointer-events-none -z-10"></div>
        </div>

        <?php include('footer.php'); ?>
    </main>

    <div x-show="actionModal" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4 sm:p-0">
        <div x-show="actionModal" x-transition.opacity class="fixed inset-0 bg-slate-900/70 backdrop-blur-md" @click="actionModal = false"></div>
        
        <div x-show="actionModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-16 scale-90 rotate-2"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100 rotate-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100 rotate-0"
             x-transition:leave-end="opacity-0 translate-y-16 scale-95 -rotate-2"
             class="bg-white dark:bg-slate-900 w-full max-w-xl rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.6)] relative z-10 overflow-hidden border border-slate-100 dark:border-slate-800 flex flex-col max-h-[90vh] transform-gpu">
            
            <div class="relative bg-slate-900 p-8 overflow-hidden isolate shrink-0 border-b border-slate-800">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-50 z-0"></div>
                <div class="absolute top-0 -left-10 w-40 h-40 bg-fuchsia-500 rounded-full mix-blend-screen filter blur-[50px] opacity-60 animate-blob z-0"></div>
                
                <div class="relative z-10 flex justify-between items-start text-white">
                    <div>
                        <span class="text-[10px] font-black text-fuchsia-300 uppercase tracking-[0.2em] mb-1 block">Tindakan Penyelia</span>
                        <h3 class="text-3xl font-outfit font-black tracking-tight" x-text="a_dewan"></h3>
                    </div>
                    <button @click="actionModal = false" class="w-10 h-10 rounded-full bg-white/10 hover:bg-rose-500 border border-white/20 flex items-center justify-center transition-all hover:rotate-90 backdrop-blur-sm shadow-sm text-white/70 hover:text-white">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-8 space-y-6 overflow-y-auto no-scrollbar">
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-50 dark:bg-slate-800/50 p-5 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5"><i class="fas fa-user text-indigo-400 mr-1"></i> Pemohon</p>
                        <p class="text-sm font-bold text-slate-800 dark:text-slate-200" x-text="a_pemohon"></p>
                    </div>
                    <div class="bg-slate-50 dark:bg-slate-800/50 p-5 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5"><i class="fas fa-edit text-indigo-400 mr-1"></i> Program</p>
                        <p class="text-sm font-bold text-slate-800 dark:text-slate-200 truncate" x-text="a_tujuan" :title="a_tujuan"></p>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-fuchsia-50 to-indigo-50 dark:from-fuchsia-900/10 dark:to-indigo-900/10 p-5 rounded-2xl border border-fuchsia-100 dark:border-fuchsia-800/30 flex justify-between items-center shadow-inner">
                    <div>
                        <p class="text-[9px] font-black text-fuchsia-500 uppercase tracking-widest mb-1">Mula Pada</p>
                        <p class="text-xs font-bold text-slate-800 dark:text-slate-200" x-text="a_mula"></p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 flex items-center justify-center text-slate-400 shadow-sm">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-[9px] font-black text-fuchsia-500 uppercase tracking-widest mb-1">Berakhir Pada</p>
                        <p class="text-xs font-bold text-slate-800 dark:text-slate-200" x-text="a_tamat"></p>
                    </div>
                </div>

                <hr class="border-slate-100 dark:border-slate-800">

                <form action="kelulusan.php" method="POST" id="approvalForm">
                    <input type="hidden" name="booking_id" x-bind:value="a_id">
                    
                    <div class="mb-6">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Catatan Kepada Pemohon (Pilihan)</label>
                        <textarea name="catatan" rows="3" placeholder="Contoh: Diluluskan bersyarat. Pastikan suis ditutup selepas guna." 
                                  class="w-full p-4 rounded-2xl bg-white dark:bg-slate-800/80 border-2 border-slate-200 dark:border-slate-700 focus:border-fuchsia-500 outline-none font-medium text-sm text-slate-800 dark:text-slate-200 transition-all placeholder-slate-400 dark:placeholder-slate-500 resize-none shadow-sm"></textarea>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" name="proses_tempahan" value="Tolak" @click="document.getElementById('keputusan_input').value = 'Rejected'"
                                class="flex-1 py-4 bg-white dark:bg-slate-800 border-2 border-rose-500 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/30 rounded-[1.5rem] font-black uppercase tracking-[0.15em] text-xs transition-all flex items-center justify-center gap-2 hover:-translate-y-1">
                            <i class="fas fa-times-circle text-lg"></i> Tolak
                        </button>
                        
                        <button type="submit" name="proses_tempahan" value="Lulus" @click="document.getElementById('keputusan_input').value = 'Approved'"
                                class="flex-1 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-white rounded-[1.5rem] font-black uppercase tracking-[0.15em] text-xs shadow-[0_10px_20px_-10px_rgba(16,185,129,0.5)] transition-all flex items-center justify-center gap-2 hover:-translate-y-1">
                            Luluskan <i class="fas fa-check-circle text-lg"></i>
                        </button>
                    </div>
                    
                    <input type="hidden" name="keputusan" id="keputusan_input" value="">
                </form>

            </div>
        </div>
    </div>

</body>
</html>