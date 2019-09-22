<?php

use Illuminate\Database\Seeder;

class activities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activitiesData = [
          ['name' => 'Presença',            'type' => App\activity::TYPE[0], 'value' => 5],
          ['name' => 'Pontualidade',        'type' => App\activity::TYPE[0], 'value' => 2],
          ['name' => 'Meditação',           'type' => App\activity::TYPE[0], 'value' => 5],
          ['name' => 'Anotação de Domingo', 'type' => App\activity::TYPE[0], 'value' => 5],
          ['name' => 'Anotação de Sexta',   'type' => App\activity::TYPE[0], 'value' => 5],
          ['name' => 'Versiculos Decorados','type' => App\activity::TYPE[1], 'value' => 2],
        ];

        foreach ($activitiesData as $data) {
          App\activity::create($data);
        }
    }
}
