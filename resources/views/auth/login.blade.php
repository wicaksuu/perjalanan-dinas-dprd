<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-8 text-center">
            <h2 class="text-2xl font-black text-slate-800 tracking-tight mb-2">Login Aplikasi</h2>
            <p class="text-sm text-slate-500">Silakan masuk menggunakan akun Single Sign-On (SSO) resmi Kabupaten Madiun untuk mengakses dashboard.</p>
        </div>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <div class="space-y-4">
            <a href="{{ route('sso.redirect') }}" class="w-full flex items-center justify-center gap-4 px-6 py-4 bg-indigo-600 border-2 border-indigo-600 rounded-2xl text-white font-black text-lg hover:bg-white hover:text-indigo-600 hover:shadow-xl hover:shadow-indigo-500/20 transition-all duration-300 group">
                <div class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                </div>
                <span>Login dengan SSO Madiun Kab</span>
            </a>

            <div class="pt-6 border-t border-slate-100 mt-8 text-center">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
                    © {{ date('Y') }} DPRD KABUPATEN MADIUN<br>
                    SISTEM INFORMASI PERJALANAN DINAS
                </p>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
