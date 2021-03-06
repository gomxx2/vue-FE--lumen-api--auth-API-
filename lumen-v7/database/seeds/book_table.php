<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class book_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker =Faker::create();
      for ($i=1;$i<20;$i++)
      {
          DB::table('book')->insert([
              'subject'=>$faker->word,
              'quantity'=>$faker->randomDigitNot(0),
          ]);
      }
    }
}
