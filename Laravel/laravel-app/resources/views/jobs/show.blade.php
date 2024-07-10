<x-layout>
    <x-slot:heading>Job Description</x-slot:heading>
    <h2 class="font-bold text-lg">{{ $job['title'] }}</h2>
    <p class="mt-6">This job pays {{ $job['salary'] }} per year.</p>
</x-layout>
