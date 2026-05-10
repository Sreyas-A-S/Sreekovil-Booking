<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Chant::create([
            'text' => 'ॐ नमः शिवाय',
            'meaning' => 'I bow to the Divine within.'
        ]);
        \App\Models\Chant::create([
            'text' => 'ॐ नमो नारायणाय',
            'meaning' => 'Surrender to the Supreme Reality.'
        ]);
        \App\Models\Chant::create([
            'text' => 'लोकाः समस्ताः सुखिनो भवन्तु',
            'meaning' => 'May all beings everywhere be happy and free.'
        ]);
        \App\Models\Chant::create([
            'text' => 'ॐ असतो मा सद्गमय',
            'meaning' => 'Lead me from the unreal to the real.'
        ]);
    }
}
