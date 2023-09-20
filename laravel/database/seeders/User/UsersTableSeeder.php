<?php

namespace Database\Seeders\User;

use App\Models\Info;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123')
        ]);

        $user->info()->create([
            'identity' => 11111111,
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'type' => 'ADMIN'
        ]);
    }
}
