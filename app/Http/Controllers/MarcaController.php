<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $marcas = Marca::all();
//        $marcas = Marca::simplePaginate(5);
        $marcas = Marca::paginate(5);

        return view('adminMarcas', [ 'marcas'=>$marcas ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarMarca');
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
        $this->validarMarca($request);
        // guardar
        $Marca = new Marca;
        $mkNombre = $request->mkNombre;
        $Marca->mkNombre = $mkNombre;
        $Marca->save();

        //retornar vista y mensaje
        return redirect('adminMarcas')->with('mensaje', 'Marca ' .$mkNombre. ' agregada correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Marca = Marca::find($id);

        return view('modificarMarca', ['Marca'=>$Marca]);

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
        $Marca = Marca::find($id);
        $mkNombre = $request->mkNombre;
        $Marca->mkNombre = $mkNombre;
        $Marca->save();

        //retornar vista y mensaje
        return redirect('adminMarcas')->with('mensaje', 'Marca ' .$mkNombre. ' modificada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmarBaja($id)
    {
        $Marca = Marca::find($id);

        return view('eliminarMarca', ['Marca'=>$Marca]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Marca::destroy($request->idMarca);

        //redirección con mensaje
        return redirect('adminMarcas')->with(['mensaje'=>'Marca: '. $request->mkNombre. ' eliminada correctamente']);
    }

    /**
     * @param Request $request
     * @return void
     */
    private function validarMarca(Request $request): void
    {
        $request->validate([
            'mkNombre' => 'required|min:2|max:50'
        ], [
                'mkNombre.required' => 'El campo "Nombre de la marca" es obligatorio',
                'mkNombre.min' => 'El campo "Nombre de la marca" debe de tener almenos 2 caracteres',
                'mkNombre.max' => 'El campo "Nombre de la marca" debe tener 50 caracteres como màximo'
            ]
        );
    }
}
