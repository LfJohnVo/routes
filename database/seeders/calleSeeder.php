<?php

namespace Database\Seeders;

use App\Models\Calle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class calleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $streets = [
            [
                'street' => '4889 Yorkie Lane',
            ],
            [
                'street' => '492 Skips Lane',
            ],
            [
                'street' => '1596 Cantebury Drive',
            ],
            [
                'street' => '4313 Michael Street',
            ],
            [
                'street' => '2928 Deer Haven Drive',
            ],
            [
                'street' => '4787 Strother Street',
            ],
            [
                'street' => '3102 Hillhaven Drive',
            ],
            [
                'street' => '1151 Sampson Street',
            ],
            [
                'street' => '4622 Oliver Street',
            ],
            [
                'street' => '195 Hamilton DriveS',
            ],

        ];

        Calle::insert($streets);
    }
}
