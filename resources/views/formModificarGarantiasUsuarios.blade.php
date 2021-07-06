@extends('layouts.plantilla')

@section('titulo','Modificacion de Garantia Activa')



@section('subTitulo', 'ACTUALIZACION DE GARANTIA ACTIVA')

@section('contenido')
 

<div class="content-formulario">
    <div class="contact-wrapper">
        <div class="modifica-form">
            <h3>Usuario : {{$usuario->name}} {{$usuario->apellido}}</h3>
            <form action="/modificarGarantiaActiva" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idUsuario" value="{{ $usuario->id }}">
                <p> 
                    <label for="garantiaActiva">Garantia Activa Actuales</label>
                    <input readonly type="number" name="garantiaActiva" id="garantiaActiva" value="{{$usuario->garantiaActiva}}">
                </p> 
                <p> 
                    <label for="garantiaActivaDispo">Garantia Activa Disponibles</label>
                    <input readonly type="number" name="garantiaActivaDispo" id="garantiaActivaDispo" value="{{$usuario->garantiaActiva}}">
                </p> 
                <p>
                    <label for="fciChange">FCI</label> 
                    <select name="fciChange" id="fciChange" >  
                        <option value="" >Selecciona El Porcentaje de FCI</option>
                        <option value="10" >10%</option>
                        <option value="20" >20%</option>
                        <option value="30" >30%</option>
                        <option value="40" >40%</option>
                        <option value="50" >50%</option>
                        <option value="60" >60%</option>
                        <option value="70" >70%</option>
                        <option value="80" >80%</option>
                        <option value="90" >90%</option>
                        <option value="100" >100%</option>
                    </select> 
                </p>    
                <p> 
                    <label for="fci">FCI Actual</label>
                    <input readonly type="number" id="fci" value="" placeholder="Selecciona El Porcentaje de FCI">
                </p> 

                <p>
                    <label for="plazoFijoChange">Plazo Fijo</label> 
                    <select name="plazoFijoChange" id="plazoFijoChange" >  
                        <option value="" >Selecciona El Porcentaje de Plazo Fijo</option>
                        <option value="10" >10%</option>
                        <option value="20" >20%</option>
                        <option value="30" >30%</option>
                        <option value="40" >40%</option>
                        <option value="50" >50%</option>
                        <option value="60" >60%</option>
                        <option value="70" >70%</option>
                        <option value="80" >80%</option>
                        <option value="90" >90%</option>
                        <option value="100" >100%</option>
                    </select>
 
                </p>    
                <p> 
                    <label for="plazoFijo">Plazo Fijo Actual</label>
                    <input readonly type="number" id="plazoFijo" value="" placeholder="Selecciona El Porcentaje de Plazo Fijo">
                </p> 
                
                <!--
                <p>
                    <label for="activoChange">Activos  </label> 
                    <select name="activoChange" id="activoChange" >  
                        <option value="" >Selecciona El Porcentaje de Activos</option>
                        <option value="10" >10%</option>
                        <option value="20" >20%</option>
                        <option value="30" >30%</option>
                        <option value="40" >40%</option>
                        <option value="50" >50%</option>
                        <option value="60" >60%</option>
                        <option value="70" >70%</option>
                        <option value="80" >80%</option>
                        <option value="90" >90%</option>
                        <option value="100" >100%</option>
                    </select>
 
                </p>    
                <p> 
                    <label for="activos">Activos Actual</label>
                    <input readonly type="number" id="activos" value="" placeholder="Selecciona El Porcentaje de Activos">
                </p> 
                
                <p>
                    <label for="efectivoChange">Efectivo  </label> 
                    <select name="efectivoChange" id="efectivoChange" >  
                        <option value="" >Selecciona El Porcentaje de Efectivo</option>
                        <option value="10" >10%</option>
                        <option value="20" >20%</option>
                        <option value="30" >30%</option>
                        <option value="40" >40%</option>
                        <option value="50" >50%</option>
                        <option value="60" >60%</option>
                        <option value="70" >70%</option>
                        <option value="80" >80%</option>
                        <option value="90" >90%</option>
                        <option value="100" >100%</option>
                    </select> 
                </p>  
                <p> 
                    <label for="efectivo">Efectivo Actual</label>
                    <input readonly type="number" id="efectivo" value="" placeholder="Selecciona El Porcentaje de Efectivo">
                </p> -->  


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
 <br>
<script src="{{ asset('js/formu-ajax.js') }}"></script>

@endsection