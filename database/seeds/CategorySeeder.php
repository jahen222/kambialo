<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Category::create([
            'name'            => 'Todos',
        ]);

        App\Category::create([
            'name'            => 'Electro',
        ]);

        App\Category::create([
            'name'            => 'Deportes',
        ]);

        App\Category::create([
            'name'            => 'Tecnología',
        ]);

        App\Category::create([
            'name'            => 'Ropa',
        ]);

        App\Category::create([
            'name'            => 'Cosmetica',
        ]);

        App\Category::create([
            'name'            => 'Jardín',
        ]);

        App\Category::create([
            'name'            => 'Mecánica',
        ]);

        App\Category::create([
            'name'            => 'Comida',
        ]);

        App\Category::create([
            'name'            => 'Muebles',
        ]);
    }
}
