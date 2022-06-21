<?php

use Illuminate\Database\Seeder;

class AdmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admission_statuses')->insert([
            'name' => 'Pendent programar',
            'description' => 'Si no hi ha data de visita'
        ]);

        DB::table('admission_statuses')->insert([
            'name' => 'Pendent decisió',
            'description' => 'Si la data de visita és mes petita que avui'
        ]);

        DB::table('admission_statuses')->insert([
            'name' => 'Pendent de realitzar',
            'description' => 'Si la data de visita és mes gran que avui'
        ]);

        DB::table('admission_statuses')->insert([
            'name' => 'Matriculació tancada',
            'description' => 'Admissió tancada'
        ]);

        DB::table('admission_statuses')->insert([
            'name' => 'Matriculació completa',
            'description' => 'Admissió tancada i completada correctament'
        ]);
    }
}
