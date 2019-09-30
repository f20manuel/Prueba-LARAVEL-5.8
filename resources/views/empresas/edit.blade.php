<?php $name = 'Editar '.$empresa->name; ?>
@extends('layouts.app')

@section('ClassBody', '')

@section('content')

<div class="row mx-0 justify-content-center">
    <div class="col-md-8 my-5">
        <div class="card">
            <form enctype="multipart/form-data" action="{{ route('empresas.update', $empresa->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="row mx-0">
                                <div class="col-md-6">
                                    <div class="my-2">
                                        <label for="file-input">
                                            Foto Actual (100x100)
                                        </label>
                                        <img class="img-thumbnail" src="{{ asset('storage/'.$empresa->logo) }}" alt="Empresa {{ $empresa->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-2">
                                        <label for="file-input">
                                            Subir foto (100x100)
                                        </label>
                                        <div id="preview"></div>
                                        <input id="file-input" name="logo" accept="image/jpg, image/png" type="file">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" value="{{ $empresa->name }}" placeholder="Nombre de la Empresa" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" value="{{ $empresa->email }}" placeholder="Correo Electrónico" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="website" value="{{ $empresa->website }}" placeholder="Sitio Web (opcional)" class="form-control @error('website') is-invalid @enderror">
                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer float-right">
                    <a href="{{ route('empresas.index') }}" class="btn btn-secondary">Volver a Eempresas</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
