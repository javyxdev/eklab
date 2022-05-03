<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria_examen;
use Illuminate\Http\Request;

class Categoria_ExamensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria_examen::all();
        return view('admin.categoria_examens.index',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categoria_examens.create');
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
            'descripcion' => 'required',
        ]);
        $mensaje = 'El registro se guardó con éxito.';
        $categoria_examen = Categoria_examen::create($request->all());
        return redirect()->route('admin.categoria_examens.edit',compact('categoria_examen'))->with('info',$mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria_examen $categoria_examen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria_examen $categoria_examen)
    {
        return view('admin.categoria_examens.edit',compact('categoria_examen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria_examen $categoria_examen)
    {
        $request->validate([
            'descripcion' => 'required',
        ]);
        $mensaje = 'El registro se actualizó con éxito.';
        $categoria_examen->update($request->all());
        return redirect()->route('admin.categoria_examens.edit',$categoria_examen)->with('info',$mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria_examen $categoria_examen)
    {
        $categoria_examen->delete();
        return redirect()->route('admin.categoria_examens.index')->with('info','Categoría eliminada con éxito.');
    }

    public function ajaxDelete($id){
        $categoria_examen = Categoria_examen::Find($id);
        $categoria_examen->delete();
        return  "Se ha eliminado correctamente el registro número: ".$id;
    }
}
