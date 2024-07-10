<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Job::factory(100)->create();

        User::factory()->create([
            'first_name' => 'Test Name',
            'last_name' => 'Test Last Name',
            'email' => 'test@example.com',
        ]);
    }
}
