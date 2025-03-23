@props(['job'])

<x-panel class="flex gap-x-6">
   <div>
      <x-employer-logo />
   </div>

   <div class="flex flex-1 flex-col">
      <a href="#" class="self-start text-sm text-gray-400">{{ $job->employer->name }}</a>

      <h3 class="mt-3 text-xl font-bold group-hover:text-blue-500 transition-colors duration-300">
         {{ $job->title }}
      </h3>
      <p class="mt-auto text-sm text-gray-400">{{ $job->salary }}</p>
   </div>

   <div class="space-x-1">
      <div class="space-x-1">
         @foreach($job->tags as $tag)
            <x-tag :$tag />
         @endforeach
      </div>
   </div>
</x-panel>
