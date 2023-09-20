<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResources;
use App\Models\Info;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class RegisterController extends Controller
{
    protected function store(Request $request)
    {

        $request->validate([
            'identity' => 'required|min:7',
            'firstname' => 'required|string|min:3',
            'lastname' => 'required|string|min:3',
            'email' => 'required|email|unique:users|min:3',
            'password' => 'required|confirmed|min:6'

        ], [
            'identity.required' => 'La cedula es requerida',
            'identity.min' => 'La cedula debe tener al menos 7 caracteres',

            'firstname.required' => 'El nombre es requerido',
            'firstname.string' => 'El Nombre debe ser de tipo alphanumerico',
            'firstname.min' => 'El Nombre debe tener al menos 3 caracteres',

            'lastname.required' => 'El Apellido es requerido',
            'lastname.string' => 'El Apellido debe ser de tipo alphanumerico',
            'lastname.min' => 'El Apellido debe tener al menos 3 caracteres',

            'email.required' => 'El correo es requerido',
            'email.email' => 'El correo debe tener un formato valido',
            'email.min' => 'El correo debe tener al menos 3 caracteres',
            'email.unique' => 'El usuario ya se encuentra registrado',

            'password.required' => 'La contraseña es requerida',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',

        ],);

        $identity = $request->input('identity');

        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $info = Info::where('identity', $identity)->first();

        if ($info) {
            $info->user_id = $user->id;
            $info->save();
        } else {
            $info = new Info();
            $info->identity = $request->input('identity');
            $info->firstname = $request->input('firstname');
            $info->lastname = $request->input('lastname');
            $info->save();
        }

        switch ($info->type) {
            case 'ADMIN':
                $role = Role::updateOrCreate(['name' => User::ADMIN], ['guard_name' => 'web']);
                break;
            case 'TEACHER':
                $role = Role::updateOrCreate(['name' => User::TEACHER], ['guard_name' => 'web']);
                break;
            case 'STUDENT':
                $role = Role::updateOrCreate(['name' => User::STUDENT], ['guard_name' => 'web']);
                break;
            default:
                $role = Role::updateOrCreate(['name' => User::PUBLIC], ['guard_name' => 'web']);
                break;
        }
        
        $user->assignRole($role);

        return response()->json([
            'user' => $info
        ], 201);
    }
}
