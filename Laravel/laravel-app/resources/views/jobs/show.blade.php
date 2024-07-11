<x-layout>
    <x-slot:heading>Job Description</x-slot:heading>
    <h2 class="font-bold text-lg">{{ $job->title }}</h2>
    <p class="mt-6">This job pays {{ $job->salary }} per year.</p>
    <div class="mt-6">
        <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
    </div>
</x-layout>
