<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         $titles = ['プログラム', '高速化', '画像編集', 'OS', 'Web開発'];

         foreach ($titles as $title) {
             DB::table('tags')->insert([
                 'title' => $title,
                 'created_at' => Carbon::now(),
                 'updated_at' => Carbon::now(),
             ]);
         }
     }
}
