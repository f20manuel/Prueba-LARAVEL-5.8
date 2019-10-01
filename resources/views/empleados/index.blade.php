<?php $name = 'Empleados'; ?>
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
                            <form id="search_empleados" action="{{ route('empleadosSearch') }}" method="POST">
                                @csrf
                                <div class="input-group no-border">
                                <input id="search" name="searchEmpleados" type="text" value="" class="form-control" placeholder="Buscar en Empresas">
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
                                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Empleado</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <form action="{{ route('empleados.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <input type="text" name="first_name" placeholder="Nombres" class="form-control @error('first_name') is-invalid @enderror" required>
                                                                @error('first_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" name="last_name" placeholder="Apellidos" class="form-control @error('last_name') is-invalid @enderror" required>
                                                                @error('last_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <input type="text" name="phone" placeholder="Telefono" class="form-control @error('phone') is-invalid @enderror" required>
                                                                @error('phone')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select name="company_id" class="form-control @error('company_id') is-invalid @enderror" required>
                                                                    <option disabled selected>Seleccionar Empresa</option>
                                                                    @foreach ($empresas as $empresa)
                                                                        <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('company_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12">
                                                                <input type="email" name="email" placeholder="Correo Electrónico" class="form-control @error('email') is-invalid @enderror" required>
                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
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
                                    Empresa y Empleado
                                </th>
                                <th class="text-center">
                                    Acción
                                </th>
                            </thead>
                            @if($empleados->total() > 0)
                            <tbody id="tbodyEmpleados">
                                @foreach ($empleados as $empleado)
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-2 align-self-center">
                                                <?php $empresa = $empresas->where('id', $empleado->company_id)->first(); ?>
                                                <img class="img-thumbnail" src="{{ asset('storage/'.$empresa->logo) }}" alt="Empleado de {{ $empresa->name }}">
                                            </div>
                                            <div class="col-md-10 align-self-center">
                                                <h4 class="my-0"><strong>{{ $empleado->first_name }} {{ $empleado->last_name }}</strong></h4>
                                                <?php $employerslist = $empleados->where('company_id', $empleado->id); ?>
                                                <p class="my-0"><strong>Correo Electrónico:</strong> {{ $empleado->email }}</p>
                                                <p class="my-0"><strong>Teléfono:</strong> {{ $empleado->phone }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="float-right">
                                            <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-primary rounded" data-tooltip="tooltip" title="Editar"><i class="now-ui-icons ui-1_settings-gear-63"></i></a>
                                            <a href="javascript:{}" onclick="document.RemoveEmployer{{ $empleado->id }}.submit();" data-tooltip="tooltip" title="Remover" class="btn btn-danger rounded"><i class="now-ui-icons ui-1_simple-remove"></i></a>
                                            <form name="RemoveEmployer{{ $empleado->id }}" action="{{ route('empleados.destroy', $empleado->id) }}" method="POST">
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
                                @foreach ($empleados as $empleado)
                                <tr>
                                    <td>
                                        <h1>No hay Empleados</h1>
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
                                <li class="page-item @if($empleados->onFirstPage() == 1) disabled @endif">
                                    <a class="page-link" href="{{ $empleados->previousPageUrl() }}">
                                        Anterior
                                    </a>
                                </li>
                                @for($i=1; $i<=$empleados->lastPage(); $i++)
                                <li class="page-item @if($empleados->currentPage() == $i) active @endif()">
                                    <a class="page-link" href="{{ $empleados->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                <li class="page-item"><a class="page-link @if($empleados->currentPage() == $empleados->lastPage()) disabled @endif" href="{{ $empleados->nextPageUrl() }}">Siguiente</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
