$('#divPadre').on('click', '.entrada', function(){
    $('#modalEntrdada').modal('show');
    var idEmpelado = $(this).attr('idEmpleado');
    $('#idEntrada').val(idEmpelado);
});

$('#divPadre').on('click', '.salida', function(){
    $('#modalSalida').modal('show');
});

$('#divPadre').on('click', '#registrarEntrada', function(){
    var horaEntrada = $('#horaEntrada').val();
    var observacionEntrada = $('#observacionEntrada').val();
    var idEmpelado = $('#idEntrada').val();

    console.log(horaEntrada, observacionEntrada, idEmpelado);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'horarioEntrada',
        type: 'post',
        data:{
            horaEntrada: horaEntrada,
            observacionEntrada: observacionEntrada,
            idEmpelado: idEmpelado
        },
        success: function(data){
            console.log(data);
            /*if(data.success==true){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Actualizacion con exito',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Se ha producido un error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }*/
        },
        error: function(data){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Error fatal por favor recargue la pagina',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
})