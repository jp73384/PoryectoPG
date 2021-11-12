@extends('plantilla.master')
@section('name')
    <div id="divPadre">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Registrar</button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar area</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="frmArea">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="">Area</label>
                                    <input type="text" name="area" id="area" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnArea">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="modalArea">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Editar Area</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="modalBody">
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary" id="updateArea">Actualizar</button>
                </div>
              </div>
            </div>
          </div>

        <p></p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Area</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                <tbody id="tableArea">
                    @foreach ($areas as $area)
                        <tr>
                            <td>{{ $area->idArea }}</td>
                            <td>{{ $area->nombre }}</td>
                            @if ($area->estado == 1)
                                <td><span class="badge badge-success">Activo</span></td>
                                <td>
                                    <button class="btn btn-danger eliminarActivar" estado="0" idArea="{{ $area->idArea }}">Eliminar</button>
                                    <button class="btn btn-warning editarArea" editarArea="{{$area->idArea}}">Editar</button>
                                </td>
                            @else
                                <td><span class="badge badge-danger">Inactivo</span></td>
                                <td>
                                    <button class="btn btn-primary eliminarActivar" estado="1" idArea="{{ $area->idArea }}">Activar</button>
                                    <button class="btn btn-warning editarArea" editarArea="{{$area->idArea}}">Editar</button>
                                </td>
                                
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script src="{{asset('/js/Administracion/area.js')}}"></script>
    </div>
@endsection
