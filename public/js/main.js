$(document).ready(function(){


  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    function submitSearchEmpresas(){
        var search = $('input[name="searchEmpresa"]').val();
        $.ajax({
            url: 'buscar/empresas',
            data: {search:search},
            type: 'POST',
            success: function(data) {
                $('#tbodyEmpresas').html(data);
            }
        });
    }

    $('#search_empresas').submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: 'buscar/empresas',
            data: data,
            type: 'POST',
            success: function(data) {
                $('#tbodyEmpresas').html(data);
            }
        });
    });

    $('input[name="searchEmpresa"]').keyup(function(e){
        e.preventDefault();
        submitSearchEmpresas();
    });

    $('input[name="searchEmpresa"]').change(function(e){
        e.preventDefault();
        submitSearchEmpresas();
    });

    //buscar empleados
    function submitsearchEmpleados(){
        var search = $('input[name="searchEmpleados"]').val();
        $.ajax({
            url: 'buscar/empleados',
            data: {search:search},
            type: 'POST',
            success: function(data) {
                $('#tbodyEmpleados').html(data);
            }
        });
    }

    $('#search_empleados').submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: 'buscar/empleados',
            data: data,
            type: 'POST',
            success: function(data) {
                $('#tbodyEmpleados').html(data);
            }
        });
    });

    $('input[name="searchEmpleados"]').keyup(function(e){
        e.preventDefault();
        submitsearchEmpleados();
    });

    $('input[name="searchEmpleado"]').change(function(e){
        e.preventDefault();
        submitsearchEmpleados();
    });

    $('[data-tooltip="tooltip"]').tooltip();

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
});
