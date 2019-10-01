<?php $name = 'Empresas'; ?>
@extends('layouts.app')

@section('ClassBody', '')

@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="card-title">{{ $name }}</h4>
                        </div>
                        <div class="col-md-6 pt-2 align-self-center">
                            <form id="search_empresas" action="{{ route('empresasSearch') }}" method="POST">
                                @csrf
                                <div class="input-group no-border">
                                <input id="search" name="searchEmpresas" type="text" value="" class="form-control" placeholder="Buscar en Empresas">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <i class="now-ui-icons ui-1_zoom-bold"></i>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2 text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCompany" data-tooltip="tooltip" title="Nueva Empresa">
                                <i class="now-ui-icons ui-1_simple-add"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nueva Empresa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <form enctype="multipart/form-data" action="{{ route('empresas.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <div class="my-2">
                                                            <label for="file-input">
                                                                Subir foto (100x100)
                                                            </label>
                                                            <div id="preview"></div>
                                                            <input id="file-input" name="logo" accept="image/jpg, image/png" type="file">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="name" placeholder="Nombre de la Empresa" class="form-control @error('name') is-invalid @enderror" required>
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="email" placeholder="Correo Electrónico" class="form-control @error('email') is-invalid @enderror" required>
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="website" placeholder="Sitio Web (opcional)" class="form-control @error('website') is-invalid @enderror">
                                                            @error('website')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>
                                    Información
                                </th>
                                <th class="text-center">
                                    Acción
                                </th>
                            </thead>
                            @if($empresas->total() > 0)
                            <tbody id="tbodyEmpresas">
                                @foreach ($empresas as $empresa)
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-2 align-self-center">
                                                <img class="img-thumbnail" src="{{ asset('storage/'.$empresa->logo) }}" alt="Empresa {{ $empresa->name }}">
                                            </div>
                                            <div class="col-md-10 align-self-center">
                                                <h4 class="my-0"><strong>{{ $empresa->name }}</strong></h4>
                                                <?php $employerslist = $empleados->where('company_id', $empresa->id); ?>
                                                <p class="my-0"><strong>Correo Electrónico:</strong> {{ $empresa->email }}</p>
                                                <p class="my-0"><strong>Empleados:</strong> {{ $employerslist->count() }}</p>
                                                <p class="my-0"><strong>Sitio Web:</strong> {{ $empresa->website }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="float-right">
                                            <a href="{{ route('empresas.edit', $empresa->id) }}" class="btn btn-primary rounded" data-tooltip="tooltip" title="Editar"><i class="now-ui-icons ui-1_settings-gear-63"></i></a>
                                            <a href="javascript:{}" onclick="document.RemoveCompany{{ $empresa->id }}.submit();" data-tooltip="tooltip" title="Remover" class="btn btn-danger rounded"><i class="now-ui-icons ui-1_simple-remove"></i></a>
                                            <form name="RemoveCompany{{ $empresa->id }}" action="{{ route('empresas.destroy', $empresa->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @else
                            <tbody id="tbodyEmpresas">
                                @foreach ($empresas as $empresa)
                                <tr>
                                    <td>
                                        <h1>No hay Empresas</h1>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                    <div class="row justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item @if($empresas->onFirstPage() == 1) disabled @endif">
                                    <a class="page-link" href="{{ $empresas->previousPageUrl() }}">
                                        Anterior
                                    </a>
                                </li>
                                @for($i=1; $i<=$empresas->lastPage(); $i++)
                                <li class="page-item @if($empresas->currentPage() == $i) active @endif()">
                                    <a class="page-link" href="{{ $empresas->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                <li class="page-item"><a class="page-link @if($empresas->currentPage() == $empresas->lastPage()) disabled @endif" href="{{ $empresas->nextPageUrl() }}">Siguiente</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("file-input").onchange = function(e) {
    // Creamos el objeto de la clase FileReader
    let reader = new FileReader();

    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL(e.target.files[0]);

        // Le decimos que cuando este listo ejecute el código interno
        reader.onload = function(){
            let preview = document.getElementById('preview'),
                    image = document.createElement('img');

            image.src = reader.result;

            preview.innerHTML = '';
            preview.append(image);

            $('#text').hide();
        };
    };
</script>

@endsection
