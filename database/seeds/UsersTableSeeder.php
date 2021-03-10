<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      \DB::table('users')->insert([
        [
          'name' => 'Usuario MMA 1',
          'last_name' => 'App 1',
          'email' => 'admin@mma.gob.cl',
          'password' => bcrypt('adminadmin'),
          'rol' => 'admin'
        ],
        [
          'name' => 'Usuario EMPRESA',
          'last_name' => 'App 2',
          'email' => 'empresa@mail.com',
          'password' => bcrypt('adminadmin'),
          'rol' => 'company'
        ]
      ]);
    }
}
