<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(40)->create();


        \App\Models\User::factory()->create([
            'name' => 'fanil724',
            'email' => 'fanil724@fanil724.com',
            'password' => Hash::make('fanil724'),
            'is_admin' => true
        ]);



        $this->call([
            InstructionsTableSeeder::class,
            ComplaintsTableSeeder::class,
        ]);
    }
}
