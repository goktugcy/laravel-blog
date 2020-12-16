<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::Create();
        for($i=0;$i<4;$i++)
        {
            $title=$faker->sentence(3);
             DB::table('articles')->insert([
                'category_id'=>rand(1,3),
                'title'=>$title,
                'image'=>$faker->imageUrl(400, 400, 'cats', true , 'Faker' , true , 'cats'),
                'content'=>$faker->paragraph(6),
                'slug'=>str_slug($title),
                'created_at'=>$faker->dateTime($max = 'now', $timezone = null),
                'updated_at'=>now()
             ]);
             
        }
       
    }
}
