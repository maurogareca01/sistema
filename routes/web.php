<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\TubosController;
use App\Http\Controllers\OximetrosController;
use App\Http\Controllers\DisponibilidadController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\RegistrosController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\GarantiaController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\RentabilidadController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register'=>false]);

 
Route::get('/', [RentabilidadController::class, 'verPanel'])->middleware('auth');
Route::post('/alertas', [RentabilidadController::class, 'alertas'])->middleware('roles:admin,administrador');
Route::post('/adminAlertas', [RentabilidadController::class, 'adminAlertas'])->middleware('roles:admin,administrador');
Route::post('/alertaGarantiaLiquidas', [RentabilidadController::class, 'alertaGarantiaLiquidas']);

////////////////RENTA//////////////

Route::post('/modificarRentabilidad', [RentabilidadController::class, 'modificarRentabilidad'])->middleware('roles:admin,administrador');



/////////////////////////////EQUIPOS////////////////////

 
Route::get('/adminEquipos', [EquiposController::class, 'listarEquipos']);
Route::post('/agregarEquipo',[EquiposController::class, 'agregarEquipo']); 

Route::get('/formModificarEquipo/{Equipo}',[EquiposController::class, 'verModificarEquipo']);
Route::post('/modificarEquipo/{idequipo}',[EquiposController::class, 'modificarEquipo']);


Route::post('/eliminarEquipo/{idequipo}',[EquiposController::class, 'eliminarEquipo']);



/////////////////////////////TUBOS////////////////////

Route::get('/adminTubos', [TubosController::class, 'listarTubos']);
Route::post('/agregarTubo',[TubosController::class, 'agregarTubo']); 

Route::get('/formModificarTubo/{Tubo}',[TubosController::class, 'verModificarTubo']);
Route::post('/modificarTubo/{idTubo}',[TubosController::class, 'modificarTubo']);

Route::post('/eliminarTubo/{idtubo}',[TubosController::class, 'eliminarTubo']);

Route::post('/cambiarEstadoTuboVencido/{idtubo}',[TubosController::class, 'cambiarEstadoTuboVencido']);  
Route::post('/modificarTuboPH/{idtubo}',[TubosController::class, 'modificarTuboPH']); 

/////////////////////////////OXIMETROS////////////////////


Route::get('/adminOximetros', [OximetrosController::class, 'listarOximetros']);
Route::post('/agregarOximetro',[OximetrosController::class, 'agregarOximetro']); 

Route::get('/formModificarOximetro/{Oximetro}',[OximetrosController::class, 'verModificarOximetro']);
Route::post('/modificarOximetro/{idOximetro}',[OximetrosController::class, 'modificarOximetro']);

Route::post('/eliminarOximetro/{idoximetro}',[OximetrosController::class, 'eliminarOximetro']);

////////////////////SERVICIOS - DISPONIBILIDAD/////////////////////////////


Route::get('/adminServicios',[DisponibilidadController::class, 'listarDispo']); 
Route::post('/agregarServicio',[DisponibilidadController::class, 'agregarServicio']); 
Route::get('/formModificarServicio/{Servicio}',[DisponibilidadController::class, 'verModificarServicio']);
Route::post('/modificarServicio/{idServicio}',[DisponibilidadController::class, 'modificarServicio']);
Route::post('/eliminarServicio/{idServicio}',[DisponibilidadController::class, 'eliminarServicio']);

Route::post('/adminServiciosActua',[DisponibilidadController::class, 'adminServiciosActua']); 


////////////////////////PEDIDOS////////////////////////////////////////////


Route::get('/adminPedidos', [PedidosController::class, 'listarPedidos']);
Route::get('/adminPedidosArchivados', [PedidosController::class, 'listarPedidosArchivados'])->middleware('roles:admin,administrador');

Route::post('/agregarPedido', [PedidosController::class, 'agregarPedido'])->middleware('roles:admin,administrador');

Route::post('/adminPedidosserv', [PedidosController::class, 'listaServicio'])->middleware('roles:admin,administrador');



Route::get('/formModificarPedido/{Pedido}',[PedidosController::class, 'verModificarPedido'])->middleware('roles:admin,administrador');
Route::post('/modificarPedido/{idPedido}',[PedidosController::class, 'modificarPedido'])->middleware('roles:admin,administrador');
Route::get('/formModificarPedidoVencidoP/{Pedido}',[PedidosController::class, 'verModificarPedidoVencidoP'])->middleware('roles:admin,administrador');
Route::post('/modificarPedidoVencidoP',[PedidosController::class, 'modificarPedidoVencidoP'])->middleware('roles:admin,administrador');
Route::post('/eliminarPedido/{idoximetro}',[PedidosController::class, 'eliminarPedido'])->middleware('roles:admin,administrador');

Route::post('/cambiarEstadoPedidoP/{idPedido}',[PedidosController::class, 'cambiarEstadoPedidoP'])->middleware('roles:admin,administrador,logistica');
 
Route::get('/pedidosDescargaPdfTodo/{idPedido}',[PedidosController::class, 'pedidosDescargaPdfTodo'])->middleware('roles:admin,administrador');
Route::get('/pedidosDescargaPdfPresu/{idPedido}',[PedidosController::class, 'pedidosDescargaPdfPresu'])->middleware('roles:admin,administrador');

Route::get('/cambiarPedidoARetirar/{idPedido}', [PedidosController::class, 'cambiarPedidoARetirar'])->middleware('roles:admin,administrador');

Route::get('/vercambiarEstadoPedidoPFecha/{idPedido}',[PedidosController::class, 'vercambiarEstadoPedidoPFecha'])->middleware('roles:admin,administrador');
Route::post('/modificarPedidoPFecha/{idPedido}',[PedidosController::class, 'modificarPedidoPFecha'])->middleware('roles:admin,administrador');


Route::get('/formUbicacionGarantiaEspera/{idPedido}',[PedidosController::class, 'formUbicacionGarantiaEspera'])->middleware('roles:admin,administrador');
Route::get('/formUbicacionGarantiaEntrega/{idPedido}',[PedidosController::class, 'formUbicacionGarantiaEntrega'])->middleware('roles:admin,administrador');
Route::post('/formCambiosFinales/{idPedido}',[PedidosController::class, 'formCambiosFinales'])->middleware('roles:admin,administrador');


Route::post('/modificarPedidoVencido/{idPedido}',[PedidosController::class, 'modificarPedidoVencido'])->middleware('roles:admin,administrador');

Route::post('/UserAsignacionDelDineroGarantia',[PedidosController::class, 'UserAsignacionDelDineroGarantia'])->middleware('roles:admin,administrador');
 
Route::post('/vencidoComentarios/{idPedido}',[PedidosController::class, 'vencidoComentarios'])->middleware('roles:admin,administrador');

Route::post('/enviarArchivos/{id}', [PedidosController::class, 'enviarArchivos'])->middleware('roles:admin,administrador');
Route::post('/modificarEmail/{id}', [PedidosController::class, 'modificarEmail'])->middleware('roles:admin,administrador');


//Route::post('/verAlquiler', [PedidosController::class, 'verAlquiler'])->middleware('roles:admin,administrador');


///////////////REGISTROS//////////////////////////
 
Route::get('/adminRegistros', [RegistrosController::class, 'listarRegistros'])->middleware('roles:admin,administrador');
 

///////////////////////CALENDARIO//////////////////////////

Route::get('/adminCalendario', [CalendarioController::class, 'verCalendario']);
Route::get('/calendario', [CalendarioController::class, 'verFechas']);  
Route::post('/modificarOrden/{idUsuario}', [CalendarioController::class, 'modificarOrden']);



//////////////////////////GARANTIAS//////////////////////////
Route::get('/adminGaran-Finan', [GarantiaController::class, 'verGarantias'])->middleware('roles:admin,administrador');
Route::get('/adminFinanzas', [GarantiaController::class, 'adminFinanzas'])->middleware('roles:admin,administrador');
Route::get('/adminDesglose', [GarantiaController::class, 'adminDesglose'])->middleware('roles:admin,administrador');
Route::get('/adminDesgloseArchivados', [GarantiaController::class, 'adminDesgloseArchivados'])->middleware('roles:admin,administrador');
Route::get('/formModificarGarantiasUsuarios/{idUsuario}', [GarantiaController::class, 'formModificarGarantiasUsuarios'])->middleware('roles:admin,administrador');
Route::post('/modificarGarantiaActiva', [GarantiaController::class, 'modificarGarantiaActiva'])->middleware('roles:admin,administrador'); 

Route::post('/agregarDesgloseActivo', [GarantiaController::class, 'agregarDesgloseActivo'])->middleware('roles:admin,administrador');

/*
Route::get('/formModificarDesgloseActivos/{idDesglose}', [GarantiaController::class, 'formModificarDesgloseActivos'])->middleware('roles:admin,administrador');
Route::post('/modificarDesgloseActivos', [GarantiaController::class, 'modificarDesgloseActivos'])->middleware('roles:admin,administrador');
Route::post('/eliminarDesgloseActivos/{idDesglose}', [GarantiaController::class, 'eliminarDesgloseActivos'])->middleware('roles:admin,administrador');
Route::post('/desgloseVerElMaxDeUsuarioConActivo', [GarantiaController::class, 'desgloseVerElMaxDeUsuarioConActivo'])->middleware('roles:admin,administrador');
*/

Route::post('/archivarReposicionDesgloseActivo/{idDesglose}', [GarantiaController::class, 'archivarReposicionDesgloseActivo'])->middleware('roles:admin,administrador');


//////////////////////////FINANZAS//////////////////////////
Route::get('/adminFinanzas', [GarantiaController::class, 'verFinanzas'])->middleware('roles:admin,administrador');



///////////////////TAREAS//////////////////////////////////////
Route::get('/adminTareas', [TareaController::class, 'verTareas']); 
Route::post('/agregarTarea', [TareaController::class, 'agregarTarea'])->middleware('roles:admin,administrador'); 
Route::get('/formModificarTarea/{idTarea}', [TareaController::class, 'formModificarTarea'])->middleware('roles:admin,administrador');
Route::post('/modificarTarea/{idTarea}', [TareaController::class, 'modificarTarea'])->middleware('roles:admin,administrador'); 
Route::post('/eliminarTarea/{idTarea}',[TareaController::class, 'eliminarTarea'])->middleware('roles:admin,administrador');
Route::post('/cambiarEstadoTarea/{idTarea}',[TareaController::class, 'cambiarEstadoTarea']);

//////////////////////////CAMBIOS/////////////////////////////////

Route::get('/adminCambios', [PedidosController::class, 'verCambios']); 
Route::get('/adminCambiosH', [CalendarioController::class, 'verCambiosSet']); 
Route::get('/formCambioPedido/{idPedido}', [PedidosController::class, 'formCambioPedido']); 
Route::post('/modificarCambioPedido/{idPedido}', [PedidosController::class, 'modificarCambioPedido']); 

Route::post('/cambiarEstadoCambios/{idCalen}', [CalendarioController::class, 'cambiarEstadoCambios']); 
Route::get('/adminCambios', [PedidosController::class, 'verCambios']); 

Route::get('/formModificarCambio/{idCalen}', [PedidosController::class, 'formModificarCambio']); 
Route::post('/modificarCambio/{idPedido}', [PedidosController::class, 'modificarCambio']); 
Route::post('/eliminarCambio/{idCalen}', [PedidosController::class, 'eliminarCambio']); 



////////////////////CAJA///////////////////////

Route::get('/adminCaja', [CajaController::class, 'verCaja']); 
Route::get('/adminCajaEntrada', [CajaController::class, 'verCajaEntrada']); 
Route::get('/adminCajaSalida', [CajaController::class, 'verCajaSalida']); 
 
Route::post('/agregarGastoSalida', [CajaController::class, 'agregarGastoSalida']); 
Route::get('/formModificarCajaSalida/{idSalida}', [CajaController::class, 'verModificarCajaSalida']); 
Route::post('/modificarCajaSalida/{idSalida}', [CajaController::class, 'modificarCajaSalida']); 
Route::post('/eliminarCajaSalida/{idSalida}', [CajaController::class, 'eliminarCajaSalida']); 

Route::get('/adminCajaEntradaV', [CajaController::class, 'verCajaEntradaV']); 
Route::post('/agregarGastoEntrada', [CajaController::class, 'agregarGastoEntrada']); 
Route::get('/formModificarCajaEntradaV/{idEntrada}', [CajaController::class, 'formModificarCajaEntradaV']); 
Route::post('/modificarCajaEntradaV/{idEntrada}', [CajaController::class, 'modificarCajaEntradaV']); 
Route::post('/eliminarCajaEntradaV/{idEntrada}', [CajaController::class, 'eliminarCajaEntradaV']); 


Route::post('/CajaSalidaVerUsuarioConGarantia', [CajaController::class, 'CajaSalidaVerUsuarioConGarantia']); 

Route::post('/agregarCierre', [CajaController::class, 'agregarCierre']); 

Route::post('/cambiarEstadoFactura/{id}', [CajaController::class, 'cambiarEstadoFactura']); 


Route::get('/verInformeCaja/{fechaInicio}/{fechaFin}',[CajaController::class, 'verInformeCaja'])->middleware('roles:admin,administrador');

Route::post('/cambiarFechaCajaFinal/{idCaja}', [CajaController::class, 'cambiarFechaCajaFinal']); 

Route::post('/eliminarCajaFinal/{idEntrada}', [CajaController::class, 'eliminarCajaFinal']); 

/////////////USUARIOS///////////////////////////////

Route::get('/adminUsuarios', [UsuarioController::class, 'verUsuarios']); 
Route::post('/registro', [UsuarioController::class, 'registro']); 
Route::get('/registroForm', [UsuarioController::class, 'registroForm']); 
Route::get('/formModificarUsuario/{id}', [UsuarioController::class, 'formModificarUsuario']); 
Route::post('/modificarUsuario/{id}', [UsuarioController::class, 'modificarUsuario']); 
Route::post('/eliminarUsuario/{id}', [UsuarioController::class, 'eliminarUsuario']); 
  

Route::get('/formPasswordUsuario/{id}', [UsuarioController::class, 'formPasswordUsuario']); 
Route::post('/modificarPassword', [UsuarioController::class, 'modificarPassword']); 




///////////////OXIMETRO-EQUIPO-TUBOS-> CAMBIAR ESTADOS (REVISAR Y REPARACION)///////////////
Route::post('/cambiarEstadoOximetro/{id}',[OximetrosController::class, 'cambiarEstadoOximetro'])->middleware('roles:admin,administrador');
Route::post('/cambiarEstadoTubo/{id}',[TubosController::class, 'cambiarEstadoTubo'])->middleware('roles:admin,administrador');
Route::post('/cambiarEstadoEquipo/{id}',[EquiposController::class, 'cambiarEstadoEquipo'])->middleware('roles:admin,administrador');


////////////////////////DESGLOSE////////////////////

Route::post('/agregarCostoFijo',[GarantiaController::class, 'agregarCostoFijo'])->middleware('roles:admin,administrador');
Route::get('/formModificarCostoFijo/{idCostoFijo}',[GarantiaController::class, 'formModificarCostoFijo'])->middleware('roles:admin,administrador');
Route::post('/modificarCostoFijo',[GarantiaController::class, 'modificarCostoFijo'])->middleware('roles:admin,administrador');
Route::post('/eliminarCostoFijo/{idCostoFijo}',[GarantiaController::class, 'eliminarCostoFijo'])->middleware('roles:admin,administrador');

Route::post('/modificarFondoHH',[GarantiaController::class, 'modificarFondoHH'])->middleware('roles:admin,administrador');

