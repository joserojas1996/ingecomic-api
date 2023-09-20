<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\InfosResources;
use App\Http\Resources\UsersResources;
use App\Models\Info;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $per_page = request('per_page') ?? null;
        $type = request('type') ?? null;

        $query = Info::name(request('search'))
        ->when($type, fn($query, $date) => $query->where('type', $date))
        ->orderByDesc('id');

        return  InfosResources::collection($per_page ? $query->paginate($per_page) : $query->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'identity' => 'required|min:7',
            'firstname' => 'required|string|min:3',
            'lastname' => 'required|string|min:3',
        ], [
            'identity.required' => 'La cedula es requerida',
            'identity.min' => 'La cedula debe tener al menos 7 caracteres',

            'firstname.required' => 'El nombre es requerido',
            'firstname.string' => 'El Nombre debe ser de tipo alphanumerico',
            'firstname.min' => 'El Nombre debe tener al menos 3 caracteres',

            'lastname.required' => 'El Apellido es requerido',
            'lastname.string' => 'El Apellido debe ser de tipo alphanumerico',
            'lastname.min' => 'El Apellido debe tener al menos 3 caracteres',
        ],);

        $data = Info::create([
            'identity' => $request->identity,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'section_id' => isset($request->section) ? decrypt($request->section) : null,
            'type' => $request->type,
        ]);

        return InfosResources::make($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $users = User::find($id);
        $users->update([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->password),
        ]);

        return UsersResources::make($users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();

        return response()->json([
            'message' => __('Registro eliminado con exito')
        ], 200);
    }
}
