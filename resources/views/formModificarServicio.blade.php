@extends('layouts.plantilla')

@section('titulo','Modificacion de Servicio')



@section('subTitulo', 'INVENTARIO  - MODIFICACION DE SERVICIO')

@section('contenido')
 

<div class="content-formulario content-alta">
    <div class="contact-wrapper ">
        <div class="modifica-form alta">
            <h3>Servicioi N° A{{$servicio->idServicio}}</h3>
            <form action="/modificarServicio/{{$servicio->idServicio}}" method="POST" enctype="multipart/form-data">
            @csrf

                {{--  
                    <p>
                        <label for="dispoER">Dispone De Concen. Respironics?</label>
                        <select  name="dispoER" id="dispoER" >
                            <option value="{{$servicio->dispoER}}" >@php if($servicio->dispoER==1){echo 'Si';}else{echo 'No';} @endphp - Actual</option>
                            <option value="0" >No</option>
                            <option value="1" >Si</option>
                        </select>
                        @error('dispoER')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </p> 
                    <p>
                        <label for="dispoEA">Dispone De Concen. Airsep?</label>
                        <select  name="dispoEA" id="dispoEA" >
                            <option value="{{$servicio->dispoEA}}" >@php if($servicio->dispoEA==1){echo 'Si';}else{echo 'No';} @endphp  - Actual</option>
                            <option value="0" >No</option>
                            <option value="1" >Si</option>
                        </select>
                        @error('dispoEA')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </p> 
                    <p>
                        <label for="dispoEY">Dispone De Concen. Yuwell?</label>
                        <select  name="dispoEY" id="dispoEY" >
                            <option value="{{$servicio->dispoEY}}" >@php if($servicio->dispoEY==1){echo 'Si';}else{echo 'No';} @endphp  - Actual</option>
                            <option value="0" >No</option>
                            <option value="1" >Si</option>
                        </select>
                        @error('dispoEY')
                            <span class="error">{{ $message }}</span>
                        @enderror 
                    </p>
                --}}
                
                {{--  
                    <p> 
                        <label for="nombreServ">Nombre</label>
                        <textarea maxlength="50" rows="1" cols="50" type="text" name="nombreServ" id="nombreServ">{{ $servicio->nombreServ }}</textarea>
                        @error('nombreServ')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                    <p> 
                        <label for="descripcion">Descripcion</label>
                        <textarea maxlength="150" rows="1" cols="50" type="text" name="descripcion" id="descripcion">{{$servicio->descripcion}}</textarea>
                        @error('descripcion')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                --}}

                {{--  
                    <p class="alto-concen">
                        <label for="">Dispone De Concentradores? </label>
                            @if($servicio->dispoER==1)
                                <label class="concen" for="respironics"><input checked class="concentradores" type="radio" name="concentradores[]"  value="respironics" id="respironics"/>Concentrador Respironics</label>
                            @else
                                <label class="concen" for="respironics"><input class="concentradores" type="radio" name="concentradores[]"  value="respironics" id="respironics"/>Concentrador Respironics</label>
                            @endif

                            @if($servicio->dispoEA==1)
                                <label class="concen" for="airsep"><input checked class="concentradores" type="radio" name="concentradores[]" value="airsep" id="airsep"/>Concentrador Airsep</label>
                            @else
                                <label class="concen" for="airsep"><input class="concentradores" type="radio" name="concentradores[]" value="airsep" id="airsep"/>Concentrador Airsep</label>
                            @endif

                            @if($servicio->dispoEY==1)
                                <label class="concen" for="yuwell"><input checked class="concentradores" type="radio" name="concentradores[]" value="yuwell" id="yuwell"/>Concentrador Yuwell</label>
                            @else
                                <label class="concen" for="yuwell"><input class="concentradores" type="radio" name="concentradores[]" value="yuwell" id="yuwell"/>Concentrador Yuwell</label>
                            @endif

                    </p> 
                --}}
                <p>
                    <label for="">Dispone De Concentrador? </label>
                    <select  name="concen" id="concen" >
                        <option value="{{$servicio->dispoER}}" >@php if($servicio->dispoER==1){echo 'Si';}else{echo 'No';} @endphp  - Actual</option>
                        <option value="0" >No</option>
                        <option value="1" >Si</option>
                    </select>
                    @error('concen')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>
                <p>
                    <label for="dispoT1">Dispone De Tubo de 1 Metro?</label>
                    <select  name="dispoT1" id="dispoT1" >
                        <option value="{{$servicio->dispoT1}}" >@php if($servicio->dispoT1==1){echo 'Si';}else{echo 'No';} @endphp  - Actual</option>
                        <option value="0" >No</option>
                        <option value="1" >Si</option>
                    </select>
                    @error('dispoT1')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p> 
                <p>
                    <label for="dispoT415">Dispone De Tubo de 415?</label>
                    <select  name="dispoT415" id="dispoT415" >
                        <option value="{{$servicio->dispoT415}}" >@php if($servicio->dispoT415==1){echo 'Si';}else{echo 'No';} @endphp  - Actual</option>
                        <option value="0" >No</option>
                        <option value="1" >Si</option>
                    </select>
                    @error('dispoT415')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p> 
                <p>
                    <label for="dispoO">Dispone De Oximetro?</label>
                    <select  name="dispoO" id="dispoO" >
                        <option value="{{$servicio->dispoO}}" >@php if($servicio->dispoO==1){echo 'Si';}else{echo 'No';} @endphp  - Actual</option>
                        <option value="0" >No</option>
                        <option value="1" >Si</option>
                    </select>
                    @error('dispoO')
                        <span class="error">{{ $message }}</span>
                    @enderror 
                </p>  
                <p>
                    <label for="costoServ">Costo de Servicio</label>
                    <input   type="number" name="costoServ" id="costoServ" autocomplete="off" value="{{$servicio->costoServ}}" placeholder="{{$servicio->costoServ}}">
                    @error('costoServ')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="garantia">Garantia</label>
                    <input   type="number" name="garantia" id="garantia" autocomplete="off" value="{{$servicio->garantia}}" placeholder="{{$servicio->garantia}}">
                    @error('garantia')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </p> 
                <p>
                    <label for="imgServ">Cargar Imagen</label>
                    <input type="file" accept="image/*" name="imgServ" id="imgServ">
                </p>
                <p> 
                    <button class="btn-verModificar" type="button" onclick="ver2('{{$servicio->imgServ}}')">Ver Imagen</button> 
                </p>
                <p>
                    <button class="btn-verModificar" onclick="location.href='/adminServicios'" type="button">Volver</button>
                </p>
                <p>
                    <button class="btn-verModificar" type="sumbit">Modificar Servicio</button>
                </p>                                
            </form>
        </div>
    </div>
</div>
<script src="../js/alertas.js"></script>
<script> //PARA SACAR EL SELECCIONADO DEL RADIO INPUT
    function deselectableRadios(rootElement) {
        if(!rootElement) rootElement = document;
        if(!window.radioChecked) window.radioChecked = null;
        window.radioClick = function(e) {
        const obj = e.target;
        if(e.keyCode) return obj.checked = e.keyCode!=32;
        obj.checked = window.radioChecked != obj;
        window.radioChecked = obj.checked ? obj : null;
    }
    rootElement.querySelectorAll("input[type='radio']").forEach( radio => {
        radio.setAttribute("onclick", "radioClick(event)");
        radio.setAttribute("onkeyup", "radioClick(event)");
    });
    }

    deselectableRadios();
</script>
 

@endsection