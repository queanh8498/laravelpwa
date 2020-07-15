<?php

use Illuminate\Database\Seeder;

class NhanvienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'tennv' => str_random(10),
            'diachi' => str_random(10),
            'sdt' => '123456',
            'quyen' => '1',
            'email' => 'A@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
