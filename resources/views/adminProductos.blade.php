@extends('layouts.plantilla')

    @section('contenido')

        <h1>Panel de administración de productos</h1>

        @if ( session('mensaje') )
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
        @endif

        <table class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Presentacion</th>
                    <th>Imagen</th>
                    <th colspan="2">
                        <a href="/agregarProducto" class="btn btn-outline-secondary">
                            Agregar
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
            @if( count($productos)>0 )
                @foreach( $productos as $producto )
                    <tr>
                        <td>{{ $producto->prdNombre }}</td>
                        <td>{{ $producto->relMarca->mkNombre }}</td>
                        <td>{{ $producto->relCategoria->catNombre }}</td>
                        <td>${{ $producto->prdPrecio }}</td>
                        <td>{{ $producto->prdPresentacion }}</td>
                        <td>
                            <img src="/productos/{{ $producto->prdImagen }}" class="img-thumbnail">
                        </td>
                        <td>
                            <a href="/modificarProducto/{{ $producto->idProducto }}" class="btn btn-outline-secondary">
                                Modificar
                            </a>
                        </td>
                        <td>
                            <a href="/eliminarProducto/{{ $producto->idProducto }}" class="btn btn-outline-secondary">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <td colspan="8">Ningun producto</td>
            @endif
            </tbody>
        </table>


    @endsection
