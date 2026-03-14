<?php
$title = isset($page_title) ? $page_title : "Sistem Tempahan Fasiliti";
$words = explode(" ", $nama_pegawai);
$initials = (count($words) >= 2) ? strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1)) : strtoupper(substr($nama_pegawai, 0, 2));

$notifikasi = []; $jumlah_notifikasi = 0;

if($group_id >= 2) {
    // NOTIFIKASI PENYELIA: Kelulusan Baru
    $sqlNoti = "SELECT id, purpose, created_at FROM bookings WHERE approval_status = 'Pending' ORDER BY created_at DESC LIMIT 5";
    $rsNoti = DB::Query($sqlNoti);
    if($rsNoti) {
        while($data = $rsNoti->fetchAssoc()) {
            $notifikasi[] = ['tajuk' => 'Kelulusan Diperlukan', 'mesej' => "Tempahan '{$data['purpose']}' menunggu kelulusan.", 'masa' => date("d M, h:i A", strtotime($data['created_at'])), 'ikon' => 'fa-clipboard-list text-amber-400', 'bg_ikon' => 'bg-amber-500/20 border border-amber-500/30', 'pautan' => 'kelulusan.php'];
            $jumlah_notifikasi++;
        }
    }
} else {
    // NOTIFIKASI PEMOHON: Status Kelulusan
    $sqlNoti = "SELECT b.id, b.approval_status, b.created_at, h.hall_name FROM bookings b LEFT JOIN halls h ON b.hall_id = h.hall_id WHERE b.user_id = " . db_prepare_string($user_db_id) . " AND b.approval_status != 'Pending' ORDER BY b.created_at DESC LIMIT 5";
    $rsNoti = DB::Query($sqlNoti);
    if($rsNoti) {
        while($data = $rsNoti->fetchAssoc()) {
            $is_lulus = ($data['approval_status'] == 'Approved');
            $notifikasi[] = ['tajuk' => $is_lulus ? 'Permohonan Lulus' : 'Permohonan Ditolak', 'mesej' => "Dewan {$data['hall_name']} " . strtolower($is_lulus ? 'Diluluskan' : 'Ditolak') . ".", 'masa' => date("d M, h:i A", strtotime($data['created_at'])), 'ikon' => $is_lulus ? 'fa-check-circle text-emerald-400' : 'fa-times-circle text-rose-400', 'bg_ikon' => $is_lulus ? 'bg-emerald-500/20 border border-emerald-500/30' : 'bg-rose-500/20 border border-rose-500/30', 'pautan' => 'senarai_tempahan.php'];
            $jumlah_notifikasi++;
        }
    }
}
?>

<header class="h-20 flex items-center justify-between px-4 lg:px-8 sticky top-0 z-30 transition-all duration-500 bg-slate-900/80 backdrop-blur-2xl border-b border-white/5 shadow-[0_4px_30px_-10px_rgba(0,0,0,0.5)]">
    
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 transition-colors border border-white/5">
            <i class="fas fa-bars text-lg"></i>
        </button>
        
        <div class="hidden sm:block">
            <h2 class="font-bold text-indigo-400 text-[9px] uppercase tracking-[0.3em] mb-0.5 opacity-80">Modul Sistem</h2>
            <p class="font-outfit font-black text-lg uppercase tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400">
                <?php echo $title; ?>
            </p>
        </div>
    </div>

    <div class="relative flex items-center gap-3 sm:gap-4">
        
        <button @click="darkMode = !darkMode" class="w-10 h-10 rounded-full flex items-center justify-center transition-all hover:scale-110 border bg-slate-800/50 border-slate-700/50 text-yellow-400 hover:shadow-[0_0_15px_rgba(250,204,21,0.3)]">
            <i class="fas" :class="darkMode ? 'fa-sun' : 'fa-moon'"></i>
        </button>

        <div class="relative" x-data="{ notiMenu: false }">
            <button @click="notiMenu = !notiMenu" @click.away="notiMenu = false" class="w-10 h-10 rounded-full flex items-center justify-center transition-all border relative hover:scale-110 bg-slate-800/50 border-slate-700/50 text-slate-300 hover:text-white hover:shadow-[0_0_15px_rgba(255,255,255,0.2)]">
                <i class="far fa-bell text-lg"></i>
                <?php if($jumlah_notifikasi > 0): ?>
                    <span class="absolute top-2 right-2.5 w-2.5 h-2.5 rounded-full bg-rose-500 border-2 border-slate-900 shadow-[0_0_10px_rgba(244,63,94,0.8)] animate-pulse"></span>
                <?php endif; ?>
            </button>
            
            <div x-show="notiMenu" x-cloak 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 class="absolute right-0 mt-4 w-80 sm:w-96 bg-slate-900/95 backdrop-blur-3xl rounded-[2rem] shadow-[0_20px_50px_-10px_rgba(0,0,0,0.7)] border border-slate-700/50 overflow-hidden z-50 flex flex-col max-h-[80vh]">
                
                <div class="px-6 py-5 border-b border-slate-800 flex justify-between items-center bg-gradient-to-r from-slate-800/50 to-transparent">
                    <h3 class="font-outfit font-black text-white tracking-wide">Notifikasi</h3>
                    <span class="bg-indigo-500/20 border border-indigo-500/30 text-indigo-300 px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest shadow-[0_0_10px_rgba(99,102,241,0.2)]"><?php echo $jumlah_notifikasi; ?> Baru</span>
                </div>
                
                <div class="overflow-y-auto no-scrollbar flex-1">
                    <?php if(empty($notifikasi)): ?>
                        <div class="px-6 py-12 text-center text-slate-500">
                            <i class="far fa-bell-slash text-4xl mb-4 opacity-40"></i>
                            <p class="font-bold text-sm">Tiada Notifikasi Semasa</p>
                        </div>
                    <?php else: ?>
                        <div class="divide-y divide-slate-800/50">
                            <?php foreach($notifikasi as $noti): ?>
                                <a href="<?php echo $noti['pautan']; ?>" class="flex items-start gap-4 p-5 hover:bg-white/5 transition-colors group">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 <?php echo $noti['bg_ikon']; ?> shadow-inner">
                                        <i class="fas <?php echo $noti['ikon']; ?>"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-200 group-hover:text-white transition-colors"><?php echo $noti['tajuk']; ?></p>
                                        <p class="text-xs text-slate-400 mt-1 line-clamp-2"><?php echo $noti['mesej']; ?></p>
                                        <p class="text-[9px] font-black text-indigo-400/70 uppercase tracking-widest mt-2"><i class="far fa-clock mr-1"></i> <?php echo $noti['masa']; ?></p>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="h-8 w-px bg-slate-700/50 mx-1 hidden sm:block"></div>

        <div class="relative" x-data="{ userMenu: false }">
            <button @click="userMenu = !userMenu" @click.away="userMenu = false" class="flex items-center gap-3 p-1 pl-4 pr-1.5 rounded-full transition-all border border-slate-700/50 hover:bg-white/5 bg-slate-900/50 shadow-sm group">
                <div class="text-right hidden md:block">
                    <p class="text-xs font-black leading-none mb-1 text-slate-200 group-hover:text-white transition-colors"><?php echo $nama_pegawai; ?></p>
                    <p class="text-[9px] font-black text-fuchsia-400 uppercase tracking-widest"><?php echo $role_pengguna; ?></p>
                </div>
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-black shadow-[0_0_15px_rgba(99,102,241,0.4)] border border-white/20">
                    <?php echo $initials; ?>
                </div>
            </button>
            
            <div x-show="userMenu" x-cloak 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 class="absolute right-0 mt-4 w-56 bg-slate-900/95 backdrop-blur-3xl rounded-3xl shadow-[0_20px_50px_-10px_rgba(0,0,0,0.7)] border border-slate-700/50 p-2 z-50">
                
                <div class="px-4 py-3 mb-2 border-b border-slate-800 md:hidden">
                    <p class="text-xs font-black text-white mb-0.5"><?php echo $nama_pegawai; ?></p>
                    <p class="text-[9px] font-black text-fuchsia-400 uppercase tracking-widest"><?php echo $role_pengguna; ?></p>
                </div>

                <a href="login.php?a=logout" class="flex items-center gap-3 px-4 py-3.5 text-xs font-bold text-rose-400 hover:text-white hover:bg-rose-500/20 rounded-2xl transition-all border border-transparent hover:border-rose-500/30">
                    <i class="fas fa-power-off text-lg"></i> Log Keluar Modul
                </a>
            </div>
        </div>

    </div>
</header>