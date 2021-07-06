@extends('layouts.plantilla')

@section('titulo','Administrador de Servicios')



@section('subTitulo', 'INVENTARIO  -  SERVICIOS -DISPONIBILIAD ')

@section('contenido')
 

<div class="inven-tablas">
        @if (session('mensaje'))
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('mensaje') }}",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif  
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UNA MODIFICACION -->
        @if (session('mensaje2'))
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('mensaje2') }}",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif  
        <!--CONTROLA EL MENSAJE QUE RECIBE CUANDO SE CONCRETO UNA ELIMINACION -->
        @if (session('mensaje3'))
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('mensaje3') }}",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif 
        <!--CONTROLA SI HAY UN ERROR EN EL FORMULARIO DE MODIFICACION-->
        @if ($errors->any())
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "No se pudo Agregar el Servicio",
                showConfirmButton: false,
                timer: 2000
                }) 
            </script>
        @endif
    <div class="sopala-inventario">
        <div class=" inventario">
            <ul class="inven">

                <li><a href="/adminEquipos">Equipos</a></li>
                <li><a href="/adminTubos">Tubos</a></li>
                <li><a href="/adminOximetros">Oximetros</a></li>
                <li><a href="/adminServicios">Servicios</a></li>
            </ul>
        </div>
    </div>

    <div class="tablas">
        <div class="content-input">
            
                <form>   
                    @csrf 
                    <div class="input">
                        <input class="search-txt" type="text" name="buscar" value="" placeholder="Buscar Servicio" autocomplete="off">
                            
                        <button type="submit"  class="search-btn">
                             <i class="fas fa-search"></i>
                        </button>
                         
                    </div>
                </form>
            
        </div>
        
        <div class="content">
            <table class="content-table">
                <thead class="thead">
                    <tr>
                        <th>N° Servicio</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Costo de Servicio</th>
                        <th>Garantia</th>
                        <th>D/C-Respironics</th>                        
                        <th>D/C-Airsep</th>                        
                        <th>D/C-Yuwell</th>
                        <th>D/Tubo 680L</th>
                        <th>D/Tubo 415L</th>
                        <th>D/Oximetro</th>
                        <th>Imagen</th>


                        <th colspan="2" class="text-center">
                            <p href="" class="btn-add" id="btn-abrir-popup">
                                <i class="fas fa-plus-square"></i>
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios as $servicio)
                   
                    <tr>
                        <td>
                            S-{{$servicio->idServicio}} 
                        </td>
                        <td> {{ $servicio->nombreServ }} </td>

                        <input type="hidden" value="{{$servicio->descripcion}}" id="{{ $servicio->idServicio }}">
                        <td><button type="button" onclick="com('{{$servicio->idServicio}}')">Ver</button></td>
                        <td> {{ $servicio->costoServ }}</td>
                        <td> {{ $servicio->garantia }}</td>
                        <td>
                            @php if($servicio->dispoER==1){
                                echo "<i class='fas fa-check' style='font-size:30px'></i>"; 
                            }else{
                                echo "<i class='fas fa-ban'style='font-size:30px'></i>";
                            }
                            @endphp
                        </td>
                        <td>
                            @php if($servicio->dispoEA==1){
                                echo "<i class='fas fa-check' style='font-size:30px'></i>"; 
                            }else{
                                echo "<i class='fas fa-ban'style='font-size:30px'></i>";
                            }
                            @endphp
                        </td>
                        <td>
                            @php if($servicio->dispoEY==1){
                                echo "<i class='fas fa-check' style='font-size:30px'></i>"; 
                            }else{
                                echo "<i class='fas fa-ban'style='font-size:30px'></i>";
                            }
                            @endphp
                        </td>
                        <td>
                            @php if($servicio->dispoT1==1){
                                echo "<i class='fas fa-check' style='font-size:30px'></i>"; 
                            }else{
                                echo "<i class='fas fa-ban'style='font-size:30px'></i>";
                            }
                            @endphp
                        </td>
                        <td>
                            @php if($servicio->dispoT415==1){
                                echo "<i class='fas fa-check' style='font-size:30px'></i>"; 
                            }else{
                                echo "<i class='fas fa-ban'style='font-size:30px'></i>";
                            }
                            @endphp
                        </td> 
                        <td>
                            @php if($servicio->dispoO==1){
                                echo "<i class='fas fa-check' style='font-size:30px'></i>"; 
                            }else{
                                echo "<i class='fas fa-ban'style='font-size:30px'></i>";
                            }
                            @endphp
                        </td>

                        <td><button type="button" onclick="ver2('{{$servicio->imgServ}}')">Ver</button></td>

                        <td>
                            <a href="/formModificarServicio/{{ $servicio->idServicio }}" class="btn-update">
                                 <i class="fas fa-pen"></i>
                            </a>
                            </td>
                        <td>
                            <form action="/eliminarServicio/{{ $servicio->idServicio }}" method="POST" class="formulario-eliminar">
                                @csrf
                                <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                            </form>    
                        </td>
                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>  
        <div class="overlay" id="overlay">
            <div class="popup" id="popup">

                <div class="content-formulario content-alta">

                    <div class="contact-wrapper">
                        
                        <div class="modifica-form alta">
                        <p href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></p>

                            <h1>Agregar Nuevo Servicio</h1>
                            <form action="/agregarServicio" method="POST" enctype="multipart/form-data">
                            @csrf
                                {{--  
                                    <p> 
                                        <label for="nombreServ">Nombre</label>
                                        <textarea maxlength="50" rows="1" cols="50" type="text" name="nombreServ" id="nombreServ">{{ old('nombreServ') }}</textarea>
                                        @error('nombreServ')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </p>
                                    <p> 
                                        <label for="descripcion">Descripcion</label>
                                        <textarea  maxlength="150" rows="1" cols="50" type="text" name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                                        @error('descripcion')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </p>
                                --}}
                                {{--  
                                    <p>
                                        <label for="imgServ">Cargar Imagen</label>
                                        <input type="file" accept="image/*" name="imgServ" id="imgServ">
                                    </p>
                                --}} 
                                {{--
                                    <p>
                                        <label for="dispoER">Dispone De Concen. Respironics?</label>
                                        <select  name="dispoER" id="dispoER" >
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
                                            <option value="0" >No</option>
                                            <option value="1" >Si</option>
                                        </select>
                                        @error('dispoEY')
                                            <span class="error">{{ $message }}</span>
                                        @enderror 
                                    </p> 
                                --}}
                                
                                {{--
                                    <p class="alto-concen">
                                    <label for="">Dispone De Concentradores? </label>
                                        <label class="concen" for="respironics"><input class="concentradores" type="checkbox" name="concentradores[]" value="respironics" id="respironics"/>Concentrador Respironics</label>
                                        <label class="concen" for="airsep"><input class="concentradores" type="checkbox" name="concentradores[]" value="airsep" id="airsep"/>Concentrador Airsep</label>
                                        <label class="concen" for="yuwell"><input class="concentradores" type="checkbox" name="concentradores[]" value="yuwell" id="yuwell"/>Concentrador Yuwell</label>
                                    </p> 
                                --}}
                                <p>
                                    <label for="">Dispone De Concentrador? </label>
                                    <select  name="concen" id="concen" >
                                        <option value="">Seleccione Una Opcion</option>
                                        <option value="0" >No</option>
                                        <option value="1" >Si</option>
                                    </select>
                                    @error('concen')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p> 
                                <p>
                                    <label for="dispoT1">Dispone De Tubo de 680L?</label>
                                    <select  name="dispoT1" id="dispoT1" >
                                        <option value="">Seleccione Una Opcion</option>
                                        <option value="0" >No</option>
                                        <option value="1" >Si</option>
                                    </select>
                                    @error('dispoT1')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p> 
                                <p>
                                    <label for="dispoT415">Dispone De Tubo de 415L?</label>
                                    <select  name="dispoT415" id="dispoT415" >
                                        <option value="">Seleccione Una Opcion</option>
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
                                        <option value="">Seleccione Una Opcion</option>
                                        <option value="0" >No</option>
                                        <option value="1" >Si</option>
                                    </select>
                                    @error('dispoO')
                                        <span class="error">{{ $message }}</span>
                                    @enderror 
                                </p> 
                                <p>
                                    <label for="costoServ">Costo de Servicio</label>
                                    <input min="0" type="number" name="costoServ" id="costoServ" autocomplete="off" value="{{ old('costoServ')  }}" >
                                    @error('costoServ')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </p>
                                <p>
                                    <label for="garantia">Garantia</label>
                                    <input min="0" type="number" name="garantia" id="garantia" autocomplete="off" value="{{ old('garantia')  }}" >
                                    @error('garantia')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </p> 
                                 
                                <p>
                                    <button class="btn-verModificar" id="btn-servicio-agregar" type="sumbit">Agregar Servicio</button>
                                </p>                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
     
    <br>
    <br>
    <div class="tablas">
        
        <h1 class="titulo-dispo">--Disponibilidad de Equipos--</h1>
        
        <div class="content">
            <table class="content-table">
                <thead class="thead">
                    <tr>
                        <th>Identificador</th>
                        <th style="width:auto">Descripcion</th>
                        <th style="width:auto">Disponibles</th>
                        <th style="width:auto">En Uso</th>
                        <th style="width:auto">Reservado</th>
                        <th style="width:auto">Revisar</th>
                        <th style="width:auto">Reparacion</th>
                        <th style="width:auto">Por Entregar</th>
                        <th style="width:auto">Por Retirar</th>
                        <th style="width:auto">Total de Equipos</th>


                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($dispoequipos as $dispoequipo)

                    <tr>
                        <td>{{ $dispoequipo->idDispo }} </td>
                        <td>{{$dispoequipo->nombre}}</td> 
                        <td>{{ $dispoequipo->siDispo}}</td>
                        <td>{{ $dispoequipo->enUsoDispo}}</td>
                        <td>{{ $dispoequipo->reserDispo}}</td>
                        <td>{{ $dispoequipo->revisarDispo}}</td>
                        <td>{{ $dispoequipo->reparacionDispo}}</td>
                        <td>{{ $dispoequipo->entregarDispo}}</td>
                        <td>{{ $dispoequipo->retirarDispo}}</td>
                        <td>{{ $dispoequipo->totalDispo}}</td>
                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>  
    </div>
    <br>
    <br>
    <div class="tablas">
        
        <h1 class="titulo-dispo">--Disponibilidad de Tubos--</h1>
        
        <div class="content">
            <table class="content-table">
                <thead class="thead">
                    <tr>
                        <th>Identificador</th>
                        <th style="width:auto">Descripcion</th>
                        <th style="width:auto">Disponibles</th>
                        <th style="width:auto">En Uso</th>
                        <th style="width:auto">Reservado</th>
                        <th style="width:auto">Revisar</th>
                        <th style="width:auto">Reparacion</th>
                        <th style="width:auto">Por Entregar</th>
                        <th style="width:auto">Por Retirar</th>
                        <th style="width:auto">Total de Tubos</th>

                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($dispotubos as $dispotubo)

                    <tr>
                        <td>{{ $dispotubo->idDispo }} </td>
                        <td>{{$dispotubo->nombre}}</td> 
                        <td>{{ $dispotubo->siDispo}}</td>
                        <td>{{ $dispotubo->enUsoDispo}}</td>
                        <td>{{ $dispotubo->reserDispo}}</td>
                        <td>{{ $dispotubo->revisarDispo}}</td>
                        <td>{{ $dispotubo->reparacionDispo}}</td>
                        <td>{{ $dispotubo->entregarDispo}}</td>
                        <td>{{ $dispotubo->retirarDispo}}</td>
                        <td>{{ $dispotubo->totalDispo}}</td>
                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>  
    </div>
    <br>
    <br>
    <div class="tablas">
        
        <h1 class="titulo-dispo">--Disponibilidad de Oximetros--</h1>
        
        <div class="content">
            <table class="content-table">
                <thead class="thead">
                    <tr>
                    <th>Identificador</th>
                        <th style="width:auto">Descripcion</th>
                        <th style="width:auto">Disponibles</th>
                        <th style="width:auto">En Uso</th>
                        <th style="width:auto">Reservado</th>
                        <th style="width:auto">Revisar</th>
                        <th style="width:auto">Reparacion</th>
                        <th style="width:auto">Por Entregar</th>
                        <th style="width:auto">Por Retirar</th>
                        <th style="width:auto">Total de Oximetros</th>

                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($dispooximetros as $dispooximetro)

                    
                    <tr>
                        <td>{{ $dispooximetro->idDispo }} </td>
                        <td>{{ $dispooximetro->nombre}}</td> 
                        <td>{{ $dispooximetro->siDispo}}</td>
                        <td>{{ $dispooximetro->enUsoDispo}}</td>
                        <td>{{ $dispooximetro->reserDispo}}</td>
                        <td>{{ $dispooximetro->revisarDispo}}</td>
                        <td>{{ $dispooximetro->reparacionDispo}}</td>
                        <td>{{ $dispooximetro->entregarDispo}}</td>
                        <td>{{ $dispooximetro->retirarDispo}}</td>
                        <td>{{ $dispooximetro->totalDispo}}</td>

                    </tr>
                   
                    @endforeach
                    

                </tbody>
            </table>
              
        </div>  
    </div>

   <br>
   <br>
   <br>
   <br>
</div>    
<script src="js/btnClick.js"></script>  <!--SCRIPT PARA QUE LOS BOTONES NO SE PRESIONES MUCHAS VECES-->

<script src="js/alertas.js"></script>  <!--SCRIPT PARA LOS BOTONES DE ALERTAS-->
<script src="js/popupBtn-cerrar.js"></script>  <!--SCRIPT PARA LA VENTANA EMERGENTE DEL FOMULARIO DE ALTA-->


@endsection