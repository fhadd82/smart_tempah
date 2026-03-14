<?php
require_once("include/dbcommon.php");
date_default_timezone_set('Asia/Kuala_Lumpur');
if(!isLogged()){ header("Location: login.php"); exit(); }
$current_page = basename($_SERVER['PHP_SELF']);
$login_user = $_SESSION["UserID"]; 
$message = ""; $message_type = "";

// --- RBAC PENGGUNA (GUNA COLUMN 'role' DARI TABLE users) ---
$strUser = "SELECT id, full_name, role FROM users WHERE username = " . db_prepare_string($login_user);
$rsUser = DB::Query($strUser);
$user_db_id = 0; $nama_pegawai = $login_user; $group_id = 1;

if($rsUser && $dataUser = $rsUser->fetchAssoc()){
    $user_db_id = $dataUser['id']; $nama_pegawai = ucwords(strtolower($dataUser['full_name'])); 
    $raw_role = strtolower(trim($dataUser['role']));
    if ($raw_role === '3' || $raw_role === 'admin' || $raw_role === 'pentadbir') { $group_id = 3; } 
    elseif ($raw_role === '2' || $raw_role === 'supervisor' || $raw_role === 'penyelia') { $group_id = 2; } 
    else { $group_id = 1; }
}
if ($group_id == 3) { $role_pengguna = "Pentadbir"; } elseif ($group_id == 2) { $role_pengguna = "Penyelia"; } else { $role_pengguna = "Pemohon"; }

$prefill_date = isset($_GET['tarikh']) ? $_GET['tarikh'] : "";

if(isset($_POST['submit_booking'])) {
    $hall_id = trim($_POST['hall_id']); 
    $purpose = trim($_POST['purpose']);
    $start_dt = $_POST['start_date'] . ' ' . $_POST['start_time'] . ':00';
    $end_dt = $_POST['end_date'] . ' ' . $_POST['end_time'] . ':00';
    $created_at = date('Y-m-d H:i:s');
    
    $sqlCheck = "SELECT count(*) as total FROM bookings WHERE hall_id = " . db_prepare_string($hall_id) . " AND approval_status IN ('Approved', 'Pending') AND ((start_datetime < " . db_prepare_string($end_dt) . " AND end_datetime > " . db_prepare_string($start_dt) . "))";
    $rsCheck = DB::Query($sqlCheck);
    $dataCheck = $rsCheck->fetchAssoc();

    if(strtotime($start_dt) >= strtotime($end_dt)) {
        $message = "Masa mula mesti lebih awal dari masa tamat."; $message_type = "error";
    } elseif($dataCheck['total'] > 0) {
        $message = "Maaf! Dewan tersebut telah ditempah pada waktu pilihan anda."; $message_type = "error";
    } else {
        $sqlInsert = "INSERT INTO bookings (user_id, hall_id, purpose, start_datetime, end_datetime, approval_status, created_at) VALUES (".db_prepare_string($user_db_id).", ".db_prepare_string($hall_id).", ".db_prepare_string($purpose).", ".db_prepare_string($start_dt).", ".db_prepare_string($end_dt).", 'Pending', ".db_prepare_string($created_at).")";
        if(DB::Exec($sqlInsert)) { $message = "Permohonan berjaya dihantar!"; $message_type = "success"; } 
        else { $message = "Ralat pangkalan data: " . DB::LastError(); $message_type = "error"; }
    }
}

$halls = [];
$rsHalls = DB::Query("SELECT * FROM halls WHERE status = 1 ORDER BY hall_name ASC"); 
if($rsHalls) { while($h = $rsHalls->fetchAssoc()) { $halls[] = $h; } }
?>

<!DOCTYPE html>
<html lang="ms" x-data="{ darkMode: $persist(false), sidebarOpen: window.innerWidth > 1024, userMenu: false }" :class="darkMode ? 'dark' : ''">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Borang Tempahan - SmartDewan</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
        
        .animation-delay-2000 { animation-delay: 2s; }
        
        input[type="date"]::-webkit-calendar-picker-indicator, input[type="time"]::-webkit-calendar-picker-indicator { cursor: pointer; opacity: 0.5; transition: 0.2s; } 
        input[type="date"]::-webkit-calendar-picker-indicator:hover, input[type="time"]::-webkit-calendar-picker-indicator:hover { opacity: 1; }
        .dark input[type="date"]::-webkit-calendar-picker-indicator, .dark input[type="time"]::-webkit-calendar-picker-indicator { filter: invert(1); }
        
        /* Kosmetik Input Kaca */
        .glass-input {
            background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02) inset;
        }
        .dark .glass-input {
            background: rgba(15, 23, 42, 0.6); border-color: rgba(255, 255, 255, 0.05); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2) inset; color: white;
        }
        .glass-input:focus { border-color: #6366f1; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); outline: none; background: white; }
        .dark .glass-input:focus { border-color: #6366f1; background: rgba(30, 41, 59, 0.8); }
    </style>
</head>
<body class="flex min-h-screen transition-colors duration-500 text-slate-800 dark:text-slate-200">
    
    <?php include('sidebar.php'); ?>
    
    <main class="flex-1 flex flex-col min-w-0 ml-0 lg:ml-64 transition-all duration-300 relative z-10">
        
        <?php $page_title = "Modul Tempahan"; include('header.php'); ?>
        
        <div class="p-4 sm:p-8 max-w-4xl mx-auto w-full relative z-10">
            
            <?php if($message): ?>
            <div class="mb-8 p-5 rounded-2xl border flex items-start gap-4 transition-all animate-in slide-in-from-top-4 <?php echo $message_type == 'success' ? 'bg-emerald-50 dark:bg-emerald-500/10 border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 shadow-lg shadow-emerald-500/20' : 'bg-rose-50 dark:bg-rose-500/10 border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-400 shadow-lg shadow-rose-500/20'; ?>">
                <div class="mt-0.5"><i class="fas <?php echo $message_type == 'success' ? 'fa-check-circle text-3xl' : 'fa-exclamation-triangle text-3xl animate-bounce'; ?>"></i></div>
                <div>
                    <h4 class="font-outfit font-black text-xl mb-1 tracking-tight"><?php echo $message_type == 'success' ? 'Tempahan Berjaya!' : 'Ralat Tempahan'; ?></h4>
                    <p class="font-semibold text-sm leading-relaxed"><?php echo $message; ?></p>
                    <?php if($message_type == 'success'): ?>
                        <a href="senarai_tempahan.php" class="inline-block mt-3 text-xs font-bold uppercase tracking-widest text-emerald-600 dark:text-emerald-400 hover:underline"><i class="fas fa-arrow-right mr-1"></i> Semak Status Anda</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-2xl border border-slate-100 dark:border-slate-800 overflow-hidden transform-gpu relative">
                
                <div class="relative bg-black p-8 sm:p-12 overflow-hidden isolate border-b border-slate-800">
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-50 z-0"></div>
                    <div class="absolute top-0 -left-10 w-96 h-96 bg-indigo-600 rounded-full mix-blend-screen filter blur-[100px] opacity-40 z-0 animate-blob"></div>
                    <div class="absolute bottom-0 -right-10 w-96 h-96 bg-fuchsia-600 rounded-full mix-blend-screen filter blur-[100px] opacity-40 z-0 animate-blob animation-delay-2000"></div>
                    
                    <div class="relative z-10 flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20 flex items-center justify-center text-3xl text-white shadow-[0_0_20px_rgba(255,255,255,0.2)]">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div>
                            <h3 class="text-3xl sm:text-4xl font-outfit font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 tracking-tight mb-1">Permohonan Baru</h3>
                            <p class="text-indigo-200 font-medium text-sm">Lengkapkan butiran program anda dengan tepat.</p>
                        </div>
                    </div>
                </div>

                <form action="tempah.php" method="POST" class="p-8 sm:p-12 space-y-8 relative z-20">
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-2">Pilih Fasiliti / Dewan <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-indigo-500"><i class="fas fa-building"></i></div>
                                <select name="hall_id" required class="glass-input w-full pl-12 pr-10 py-4 rounded-2xl font-bold text-sm cursor-pointer appearance-none">
                                    <option value="" disabled selected>-- Klik untuk pilih senarai dewan --</option>
                                    <?php foreach($halls as $hall): $nilai_id = isset($hall['hall_id']) ? $hall['hall_id'] : (isset($hall['id']) ? $hall['id'] : $hall['ID']); ?>
                                        <option value="<?php echo htmlspecialchars($nilai_id); ?>" class="text-slate-800"><?php echo htmlspecialchars($hall['hall_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-slate-400"><i class="fas fa-chevron-down text-xs"></i></div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-2">Tujuan Program <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-indigo-500"><i class="fas fa-edit"></i></div>
                                <input type="text" name="purpose" required placeholder="Contoh: Taklimat Pengurusan Suku Tahun Pertama" class="glass-input w-full pl-12 pr-5 py-4 rounded-2xl font-bold text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="p-6 sm:p-8 rounded-[2rem] bg-gradient-to-b from-slate-50 to-white dark:from-slate-800/50 dark:to-slate-900 border border-slate-200/50 dark:border-slate-800 shadow-inner"
                         x-data="{ 
                            t_mula: '<?php echo htmlspecialchars($prefill_date); ?>', 
                            t_tamat: '<?php echo htmlspecialchars($prefill_date); ?>',
                            m_mula: '',
                            m_tamat: ''
                         }">
                        
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 flex items-center justify-center"><i class="fas fa-clock"></i></div>
                            <h4 class="font-outfit font-black text-slate-800 dark:text-white text-lg">Ketetapan Tarikh & Masa</h4>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                            
                            <div class="space-y-3 relative">
                                <label class="block text-[10px] font-black uppercase tracking-widest text-emerald-500 ml-1"><i class="fas fa-play-circle mr-1"></i> Mula Pada</label>
                                <div class="flex gap-3">
                                    <div class="relative w-full">
                                        <input type="date" name="start_date" required 
                                               x-model="t_mula" 
                                               @change="
                                                  if(t_tamat < t_mula && t_tamat !== '') t_tamat = t_mula;
                                                  if(t_mula === t_tamat && m_tamat < m_mula && m_tamat !== '') m_tamat = m_mula;
                                               " 
                                               class="glass-input w-full px-4 py-3.5 rounded-xl font-bold text-sm" <?php if($prefill_date) echo 'title="Tarikh dipilih dari kalendar"'; ?>>
                                    </div>
                                    <div class="relative w-full">
                                        <input type="time" name="start_time" required 
                                               x-model="m_mula"
                                               @change="if(t_mula === t_tamat && m_tamat < m_mula && m_tamat !== '') m_tamat = m_mula;"
                                               class="glass-input w-full px-4 py-3.5 rounded-xl font-bold text-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="h-px w-full bg-slate-200 dark:bg-slate-700 md:hidden"></div>

                            <div class="space-y-3 relative">
                                <label class="block text-[10px] font-black uppercase tracking-widest text-rose-500 ml-1"><i class="fas fa-stop-circle mr-1"></i> Berakhir Pada</label>
                                <div class="flex gap-3">
                                    <div class="relative w-full">
                                        <input type="date" name="end_date" required 
                                               x-model="t_tamat" 
                                               :min="t_mula" 
                                               @change="if(t_mula === t_tamat && m_tamat < m_mula && m_tamat !== '') m_tamat = m_mula;"
                                               class="glass-input w-full px-4 py-3.5 rounded-xl font-bold text-sm cursor-pointer">
                                    </div>
                                    <div class="relative w-full">
                                        <input type="time" name="end_time" required 
                                               x-model="m_tamat"
                                               :min="t_mula === t_tamat ? m_mula : null"
                                               class="glass-input w-full px-4 py-3.5 rounded-xl font-bold text-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex items-start gap-2 p-3 bg-amber-50 dark:bg-amber-500/10 border border-amber-100 dark:border-amber-500/20 rounded-xl text-amber-600 dark:text-amber-400">
                            <i class="fas fa-info-circle mt-0.5"></i>
                            <p class="text-[10px] font-bold leading-relaxed">Sistem akan menyekat tempahan secara automatik sekiranya tarikh dan waktu yang anda pilih bertindih dengan sesi sedia ada di dalam kalendar.</p>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" name="submit_booking" class="group relative w-full py-5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-[1.5rem] font-black uppercase tracking-[0.15em] text-sm shadow-[0_15px_30px_-10px_rgba(99,102,241,0.5)] transition-all hover:-translate-y-1 hover:shadow-[0_20px_40px_-10px_rgba(99,102,241,0.6)] overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center gap-3">
                                Hantar Permohonan <i class="fas fa-paper-plane group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                        </button>
                    </div>

                </form>
            </div>
            
            <div class="fixed top-40 -left-20 w-64 h-64 bg-indigo-500/10 rounded-full blur-[80px] pointer-events-none -z-10"></div>
            <div class="fixed bottom-20 -right-20 w-64 h-64 bg-purple-500/10 rounded-full blur-[80px] pointer-events-none -z-10"></div>
            
        </div>
        <?php include('footer.php'); ?>
    </main>
    
    <style>
        @keyframes shimmer { 100% { transform: translateX(100%); } }
    </style>
</body>
</html>