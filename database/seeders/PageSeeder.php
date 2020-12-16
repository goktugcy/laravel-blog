<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $pages=['Hakkımda','Projelerim','Satışlarım'];
            $count=0;
        foreach($pages as $page)
        {
            $count++;
            DB::table('pages')->insert([
                'title'=>$page,
                'slug'=>str_slug($page),
                'image'=>'https://images.alphacoders.com/921/921246.png',
                'content'=>'Esse et tempor nulla ad est. Sint nisi adipisicing non consectetur irure et. Laborum sint proident enim aute labore. Reprehenderit qui proident minim magna ea mollit dolore eiusmod non.',
                 'order'=>$count,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
    }
    }
}