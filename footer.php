<footer class="mt-auto py-6 px-4 sm:px-8 border-t transition-all duration-300"
        :class="darkMode ? 'bg-slate-900/50 border-slate-800/50 backdrop-blur-md' : 'bg-white border-slate-200/50'">
    <div class="max-w-[95rem] mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
        
        <div class="text-center md:text-left">
            <p class="text-[11px] font-bold text-slate-500 dark:text-slate-400 tracking-wide">
                &copy; <?php echo date('Y'); ?> 
                <span class="text-indigo-600 dark:text-indigo-400 font-black">SmartDewan</span>. 
                Hak Cipta Terpelihara.
            </p>
            <p class="text-[9px] font-medium text-slate-400 dark:text-slate-500 mt-1 uppercase tracking-widest">
                Dibina dengan ❤️ untuk kemudahan pengurusan fasiliti
            </p>
        </div>

        <div class="flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">
            <div class="flex items-center gap-1.5 hover:text-emerald-500 transition-colors cursor-default">
                <i class="fas fa-shield-check text-emerald-500"></i>
                <span>Sistem Selamat</span>
            </div>
            
            <div class="w-1 h-1 rounded-full bg-slate-300 dark:bg-slate-700"></div>
            
            <div class="flex items-center gap-1.5 hover:text-indigo-500 transition-colors cursor-default">
                <i class="fas fa-code-branch"></i>
                <span>Versi 3.0</span>
            </div>
        </div>

    </div>
</footer>