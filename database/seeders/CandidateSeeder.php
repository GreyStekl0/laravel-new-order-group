<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Candidate::create(['name' => 'Против всех']);
        Candidate::create(['name' => 'Недействительные бюллетени']);
    }
}
