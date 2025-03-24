@props(['employer', 'width' => 90])

<img
   src="{{ asset($employer->logo) }}"
   class="rounded-lg"
   alt="logo employer"
   width="{{ $width }}"
>
