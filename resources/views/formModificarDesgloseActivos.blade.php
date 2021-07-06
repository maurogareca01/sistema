@extends('layouts.plantilla')

@section('titulo','Modificacion de Reposicion')



@section('subTitulo', 'DESGLOSE - MODIFICACION DE REPOSICION DE ACTIVO')

@section('contenido')
 

<div class="content-formulario">
    <div class="contact-wrapper">
        <div class="modifica-form">
            <h3>Reposicion N°: {{$desgloseActivos->idDesglose}}</h3>
            <form action="/modificarDesgloseActivos" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idDesglose" id="idDesglose" value="{{$desgloseActivos->idDesglose }}">
                
    
                <p>
                    <label for="cuenta">Quien Repone el Dinero:</label>
                    <select name="cuenta" id="cuenta"> 
                        <option value="{{$desgloseActivos->reponeUsuario}}">{{$desgloseActivos->reponeUsuario}} - ACTUAL</option>
                        @foreach($usuarios as $user)
                            <option value="{{$user->id}}">{{$user->name}} {{$user->apellido}}</option>
                        @endforeach
                    </select>
                    @error('cuenta')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>       
                <p>
                    <label for="reponer">Dinero A Reponer</label>
                    <input disabled type="number"   id="reponer" name="reponer" value="{{$desgloseActivos->dinero}}">
                    @error('reponer')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>               
                <p>
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" maxlength="252" id="descripcion" cols="30" rows="10">{{ $desgloseActivos->descripcion }}</textarea> 
                    @error('descripcion')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>   
                <p>
                    <label for="medioPagoDesglose">Medio De Pago</label>
                    <select name="medioPagoDesglose" id="medioPagoDesglose"  >
                        <option value="{{$desgloseActivos->medioDePago}}">{{$desgloseActivos->medioDePago}} - ACTUAL</option>
                        <option value="Efectivo" >Efectivo</option>
                        <option value="Bank" >Bank</option>
                        <option value="Mercado Pago" >Mercado Pago</option>
                        <option value="Uala" >Ualá</option>
                    </select>
                    @error('medioPagoDesglose')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>  
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminDesglose'" type="button">Volver</button>
                </p>
                <p>
                    <button class="btn-verModificar" type="sumbit">Modificar</button>
                </p>                                
            </form>
        </div>
    </div>
</div> 
 
<script>
$(document).ready(function() {

    $('#cuenta').on('change', function() {
        var cuenta = $(this).val(); 
        var idDesglose = $('#idDesglose').val();  

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/desgloseVerElMaxDeUsuarioConActivo',
            method: 'post',
            data: {
                cuenta: cuenta,
                idDesglose: idDesglose,
                _token: $('input[name="_token"]').val()
            }
        }).done(function(res) {
            var arreglo = JSON.parse(res)
            //console.log(arreglo.user.activos,arreglo.desgloseActivos.dinero);

            $('#reponer').empty();
            $('#reponer').replaceWith(
                "<input type='number' id='reponer' name='reponer'>"
                  
            );
        })
 

    });
})

</script>
@endsection