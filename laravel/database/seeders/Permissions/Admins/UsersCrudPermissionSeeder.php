<?php

namespace Database\Seeders\Permissions\Admins;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UsersCrudPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::updateOrCreate(['name' => 'users.view'], ['guard_name' => 'web', 'label' => 'Ver Usuarios']);
        Permission::updateOrCreate(['name' => 'users.create'], ['guard_name' => 'web', 'label' => 'Crear Usuarios']);
        Permission::updateOrCreate(['name' => 'users.update'], ['guard_name' => 'web', 'label' => 'Modificar Usuarios']);
        Permission::updateOrCreate(['name' => 'users.delete'], ['guard_name' => 'web', 'label' => 'Eliminar Usuarios']);
        Permission::updateOrCreate(['name' => 'users.permissions'], ['guard_name' => 'web', 'label' => 'Asignar permisos de Usuarios']);
    }
}
