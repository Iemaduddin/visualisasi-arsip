<?php

namespace Database\Seeders;

use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locs = [
            // Akasia
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Kartu',
                'floor' => 1,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Kartu',
                'floor' => 1,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Kartu',
                'floor' => 2,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Kartu',
                'floor' => 2,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Kartu',
                'floor' => 3,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Kartu',
                'floor' => 3,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Kartu',
                'floor' => 4,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Kartu',
                'floor' => 4,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Surat',
                'floor' => 1,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Surat',
                'floor' => 1,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Surat',
                'floor' => 2,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Surat',
                'floor' => 2,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Surat',
                'floor' => 3,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Surat',
                'floor' => 3,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Surat',
                'floor' => 4,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Surat',
                'floor' => 4,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Akta',
                'floor' => 1,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Akta',
                'floor' => 1,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Akta',
                'floor' => 2,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Akta',
                'floor' => 2,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Akta',
                'floor' => 3,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Akta',
                'floor' => 3,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Akta',
                'floor' => 4,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Akasia',
                'rack_name' => 'Akta',
                'floor' => 4,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            // Bougenville
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Kartu',
                'floor' => 1,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Kartu',
                'floor' => 1,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Kartu',
                'floor' => 2,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Kartu',
                'floor' => 2,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Kartu',
                'floor' => 3,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Kartu',
                'floor' => 3,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Kartu',
                'floor' => 4,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Kartu',
                'floor' => 4,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Surat',
                'floor' => 1,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Surat',
                'floor' => 1,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Surat',
                'floor' => 2,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Surat',
                'floor' => 2,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Surat',
                'floor' => 3,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Surat',
                'floor' => 3,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Surat',
                'floor' => 4,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Surat',
                'floor' => 4,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Akta',
                'floor' => 1,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Akta',
                'floor' => 1,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Akta',
                'floor' => 2,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Akta',
                'floor' => 2,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Akta',
                'floor' => 3,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Akta',
                'floor' => 3,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Akta',
                'floor' => 4,
                'column' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'room_name' => 'Bougenville',
                'rack_name' => 'Akta',
                'floor' => 4,
                'column' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];
        foreach ($locs as $loc) {
            Location::create($loc);
        }
    }
}
