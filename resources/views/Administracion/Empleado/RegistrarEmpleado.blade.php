@extends('plantilla.master')
@section('name')
    <div id="divPadre">
        <div class="modal" tabindex="-1" id="registroEmpleado">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registro de Empleados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="bodyEmpleado">
                        <form action="" method="post" id="frmEmpelado">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="telefono">Telefono:</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="dpi">DPI:</label>
                                    <input type="text" class="form-control" name="dpi" id="dpi">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="nacimiento">Fecha nacimiento</label>
                                    <input type="date" name="nacimiento" id="nacimiento" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="estadoCivil">Estado Civil:</label>
                                    <select name="estadoCivil" id="estadoCivil" class="form-control">
                                        <option value="Soltero">Soltero</option>
                                        <option value="Casado">Casado</option>
                                        <option value="Viudo">Viudo</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="correo">Correo Electronico:</label>
                                    <input type="email" class="form-control" name="correo" id="correo">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="area">Area:</label>
                                    <select class="form-control" name="area" id="area">
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->idArea }}">{{ $area->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label for="direccion">Dirección:</label>
                                    <textarea class="form-control" name="direccion" id="direccion"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="editarEmpleado">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Datos Empleados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="empleadoBody">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnActualizar">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-primary" id="btnNew">Nuevo</button>

        <p></p>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>DPI</th>
                    <th>F. Nacimineto</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Estado Civil</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Area</th>
                    <th>Opciones</th>
                </thead>
                <tbody id="tableEmpleado">
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->idEmpleado }}</td>
                            <td>{{ $empleado->nombre }}</td>
                            <td>{{ $empleado->dpi }}</td>
                            <td>{{ $empleado->nacimiento }}</td>
                            <td>{{ $empleado->direccion }}</td>
                            <td>{{ $empleado->telefono }}</td>
                            <td>{{ $empleado->estadoCivil }}</td>
                            <td>{{ $empleado->correo }}</td>
                            @if ($empleado->estado == 1)
                                <td><span class="badge badge-success">Activo</span></td>

                            @else
                                <td><span class="badge badge-danger">Inactivo</span></td>
                            @endif
                            <td>{{ $empleado->area }}</td>
                            <td>
                                @if ($empleado->estado == 1)
                                    <button class="btn btn-danger elimiarActivar" estado="0"
                                        idEmpleado="{{ $empleado->idEmpleado }}">Eliminar</button>
                                @else
                                    <button class="btn btn-success elimiarActivar" estado="1"
                                        idEmpleado="{{ $empleado->idEmpleado }}">Activar</button>
                                @endif
                                <button class="btn btn-info btnEditar"
                                    idEmpleado="{{ $empleado->idEmpleado }}">Editar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script src="{{ asset('/js/Administracion/empleado.js') }}"></script>
    </div>
@endsection
