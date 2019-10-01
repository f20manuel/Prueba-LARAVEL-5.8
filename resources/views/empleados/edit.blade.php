<?php $name = 'Editar '.$empleado->name; ?>
@extends('layouts.app')

@section('ClassBody', '')

@section('content')

<div class="row mx-0 justify-content-center">
    <div class="col-md-8 my-5">
        <div class="card">
            <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input type="text" name="first_name" placeholder="Nombres" value="{{ $empleado->first_name }}" class="form-control @error('first_name') is-invalid @enderror" required>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="last_name" placeholder="Apellidos" value="{{ $empleado->last_name }}" class="form-control @error('last_name') is-invalid @enderror" required>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input type="text" name="phone" placeholder="Telefono" value="{{ $empleado->phone }}" class="form-control @error('phone') is-invalid @enderror" required>
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
                                            @if($empresa->id == $empleado->company_id)
                                                <option value="{{ $empresa->id }}" selected>{{ $empresa->name }}</option>
                                            @else
                                                <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
                                            @endif
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
                                    <input type="email" value="{{ $empleado->email }}" name="email" placeholder="Correo Electrónico" class="form-control @error('email') is-invalid @enderror" required>
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
