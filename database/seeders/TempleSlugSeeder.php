<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Temple;
use Illuminate\Support\Str;

class TempleSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Temple::whereNull('slug')->orWhere('slug', '')->each(function ($temple) {
            $temple->slug = Str::slug($temple->name);
            $temple->save();
        });
    }
}
?>
