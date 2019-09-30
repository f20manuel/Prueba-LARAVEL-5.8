<?php

use Illuminate\Database\Seeder;
use App\Empleados;

class EmpleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 150;
        factory(Empleados::class, $count)->create();
    }
}
