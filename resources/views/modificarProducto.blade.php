@extends('layouts.plantilla')

@section('contenido')


        <h1>Modificación de un producto</h1>

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/modificarProducto/{{ $Producto->idProducto }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

                <input type="hidden" name="imgActual" value="{{ $Producto->prdImagen }}">

                Nombre: <br>
                <input type="text" name="prdNombre"
                       value="{{ old('prdNombre', $Producto->prdNombre ) }}"
                       class="form-control">
                <br>
                Precio: <br>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="number" name="prdPrecio"
                           value="{{ old('prdPrecio', $Producto->prdPrecio ) }}"
                           class="form-control">
                </div>
                <br>
                Marca: <br>
                <select name="idMarca" class="form-control" required>
                    <option value="{{ $Producto->idMarca }}">{{ $Producto->relMarca->mkNombre }}</option>
                    <option value="">Seleccione una marca</option>
                @foreach( $marcas as $marca )
                    <option value="{{ $marca->idMarca }}">{{ $marca->mkNombre }}</option>
                @endforeach
                </select>
                <br>
                Categoría: <br>
                <select name="idCategoria" class="form-control" required>
                    <option value="{{ $Producto->idCategoria }}">{{ $Producto->relCategoria->catNombre }}</option>
                    <option value="">Seleccione una Categoría</option>
                @foreach( $categorias as $categoria )
                    <option value="{{ $categoria->idCategoria }}">{{ $categoria->catNombre }}</option>
                @endforeach
                </select>
                <br>
                Presentacion: <br>
                <textarea name="prdPresentacion" class="form-control"
                          >{{ old('prdPresentacion', $Producto->prdPresentacion ) }}</textarea>
                <br>
                Stock: <br>
                <input type="number" name="prdStock"
                       value="{{ old('prdStock', $Producto->prdStock ) }}"
                       class="form-control">
                <br>
                Imagen Actual: <br>
                <img src="/productos/{{ $Producto->prdImagen }}" class="img-thumbnail">
                <br>
                Modificar Imagen (opcional): <br>
                <div class="custom-file mt-1 mb-4">
                    <input type="file" name="prdImagen"  class="custom-file-input" id="customFileLang" lang="es">
                    <label class="custom-file-label" for="customFileLang" data-browse="Buscar en disco">
                        @if($Producto->prdImagen)
                            {{ $Producto->prdImagen }}
                        @else
                            Seleccionar Archivo:
                        @endif
                    </label>
                </div>

                <br>
                <button class="btn btn-dark mb-3">Modificar Producto</button>
                <a href="/adminProductos" class="btn btn-outline-secondary mb-3">Volver al panel de Productos</a>
            </form>

        </div>

        @if( $errors->any() )
            <div class="alert alert-danger col-8 mx-auto p-2">
                <ul>
                    @foreach( $errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


   @endsection

