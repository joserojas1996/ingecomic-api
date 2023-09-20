<?php

namespace Database\Seeders;

use App\Models\Tools\Sequence;
use Illuminate\Database\Seeder;

class SequencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sequence::updateOrCreate([
            'type' => Sequence::TYPES_SEQUENCES['user']
        ], [
            'value' => 0,
        ]);
    }
}
