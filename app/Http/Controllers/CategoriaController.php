<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::paginate(5);

        return view('adminCategorias', [ 'categorias'=>$categorias ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarCategoria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion
        $this->validarCategoria($request);
        // guardar
        $Categoria = new Categoria();
        $catNombre = $request->catNombre;
        $Categoria->catNombre = $catNombre;
        $Categoria->save();

        //retornar vista y mensaje
        return redirect('adminCategorias')->with('mensaje', 'Categoria ' .$catNombre. ' agregada correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Categoria = Categoria::find($id);

        return view('modificarCategoria', ['Categoria'=>$Categoria]);
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
        //validacion
        $this->validarMarca($request);
        // guardar
        $Categoria = Categoria::find($id);
        $catNombre = $request->catNombre;
        $Categoria->catNombre = $catNombre;
        $Categoria->save();

        //retornar vista y mensaje
        return redirect('adminCategorias')->with('mensaje', 'Categoria ' .$catNombre. ' modificada correctamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmarBaja($id)
    {
        $Categoria = Categoria::find($id);

        return view('eliminarCategoria', ['Categoria'=>$Categoria]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Categoria::destroy($request->idCategoria);

        //redirección con mensaje
        return redirect('adminCategorias')->with(['mensaje'=>'Categoria: '. $request->catNombre. ' eliminada correctamente']);
    }

    /**
     * @param Request $request
     * @return void
     */
    private function validarCategoria(Request $request): void
    {
        $request->validate([
            'catNombre' => 'required|min:2|max:50'
        ], [
                'catNombre.required' => 'El campo "Nombre de la categoria" es obligatorio',
                'catNombre.min' => 'El campo "Nombre de la categoria" debe de tener almenos 2 caracteres',
                'catNombre.max' => 'El campo "Nombre de la categoria" debe tener 50 caracteres como màximo'
            ]
        );
    }
}
