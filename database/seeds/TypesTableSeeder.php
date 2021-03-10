<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('types')->insert([
            ['name' => 'MP10'],
            ['name' => 'MP2.5'],
            ['name' => 'DISCRETO'],
            ['name' => 'ESTUDIO'],
            ['name' => 'EXTERNO']
        ]);
    }
}
