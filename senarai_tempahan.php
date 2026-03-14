<?php
// 1. INTEGRASI TERAS PHPRUNNER & ZON MASA
require_once("include/dbcommon.php");
date_default_timezone_set('Asia/Kuala_Lumpur');

if(!isLogged()){
    header("Location: login.php");
    exit();
}

$login_user = $_SESSION["UserID"];

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

// Label untuk paparan menu/header
if ($group_id == 3) { $role_pengguna = "Pentadbir"; } 
elseif ($group_id == 2) { $role_pengguna = "Penyelia"; } 
else { $role_pengguna = "Pemohon"; }
// -----------------------------------------------------------

// 2. AMBIL REKOD TEMPAHAN PENGGUNA INI SAHAJA
$senarai_tempahan = [];
$strSQL = "SELECT b.id, b.purpose, b.start_datetime, b.end_datetime, b.approval_status, b.supervisor_remarks, b.created_at, h.hall_name 
           FROM bookings b 
           LEFT JOIN halls h ON b.hall_id = h.hall_id 
           WHERE b.user_id = " . db_prepare_string($user_db_id) . " 
           ORDER BY b.created_at DESC"; // Susun dari yang paling baru

$rs = DB::Query($strSQL);
if($rs) {
    while($data = $rs->fetchAssoc()) {
        $senarai_tempahan[] = $data;
    }
} else {
    die("Ralat Pangkalan Data: " . DB::LastError());
}

// Fungsi bantuan format tarikh (HARI DAHULU BARU BULAN)
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
        
        // Pembolehubah Modal Butiran (Kosmik)
        modalBuka: false,
        m_dewan: '', m_tujuan: '', m_mula: '', m_tamat: '', m_status: '', m_catatan: '', m_mohon: ''
      }" 
      :class="darkMode ? 'dark' : ''">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempahan Saya - SmartDewan</title>
    
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
        
        /* Custom Scrollbar untuk table responsif */
        .table-container::-webkit-scrollbar { height: 6px; }
        .table-container::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
        .dark .table-container::-webkit-scrollbar-thumb { background-color: #475569; }
    </style>
</head>

<body class="flex min-h-screen transition-colors duration-500 text-slate-800 dark:text-slate-200">

    <?php include('sidebar.php'); ?>

    <main class="flex-1 flex flex-col min-w-0 ml-0 lg:ml-64 transition-all duration-300">
        
        <?php 
        $page_title = "Senarai Tempahan Saya"; 
        include('header.php'); 
        ?>

        <div class="p-4 sm:p-8 max-w-7xl mx-auto w-full relative z-10">
            
            <div class="relative bg-black rounded-[2.5rem] p-8 sm:p-10 mb-8 overflow-hidden shadow-2xl border border-slate-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-50 z-0"></div>
                <div class="absolute top-0 -left-10 w-64 h-64 bg-indigo-600 rounded-full mix-blend-screen filter blur-[80px] opacity-40 z-0 animate-blob"></div>
                
                <div class="relative z-10">
                    <h2 class="text-3xl sm:text-4xl font-outfit font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 tracking-tight">Rekod Tempahan</h2>
                    <p class="text-sm font-medium text-indigo-200 mt-2">Pantau status permohonan penggunaan dewan anda di sini.</p>
                </div>
                <a href="tempah.php" class="relative z-10 group bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white px-6 py-3.5 rounded-2xl text-sm font-black uppercase tracking-widest shadow-[0_10px_25px_-5px_rgba(99,102,241,0.5)] transition-all hover:-translate-y-1 flex items-center gap-3 overflow-hidden">
                    <span class="relative z-10 flex items-center gap-2"><i class="fas fa-plus group-hover:rotate-90 transition-transform"></i> Tempah Baru</span>
                </a>
            </div>

            <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] shadow-xl border border-slate-100 dark:border-slate-800 overflow-hidden transform-gpu">
                
                <div class="table-container overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-800/50 text-[10px] uppercase tracking-[0.2em] font-black text-slate-400 border-b border-slate-100 dark:border-slate-800">
                                <th class="px-6 py-5"># ID</th>
                                <th class="px-6 py-5">Fasiliti / Dewan</th>
                                <th class="px-6 py-5">Tujuan</th>
                                <th class="px-6 py-5">Tarikh & Masa</th>
                                <th class="px-6 py-5 text-center">Status</th>
                                <th class="px-6 py-5 text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-50 dark:divide-slate-800/50">
                            
                            <?php if(empty($senarai_tempahan)): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center opacity-60">
                                        <div class="w-20 h-20 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-folder-open text-4xl"></i>
                                        </div>
                                        <p class="font-outfit font-black text-lg">Tiada Rekod Tempahan</p>
                                        <p class="text-xs font-medium mt-1">Anda belum membuat sebarang permohonan dewan.</p>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                
                                <?php foreach($senarai_tempahan as $index => $row): 
                                    // Tetapkan gaya warna status
                                    $status = $row['approval_status'];
                                    if($status == 'Approved') {
                                        $badge_bg = 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800';
                                        $icon = 'fa-check-circle';
                                        $status_text = 'Diluluskan';
                                    } elseif($status == 'Rejected') {
                                        $badge_bg = 'bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 border-rose-200 dark:border-rose-800';
                                        $icon = 'fa-times-circle';
                                        $status_text = 'Ditolak';
                                    } else {
                                        $badge_bg = 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-200 dark:border-amber-800';
                                        $icon = 'fa-hourglass-half animate-pulse';
                                        $status_text = 'Menunggu';
                                    }
                                ?>
                                <tr class="hover:bg-indigo-50/30 dark:hover:bg-indigo-900/10 transition-colors group">
                                    <td class="px-6 py-4 font-black text-slate-400 dark:text-slate-500">
                                        #<?php echo str_pad($row['id'], 4, '0', STR_PAD_LEFT); ?>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-slate-700 dark:text-slate-200">
                                        <?php echo htmlspecialchars($row['hall_name']); ?>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-400 max-w-[200px] truncate font-medium">
                                        <?php echo htmlspecialchars($row['purpose']); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-slate-700 dark:text-slate-200 text-xs"><?php echo date("d M Y", strtotime($row['start_datetime'])); ?></p>
                                        <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest mt-0.5">
                                            <?php echo date("h:i A", strtotime($row['start_datetime'])) . ' - ' . date("h:i A", strtotime($row['end_datetime'])); ?>
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border shadow-sm <?php echo $badge_bg; ?>">
                                            <i class="fas <?php echo $icon; ?>"></i> <?php echo $status_text; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button @click="modalBuka = true; 
                                                        m_dewan = '<?php echo addslashes($row['hall_name']); ?>';
                                                        m_tujuan = '<?php echo addslashes($row['purpose']); ?>';
                                                        m_mula = '<?php echo formatTarikhMasa($row['start_datetime']); ?>';
                                                        m_tamat = '<?php echo formatTarikhMasa($row['end_datetime']); ?>';
                                                        m_status = '<?php echo $status; ?>';
                                                        m_catatan = '<?php echo addslashes($row['supervisor_remarks'] ?? 'Tiada catatan'); ?>';
                                                        m_mohon = '<?php echo formatTarikhMasa($row['created_at']); ?>';"
                                                class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-indigo-600 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 flex items-center justify-center transition-all mx-auto shadow-sm group-hover:scale-105"
                                                title="Lihat Butiran Lengkap">
                                            <i class="fas fa-eye text-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-5 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center sm:text-left">
                    Memaparkan <span class="text-indigo-500"><?php echo count($senarai_tempahan); ?></span> rekod tempahan anda.
                </div>
            </div>

            <div class="fixed top-40 -right-20 w-64 h-64 bg-fuchsia-500/5 rounded-full blur-[80px] pointer-events-none -z-10"></div>
        </div>

        <?php include('footer.php'); ?>
    </main>

    <div x-show="modalBuka" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4 sm:p-0">
        <div x-show="modalBuka" x-transition.opacity class="fixed inset-0 bg-slate-900/70 backdrop-blur-md" @click="modalBuka = false"></div>
        
        <div x-show="modalBuka" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-16 scale-90 rotate-2"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100 rotate-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100 rotate-0"
             x-transition:leave-end="opacity-0 translate-y-16 scale-95 -rotate-2"
             class="bg-white dark:bg-slate-900 w-full max-w-md rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.6)] relative z-10 border border-slate-100 dark:border-slate-800 overflow-hidden transform-gpu">
            
            <div class="h-32 bg-gradient-to-br from-indigo-600 via-blue-600 to-cyan-600 relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-30"></div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/20 rounded-full blur-2xl"></div>
                
                <button @click="modalBuka = false" class="absolute top-5 right-5 w-8 h-8 flex items-center justify-center rounded-full bg-black/20 backdrop-blur-md text-white hover:bg-rose-500 hover:rotate-90 transition-all border border-white/20 shadow-sm">
                    <i class="fas fa-times"></i>
                </button>
                
                <div class="absolute -bottom-6 left-8 w-16 h-16 bg-white dark:bg-slate-800 rounded-2xl shadow-xl flex items-center justify-center text-3xl text-indigo-500 border-4 border-white/50 dark:border-slate-800/50 transform rotate-[-5deg] hover:rotate-0 transition-transform">
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
            
            <div class="px-8 pb-8 pt-10 space-y-6 relative">
                
                <div>
                    <span class="text-[9px] font-black text-indigo-500 uppercase tracking-widest mb-1 block">Maklumat Lengkap</span>
                    <h3 class="text-3xl font-outfit font-black text-slate-800 dark:text-white leading-tight tracking-tight" x-text="m_dewan"></h3>
                </div>

                <div class="relative flex items-center py-1">
                    <div class="absolute -left-12 w-6 h-6 rounded-full bg-slate-900/70"></div>
                    <div class="h-px w-full border-t-2 border-dashed border-slate-200 dark:border-slate-700"></div>
                    <div class="absolute -right-12 w-6 h-6 rounded-full bg-slate-900/70"></div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-500 flex items-center justify-center shrink-0 mt-1 border border-indigo-100 dark:border-indigo-500/20">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Tujuan Program</p>
                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200 leading-snug" x-text="m_tujuan"></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50 shadow-sm">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2"><i class="fas fa-play-circle text-emerald-500 mr-1"></i> Bermula</p>
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-300" x-text="m_mula"></p>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50 shadow-sm">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2"><i class="fas fa-stop-circle text-rose-500 mr-1"></i> Berakhir</p>
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-300" x-text="m_tamat"></p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between border-t border-b border-slate-100 dark:border-slate-800 py-4">
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Status Permohonan</p>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm border relative z-10"
                                  :class="{
                                      'bg-emerald-50 text-emerald-600 border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-800': m_status === 'Approved',
                                      'bg-rose-50 text-rose-600 border-rose-200 dark:bg-rose-500/10 dark:text-rose-400 dark:border-rose-800': m_status === 'Rejected',
                                      'bg-amber-50 text-amber-600 border-amber-200 dark:bg-amber-500/10 dark:text-amber-400 dark:border-amber-800': m_status === 'Pending'
                                  }">
                                  <i class="fas" :class="{'fa-check-circle': m_status==='Approved', 'fa-times-circle': m_status==='Rejected', 'fa-hourglass-half animate-pulse': m_status==='Pending'}"></i>
                                  <span x-text="m_status === 'Approved' ? 'Diluluskan' : (m_status === 'Rejected' ? 'Ditolak' : 'Menunggu')"></span>
                            </span>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Tarikh Mohon</p>
                            <p class="text-[10px] font-bold text-slate-500 dark:text-slate-400" x-text="m_mohon"></p>
                        </div>
                    </div>

                    <div class="bg-rose-50/50 dark:bg-rose-500/10 p-4 rounded-2xl border border-rose-100 dark:border-rose-900/30 relative overflow-hidden" x-show="m_catatan !== '' && m_catatan !== 'Tiada catatan'">
                        <div class="absolute -right-4 -top-4 w-16 h-16 bg-rose-200 dark:bg-rose-500/20 rounded-full blur-xl pointer-events-none"></div>
                        <p class="text-[10px] font-black text-rose-500 uppercase tracking-widest mb-1.5 relative z-10"><i class="fas fa-comment-dots mr-1"></i> Ulasan Penyelia</p>
                        <p class="text-sm font-medium text-slate-700 dark:text-slate-300 italic relative z-10" x-text="m_catatan"></p>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>