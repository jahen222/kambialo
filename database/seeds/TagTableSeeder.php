<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Tag::create([
            'name'            => 'Arte',
        ]);

        App\Tag::create([
            'name'            => 'Música',
        ]);
    }
}
