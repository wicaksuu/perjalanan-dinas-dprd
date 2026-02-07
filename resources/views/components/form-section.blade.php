@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-10']) }}>
    <x-section-title>
        <x-slot name="title"><span class="text-slate-900 font-black text-xl tracking-tight">{{ $title }}</span></x-slot>
        <x-slot name="description"><span class="text-slate-500 font-medium text-sm">{{ $description }}</span></x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2 space-y-6">
        <div class="relative rounded-[2.5rem] shadow-xl shadow-slate-200/50">
             <!-- Glass Background -->
             <div class="absolute inset-0 bg-white/70 backdrop-blur-xl rounded-[2.5rem] border border-white -z-10"></div>

            <form wire:submit="{{ $submit }}" class="relative overflow-hidden rounded-[2.5rem]">
                <div class="px-8 py-10">
                    <div class="grid grid-cols-6 gap-8">
                        {{ $form }}
                    </div>
                </div>

                @if (isset($actions))
                    <div class="flex items-center justify-end px-8 py-5 bg-slate-50/50 border-t border-slate-100 text-end">
                        {{ $actions }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
