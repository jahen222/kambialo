<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(SubscriptionSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(TagTableSeeder::class);


    }
}
