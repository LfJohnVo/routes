<?php

namespace Database\Seeders;

use App\Models\Conductore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class conductoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nombres = [
            [
                'nombre' => 'James Lewis',
            ],
            [
                'nombre' => 'Paul Gutierrez',
            ],
            [
                'nombre' => 'Jack Brown',
            ],
            [
                'nombre' => 'Amy Jones',
            ],
            [
                'nombre' => 'Linda Henderson',
            ],
            [
                'nombre' => 'Mitchell Huynh',
            ],
            [
                'nombre' => 'Jacqueline Sandoval',
            ],
            [
                'nombre' => 'Brandon Marshall',
            ],
            [
                'nombre' => 'Albert Smith',
            ],
            [
                'nombre' => 'Abigail Castillo DDS',
            ],

        ];

        Conductore::insert($nombres);
    }
}
