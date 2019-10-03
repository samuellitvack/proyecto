<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(['name'=>'samuel', 'email'=>'samuel@aulasoft.com', 'password'=>bcrypt('123456789')]);
    }
}
