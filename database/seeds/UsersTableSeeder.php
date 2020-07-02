<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'      => 'Italo Morales',
            'email'     => 'i@italomoralesf.com',
            'password'     => bcrypt('123'),
            'subscription_id' => 2
        ]);
    }
}
