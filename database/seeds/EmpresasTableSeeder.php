<?php

use Illuminate\Database\Seeder;
use App\Empresas;

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresa = new Empresas();
        $empresa->name = 'Samsung';
        $empresa->email = 'info@samsung.com';
        $empresa->logo = 'samsung.webp';
        $empresa->website = 'https://www.samsung.com';
        $empresa->save();
    }
}
