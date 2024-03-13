@extends('layouts.plantilla')

    @section('contenido')

        <h1>Baja de una categoria</h1>

        <div class="col text-danger align-self-center">
            <form action="/eliminarCategoria" method="post">
            @csrf
            @method('delete')
                <div class="form-group">
                    <input type="hidden" name="idCategoria" value="{{ $Categoria->idCategoria }}">
                    <label for="catNombre">Nombre de la categoria</label>
                    <input type="text" name="catNombre"
                           value="{{ old('catNombre', $Categoria->catNombre ) }}"
                           class="form-control" id="catNombre">
                </div>
                <button class="btn btn-danger btn-block my-3">Confirmar baja</button>
                <a href="/adminCategorias" class="btn btn-outline-secondary btn-block">
                    Volver a panel
                </a>

            </form>
        </div>
        </form>

            <script>
                Swal.fire({
                    title: '¿Desea eliminar la categoria?',
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
                        window.location = '/adminCategorias'
                    }
                })
            </script>


    @endsection
