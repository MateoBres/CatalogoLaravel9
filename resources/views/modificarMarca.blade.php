@extends('layouts.plantilla')

    @section('contenido')

        <h1>Modificación de una marca</h1>

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/modificarMarca/{{ $Marca->idMarca }}" method="post">
            @csrf
            @method('put')
                <div class="form-group">
                    <label for="mkNombre">Nombre de la marca</label>
                    <input type="text" name="mkNombre"
                           value="{{ old('mkNombre', $Marca->mkNombre ) }}"
                           class="form-control" id="mkNombre">
                </div>
                <button class="btn btn-dark mr-3">Modificar marca</button>
                <a href="/adminMarcas" class="btn btn-outline-secondary">
                    Volver a panel
                </a>
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

