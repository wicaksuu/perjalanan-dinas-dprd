<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-10']) }}>
    <x-section-title>
        <x-slot name="title"><span class="text-slate-900 font-black text-xl tracking-tight">{{ $title }}</span></x-slot>
        <x-slot name="description"><span class="text-slate-500 font-medium text-sm">{{ $description }}</span></x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="relative rounded-[2.5rem] shadow-xl shadow-slate-200/50">
            <!-- Glass Background -->
            <div class="absolute inset-0 bg-white/70 backdrop-blur-xl rounded-[2.5rem] border border-white -z-10"></div>

            <!-- Content -->
            <div class="px-8 py-10">
                {{ $content }}
            </div>
        </div>
    </div>
</div>
