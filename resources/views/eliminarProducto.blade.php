@extends('layouts.plantilla')

    @section('contenido')

        <h1>Baja de un producto</h1>

        <div class="row alert bg-light border-danger col-8 mx-auto p-2">
            <div class="col">
                <img src="/productos/{{ $Producto->prdImagen }}" class="img-thumbnail">
            </div>
            <div class="col text-danger align-self-center">
                <form action="/eliminarProducto" method="post">
                @csrf
                @method('delete')
                    <input type="hidden" name="prdNombre" value="{{ $Producto->prdNombre }}">
                    <input type="hidden" name="idProducto" value="{{ $Producto->idProducto }}">
                    <h2>{{ $Producto->prdNombre }}</h2>
                    Categoría: {{ $Producto->relCategoria->catNombre  }}  <br>
                    Marca:  {{ $Producto->relMarca->mkNombre }} <br>
                    Presentación: {{ $Producto->prdPresentacion }} <br>
                    Precio: ${{ $Producto->prdPrecio }}
                    <button class="btn btn-danger btn-block my-3">Confirmar baja</button>
                    <a href="/adminProductos" class="btn btn-outline-secondary btn-block">
                        Volver a panel
                    </a>

                </form>
            </div>
        </form>
        </div>

            <script>
                Swal.fire({
                    title: '¿Desea eliminar el producto?',
                    text: "Esta acción no se puede deshacer.",
                    type: 'error',
                    showCancelButton: true,
                    cancelButtonColor: '#8fc87a',
                    cancelButtonText: 'No, no lo quiero eliminar',
                    confirmButtonColor: '#d00',
                    confirmButtonText: 'Si, lo quiero eliminar'
                }).then((result) => {
                    if (!result.value) {
                        //redirección a adminProductos
                        window.location = '/adminProductos'
                    }
                })
            </script>


    @endsection
