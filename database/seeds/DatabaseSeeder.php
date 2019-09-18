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
    	$this->call(UsersSeeder::class);
        $this->call(AlumnosSeeder::class);
        $this->call(PreceptoresSeeder::class);
        $this->call(ProfesoresSeeder::class);
        $this->call(MateriasSeeder::class);
    }
}
