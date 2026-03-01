<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body style="font-family: 'Outfit', sans-serif;" class="antialiased overflow-x-hidden">
        <!-- Modern Toaster / Notification System -->
        <div x-data="{ 
                notifications: [],
                add(notification) {
                    this.notifications.push({
                        id: Date.now(),
                        type: notification.type,
                        message: notification.message,
                        show: false
                    });
                    this.$nextTick(() => {
                        let n = this.notifications[this.notifications.length - 1];
                        n.show = true;
                        setTimeout(() => {
                            n.show = false;
                            setTimeout(() => {
                                this.notifications = this.notifications.filter(i => i.id !== n.id);
                            }, 500);
                        }, 4000);
                    });
                }
            }"
            @toast.window="add($event.detail)"
            class="fixed top-6 right-6 z-[9999] flex flex-col gap-3 pointer-events-none w-full max-w-sm"
        >
            <template x-for="n in notifications" :key="n.id">
                <div x-show="n.show"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="translate-x-full opacity-0 scale-90"
                    x-transition:enter-end="translate-x-0 opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="translate-x-0 opacity-100 scale-100"
                    x-transition:leave-end="translate-x-full opacity-0 scale-90"
                    class="pointer-events-auto group relative"
                >
                    <div :class="{
                        'bg-white/90 border-emerald-500/20 shadow-emerald-500/10': n.type === 'success',
                        'bg-white/90 border-rose-500/20 shadow-rose-500/10': n.type === 'error',
                        'bg-white/90 border-blue-500/20 shadow-blue-500/10': n.type === 'info'
                    }" class="backdrop-blur-xl border p-5 rounded-2xl shadow-2xl flex items-start gap-4">
                        
                        <!-- Icon Success -->
                        <template x-if="n.type === 'success'">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </template>

                        <!-- Icon Error -->
                        <template x-if="n.type === 'error'">
                            <div class="w-10 h-10 rounded-xl bg-rose-500/10 flex items-center justify-center text-rose-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                        </template>

                        <div class="flex-1 pt-0.5">
                            <h4 class="text-[10px] font-black uppercase tracking-widest mb-1" :class="{
                                'text-emerald-600': n.type === 'success',
                                'text-rose-600': n.type === 'error',
                                'text-blue-600': n.type === 'info'
                            }" x-text="n.type === 'success' ? 'Berhasil' : (n.type === 'error' ? 'Gagal' : 'Informasi')"></h4>
                            <p class="text-xs font-bold text-slate-600 leading-relaxed" x-text="n.message"></p>
                        </div>

                        <button @click="n.show = false" class="text-slate-300 hover:text-slate-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <x-banner />

        <!-- Check for flash sessions on load -->
        @if(session()->has('success'))
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    window.dispatchEvent(new CustomEvent('toast', { detail: { type: 'success', message: @json(session('success')) } }));
                });
            </script>
        @endif

        @if(session()->has('error'))
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    window.dispatchEvent(new CustomEvent('toast', { detail: { type: 'error', message: @json(session('error')) } }));
                });
            </script>
        @endif

        <div class="min-h-screen bg-slate-50">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        @stack('scripts')
    </body>
</html>
