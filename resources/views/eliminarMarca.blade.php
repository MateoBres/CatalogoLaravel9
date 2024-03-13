@extends('layouts.plantilla')

    @section('contenido')

        <h1>Baja de una marca</h1>

        <div class="col text-danger align-self-center">
            <form action="/eliminarMarca" method="post">
            @csrf
            @method('delete')
                <div class="form-group">
                    <input type="hidden" name="idMarca" value="{{ $Marca->idMarca }}">
                    <label for="mkNombre">Nombre de la marca</label>
                    <input type="text" name="mkNombre"
                           value="{{ old('mkNombre', $Marca->mkNombre ) }}"
                           class="form-control" id="mkNombre">
                </div>
                <button class="btn btn-danger btn-block my-3">Confirmar baja</button>
                <a href="/adminMarcas" class="btn btn-outline-secondary btn-block">
                    Volver a panel
                </a>

            </form>
        </div>
        </form>

            <script>
                Swal.fire({
                    title: '¿Desea eliminar la marca?',
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
                        window.location = '/adminMarcas'
                    }
                })
            </script>


    @endsection
