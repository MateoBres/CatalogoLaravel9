<?php

namespace App\Http\Controllers;


use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //obtenemos los productos
        $productos = Producto::with('relMarca', 'relCategoria')->get();
        return view('/adminProductos', [ 'productos'=>$productos ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $marcas = Marca::orderBy('mkNombre')->get();
        $categorias = Categoria::orderBy('catNombre')->get();
        return view('agregarProducto', ['marcas'=>$marcas, 'categorias'=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        // validación
        $this->validarProducto($request);
        // instanciar
        $Producto = new Producto;
        // asignar
        $this->asignarCampos($Producto, $request);
        //guardar
        $Producto->save();
        //retornar peticion + mensaje ok
        return redirect('/adminProductos')->with('mensaje', 'Producto: '. $request->prdNombre. ' agregado correctamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Producto = Producto::with('relMarca', 'relCategoria')->find($id);
        $marcas = Marca::orderBy('mkNombre')->get();
        $categorias = Categoria::orderBy('catNombre')->get();

        return view('/modificarProducto', ['Producto'=>$Producto, 'marcas'=>$marcas, 'categorias'=>$categorias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validación
        $this->validarProducto($request);

        // obtener un producto por id
        $Producto = Producto::find($id);
        // asignar
        $this->asignarCampos($Producto, $request);
        //guardar
        $Producto->save();
        //retornar peticion + mensaje ok
        return redirect('/adminProductos')->with('mensaje', 'Producto: '. $request->prdNombre. ' modificado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmarBaja($id)
    {
        $Producto = Producto::with('relMarca', 'relCategoria')->find($id);

        return view('eliminarProducto', ['Producto'=>$Producto]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Producto::destroy($request->idProducto);

        //redirección con mensaje
        return redirect('adminProductos')->with(['mensaje'=>'Producto: '. $request->prdNombre. ' eliminado correctamente']);
    }

    private function validarProducto(Request $request)
    {
        $request->validate(
            [
                'prdNombre'=>'required|min:2|max:70',
                'prdPrecio'=>'required|numeric|min:0',
                'prdPresentacion'=>'required|min:3|max:150',
                'prdStock'=>'required|integer|min:1',
                'prdImagen'=>'mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
            ],
            [
                'prdNombre.required'=>'Complete el campo Nombre',
                'prdNombre.min'=>'Complete el campo Nombre con al menos 3 caractéres',
                'prdNombre.max'=>'Complete el campo Nombre con 70 caractéres como máxino',
                'prdPrecio.required'=>'Complete el campo Precio',
                'prdPrecio.numeric'=>'Complete el campo Precio con un número',
                'prdPrecio.min'=>'Complete el campo Precio con un número positivo',
                'prdPresentacion.required'=>'Complete el campo Presentación',
                'prdPresentacion.min'=>'Complete el campo Presentación con al menos 3 caractéres',
                'prdPresentacion.max'=>'Complete el campo Presentación con 150 caractérescomo máxino',
                'prdStock.required'=>'Complete el campo Stock',
                'prdStock.integer'=>'Complete el campo Stock con un número entero',
                'prdStock.min'=>'Complete el campo Stock con un número positivo',
                'prdImagen.mimes'=>'Debe ser una imagen',
                'prdImagen.max'=>'Debe ser una imagen de 2MB como máximo'
            ]
        );
    }

    private function subirImagen(Request $request)
    {
        //si no enviaron archivo store()
        $prdImagen = 'noDisponible.jpg';
        //si no enviaron archivo update()
        if( $request->has('imgActual') ){
            $prdImagen = $request->imgActual;
        }

        //si enviaron archivo
        if( $request->file('prdImagen') ){
            //renombrar archivo
            # time() . extension
            $ext = $request->file('prdImagen')->extension();
            $prdImagen = time().'.'.$ext;

            //subir imagen
            $request
                ->file('prdImagen')
                ->move( public_path('productos/'), $prdImagen );
        }

        return $prdImagen;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Producto $Producto
     * @param  \Illuminate\Http\Request  $request
     * @return Producto
     */
    private function asignarCampos($Producto, $request)
    {
        //subir imagen *
        $prdImagen = $this->subirImagen($request);
        $Producto->prdNombre = $request->prdNombre;
        $Producto->prdPrecio = $request->prdPrecio;
        $Producto->idMarca = $request->idMarca;
        $Producto->idCategoria = $request->idCategoria;
        $Producto->prdPresentacion = $request->prdPresentacion;
        $Producto->prdStock = $request->prdStock;
        $Producto->prdImagen = $prdImagen;

        return $Producto;
    }

}
