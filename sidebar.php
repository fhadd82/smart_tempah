<div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-slate-950/80 lg:hidden backdrop-blur-md" @click="sidebarOpen = false"></div>

<aside class="fixed inset-y-0 left-0 z-50 w-64 transition-transform duration-500 transform bg-slate-900/95 backdrop-blur-3xl border-r border-slate-800 lg:translate-x-0 overflow-hidden"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    
    <div class="absolute top-0 -left-20 w-40 h-40 bg-indigo-600 rounded-full mix-blend-screen filter blur-[60px] opacity-20 pointer-events-none"></div>
    <div class="absolute bottom-40 -right-20 w-40 h-40 bg-purple-600 rounded-full mix-blend-screen filter blur-[60px] opacity-20 pointer-events-none"></div>

    <div class="relative h-20 flex items-center justify-between px-6 border-b border-slate-800/60 bg-slate-900/50">
        <div class="flex items-center gap-3">
            <div class="relative flex items-center justify-center w-8 h-8">
                <div class="absolute inset-0 bg-indigo-500 rounded-xl blur shadow-[0_0_15px_rgba(99,102,241,0.5)]"></div>
                <div class="relative w-full h-full rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-black text-lg border border-white/20">
                    S
                </div>
            </div>
            <span class="text-xl font-outfit font-black tracking-tight text-white">Smart<span class="text-indigo-400">Dewan</span></span>
        </div>
        <button @click="sidebarOpen = false" class="lg:hidden w-8 h-8 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center text-slate-400 hover:text-white transition-all">
            <i class="fas fa-times text-sm"></i>
        </button>
    </div>

    <div class="relative p-4 overflow-y-auto h-[calc(100vh-5rem)] no-scrollbar space-y-1 z-10">
        
        <p class="px-4 text-[9px] font-black text-indigo-400 uppercase tracking-[0.2em] mb-3 mt-4 opacity-80">Menu Utama</p>
        
        <a href="menu.php" class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all <?php echo ($current_page == 'menu.php') ? 'bg-gradient-to-r from-indigo-500/20 to-purple-500/10 text-indigo-300 border border-indigo-500/30 shadow-[0_0_20px_-5px_rgba(99,102,241,0.3)]' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200'; ?>">
            <div class="<?php echo ($current_page == 'menu.php') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-indigo-400'; ?> transition-colors">
                <i class="fas fa-home w-5"></i>
            </div>
            Papan Pemuka
        </a>
        
        <a href="tempah.php" class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all <?php echo ($current_page == 'tempah.php') ? 'bg-gradient-to-r from-indigo-500/20 to-purple-500/10 text-indigo-300 border border-indigo-500/30 shadow-[0_0_20px_-5px_rgba(99,102,241,0.3)]' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200'; ?>">
            <div class="<?php echo ($current_page == 'tempah.php') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-indigo-400'; ?> transition-colors">
                <i class="fas fa-calendar-plus w-5"></i>
            </div>
            Buat Tempahan
        </a>
        
        <a href="senarai_tempahan.php" class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all <?php echo ($current_page == 'senarai_tempahan.php') ? 'bg-gradient-to-r from-indigo-500/20 to-purple-500/10 text-indigo-300 border border-indigo-500/30 shadow-[0_0_20px_-5px_rgba(99,102,241,0.3)]' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200'; ?>">
            <div class="<?php echo ($current_page == 'senarai_tempahan.php') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-indigo-400'; ?> transition-colors">
                <i class="fas fa-list w-5"></i>
            </div>
            Tempahan Saya
        </a>

        <?php if($group_id >= 2): ?>
        <div class="pt-4 pb-1">
            <div class="h-px w-full bg-gradient-to-r from-transparent via-slate-700 to-transparent"></div>
        </div>
        <p class="px-4 text-[9px] font-black text-fuchsia-400 uppercase tracking-[0.2em] mb-3 mt-2 opacity-80">Tugas Penyelia</p>
        
        <a href="kelulusan.php" class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all <?php echo ($current_page == 'kelulusan.php') ? 'bg-gradient-to-r from-fuchsia-500/20 to-pink-500/10 text-fuchsia-300 border border-fuchsia-500/30 shadow-[0_0_20px_-5px_rgba(217,70,239,0.3)]' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200'; ?>">
            <div class="<?php echo ($current_page == 'kelulusan.php') ? 'text-fuchsia-400' : 'text-slate-500 group-hover:text-fuchsia-400'; ?> transition-colors">
                <i class="fas fa-clipboard-check w-5"></i>
            </div>
            Kelulusan Dewan
        </a>
        <?php endif; ?>

        <?php if($group_id == 3): ?>
        <div class="pt-4 pb-1">
            <div class="h-px w-full bg-gradient-to-r from-transparent via-slate-700 to-transparent"></div>
        </div>
        <p class="px-4 text-[9px] font-black text-emerald-400 uppercase tracking-[0.2em] mb-3 mt-2 opacity-80">Pengurusan Sistem</p>
        
        <a href="urus_dewan.php" class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all <?php echo ($current_page == 'urus_dewan.php') ? 'bg-gradient-to-r from-emerald-500/20 to-teal-500/10 text-emerald-300 border border-emerald-500/30 shadow-[0_0_20px_-5px_rgba(16,185,129,0.3)]' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200'; ?>">
            <div class="<?php echo ($current_page == 'urus_dewan.php') ? 'text-emerald-400' : 'text-slate-500 group-hover:text-emerald-400'; ?> transition-colors">
                <i class="fas fa-building w-5"></i>
            </div>
            Urus Fasiliti
        </a>
        <?php endif; ?>

    </div>
</aside>