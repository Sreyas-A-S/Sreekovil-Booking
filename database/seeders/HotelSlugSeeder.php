<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use Illuminate\Support\Str;

class HotelSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotel::whereNull('slug')
            ->orWhere('slug', '')
            ->each(function ($hotel) {
                $hotel->slug = Str::slug($hotel->name);
                $hotel->save();
            });
    }
}
?>
