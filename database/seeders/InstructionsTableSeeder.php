<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class InstructionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = Storage::files('public/Instructions/');
        $fileNames = array_map('basename', $files);

        for ($i = 0; $i < 40; $i++) {
            \App\Models\Instruction::create([
                'title' => fake()->realText(10),
                'description' => fake()->realText(50),
                'file' => 'instructions/' . $fileNames[mt_rand(0, count($fileNames) - 1)],
                'is_moderation' => mt_rand(0, 1),
                'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
