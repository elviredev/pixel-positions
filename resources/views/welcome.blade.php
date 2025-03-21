<x-layout>
   <div class="space-y-10">
      <section class="text-center pt-6">
         <h1 class="font-bold text-4xl">Let's find your next job</h1>

         <form action="" class="mt-6">
            <input
               type="text"
               class="rounded-xl bg-white/5 border-white/10 px-5 py-4 w-full max-w-xl"
               placeholder="Web Developer..." >
         </form>
      </section>

      <section class="pt-10">
         <x-section-heading>Featured Jobs</x-section-heading>

         <div class="grid lg:grid-cols-3 gap-8 mt-6">
            <x-job-card />
            <x-job-card />
            <x-job-card />
         </div>
      </section>

      <section>
         <x-section-heading>Tags</x-section-heading>

         <div class="mt-6 space-x-1">
            <x-tag>Remote</x-tag>
            <x-tag>Remote</x-tag>
            <x-tag>Remote</x-tag>
            <x-tag>Remote</x-tag>
            <x-tag>Remote</x-tag>
            <x-tag>Remote</x-tag>
            <x-tag>Remote</x-tag>
            <x-tag>Remote</x-tag>
            <x-tag>Remote</x-tag>
            <x-tag>Remote</x-tag>
         </div>
      </section>

      <section>
         <x-section-heading>Recent Jobs</x-section-heading>

         <div class="mt-6 space-y-6">
            <x-job-card-large />
            <x-job-card-large />
            <x-job-card-large />
         </div>
      </section>
   </div>
</x-layout>
