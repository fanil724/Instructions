<?php

namespace Database\Seeders;

use App\Models\Instructions;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintsInstructionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 40; $i++) {
            \App\Models\ComplaintsInstructions::create([
                'title' => fake()->realText(10),
                'dexription' => fake()->realText(50),
                'users_id' => User::query()->inRandomOrder()->first()->id,
                'instructions_id' => Instructions::query()->inRandomOrder()->first()->id,
                'status' => mt_rand(0, 1)
            ]);
        }
    }
}
