<x-layout>
   <x-page-heading>Edit Job: {{ $job->title }}</x-page-heading>

   <x-forms.form method="POST" action="/jobs/{{ $job->id }}">
      @method('PATCH')

      <x-forms.input label="Title" name="title" placeholder="CEO" :value="$job->title" />
      <x-forms.input label="Salary" name="salary" placeholder="$90,000 USD" :value="$job->salary" />
      <x-forms.input label="Location" name="location" placeholder="Winter Park, Florida" :value="$job->location" />

      <x-forms.select label="Schedule" name="schedule">
         <option
            value="Part Time" {{ old('schedule', $job->schedule) === 'Part Time' ? 'selected' : ''}}
         >
            Part Time
         </option>
         <option
            value="Full Time" {{ old('schedule', $job->schedule) === 'Full Time' ? 'selected' : ''}}
         >
            Full Time
         </option>
      </x-forms.select>

      <x-forms.input label="URL" name="url" placeholder="https://acme.com/jobs/ceo-wanted" :value="$job->url" />
      <x-forms.checkbox label="Feature (Costs Extra)" name="featured" :checked="old('featured', $job->featured)" />

      <x-forms.divider />

      <x-forms.input
         label="Tags (comma separated)"
         name="tags"
         placeholder="laravel, video, education"
         :value="$job->tags->pluck('name')->implode(', ')"
      />

      <div class="flex items-center gap-x-6 justify-end">
         <a
            href="/jobs/{{ $job->id }}"
            type="button"
            class="font-semibold text-gray-300 hover:underline hover:text-gray-400 transition-all duration-300"
         >
            Cancel
         </a>

         <x-forms.button type="submit">Update</x-forms.button>
      </div>
   </x-forms.form>
</x-layout>
