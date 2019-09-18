<?php

use Illuminate\Database\Seeder;

class PreceptoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i=0; $i<=100; $i++):
           DB::table('table_preceptores')->insert(['DNI'=>$faker->randomNumber(8), 'Nombre'=>$faker->firstName('male'), 'Apellido'=>$faker->lastName, 'Fecha_nac'=>$faker->dateTimeBetween('-20 years', 'now - 12 years')->format('Y-m-d'), 'Telefono'=>$faker->e164PhoneNumber, 'Direccion'=>$faker->address, 'Nacionalidad'=>$faker->country]);
        endfor;
    }
}
