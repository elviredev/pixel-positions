@props(['job'])

<x-panel class="flex gap-x-6">
   <div>
      <x-employer-logo :employer="$job->employer" />
   </div>

   <div class="flex flex-1 flex-col">
      <a href="#" class="self-start text-sm text-gray-400">{{ $job->employer->name }}</a>

      <h3 class="mt-3 text-xl font-bold group-hover:text-blue-500 transition-colors duration-300">
         <a href="{{ $job->url }}" target="_blank">{{ $job->title }}</a>
      </h3>
      <p class="mt-auto text-sm text-gray-400">{{ $job->salary }}</p>
   </div>

   <div class="flex flex-col justify-between">
      <div class="space-x-1">
         @foreach($job->tags as $tag)
            <x-tag :$tag />
         @endforeach
      </div>

      <div class="flex justify-end">
         <a href="/jobs/{{ $job->id }}" class="group-hover:text-green-500 font-bold transition-colors duration-300">Details</a>
      </div>
   </div>
</x-panel>
