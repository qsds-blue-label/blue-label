<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidate;


class CadidateTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Candidate::factory()->create([
            'cadidate_name' => 'Juliet T. Uy',
            'cadidate_code' => 'JTU',
        ]);

        Candidate::factory()->create([
            'cadidate_name' => 'Oscar S. Moreno',
            'cadidate_code' => 'OSM',
        ]);

        Candidate::factory()->create([
            'cadidate_name' => 'Peter M. Unabia',
            'cadidate_code' => 'PMU',
        ]);
    }
}
