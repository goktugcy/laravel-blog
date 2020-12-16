<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('admins')->insert([
                'name'=>'Göktuğ Ceyhan',
                'email'=>'goktugceyhan@gmail.com',
                'password'=>bcrypt('solgar512')
            ]);
    }
}
