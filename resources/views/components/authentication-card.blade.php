<div class="min-h-screen flex flex-col justify-center items-center p-6 space-y-10">
    <div class="animate-fade-in-up">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md bg-white/70 backdrop-blur-2xl rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-white/80 p-10 animate-fade-in-up transition-all duration-500 hover:shadow-blue-500/5" style="animation-delay: 100ms;">
        {{ $slot }}
    </div>
</div>
