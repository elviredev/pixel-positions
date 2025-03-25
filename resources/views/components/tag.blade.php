@props(['tag', 'size' => 'base'])

@php
    $classes = 'inline-block mt-1 bg-white/10 hover:bg-white/25 rounded-xl font-bold transition-colors duration-300';

    if ($size === 'base') {
      $classes .= ' px-5 py-1 text-xs lg:text-sm';
    } elseif ($size === 'small') {
      $classes .= ' px-3 py-1 text-2xs';
    }
@endphp

<a href="/tags/{{ strtolower($tag->name) }}" class="{{ $classes }}">
   {{ $tag->name }}
</a>
