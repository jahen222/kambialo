<?php

use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Subscription::create([
            'name'            => 'PLAN 1',
            'description'     => '1 Producto',
            'quote'        => 1,
            'price'           => 1000
        ]);

        App\Subscription::create([
            'name'            => 'PLAN 2',
            'description'     => '5 Producto',
            'quote'        => 2,
            'price'           => 4000
        ]);

        App\Subscription::create([
            'name'            => 'PLAN 3',
            'description'     => '50 Producto',
            'quote'        => 50,
            'price'           => 7000
        ]);
    }
}
