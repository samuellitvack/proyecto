<?php

use Illuminate\Database\Seeder;

class MateriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('table_materias')->insert(['Nombre'=>'Matemáticas']);
        DB::table('table_materias')->insert(['Nombre'=>'Lengua extranjera']);
        DB::table('table_materias')->insert(['Nombre'=>'Ciencias sociales']);
        DB::table('table_materias')->insert(['Nombre'=>'Artes plásticas']);
        DB::table('table_materias')->insert(['Nombre'=>'Música']);
        DB::table('table_materias')->insert(['Nombre'=>'Educación física']);
        DB::table('table_materias')->insert(['Nombre'=>'Ciencias naturales']);
        DB::table('table_materias')->insert(['Nombre'=>'Religión']);
        DB::table('table_materias')->insert(['Nombre'=>'Biología']);
        DB::table('table_materias')->insert(['Nombre'=>'Física']);
        DB::table('table_materias')->insert(['Nombre'=>'Química']);
        DB::table('table_materias')->insert(['Nombre'=>'Historia']);
        DB::table('table_materias')->insert(['Nombre'=>'Geografía']);
        DB::table('table_materias')->insert(['Nombre'=>'Filosofía']);
        DB::table('table_materias')->insert(['Nombre'=>'Psicología']);
        DB::table('table_materias')->insert(['Nombre'=>'Sociología']);
        DB::table('table_materias')->insert(['Nombre'=>'Derecho']);
        DB::table('table_materias')->insert(['Nombre'=>'Tecnología']);
        DB::table('table_materias')->insert(['Nombre'=>'Ética']);
        DB::table('table_materias')->insert(['Nombre'=>'Literatura']);
        DB::table('table_materias')->insert(['Nombre'=>'Informática']);
        DB::table('table_materias')->insert(['Nombre'=>'Electrónica']);
        DB::table('table_materias')->insert(['Nombre'=>'Metodologías de investigación']);
    }
}
