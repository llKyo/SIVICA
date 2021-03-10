<?php

use Illuminate\Database\Seeder;

class NamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('names')->insert([
            ['name' => 'MP'],
            ['name' => 'O3'],
            ['name' => 'CO'],
            ['name' => 'NO/NOx'],
            ['name' => 'SO2'],
            ['name' => 'WS'],
            ['name' => 'WD'],
            ['name' => 'RS'],
            ['name' => 'THR'],
            ['name' => 'P°'],
            ['name' => 'PLUVIO'],
            ['name' => 'DILUTOR'],
            ['name' => 'LOGGER'],
            ['name' => 'MODEM'],
            ['name' => 'PC'],
            ['name' => 'AA'],
            ['name' => 'UPS'],
            ['name' => 'BOMBA']
        ]);
    }
}
