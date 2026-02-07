<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl border-b border-slate-200/50 shadow-sm transition-all duration-500">
    <!-- Primary Navigation Menu -->
    <div class="relative z-50 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center gap-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <x-application-mark class="block h-9 w-auto transition-transform duration-500 group-hover:scale-110" />
                        <div class="flex flex-col">
                            <span class="text-xs font-black tracking-[0.2em] uppercase text-slate-900 leading-none">DPRD</span>
                            <span class="text-[9px] font-bold tracking-widest uppercase text-slate-400 leading-tight">Kab. Madiun</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="text-[11px] font-black uppercase tracking-widest">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link href="{{ route('kegiatan-dinas.index') }}" :active="request()->routeIs('kegiatan-dinas.*') && !request()->routeIs('kegiatan-dinas.laporan*') && !request()->routeIs('kegiatan-dinas.kalender*')" class="text-[11px] font-black uppercase tracking-widest">
                        Kegiatan Dinas
                    </x-nav-link>
                    
                    <x-nav-link href="{{ route('kegiatan-dinas.kalender') }}" :active="request()->routeIs('kegiatan-dinas.kalender')" class="text-[11px] font-black uppercase tracking-widest">
                        Kalender
                    </x-nav-link>

                    <div class="hidden sm:flex sm:items-center relative h-full" x-data="{ open: false }">
                        <button @click="open = ! open" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('kegiatan-dinas.laporan*') ? 'border-indigo-500 text-slate-900' : 'border-transparent text-slate-500' }} text-[11px] font-black uppercase tracking-widest leading-5 hover:text-indigo-600 hover:border-slate-300 focus:outline-none transition duration-300 ease-in-out">
                            <div>Analisa Laporan</div>
                            <div class="ms-1.5 opacity-50">
                                <svg class="fill-current h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>

                        <div x-show="open" @click.away="open = false" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 top-full mt-2 w-56 rounded-[1.5rem] shadow-2xl origin-top-left left-0 overflow-hidden" style="display: none;">
                            <div class="rounded-[1.5rem] ring-1 ring-black ring-opacity-5 py-2 bg-white/90 backdrop-blur-xl border border-white/50">
                                    <a href="{{ route('kegiatan-dinas.laporan-pimpinan') }}" class="flex items-center gap-3 w-full px-5 py-3 text-start text-xs font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-purple-600 focus:outline-none transition duration-300">
                                        <div class="w-8 h-8 rounded-xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                        </div>
                                        {{ __('Pimpinan') }}
                                    </a>
                                    <div class="border-t border-slate-100 mx-5 my-1"></div>
                                    <a href="{{ route('kegiatan-dinas.laporan') }}" class="flex items-center gap-3 w-full px-5 py-3 text-start text-xs font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-indigo-600 focus:outline-none transition duration-300">
                                    <div class="w-8 h-8 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    {{ __('Anggota') }}
                                </a>
                                <a href="{{ route('kegiatan-dinas.laporan-pegawai') }}" class="flex items-center gap-3 w-full px-5 py-3 text-start text-xs font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-emerald-600 focus:outline-none transition duration-300">
                                    <div class="w-8 h-8 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </div>
                                    {{ __('Staf') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Data Master Dropdown as nav-link style -->
                    <div class="hidden sm:flex sm:items-center relative h-full" x-data="{ open: false }">
                        <button @click="open = ! open" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-[11px] font-black uppercase tracking-widest leading-5 text-slate-500 hover:text-orange-500 hover:border-slate-300 focus:outline-none transition duration-300 ease-in-out">
                            <div>Data Master</div>
                            <div class="ms-1.5 opacity-50">
                                <svg class="fill-current h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>

                        <div x-show="open" @click.away="open = false" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 top-full mt-2 w-56 rounded-[1.5rem] shadow-2xl origin-top-left left-0 overflow-hidden" style="display: none;">
                            <div class="rounded-[1.5rem] ring-1 ring-black ring-opacity-5 py-2 bg-white/90 backdrop-blur-xl border border-white/50">
                                <a href="{{ route('komisi.index') }}" class="flex items-center gap-3 w-full px-5 py-3 text-start text-xs font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-orange-600 focus:outline-none transition duration-300">
                                    <div class="w-8 h-8 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center text-orange-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-1 4h1m-1 4h1"></path></svg>
                                    </div>
                                    {{ __('Komisi') }}
                                </a>
                                <!-- Data Pimpinan Link -->
                                <a href="{{ route('anggota.index', ['komisi_id' => 'pimpinan']) }}" class="flex items-center gap-3 w-full px-5 py-3 text-start text-xs font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-purple-600 focus:outline-none transition duration-300">
                                    <div class="w-8 h-8 rounded-xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                    {{ __('Data Pimpinan') }}
                                </a>
                                <a href="{{ route('anggota.index') }}" class="flex items-center gap-3 w-full px-5 py-3 text-start text-xs font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-blue-600 focus:outline-none transition duration-300">
                                    <div class="w-8 h-8 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                    {{ __('Anggota Dewan') }}
                                </a>
                                <div class="border-t border-slate-100 mx-5 my-1"></div>
                                <a href="{{ route('pegawai.index') }}" class="flex items-center gap-3 w-full px-5 py-3 text-start text-xs font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-emerald-600 focus:outline-none transition duration-300">
                                    <div class="w-8 h-8 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </div>
                                    {{ __('Pegawai Setwan') }}
                                </a>
                                <a href="{{ route('pendamping.index') }}" class="flex items-center gap-3 w-full px-5 py-3 text-start text-xs font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-indigo-600 focus:outline-none transition duration-300">
                                    <div class="w-8 h-8 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    </div>
                                    {{ __('Pendamping') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Manajemen Tim -->
                                    <div class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                        {{ __('Kelola Tim') }}
                                    </div>

                                    <!-- Pengaturan Tim -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Pengaturan Tim') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Buat Tim Baru') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <!-- Pengalih Tim -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-slate-100 mx-5 my-1"></div>

                                        <div class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                            {{ __('Ganti Tim') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-4 py-2 border border-slate-100 text-xs leading-4 font-black uppercase tracking-widest rounded-xl text-slate-600 bg-white/50 backdrop-blur-sm hover:text-blue-600 hover:bg-white hover:border-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-all duration-300">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 w-4 h-4 transition-transform duration-300 group-hover:translate-y-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Manajemen Akun -->
                            <div class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                {{ __('Kelola Akun') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profil') }}
                            </x-dropdown-link>

                             @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('Token API') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-slate-100 mx-5 my-1"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Keluar') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden fixed inset-0 z-40 pt-16">
        <!-- Backdrop -->
        <div @click="open = false" x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-slate-900/20 backdrop-blur-sm"></div>
        
        <!-- Menu Content -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="relative bg-white/90 backdrop-blur-2xl border-b border-slate-200 shadow-2xl max-h-[calc(100vh-4rem)] overflow-y-auto pb-8 rounded-b-[2.5rem]">
            <div class="pt-4 pb-3 space-y-1 px-4">
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="flex items-center gap-3 py-3 rounded-2xl">
                    <div class="w-8 h-8 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <span class="text-xs font-black uppercase tracking-widest">{{ __('Dashboard') }}</span>
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('kegiatan-dinas.index') }}" :active="request()->routeIs('kegiatan-dinas.*') && !request()->routeIs('kegiatan-dinas.laporan*') && !request()->routeIs('kegiatan-dinas.kalender*')" class="flex items-center gap-3 py-3 rounded-2xl">
                    <div class="w-8 h-8 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="text-xs font-black uppercase tracking-widest">{{ __('Kegiatan Dinas') }}</span>
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('kegiatan-dinas.kalender') }}" :active="request()->routeIs('kegiatan-dinas.kalender')" class="flex items-center gap-3 py-3 rounded-2xl">
                    <div class="w-8 h-8 rounded-xl bg-rose-50 flex items-center justify-center text-rose-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-xs font-black uppercase tracking-widest">{{ __('Kalender') }}</span>
                </x-responsive-nav-link>

                <!-- Section: Analisa Laporan -->
                <div class="pt-4 pb-2">
                    <div class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Analisa Laporan</div>
                    <div class="grid grid-cols-1 gap-2">
                        <x-responsive-nav-link href="{{ route('kegiatan-dinas.laporan-pimpinan') }}" :active="request()->routeIs('kegiatan-dinas.laporan-pimpinan')" class="flex items-center gap-3 py-3 rounded-2xl">
                            <div class="w-8 h-8 rounded-xl bg-purple-50 flex items-center justify-center text-purple-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest">{{ __('Laporan Pimpinan') }}</span>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('kegiatan-dinas.laporan') }}" :active="request()->routeIs('kegiatan-dinas.laporan') && !request()->routeIs('kegiatan-dinas.laporan-pimpinan') && !request()->routeIs('kegiatan-dinas.laporan-pegawai')" class="flex items-center gap-3 py-3 rounded-2xl">
                            <div class="w-8 h-8 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest">{{ __('Laporan Anggota') }}</span>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('kegiatan-dinas.laporan-pegawai') }}" :active="request()->routeIs('kegiatan-dinas.laporan-pegawai')" class="flex items-center gap-3 py-3 rounded-2xl">
                            <div class="w-8 h-8 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest">{{ __('Laporan Staf') }}</span>
                        </x-responsive-nav-link>
                    </div>
                </div>

                <!-- Section: Data Master -->
                <div class="pt-4 pb-2">
                    <div class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Data Master</div>
                    <div class="grid grid-cols-1 gap-2">
                        <x-responsive-nav-link href="{{ route('komisi.index') }}" :active="request()->routeIs('komisi.*')" class="flex items-center gap-3 py-3 rounded-2xl">
                            <div class="w-8 h-8 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-1 4h1m-1 4h1"></path></svg>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest">{{ __('Komisi') }}</span>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('anggota.index') }}" :active="request()->routeIs('anggota.*')" class="flex items-center gap-3 py-3 rounded-2xl">
                            <div class="w-8 h-8 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest">{{ __('Anggota Dewan') }}</span>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('pegawai.index') }}" :active="request()->routeIs('pegawai.*')" class="flex items-center gap-3 py-3 rounded-2xl">
                            <div class="w-8 h-8 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest">{{ __('Pegawai Setwan') }}</span>
                        </x-responsive-nav-link>
                    </div>
                </div>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-6 pb-4 border-t border-slate-200 px-4">
                <div class="flex items-center gap-4 px-4 mb-6">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0">
                            <img class="size-12 rounded-2xl object-cover ring-4 ring-white shadow-lg" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div class="flex flex-col">
                        <div class="font-black text-sm text-slate-900 uppercase tracking-widest">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-[10px] text-slate-500 tracking-wider">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="space-y-1">
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" class="flex items-center gap-3 py-3 rounded-2xl">
                        <div class="w-8 h-8 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <span class="text-xs font-black uppercase tracking-widest">{{ __('Profil') }}</span>
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();" class="flex items-center gap-3 py-3 rounded-2xl text-rose-600">
                            <div class="w-8 h-8 rounded-xl bg-rose-50 flex items-center justify-center text-rose-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest">{{ __('Keluar') }}</span>
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
