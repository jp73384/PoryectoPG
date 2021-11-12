@extends('plantilla.master')
@section('name')
    <div id="divPadre">

        <div class="modal" tabindex="-1" id="modalSalida">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Registrar Salida</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <label for="">Horario Salida</label>
                                <input type="time" name="horaSalida" id="horaSalida" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <label for="">Observaciones</label>
                                <textarea class="form-control" name="observacionSalida" id="observacionSalida"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary">Guardar</button>
                </div>
              </div>
            </div>
          </div>

        <div class="modal" tabindex="-1" id="modalEntrdada">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Registrar Entrada</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-sm-12 col-sm-12">
                                <label for="">Horario de entrada</label>
                                <input type="time" class="form-control" id="horaEntrada" name="horaEntrada">
                                <input type="text" name="idEntrada" id="idEntrada" hidden>
                            </div>
                            <div class="col-sm-12 col-sm-12">
                                <label for="">Observaciones</label>
                                <textarea class="form-control" name="observacionEntrada" id="observacionEntrada"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary" id="registrarEntrada">Guardar</button>
                </div>
              </div>
            </div>
          </div>
        <h5 class="text-center">Registrar horario de entradas</h5>
        <p></p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Cargo</th>
                    <th>Horario entrada</th>
                    <th>Horario salida</th>
                </thead>
                <tbody id="tablaEmpleado">
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->idEmpleado }}</td>
                            <td>{{ $empleado->nombre }}</td>
                            <td>{{ $empleado->area }}</td>
                            <td>
                                <button class="btn btn-success entrada" idEmpleado="{{$empleado->idEmpleado}}">Registrar</button>
                            </td>
                            <td>
                                <button class="btn btn-warning salida" idEmpleado="{{$empleado->idEmpleado}}">Registrar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script src="{{asset('/js/Administracion/registrarEntrada.js')}}"></script>
    </div>
@endsection
