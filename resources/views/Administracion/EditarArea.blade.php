@extends('plantilla.master')
@section('name')
    <div id="divPadre">
        <form action="{{Route('updateArea')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <label for="area">Area</label>
                    <input type="text" name="area" id="area" value="{{$editar->nombre}}" class="form-control">
                    <input type="text" name="idArea" id="idArea" value="{{$editar->idArea}}" hidden>
                </div>
                <div class="col-md-2 col-sm-2">
                    <label for="area">Actualizar</label>
                    <input type="submit" value="Actualizar" class="form-control btn btn-success">;
                </div>
            </div>
        </form>
    </div>
@endsection