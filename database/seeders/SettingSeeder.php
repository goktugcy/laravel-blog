<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('settings')->insert([
                'title'=>'Blog Sitesi v1',
                'active'=>'1',
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
    }
}
