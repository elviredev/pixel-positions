<x-layout>
   <x-page-heading>{{ $job->title }}</x-page-heading>

   <x-panel class="flex gap-x-6 p-6 hover:border-transparent">
      <div>
         <x-employer-logo :employer="$job->employer" width="125" />
      </div>

      <div class="flex flex-1 flex-col">
         <a href="#" class="self-start text-sm text-gray-400">{{ $job->employer->name }}</a>

         <h3 class="mt-3 text-xl font-bold group-hover:text-blue-500 transition-colors duration-300">
            <a href="{{ $job->url }}" target="_blank">{{ $job->title }}</a>
         </h3>
         <p class="mt-3 text-sm text-gray-400">{{ $job->salary }}</p>
         <p class="mt-3 text-sm text-gray-400">{{ $job->schedule }}</p>
      </div>

      <div class="space-x-1">
         <div class="space-x-1">
            @foreach($job->tags as $tag)
               <x-tag :$tag />
            @endforeach
         </div>
         <div class="mt-6">
            <p>{{ $job->location }}</p>
            <p class="mt-3 text-sm text-gray-400">Featured : {{ $job->featured ? 'Yes' : 'No' }}</p>
         </div>
      </div>
   </x-panel>

   @can('edit', $job)
      <div class="mt-6 flex justify-end">
         <x-forms.button>
            <a href="/jobs/{{ $job->id }}/edit">Edit job</a>
         </x-forms.button>
      </div>
   @endcan
</x-layout>
