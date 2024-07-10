<x-layout>
    <x-slot:heading>Job Listings</x-slot:heading>
    <div class="space-y-4">
        @foreach($jobs as $job)
            <a href="/jobs/{{ $job['id'] }}"
               class="block px-6 py-6 border border-gray-200 rounded-lg hover:bg-gray-200 duration-100">
                <div class="font-bold text-blue-500 text-sm">{{$job->employer->name}}</div>
                <strong>{{ $job['title'] }}</strong>: Pays {{ $job['salary'] }} per year.
            </a>
        @endforeach
    </div>
</x-layout>
