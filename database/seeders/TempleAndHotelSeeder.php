<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Temple;
use App\Models\Hotel;
use Illuminate\Support\Facades\Schema;

class TempleAndHotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Hotel::truncate();
        Temple::truncate();
        Schema::enableForeignKeyConstraints();

        $temples = [
            [
                'name' => 'Sabarimala Ayyappa Temple',
                'description' => 'A world-famous temple dedicated to Lord Ayyappa, located in the Periyar Tiger Reserve in Kerala.',
                'location' => 'Pathanamthitta, Kerala',
                'photos' => ['assets/temples/temple_1.png'],
                'hotels' => [
                    [
                        'name' => 'The Kaanana Resort',
                        'details' => 'Luxury stay near the Pamba river with forest views.',
                        'onwards_price' => 4500.00,
                        'photos' => ['assets/temples/hotel_1.png']
                    ]
                ]
            ],
            [
                'name' => 'Guruvayur Sree Krishna Temple',
                'description' => 'The Bhuloka Vaikunta, dedicated to the charming infant form of Lord Krishna.',
                'location' => 'Thrissur, Kerala',
                'photos' => ['assets/temples/temple_2.png'],
                'hotels' => [
                    [
                        'name' => 'Hotel Devaragam',
                        'details' => 'Premium boutique hotel offering world-class amenities.',
                        'onwards_price' => 5500.00,
                        'photos' => ['assets/temples/hotel_2.png']
                    ]
                ]
            ],
            [
                'name' => 'Meenakshi Amman Temple',
                'description' => 'A historic temple on the southern bank of the Vaigai River in Madurai.',
                'location' => 'Madurai, Tamil Nadu',
                'photos' => ['assets/temples/temple_3.png'],
                'hotels' => [
                    [
                        'name' => 'Heritage Madurai',
                        'details' => 'A luxury resort featuring traditional architecture.',
                        'onwards_price' => 7500.00,
                        'photos' => ['assets/temples/hotel_3.png']
                    ]
                ]
            ],
            [
                'name' => 'Padmanabhaswamy Temple',
                'description' => 'The richest temple in the world, dedicated to Lord Vishnu in the Anantha Shayana posture.',
                'location' => 'Thiruvananthapuram, Kerala',
                'photos' => ['assets/temples/temple_4.png'],
                'hotels' => [
                    [
                        'name' => 'Hyatt Regency Trivandrum',
                        'details' => 'Ultra-luxury stay close to the temple with panoramic views.',
                        'onwards_price' => 8500.00,
                        'photos' => ['assets/temples/hotel_1.png']
                    ]
                ]
            ],
            [
                'name' => 'Brihadisvara Temple',
                'description' => 'A UNESCO site and a brilliant example of Dravidian architecture by Raja Raja Chola I.',
                'location' => 'Thanjavur, Tamil Nadu',
                'photos' => ['assets/temples/temple_5.png'],
                'hotels' => [
                    [
                        'name' => 'Svatma Thanjavur',
                        'details' => 'Experience Chola grandeur in this luxury boutique hotel.',
                        'onwards_price' => 9000.00,
                        'photos' => ['assets/temples/hotel_2.png']
                    ]
                ]
            ],
            [
                'name' => 'Sri Ranganathaswamy Temple',
                'description' => 'Dedicated to Lord Ranganatha, one of the largest temple complexes in the world.',
                'location' => 'Srirangam, Tamil Nadu',
                'photos' => ['assets/temples/temple_6.png'],
                'hotels' => [
                    [
                        'name' => 'Courtyard by Marriott',
                        'details' => 'Modern luxury stay situated near the sacred Cauvery river.',
                        'onwards_price' => 6000.00,
                        'photos' => ['assets/temples/hotel_3.png']
                    ]
                ]
            ],
            [
                'name' => 'Chottanikkara Bhagavathy Temple',
                'description' => 'Dedicated to Mother Goddess Bhagavathy, revered for spiritual healing.',
                'location' => 'Ernakulam, Kerala',
                'photos' => ['assets/temples/temple_7.png'],
                'hotels' => [
                    [
                        'name' => 'Kochi Marriott Hotel',
                        'details' => 'Premium luxury hotel within driving distance from the temple.',
                        'onwards_price' => 9500.00,
                        'photos' => ['assets/temples/hotel_1.png']
                    ]
                ]
            ],
            [
                'name' => 'Attukal Bhagavathy Temple',
                'description' => 'The "Sabarimala of Women", famous for the world-record Pongala festival.',
                'location' => 'Thiruvananthapuram, Kerala',
                'photos' => ['assets/temples/temple_8.png'],
                'hotels' => [
                    [
                        'name' => 'The Leela Kovalam',
                        'details' => 'Iconic cliff-top resort with breathtaking ocean views.',
                        'onwards_price' => 15000.00,
                        'photos' => ['assets/temples/hotel_2.png']
                    ]
                ]
            ]
        ];

        foreach ($temples as $templeData) {
            $hotels = $templeData['hotels'];
            unset($templeData['hotels']);

            $temple = Temple::create($templeData);

            foreach ($hotels as $hotelData) {
                $hotelData['temple_id'] = $temple->id;
                Hotel::create($hotelData);
            }
        }
    }
}
