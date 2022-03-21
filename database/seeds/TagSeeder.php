<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i<5; $i++){
            $tag = new Tag();
            $tag->name = $faker->words(2, true);
            $tag->slug=Str::of($tag->name)->slug("-");
            $tag->save();
        }
    }
}
