<?php

namespace Database\Seeders;

use App\Models\Instruction;
use App\Models\User;
use App\Models\Complaint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 40; $i++) {
            Complaint::create([
                'title' => fake()->realText(10),
                'dexription' => fake()->realText(50),
                'user_id' => User::inRandomOrder()->first()->id,
                'instruction_id' => Instruction::inRandomOrder()->first()->id,
                'status' => mt_rand(0, 1)
            ]);
        }
    }
}
