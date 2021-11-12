$('#divPadre').on('click', '#btnArea' , function(){

    var area = $('#area').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'guardarArea',
        type: 'post',
        data:{
            area: area
        },
        success: function(data){
            if(data.success==true){
                reloadArea();
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Registro con exito',
                    showConfirmButton: false,
                    timer: 1500
                  });
                  $('#frmArea')[0].reset();
                  $('#exampleModal').modal('hide');
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Fallo al registrar',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }
        },
        error: function(data){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
              })
        }
    })
});

$('#divPadre').on('click', '.eliminarActivar', function(){

    var estado = $(this).attr('estado');
    var idArea = $(this).attr('idArea');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'eliminarActivar',
        type: 'post',
        data:{
            estado: estado,
            idArea: idArea
        },
        success: function(data){
            if(data.success==true){
                reloadArea();
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Se proceso con exito',
                    showConfirmButton: false,
                    timer: 1500
                  });
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Ocurrio un error',
                    showConfirmButton: false,
                    timer: 1500
                  });
            }
        },
        error: function(data){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Error fatal',
                showConfirmButton: false,
                timer: 1500
              });
        }
    })
});

$('#divPadre').on('click', '.editarArea', function(){

    $('#modalArea').modal('show');

    var idArea = $(this).attr('editarArea');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'editarArea',
        type: 'post',
        data:{
            idArea: idArea
        },
        success: function(data){
            $('#modalBody').html(data);
        },
        error: function(data){

        }
    });

});


$('#divPadre').on('click', '#updateArea', function(){
    
    console.log('clic');
    var area = $('#areaEditar').val();
    var idArea = $('#idAreaEditar').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'updateArea',
        type: 'post',
        data:{
            area: area,
            idArea: idArea
        },
        success: function(data){
            if(data.success==true){
                $('#modalArea').modal('hide');
                reloadArea();
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Se proceso con exito',
                    showConfirmButton: false,
                    timer: 1500
                  });
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Ocurrio un error',
                    showConfirmButton: false,
                    timer: 1500
                  });
            }
        },
        error: function(data){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Error fatal',
                showConfirmButton: false,
                timer: 1500
              });
        }
    });
});

//funcionPara regcargar
function reloadArea(){

    $.ajax({
        url: 'reloadArea',
        type: 'get',
        success: function(data){
           $('#tableArea').html(data);
        }
    })
}