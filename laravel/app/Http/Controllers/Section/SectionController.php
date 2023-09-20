<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Http\Resources\Section\SectionResources;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $per_page = request('per_page') ?? null;
        $query = Section::name(request('search'))->orderByDesc('id');

        return  SectionResources::collection($per_page ? $query->paginate($per_page) : $query->get());
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
            'name' => 'required|string|min:3',
        ], [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser de tipo alphanumerico',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
        ],);

        $data = Section::create([
            'name' => $request->input('name'),
        ]);

        return SectionResources::make($data);
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
        $request->validate([
            'name' => 'required|string|min:3',
        ], [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser de tipo alphanumerico',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
        ],);

        $users = Section::find($id);
        $users->update([
            'name' => $request->input('name')
        ]);

        return SectionResources::make($users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Section::find($id);
        $data->delete();

        return response()->json([
            'message' => __('Seccion eliminada con exito')
        ], 200);
    }
}
