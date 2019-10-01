<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'empresas']);
        Permission::create(['name' => 'empleados']);

        $Admin = Role::create(['name' => 'Admin']);
        $Admin->givePermissionTo(Permission::all());
    }
}
