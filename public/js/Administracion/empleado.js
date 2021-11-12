$('#divPadre').on('click', '#btnNew', function () {
    $('#registroEmpleado').modal('show');
});

$('#divPadre').on('click', '#btnSave', function () {

    var formdata = new FormData($('#frmEmpelado')[0]);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'guadarEmpleado',
        type: 'post',
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.success == true) {
                $('#frmEmpelado')[0].reset();
                $('#registroEmpleado').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Registro con exito',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'No se pudo registrar',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        error: function (data) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Se produjo un error grave',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
});

$('#divPadre').on('click', '.elimiarActivar', function(){
    
    var estado = $(this).attr('estado');
    var idEmpleado = $(this).attr('idEmpleado');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'estadoEmpleado',
        type: 'post',
        data:{
            idEmpleado: idEmpleado,
            estado: estado
        },
        success: function(data){
            if (data.success == true) {
                recargarEmpleado()
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Operacion exitosa',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Fallo',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        error: function(data){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Fatal recargue la pagina',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });

});

$('#divPadre').on('click', '.btnEditar', function(){
    
    $('#editarEmpleado').modal('show');
    var idEmpleado = $(this).attr('idEmpleado');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'editarEmpleado',
        type: 'post',
        data: {
            idEmpleado: idEmpleado
        }, 
        success: function(data){
            $('#empleadoBody').html(data);
        },
        error: function(data){
            console.log(data);
        }
    });
});

$('#divPadre').on('click', '#btnActualizar', function(){
    
    var formdata = new FormData($('#frmEmpeladoEditar')[0]);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'updateEmpleado',
        type: 'post',
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.success == true) {
                $('#editarEmpleado').modal('hide');
                recargarEmpleado();
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Actualizacion con exito',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'No se pudo registrar',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        error: function (data) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Se produjo un error grave',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
});

function recargarEmpleado() {
    $.ajax({
        url: 'recargaEmpleado',
        type: 'get',
        success: function (data) {
            $('#tableEmpleado').html(data);
        }
    });
}