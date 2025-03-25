@props(['employer', 'width' => 90])

<img
   src="{{ $employer->logo ? asset($employer->logo) : asset('lary-ai-face.svg') }}"
   class="rounded-lg"
   alt="logo employer"
   width="{{ $width }}"
>
