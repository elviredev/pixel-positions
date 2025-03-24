@props(['job'])

<x-panel class="flex flex-col text-center">
   <div class="flex justify-between">
      <div class="self-start text-sm">{{ $job->employer->name }}</div>
      <a href="/jobs/{{ $job->id }}" class="group-hover:text-green-500 font-bold transition-colors duration-300">Details</a>
   </div>

   <div class="py-8">
      <h3 class="group-hover:text-blue-500 text-xl font-bold transition-colors duration-300">
         <a href="{{ $job->url }}" target="_blank">{{ $job->title }}</a>
      </h3>
      <p class="text-sm mt-4">{{ $job->salary }}</p>
   </div>

   <div class="flex justify-between items-center mt-auto">
      <div class="space-x-1">
         @foreach($job->tags as $tag)
            <x-tag size="small" :$tag />
         @endforeach
      </div>

      <x-employer-logo :employer="$job->employer" :width="42" />
   </div>
</x-panel>
