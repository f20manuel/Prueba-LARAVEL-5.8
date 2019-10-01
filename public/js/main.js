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
});
