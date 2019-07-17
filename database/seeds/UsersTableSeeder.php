<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'username' => config('constants.userSeeder.username'),
            'email' => config('constants.userSeeder.email'),
            'balance' => config('constants.userSeeder.balance'),
            'role' => config('constants.userSeeder.role'),
            'password' => bcrypt(config('constants.userSeeder.password'))
        ]);
    }
}
