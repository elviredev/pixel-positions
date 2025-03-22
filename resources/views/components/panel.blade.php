@php
    $classes = 'rounded-xl bg-white/5 p-4 border border-transparent hover:border-blue-500 transition-colors duration-300 group';
@endphp

<div {{ $attributes(['class' => $classes]) }}>
   {{ $slot }}
</div>
