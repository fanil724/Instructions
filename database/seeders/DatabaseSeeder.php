<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(40)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'is_admin' => mt_rand(0, 1),
            'is_blocked' => mt_rand(0, 1),
        ]);

        $this->call([
            InstructionsTableSeeder::class,
            ComplaintsInstructionsTableSeeder::class,

        ]);
    }
}
