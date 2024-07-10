<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => Job::with('employer')->get(),
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    if (!$job) {
        abort(404);
    }

    return view('job', [
        'job' => $job,
    ]);
});

Route::get('/contact', function () {
    return view('contact');
});
