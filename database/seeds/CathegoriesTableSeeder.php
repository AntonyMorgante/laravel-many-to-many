<?php

use Illuminate\Database\Seeder;
use App\Cathegory;
use Faker\Generator as Faker;

class CathegoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i<5; $i++){
            $cath = new Cathegory();
            $cath->name = $faker->words(1, true);
            $cath->save();
        }
    }
}
