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

      {{-- Buttons for Delete job, Cancel action and Update job --}}
      <div class="mt-6 flex items-center justify-between gap-x-6">
         <div class="flex items-center">
            <button
               form="delete-form"
               onclick="confirmDelete(event)"
               class="text-red-500 text-sm lg:text-base font-semibold hover:text-red-600
               cursor-pointer hover:underline transition-all
               duration-300">Delete Job</button>
         </div>

         <div class="flex items-center gap-x-6">
            <a
               href="/jobs/{{ $job->id }}"
               type="button"
               class="font-semibold text-sm lg:text-base text-gray-300 hover:underline hover:text-gray-400 transition-all duration-300"
            >
               Cancel
            </a>

            <x-forms.button type="submit">Update</x-forms.button>
         </div>
      </div>
   </x-forms.form>

   {{-- Form for delete job --}}
   <x-forms.form
      method="POST"
      action="/jobs/{{ $job->id }}"
      id="delete-form"
      class="hidden"
   >
      @method('DELETE')
   </x-forms.form>

   <script>
      function confirmDelete(event) {
         event.preventDefault();
         Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
         }).then((result) => {
            if (result.isConfirmed) {
               document.getElementById('delete-form').submit();
            }
         });
      }
   </script>
</x-layout>


