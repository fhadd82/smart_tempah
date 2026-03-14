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

// --- AMBIL MAKLUMAT PENGGUNA & TETAPKAN KAWALAN AKSES (RBAC) ---
$strUser = "SELECT id, full_name, role FROM users WHERE username = " . db_prepare_string($login_user);
$rsUser = DB::Query($strUser);

$user_db_id = 0;
$nama_pegawai = $login_user; 
$role_pengguna = "Pemohon"; 
$group_id = 1;

if($rsUser && $dataUser = $rsUser->fetchAssoc()){
    $user_db_id = $dataUser['id'];
    $nama_pegawai = ucwords(strtolower($dataUser['full_name'])); 
    
    $peranan_db = strtolower(trim($dataUser['role']));
    if ($peranan_db === '3' || $peranan_db === 'admin' || $peranan_db === 'pentadbir') {
        $group_id = 3; $role_pengguna = "Pentadbir";
    } elseif ($peranan_db === '2' || $peranan_db === 'penyelia' || $peranan_db === 'supervisor') {
        $group_id = 2; $role_pengguna = "Penyelia";
    } else {
        $group_id = 1; $role_pengguna = "Pemohon";
    }
}

// --- PROSES TEMPAHAN PANTAS (DARI POP-UP DOUBLE CLICK) ---
if(isset($_POST['submit_quick_booking'])) {
    $hall_id = trim($_POST['hall_id']); 
    $purpose = trim($_POST['purpose']);
    
    $start_dt = $_POST['start_date'] . ' ' . $_POST['start_time'] . ':00';
    $end_dt = $_POST['end_date'] . ' ' . $_POST['end_time'] . ':00';
    $created_at = date('Y-m-d H:i:s');
    
    // SEMAKAN KETAT: Elak Pertindihan Masa & Dewan
    $sqlCheck = "SELECT count(*) as total FROM bookings 
                 WHERE hall_id = " . db_prepare_string($hall_id) . " 
                 AND approval_status IN ('Approved', 'Pending') 
                 AND ((start_datetime < " . db_prepare_string($end_dt) . " AND end_datetime > " . db_prepare_string($start_dt) . "))";
    
    $rsCheck = DB::Query($sqlCheck);
    $dataCheck = $rsCheck->fetchAssoc();

    // Validasi PHP: Pastikan Masa Tamat selepas Masa Mula
    if(strtotime($start_dt) >= strtotime($end_dt)) {
        $message = "Sila pastikan tarikh dan masa tamat adalah SELEPAS waktu mula.";
        $message_type = "error";
    } elseif($dataCheck['total'] > 0) {
        $message = "MAAF! Dewan yang dipilih telah pun ditempah pada masa tersebut. Sila pilih waktu lain.";
        $message_type = "error";
    } else {
        $sqlInsert = "INSERT INTO bookings (user_id, hall_id, purpose, start_datetime, end_datetime, approval_status, created_at) 
                      VALUES (".db_prepare_string($user_db_id).", ".db_prepare_string($hall_id).", ".db_prepare_string($purpose).", ".db_prepare_string($start_dt).", ".db_prepare_string($end_dt).", 'Pending', ".db_prepare_string($created_at).")";
        
        if(DB::Exec($sqlInsert)) {
            $message = "Berjaya! Tempahan anda telah dihantar dan sedang menunggu kelulusan.";
            $message_type = "success";
        } else {
            $message = "Ralat sistem: " . DB::LastError();
            $message_type = "error";
        }
    }
}

// --- AMBIL SENARAI DEWAN UNTUK POP-UP TEMPAHAN ---
$senarai_halls = [];
$strSQLHalls = "SELECT * FROM halls WHERE status = 1 ORDER BY hall_name ASC";
$rsHalls = DB::Query($strSQLHalls); 
if($rsHalls) { while($h = $rsHalls->fetchAssoc()) { $senarai_halls[] = $h; } }

// --- SAPAAN DINAMIK IKUT WAKTU ---
$jam_sekarang = (int)date('H');
if ($jam_sekarang >= 5 && $jam_sekarang < 12) { $ucapan = "Selamat Pagi"; $ikon_waktu = "fa-sun text-yellow-400"; $bg_sapaan = "bg-gradient-to-r from-amber-500/20 to-orange-500/20 border-amber-500/30"; }
elseif ($jam_sekarang >= 12 && $jam_sekarang < 17) { $ucapan = "Selamat Tengah Hari"; $ikon_waktu = "fa-cloud-sun text-sky-400"; $bg_sapaan = "bg-gradient-to-r from-sky-500/20 to-blue-500/20 border-sky-500/30"; }
elseif ($jam_sekarang >= 17 && $jam_sekarang < 20) { $ucapan = "Selamat Petang"; $ikon_waktu = "fa-sunset text-rose-400"; $bg_sapaan = "bg-gradient-to-r from-rose-500/20 to-pink-500/20 border-rose-500/30"; }
else { $ucapan = "Selamat Malam"; $ikon_waktu = "fa-moon text-indigo-400"; $bg_sapaan = "bg-gradient-to-r from-indigo-500/20 to-purple-500/20 border-indigo-500/30"; }

// 2. PARAMETER KALENDAR
$bulan = isset($_GET['bulan']) ? intval($_GET['bulan']) : intval(date('n'));
$tahun = isset($_GET['tahun']) ? intval($_GET['tahun']) : intval(date('Y'));

$nama_bulan_melayu = [
    1=>'Januari', 2=>'Februari', 3=>'Mac', 4=>'April', 5=>'Mei', 6=>'Jun',
    7=>'Julai', 8=>'Ogos', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Disember'
];
$nama_hari_pendek = ['Ahad', 'Isnin', 'Selasa', 'Rabu', 'Khamis', 'Jumaat', 'Sabtu'];

$prev_m = ($bulan == 1) ? 12 : $bulan - 1; $prev_y = ($bulan == 1) ? $tahun - 1 : $tahun;
$next_m = ($bulan == 12) ? 1 : $bulan + 1; $next_y = ($bulan == 12) ? $tahun + 1 : $tahun;

$hari_ini_num = intval(date('j')); $bulan_ini_num = intval(date('n')); $tahun_ini_num = intval(date('Y'));
$jumlah_hari_sebulan = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
$hari_pertama_minggu = date('w', mktime(0, 0, 0, $bulan, 1, $tahun));

// 3. AMBIL DATA TEMPAHAN (BOOKINGS)
$data_tempahan = array();
$tarikh_mula_bulan_ini = date('Y-m-d', mktime(0, 0, 0, $bulan, 1, $tahun));
$tarikh_tamat_bulan_ini = date('Y-m-d', mktime(23, 59, 59, $bulan, $jumlah_hari_sebulan, $tahun));

$strSQL = "SELECT b.id, b.purpose, b.start_datetime, b.end_datetime, b.approval_status, b.supervisor_remarks, h.hall_name 
           FROM bookings b LEFT JOIN halls h ON b.hall_id = h.hall_id 
           WHERE b.approval_status IN ('Approved', 'Pending')
           AND DATE(b.start_datetime) <= '$tarikh_tamat_bulan_ini'
           AND DATE(b.end_datetime) >= '$tarikh_mula_bulan_ini'
           ORDER BY b.start_datetime ASC";
$rs = DB::Query($strSQL);

if($rs) {
    while($data = $rs->fetchAssoc()){
        $mula_stamp = strtotime($data['start_datetime']);
        $tamat_stamp = strtotime($data['end_datetime']);
        
        $hari_mula_proses = max(1, (int)date('j', $mula_stamp) - (date('n', $mula_stamp) != $bulan ? cal_days_in_month(CAL_GREGORIAN, date('n', $mula_stamp), date('Y', $mula_stamp)) : 0));
        if(date('Y-m', $mula_stamp) < "$tahun-" . str_pad($bulan, 2, '0', STR_PAD_LEFT)){ $hari_mula_proses = 1; }
        $hari_tamat_proses = (int)date('j', $tamat_stamp);
        if(date('Y-m', $tamat_stamp) > "$tahun-" . str_pad($bulan, 2, '0', STR_PAD_LEFT)){ $hari_tamat_proses = $jumlah_hari_sebulan; }

        $is_multi_day = (date('Y-m-d', $mula_stamp) != date('Y-m-d', $tamat_stamp));

        for ($hari_semasa = $hari_mula_proses; $hari_semasa <= $hari_tamat_proses; $hari_semasa++) {
            $masa_papar = "";
            if ($is_multi_day) {
                if ($hari_semasa == $hari_mula_proses) { $masa_papar = date("h:i A", $mula_stamp) . " - 11:59 PM"; } 
                elseif ($hari_semasa == $hari_tamat_proses) { $masa_papar = "12:00 AM - " . date("h:i A", $tamat_stamp); } 
                else { $masa_papar = "Sepanjang Hari"; }
            } else {
                $masa_papar = date("h:i A", $mula_stamp) . " - " . date("h:i A", $tamat_stamp);
            }

            // MASA PENUH UNTUK MODAL (HARI BULAN TAHUN)
            $tarikh_mula_format = date("d", $mula_stamp) . " " . $nama_bulan_melayu[(int)date("n", $mula_stamp)] . " " . date("Y", $mula_stamp) . " (" . date("h:i A", $mula_stamp) . ")";
            $tarikh_tamat_format = date("d", $tamat_stamp) . " " . $nama_bulan_melayu[(int)date("n", $tamat_stamp)] . " " . date("Y", $tamat_stamp) . " (" . date("h:i A", $tamat_stamp) . ")";

            $data_tempahan[$hari_semasa][] = array(
                'id' => $data['id'],
                'dewan' => $data['hall_name'],
                'tujuan' => $data['purpose'],
                'masa_papar' => $masa_papar,
                'masa_penuh' => $tarikh_mula_format . ' — ' . $tarikh_tamat_format,
                'status' => $data['approval_status'],
                'catatan' => $data['supervisor_remarks']
            );
        }
    }
}

$total_lulus = 0; $total_pending = 0; $id_dikira = [];
foreach($data_tempahan as $hari => $senarai) {
    foreach($senarai as $t) {
        if(!in_array($t['id'], $id_dikira)){
             if($t['status'] == 'Approved') $total_lulus++;
             if($t['status'] == 'Pending') $total_pending++;
             $id_dikira[] = $t['id'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ms" 
      x-data="{ 
        darkMode: $persist(false), 
        sidebarOpen: window.innerWidth > 1024,
        userMenu: false,
        
        // Pembolehubah Modal Butiran Info
        modalBuka: false, 
        m_dewan: '', m_tujuan: '', m_masa: '', m_masa_penuh: '', m_status: '', m_catatan: '', m_tarikh: '',
        
        // Pembolehubah Modal Tempahan Pantas & Kawalan Tarikh/Masa Pintar
        bookingModal: false,
        b_tarikh: '', b_tarikh_tamat: '', b_tarikh_papar: '', b_masa_mula: '', b_masa_tamat: '',
        
        bukaTempahan(hari) {
            let bulan = String('<?php echo $bulan; ?>').padStart(2, '0');
            let tahun = '<?php echo $tahun; ?>';
            let hari_str = String(hari).padStart(2, '0');
            
            let selectedDate = `${tahun}-${bulan}-${hari_str}`;
            this.b_tarikh = selectedDate; 
            this.b_tarikh_tamat = selectedDate;
            this.b_masa_mula = ''; 
            this.b_masa_tamat = '';
            
            // Format paparan HARI BULAN TAHUN
            this.b_tarikh_papar = `${hari_str} <?php echo $nama_bulan_melayu[$bulan]; ?> ${tahun}`;
            this.bookingModal = true;
        }
      }" 
      :class="darkMode ? 'dark' : ''">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pintar - SmartDewan</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = { 
            darkMode: 'class',
            theme: {
                extend: {
                    animation: { blob: "blob 10s infinite alternate", shimmer: "shimmer 2s infinite" },
                    keyframes: {
                        blob: {
                            "0%": { transform: "translate(0px, 0px) scale(1)", filter: "hue-rotate(0deg)" },
                            "50%": { transform: "translate(40px, -60px) scale(1.2)", filter: "hue-rotate(45deg)" },
                            "100%": { transform: "translate(0px, 0px) scale(1)", filter: "hue-rotate(0deg)" },
                        },
                        shimmer: { "100%": { transform: "translateX(100%)" } }
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
        
        .calendar-grid { display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); gap: 16px; }
        
        .day-card { 
            min-height: 160px; background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6); border-radius: 1.5rem; padding: 0.75rem; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden; cursor: pointer;
        }
        .dark .day-card { background: rgba(15, 23, 42, 0.7); border-color: rgba(255, 255, 255, 0.03); box-shadow: 0 4px 20px rgba(0,0,0,0.4); }
        .day-card:hover { transform: translateY(-4px) scale(1.01); box-shadow: 0 25px 30px -10px rgba(0, 0, 0, 0.1); border-color: rgba(99,102,241,0.3); z-index: 10; }
        
        .day-card::after {
            content: '+ Dwi-Klik utk Tempah'; position: absolute; bottom: 8px; left: 0; right: 0; text-align: center;
            font-size: 8px; font-weight: 800; text-transform: uppercase; color: #6366f1; opacity: 0; transform: translateY(10px); transition: all 0.3s ease;
        }
        .day-card:hover::after { opacity: 0.7; transform: translateY(0); }
        
        .empty-card { background: transparent !important; border: 1px dashed #cbd5e1 !important; box-shadow: none !important; cursor: default; }
        .dark .empty-card { border-color: #1e293b !important; }
        .empty-card::after { display: none !important; }

        .event-pill { position: relative; overflow: hidden; z-index: 20; }
        .dim-effect { position: absolute; inset: 0; background: repeating-linear-gradient(45deg, transparent, transparent 5px, rgba(0,0,0,0.05) 5px, rgba(0,0,0,0.05) 10px); pointer-events: none; }
        .dark .dim-effect { background: repeating-linear-gradient(45deg, transparent, transparent 5px, rgba(255,255,255,0.05) 5px, rgba(255,255,255,0.05) 10px); }
        
        /* Glass Input dalam Modal Kosmik */
        .glass-input { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.5); transition: all 0.3s ease; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); }
        .dark .glass-input { background: rgba(15, 23, 42, 0.5); border-color: rgba(255, 255, 255, 0.1); color: white; box-shadow: inset 0 2px 4px rgba(0,0,0,0.2); }
        .glass-input:focus { border-color: #6366f1; background: white; box-shadow: 0 0 0 4px rgba(99,102,241,0.1); outline: none; }
        .dark .glass-input:focus { background: rgba(30, 41, 59, 0.9); border-color: #818cf8; box-shadow: 0 0 0 4px rgba(129,140,248,0.15); }
        
        input[type="date"]::-webkit-calendar-picker-indicator, input[type="time"]::-webkit-calendar-picker-indicator { cursor: pointer; opacity: 0.6; }
        .dark input[type="date"]::-webkit-calendar-picker-indicator, .dark input[type="time"]::-webkit-calendar-picker-indicator { filter: invert(1); }
        
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>

<body class="flex min-h-screen transition-colors duration-500 text-slate-800 dark:text-slate-200">

    <?php include('sidebar.php'); ?>

    <main class="flex-1 flex flex-col min-w-0 ml-0 lg:ml-64 transition-all duration-300">
        
        <?php $page_title = "Papan Pemuka Pintar"; include('header.php'); ?>

        <div class="p-4 sm:p-8 max-w-[95rem] mx-auto w-full">
            
            <?php if($message): ?>
            <div class="mb-6 p-5 rounded-2xl border flex items-start gap-4 transition-all animate-in slide-in-from-top-4 <?php echo $message_type == 'success' ? 'bg-emerald-50 dark:bg-emerald-500/10 border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 shadow-lg shadow-emerald-500/20' : 'bg-rose-50 dark:bg-rose-500/10 border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-400 shadow-lg shadow-rose-500/20'; ?>">
                <div class="mt-0.5"><i class="fas <?php echo $message_type == 'success' ? 'fa-check-circle text-3xl' : 'fa-exclamation-triangle text-3xl animate-bounce'; ?>"></i></div>
                <div>
                    <h4 class="font-outfit font-black text-xl mb-1 tracking-tight"><?php echo $message_type == 'success' ? 'Tempahan Berjaya Disimpan!' : 'Harap Maklum'; ?></h4>
                    <p class="font-semibold text-sm leading-relaxed"><?php echo $message; ?></p>
                </div>
            </div>
            <?php endif; ?>

            <div class="relative bg-black rounded-[2.5rem] p-8 sm:p-12 mb-10 overflow-hidden shadow-2xl border border-slate-800">
                <div class="absolute top-0 -left-10 w-96 h-96 bg-indigo-600 rounded-full mix-blend-screen filter blur-[100px] opacity-40 z-0 animate-blob"></div>
                <div class="absolute bottom-0 -right-10 w-96 h-96 bg-fuchsia-600 rounded-full mix-blend-screen filter blur-[100px] opacity-40 z-0 animate-blob animation-delay-2000"></div>
                
                <div class="relative z-10 flex flex-col xl:flex-row justify-between items-center gap-8">
                    <div class="text-center xl:text-left">
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 text-white text-[10px] font-black uppercase tracking-widest mb-6 shadow-inner <?php echo $bg_sapaan; ?>">
                            <i class="fas <?php echo $ikon_waktu; ?> text-sm"></i> <?php echo $ucapan; ?>
                        </div>
                        <h1 class="text-5xl sm:text-6xl font-outfit font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 mb-3 tracking-tight">
                            Hai, <?php echo explode(' ', $nama_pegawai)[0]; ?> 👋
                        </h1>
                        <p class="text-slate-400 text-base max-w-lg font-medium">Platform tempahan fasiliti kelas atasan. <br><span class="text-indigo-400 font-bold bg-indigo-500/20 px-2 py-0.5 rounded-md">Dwi-klik pada tarikh kosong</span> untuk menempah dengan pantas.</p>
                    </div>

                    <div class="flex gap-4 w-full xl:w-auto mt-4 xl:mt-0">
                        <div class="flex-1 xl:w-48 relative group">
                            <div class="absolute inset-0 bg-emerald-500 rounded-[2rem] blur-xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 p-6 rounded-[2rem] text-center transform transition-all group-hover:-translate-y-2">
                                <div class="w-12 h-12 mx-auto bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 rounded-full flex items-center justify-center text-xl mb-4 shadow-[0_0_15px_rgba(16,185,129,0.3)]"><i class="fas fa-check"></i></div>
                                <p class="text-4xl font-black text-white leading-none"><?php echo $total_lulus; ?></p>
                                <p class="text-[10px] text-emerald-300/70 font-bold uppercase tracking-widest mt-2">Sesi Diluluskan</p>
                            </div>
                        </div>
                        <div class="flex-1 xl:w-48 relative group">
                            <div class="absolute inset-0 bg-amber-500 rounded-[2rem] blur-xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 p-6 rounded-[2rem] text-center transform transition-all group-hover:-translate-y-2">
                                <div class="w-12 h-12 mx-auto bg-amber-500/20 border border-amber-500/30 text-amber-400 rounded-full flex items-center justify-center text-xl mb-4 shadow-[0_0_15px_rgba(245,158,11,0.3)]"><i class="fas fa-hourglass-half"></i></div>
                                <p class="text-4xl font-black text-white leading-none"><?php echo $total_pending; ?></p>
                                <p class="text-[10px] text-amber-300/70 font-bold uppercase tracking-widest mt-2">Menunggu Reviu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-6 px-2">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center shadow-lg shadow-indigo-500/30"><i class="far fa-calendar-alt text-xl"></i></div>
                    <h2 class="text-4xl font-outfit font-black tracking-tighter" :class="darkMode ? 'text-white' : 'text-slate-900'">
                        <?php echo $nama_bulan_melayu[$bulan]; ?> <span class="font-light text-slate-400 ml-1"><?php echo $tahun; ?></span>
                    </h2>
                </div>

                <div class="flex items-center bg-white dark:bg-slate-900 p-2 rounded-full border border-slate-200 dark:border-slate-800 shadow-[0_8px_30px_rgb(0,0,0,0.04)] dark:shadow-none">
                    <a href="?bulan=<?php echo $prev_m; ?>&tahun=<?php echo $prev_y; ?>" class="w-10 h-10 flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full text-slate-500 transition-colors"><i class="fas fa-chevron-left"></i></a>
                    <div class="h-6 w-px bg-slate-200 dark:bg-slate-700 mx-1"></div>
                    <form method="GET" class="px-2 flex gap-2 items-center">
                        <select name="bulan" onchange="this.form.submit()" class="bg-transparent border-none text-sm font-bold focus:ring-0 cursor-pointer outline-none appearance-none" :class="darkMode ? 'text-slate-200 bg-slate-900' : 'text-slate-800'">
                            <?php foreach($nama_bulan_melayu as $m => $n): ?><option value="<?php echo $m; ?>" <?php if($bulan == $m) echo 'selected'; ?>><?php echo $n; ?></option><?php endforeach; ?>
                        </select>
                        <select name="tahun" onchange="this.form.submit()" class="bg-transparent border-none text-sm font-bold focus:ring-0 cursor-pointer outline-none appearance-none" :class="darkMode ? 'text-slate-200 bg-slate-900' : 'text-slate-800'">
                            <?php for($y = $tahun - 2; $y <= $tahun + 2; $y++): ?><option value="<?php echo $y; ?>" <?php if($tahun == $y) echo 'selected'; ?>><?php echo $y; ?></option><?php endfor; ?>
                        </select>
                    </form>
                    <div class="h-6 w-px bg-slate-200 dark:bg-slate-700 mx-1"></div>
                    <a href="?bulan=<?php echo $next_m; ?>&tahun=<?php echo $next_y; ?>" class="w-10 h-10 flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full text-slate-500 transition-colors"><i class="fas fa-chevron-right"></i></a>
                </div>
            </div>

            <div class="mb-10">
                <div class="calendar-grid mb-3 px-4">
                    <?php foreach($nama_hari_pendek as $idx => $h): ?>
                        <div class="text-right text-[10px] font-black uppercase tracking-[0.15em] <?php echo ($idx==0 || $idx==6)?'text-rose-500 dark:text-rose-400':'text-slate-400 dark:text-slate-500'; ?>"><?php echo $h; ?></div>
                    <?php endforeach; ?>
                </div>

                <div class="calendar-grid">
                    <?php
                    for($i=0; $i<$hari_pertama_minggu; $i++) echo "<div class='day-card empty-card'></div>";

                    for($tgl=1; $tgl<=$jumlah_hari_sebulan; $tgl++):
                        $senarai = isset($data_tempahan[$tgl]) ? $data_tempahan[$tgl] : [];
                        $is_today = ($tgl == $hari_ini_num && $bulan == $bulan_ini_num && $tahun == $tahun_ini_num);
                    ?>
                        <div @dblclick="bukaTempahan(<?php echo $tgl; ?>)" 
                             class="day-card flex flex-col group <?php if($is_today) echo 'ring-2 ring-indigo-500 ring-offset-2 dark:ring-offset-slate-950 bg-indigo-50/30 dark:bg-indigo-900/10'; ?>">
                            
                            <div class="flex justify-between items-start mb-3 z-10 relative pointer-events-none">
                                <div class="mt-2 ml-1">
                                    <?php if(!empty($senarai)): ?><div class="w-1.5 h-1.5 rounded-full bg-indigo-500 shadow-[0_0_5px_rgba(99,102,241,0.8)]"></div><?php endif; ?>
                                </div>
                                <span class="w-8 h-8 flex items-center justify-center rounded-full text-sm font-black transition-all <?php if($is_today) echo 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/40'; else echo 'text-slate-500 dark:text-slate-400 group-hover:text-indigo-600 dark:group-hover:text-indigo-400'; ?>"><?php echo $tgl; ?></span>
                            </div>

                            <div class="flex-1 overflow-y-auto no-scrollbar space-y-2 pb-4">
                                <?php foreach($senarai as $t): 
                                    $is_approved = ($t['status'] == 'Approved');
                                    $pill_base = "event-pill p-2.5 rounded-xl border text-xs font-semibold cursor-pointer transition-all hover:scale-[1.02] shadow-sm";
                                    if($is_approved) {
                                        $pill_color = "bg-emerald-50 text-emerald-800 border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-300 dark:border-emerald-500/30";
                                        $status_dot = "bg-emerald-500";
                                    } else {
                                        $pill_color = "bg-amber-50 text-amber-800 border-amber-200 dark:bg-amber-500/10 dark:text-amber-300 dark:border-amber-500/30";
                                        $status_dot = "bg-amber-500 animate-pulse";
                                    }
                                ?>
                                    <div @dblclick.stop=""
                                         @click="modalBuka = true; 
                                                 m_dewan = '<?php echo addslashes($t['dewan'] ?? 'Dewan Tidak Diketahui'); ?>'; 
                                                 m_tujuan = '<?php echo addslashes($t['tujuan']); ?>'; 
                                                 m_masa = '<?php echo addslashes($t['masa_papar']); ?>'; 
                                                 m_masa_penuh = '<?php echo addslashes($t['masa_penuh']); ?>'; 
                                                 m_status = '<?php echo addslashes($t['status']); ?>'; 
                                                 m_catatan = '<?php echo addslashes($t['catatan']); ?>'; 
                                                 m_tarikh = '<?php echo $tgl . ' ' . $nama_bulan_melayu[$bulan] . ' ' . $tahun; ?>';"
                                         class="<?php echo "$pill_base $pill_color"; ?>" title="<?php echo htmlspecialchars($t['tujuan']); ?>">
                                        <div class="dim-effect"></div>
                                        <div class="relative z-10">
                                            <div class="flex items-center justify-between mb-1">
                                                <span class="text-[9px] font-black uppercase tracking-widest opacity-70 truncate"><?php echo htmlspecialchars($t['dewan'] ?? 'Dewan'); ?></span>
                                                <div class="w-1.5 h-1.5 rounded-full shrink-0 <?php echo $status_dot; ?>"></div>
                                            </div>
                                            <p class="truncate block leading-tight text-[11px] font-bold"><?php echo htmlspecialchars($t['tujuan']); ?></p>
                                            <p class="text-[9px] font-medium mt-1 opacity-80"><i class="far fa-clock mr-0.5"></i> <?php echo $t['masa_papar']; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                    <?php
                    $total_cells_used = $hari_pertama_minggu + $jumlah_hari_sebulan;
                    $remaining_cells = 7 - ($total_cells_used % 7);
                    if($remaining_cells < 7) { for($i=0; $i<$remaining_cells; $i++) echo "<div class='day-card empty-card'></div>"; }
                    ?>
                </div>
            </div>
        </div>

        <?php include('footer.php'); ?>
    </main>

    <div x-show="modalBuka" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-0">
        <div x-show="modalBuka" x-transition.opacity class="fixed inset-0 bg-slate-900/70 backdrop-blur-md" @click="modalBuka = false"></div>
        
        <div x-show="modalBuka" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-16 scale-90 rotate-2"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100 rotate-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100 rotate-0"
             x-transition:leave-end="opacity-0 translate-y-16 scale-95 -rotate-2"
             class="bg-white dark:bg-slate-900 w-full max-w-md rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.6)] relative z-10 border border-slate-100 dark:border-slate-800 overflow-hidden transform-gpu">
            
            <div class="h-36 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-40"></div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/20 rounded-full blur-2xl"></div>
                
                <button @click="modalBuka = false" class="absolute top-5 right-5 w-8 h-8 flex items-center justify-center rounded-full bg-black/20 backdrop-blur-md text-white hover:bg-rose-500 hover:rotate-90 transition-all border border-white/20">
                    <i class="fas fa-times"></i>
                </button>
                
                <div class="absolute -bottom-8 left-8 w-16 h-16 bg-white dark:bg-slate-800 rounded-2xl shadow-xl flex items-center justify-center text-3xl text-indigo-500 border-4 border-white/50 dark:border-slate-800/50 transform rotate-[-5deg] hover:rotate-0 transition-transform">
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
            
            <div class="px-8 pb-8 pt-12 space-y-6 relative">
                
                <div>
                    <span class="inline-block px-3 py-1 bg-indigo-50 text-indigo-600 dark:bg-indigo-500/20 dark:text-indigo-400 rounded-md text-[10px] font-black uppercase tracking-[0.2em] mb-2" x-text="m_tarikh"></span>
                    <h3 class="text-3xl font-outfit font-black text-slate-800 dark:text-white leading-tight tracking-tight" x-text="m_dewan"></h3>
                </div>

                <div class="relative flex items-center py-2">
                    <div class="absolute -left-12 w-6 h-6 rounded-full bg-slate-900/70"></div>
                    <div class="h-px w-full border-t-2 border-dashed border-slate-200 dark:border-slate-700"></div>
                    <div class="absolute -right-12 w-6 h-6 rounded-full bg-slate-900/70"></div>
                </div>

                <div class="space-y-5">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tujuan / Program</p>
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 leading-snug" x-text="m_tujuan"></p>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-500/20 text-indigo-500 flex items-center justify-center shrink-0"><i class="far fa-clock text-lg"></i></div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Jadual Masa Penuh</p>
                                <p class="text-xs font-bold text-slate-800 dark:text-slate-200 leading-tight" x-text="m_masa_penuh"></p>
                            </div>
                        </div>
                        
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50 relative overflow-hidden flex items-center justify-between">
                            <div class="absolute inset-0 opacity-10" :class="m_status === 'Approved' ? 'bg-emerald-500' : 'bg-amber-500'"></div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest relative z-10">Status Tempahan</p>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm relative z-10" :class="m_status === 'Approved' ? 'bg-emerald-500 text-white shadow-emerald-500/40' : 'bg-amber-500 text-white shadow-amber-500/40'">
                                <i class="fas" :class="m_status === 'Approved' ? 'fa-check-circle' : 'fa-hourglass-half animate-pulse'"></i> <span x-text="m_status === 'Approved' ? 'LULUS' : 'MENUNGGU'"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div x-show="m_catatan !== ''" class="p-4 bg-rose-50 dark:bg-rose-500/10 rounded-2xl border border-rose-100 dark:border-rose-900/30 relative">
                    <p class="text-[10px] font-black text-rose-500 uppercase tracking-widest mb-1.5"><i class="fas fa-comment-dots mr-1"></i> Ulasan Penyelia</p>
                    <p class="text-sm font-medium italic text-slate-700 dark:text-slate-300" x-text="m_catatan"></p>
                </div>
            </div>
        </div>
    </div>

    <div x-show="bookingModal" x-cloak class="fixed inset-0 z-[110] flex items-center justify-center p-4 sm:p-0">
        <div x-show="bookingModal" x-transition.opacity class="fixed inset-0 bg-slate-900/80 backdrop-blur-md" @click="bookingModal = false"></div>
        
        <div x-show="bookingModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90 translate-y-12 rotate-[-2deg]"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0 rotate-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-12"
             class="bg-white dark:bg-slate-900 w-full max-w-2xl rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.6)] relative z-10 border border-slate-100 dark:border-slate-800 overflow-hidden flex flex-col max-h-[90vh] transform-gpu">
            
            <div class="relative bg-slate-900 p-8 overflow-hidden isolate shrink-0 border-b border-slate-800">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-50 z-0"></div>
                <div class="absolute top-0 -left-10 w-40 h-40 bg-indigo-500 rounded-full mix-blend-screen filter blur-[50px] opacity-60 animate-blob z-0"></div>
                <div class="absolute bottom-0 -right-10 w-40 h-40 bg-purple-500 rounded-full mix-blend-screen filter blur-[50px] opacity-60 animate-blob animation-delay-2000 z-0"></div>
                
                <div class="relative z-10 flex justify-between items-center text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-xl text-yellow-300 shadow-[0_0_15px_rgba(253,224,71,0.3)]">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-outfit font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-300">Tempahan Pantas</h3>
                            <p class="text-indigo-200 text-xs font-medium mt-0.5">Sesi bermula <span class="font-bold text-white px-2 py-0.5 bg-white/10 rounded-md" x-text="b_tarikh_papar"></span></p>
                        </div>
                    </div>
                    <button @click="bookingModal = false" class="w-10 h-10 rounded-full bg-white/10 hover:bg-rose-500 border border-white/20 flex items-center justify-center transition-all hover:rotate-90 backdrop-blur-sm shadow-sm">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="p-8 overflow-y-auto no-scrollbar relative bg-slate-50/50 dark:bg-slate-900">
                
                <div class="mb-6 p-4 bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/30 rounded-2xl flex gap-3 text-amber-700 dark:text-amber-400 shadow-sm">
                    <i class="fas fa-shield-alt text-lg mt-0.5"></i>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest mb-0.5">Sistem Pintar Aktif</p>
                        <p class="text-xs font-semibold leading-relaxed">Tarikh dan masa yang bertindih dengan sesi sedia ada akan ditolak secara automatik. Sila pastikan kekosongan.</p>
                    </div>
                </div>

                <form action="menu.php" method="POST" class="space-y-6 relative z-10">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Fasiliti / Dewan <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-indigo-500"><i class="fas fa-building"></i></div>
                            <select name="hall_id" required class="glass-input w-full pl-10 pr-4 py-3.5 rounded-2xl font-bold text-sm outline-none cursor-pointer appearance-none">
                                <option value="" disabled selected>-- Pilih Dewan --</option>
                                <?php if(!empty($senarai_halls)): ?>
                                    <?php foreach($senarai_halls as $hall): $nilai_id = isset($hall['hall_id']) ? $hall['hall_id'] : (isset($hall['id']) ? $hall['id'] : $hall['ID']); ?>
                                        <option value="<?php echo htmlspecialchars($nilai_id); ?>" class="text-slate-800"><?php echo htmlspecialchars($hall['hall_name']); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400"><i class="fas fa-chevron-down text-xs"></i></div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Tujuan Program <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-indigo-500"><i class="fas fa-edit"></i></div>
                            <input type="text" name="purpose" required placeholder="Cth: Taklimat Pengurusan Suku Tahun" class="glass-input w-full pl-10 pr-4 py-3.5 rounded-2xl font-bold text-sm outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-white dark:bg-slate-800/50 rounded-3xl border border-slate-100 dark:border-slate-700/50 shadow-sm relative overflow-hidden">
                        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-indigo-50 dark:bg-indigo-500/5 rounded-full blur-xl pointer-events-none"></div>
                        
                        <div class="space-y-3 relative z-10">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-emerald-500 ml-1"><i class="fas fa-play-circle mr-1"></i> Tarikh & Mula</label>
                            <input type="date" name="start_date" required 
                                   x-model="b_tarikh" 
                                   readonly 
                                   class="glass-input w-full px-4 py-3 rounded-xl text-slate-500 font-bold text-xs cursor-not-allowed select-none opacity-80" title="Tarikh mula dikunci dari kalendar.">
                                   
                            <input type="time" name="start_time" required 
                                   x-model="b_masa_mula" 
                                   @change="if(b_tarikh === b_tarikh_tamat && b_masa_tamat < b_masa_mula && b_masa_tamat !== '') b_masa_tamat = b_masa_mula;" 
                                   class="glass-input w-full px-4 py-3 rounded-xl font-bold text-sm cursor-pointer">
                        </div>
                        
                        <div class="space-y-3 relative z-10">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-rose-500 ml-1"><i class="fas fa-stop-circle mr-1"></i> Tarikh & Tamat</label>
                            
                            <input type="date" name="end_date" required 
                                   x-model="b_tarikh_tamat" 
                                   :min="b_tarikh" 
                                   @change="if(b_tarikh === b_tarikh_tamat && b_masa_tamat < b_masa_mula && b_masa_tamat !== '') b_masa_tamat = b_masa_mula;" 
                                   class="glass-input w-full px-4 py-3 rounded-xl font-bold text-xs cursor-pointer">
                                   
                            <input type="time" name="end_time" required 
                                   x-model="b_masa_tamat" 
                                   :min="b_tarikh === b_tarikh_tamat ? b_masa_mula : null" 
                                   class="glass-input w-full px-4 py-3 rounded-xl font-bold text-sm cursor-pointer">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" name="submit_quick_booking" class="group relative w-full py-5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-[1.5rem] font-black uppercase tracking-[0.2em] text-xs shadow-[0_15px_30px_-10px_rgba(99,102,241,0.5)] transition-all hover:-translate-y-1 hover:shadow-[0_20px_40px_-10px_rgba(99,102,241,0.6)] overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center gap-3">
                                Hantar Tempahan <i class="fas fa-rocket group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-shimmer"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>