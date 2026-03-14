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

// KAWALAN AKSES
if($group_id != 3) { die("<div style='padding:50px; text-align:center; font-family:sans-serif;'><h2>Akses Disekat</h2><p>Halaman ini dikhaskan untuk Pentadbir sistem.</p><br><a href='menu.php' style='background:#4f46e5;color:white;padding:10px 20px;border-radius:5px;text-decoration:none;'>Kembali</a></div>"); }

// TAMBAH DEWAN
if(isset($_POST['tambah_dewan'])) {
    $hall_name = trim($_POST['hall_name']); $capacity = intval($_POST['capacity']); $status = intval($_POST['status']);
    $sqlInsert = "INSERT INTO halls (hall_name, capacity, status) VALUES (" . db_prepare_string($hall_name) . ", $capacity, $status)";
    if(DB::Exec($sqlInsert)) { $message = "Dewan baharu ditambah."; }
}

// TUKAR STATUS
if(isset($_POST['tukar_status'])) {
    $hall_id = db_prepare_string($_POST['hall_id']); $new_status = intval($_POST['new_status']); 
    $sqlUpdate = "UPDATE halls SET status = $new_status WHERE hall_id = $hall_id";
    if(DB::Exec($sqlUpdate)) { $message = "Status dikemaskini."; }
}

$senarai_dewan = [];
$rs = DB::Query("SELECT * FROM halls ORDER BY status DESC, hall_name ASC");
if($rs) { while($data = $rs->fetchAssoc()) { $senarai_dewan[] = $data; } }
?>

<!DOCTYPE html>
<html lang="ms" x-data="{ darkMode: $persist(false), sidebarOpen: window.innerWidth > 1024, userMenu: false }" :class="darkMode ? 'dark' : ''">
<head>
    <meta charset="UTF-8"><title>Urus Fasiliti - SmartDewan</title>
    <script src="https://cdn.tailwindcss.com"></script><script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script><script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config = { darkMode: 'class' }</script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; } .font-outfit { font-family: 'Outfit', sans-serif; } [x-cloak] { display: none !important; }</style>
</head>
<body class="flex min-h-screen transition-colors" :class="darkMode ? 'bg-slate-950 text-slate-200' : 'bg-slate-50 text-slate-800'">
    <?php include('sidebar.php'); ?>
    <main class="flex-1 flex flex-col min-w-0 lg:ml-64">
        <?php $page_title = "Pengurusan Fasiliti"; include('header.php'); ?>
        <div class="p-4 sm:p-8 max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-xl overflow-hidden p-6 border border-slate-100 dark:border-slate-800">
                    <h3 class="font-outfit font-black text-xl mb-4">Tambah Dewan</h3>
                    <form method="POST" class="space-y-4">
                        <input type="text" name="hall_name" required placeholder="Nama Dewan" class="w-full p-3 rounded-xl bg-slate-50 dark:bg-slate-800 border focus:border-indigo-500 font-bold text-sm outline-none">
                        <input type="number" name="capacity" placeholder="Kapasiti" class="w-full p-3 rounded-xl bg-slate-50 dark:bg-slate-800 border focus:border-indigo-500 font-bold text-sm outline-none">
                        <select name="status" class="w-full p-3 rounded-xl bg-slate-50 dark:bg-slate-800 border font-bold text-sm outline-none cursor-pointer"><option value="1">Aktif</option><option value="0">Selenggara</option></select>
                        <button type="submit" name="tambah_dewan" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-xl transition-colors">SIMPAN</button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-[2rem] shadow-xl overflow-hidden border border-slate-100 dark:border-slate-800 p-2">
                <div class="overflow-x-auto">
                    <table class="w-full text-left whitespace-nowrap"><thead class="text-[10px] uppercase font-black text-slate-400 border-b border-slate-100 dark:border-slate-800"><tr><th class="p-4">Dewan</th><th class="p-4 text-center">Status</th><th class="p-4 text-right">Tindakan</th></tr></thead>
                    <tbody class="text-sm font-bold">
                        <?php foreach($senarai_dewan as $row): $isActive = ($row['status']==1); $h_id = isset($row['hall_id']) ? $row['hall_id'] : $row['id']; ?>
                        <tr class="border-b border-slate-50 dark:border-slate-800/50 hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="p-4"><?php echo htmlspecialchars($row['hall_name']); ?></td>
                            <td class="p-4 text-center"><span class="px-2 py-1 text-[9px] rounded-md <?php echo $isActive ? 'bg-emerald-100 text-emerald-600' : 'bg-rose-100 text-rose-600'; ?>"><?php echo $isActive ? 'AKTIF' : 'TUTUP'; ?></span></td>
                            <td class="p-4 text-right">
                                <form method="POST"><input type="hidden" name="hall_id" value="<?php echo htmlspecialchars($h_id); ?>"><input type="hidden" name="new_status" value="<?php echo $isActive?0:1; ?>"><button type="submit" name="tukar_status" class="text-[10px] bg-slate-100 dark:bg-slate-800 px-3 py-1.5 rounded-lg hover:bg-indigo-500 hover:text-white transition-colors"><i class="fas fa-sync-alt"></i> Tukar</button></form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody></table>
                </div>
            </div>

        </div>
        <?php include('footer.php'); ?>
    </main>
</body>
</html>