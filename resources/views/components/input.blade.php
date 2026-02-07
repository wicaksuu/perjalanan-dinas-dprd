@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-slate-200 text-slate-900 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm transition-all duration-200 placeholder-slate-400']) !!}>
