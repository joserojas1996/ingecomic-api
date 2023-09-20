<?php

namespace Database\Seeders;

use Database\Seeders\Permissions\Admins\UsersCrudPermissionSeeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersCrudPermissionSeeder::class,
        ]);
        Role::updateOrCreate(['name' => User::TEACHER], ['guard_name' => 'web']);
        Role::updateOrCreate(['name' => User::STUDENT], ['guard_name' => 'web']);
        Role::updateOrCreate(['name' => User::ADMIN], ['guard_name' => 'web']);
        Role::updateOrCreate(['name' => User::PUBLIC], ['guard_name' => 'web']);

        $role = Role::updateOrCreate(['name' => User::ADMIN], ['guard_name' => 'web']);

        $user = User::where('email', 'admin@admin.com')->first();
        $user->assignRole($role);
    }
}
