 var ver = function($var) {
     Swal.fire({
         html: "<h1>" + $var + "</h1>",
         heightAuto: 'false'
     })
 }

 var com = function($va) {
     x = '#' + $va
     va = $(x).val()
         //alert(x)
     Swal.fire({
         title: va,
         width: 700
     })
 }

 var ver2 = function($ver2) {
         Swal.fire({
             title: ' ',
             text: ' ',
             imageUrl: '/img/' + $ver2,


             imageWidth: 300,
             imageHeight: 300,
             imageAlt: 'image',
         })
     } //ver la imagen

 $('.formulario-eliminar').submit(function(e) {
     e.preventDefault();

     Swal.fire({
         title: '¿Confirmar Baja?',
         text: "Si pulsa el boton Eliminar se eliminara del Inventario",
         showCancelButton: true,
         confirmButtonColor: '#d33',
         confirmButtonText: 'Eliminar',
         cancelButtonColor: '#3085d6',
         cancelButtonText: 'Cancelar'

     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();
         }
     })
 })


 var verServ = function($id, $nombreServ, $descripcion, $img, $ER, $EA, $EY, $T1, $T415, $O) {
     $S = '';
     if ($ER == 0) {
         $ER = '  --';
     } else {
         $ER = 'R' + $ER;
         $S = 'R';
     }
     if ($EA == 0) {
         $EA = '  --';
     } else {
         $EA = 'A' + $EA;
         $S = 'A';
     }
     if ($EY == 0) {
         $EY = '  --';
     } else {
         $EY = 'Y' + $EY;
         $S = 'Y';
     }
     if ($T1 == 0) {
         $T1 = '  --';
     } else {
         $T1 = 'T' + $T1;
     }
     if ($T415 == 0) {
         $T415 = '  --';
     } else {
         $T415 = 'T' + $T415;
     }
     if ($O == 0) {
         $O = '  --';
     } else {
         $O = 'X' + $O;
     }

     Swal.fire({
         html: '<div class="verCliente">' +
             '<p>Servicio N°: S-' + $id + $S + '</p>' +
             '<p>Nombre del Servicio: ' + $nombreServ + '</p>  ' +
             '<p>Descripcion del Servicio: ' + $descripcion + '</p>  ' +
             '<p>Concentrador Respironics N°:  ' + $ER + '</p>  ' +
             '<p>Concentrador Airsep N°:  ' + $EA + '</p>  ' +
             '<p>Concentrador Yuwell N°:  ' + $EY + '</p>  ' +
             '<p>Tubo 680L N°:  ' + $T1 + '</p>  ' +
             '<p>Tubo 415L N°:  ' + $T415 + '</p>  ' +
             '<p>Oximetro N°:  ' + $O + '</p>  ' +
             '</div>',
         imageUrl: 'img/' + $img,
         imageWidth: 300,
         imageHeight: 300,
         width: 800,
         heightAuto: true,
         imageAlt: 'image',
     })
 }

 var verClien = function($nombre, $dni, $dire, $local, $tel, $email, $recibe, $imgDniF, $imgDniD, $imgOrden) {

     $imgDniF = "'" + $imgDniF + "'";
     $imgDniD = "'" + $imgDniD + "'";
     $imgOrden = "'" + $imgOrden + "'";
     Swal.fire({
         html: '<div class="verCliente">' +
             '<p>Nombre del Cliente:   ' + $nombre + '</p>' +
             '<p>DNI:   ' + $dni + '</p>' +
             '<p>Direccion:   ' + $dire + '</p>' +
             '<p>Localidad:   ' + $local + '</p>' +
             '<p>Telefono:   ' + $tel + '</p>' +
             '<p>Email:   ' + $email + '</p>' +
             '<p>Recibe el Equipo:  ' + $recibe + '</p>' +
             '<p>Imagen Dni Frente: <button class="btn-verClien" type="button" onclick="ver2(' + $imgDniF + ')">Dni Frente </button></p>' +
             '<p>Imagen Dni Dorso: <button class="btn-verClien" type="button" onclick="ver2(' + $imgDniD + ')">Dni Dorso </button></p>' +
             '<p>Imagen Orden: <button class="btn-verClien" type="button" onclick="ver2(' + $imgOrden + ')">Orden Medica </button></p>' +
             '</div>',
         width: 800,
     })
 }
 var verClienLogistica = function($nombre, $dni, $dire, $local, $tel, $recibe, $comentarios) {

         Swal.fire({
             html: '<div class="verCliente">' +
                 '<p>Nombre del Cliente:   ' + $nombre + '</p>' +
                 '<p>DNI:   ' + $dni + '</p>' +
                 '<p>Direccion:   ' + $dire + '</p>' +
                 '<p>Localidad:   ' + $local + '</p>' +
                 '<p>Telefono:   ' + $tel + '</p>' +
                 '<p>Recibe el Equipo:  ' + $recibe + '</p>' +
                 '<p>Comentarios:  ' + $comentarios + '</p>' +
                 '</div>',
             width: 800,
         })
     }
     /*
      var verAlquilerLogistica = function(id) {
          console.log(id)

          $.ajax({
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              url: '/verAlquiler',
              method: 'post',
              data: {
                  id: id,
                  _token: $('input[name="_token"]').val()
              }
          }).done(function(res) {
              var arreglo = JSON.parse(res)
              console.log(arreglo.pedido)

          })

      }*/


 var verHs = function($hsCompra, $hsAct, $hsUltCam, $hsProxCam) {

     Swal.fire({
         html: '<div class="verCliente">' +
             '<p>Horas de Compra:   ' + $hsCompra + '</p>' +
             '<p>Horas Actuales:   ' + $hsAct + '</p>' +
             '<p>Horas del Ultimo Cambio:   ' + $hsUltCam + '</p>' +
             '<p>Horas del Proximo Cambio:   ' + $hsProxCam + '</p>',
         width: 800,
     })
 }

 var verAlert = function($descripcion, $nombreCliente, $dni, $bandera) {
     if ($bandera == 'tarea') {
         Swal.fire({
             html: '<div class="verCliente">' +
                 '<p>Descripcion :   ' + $descripcion + '</p>' +
                 '<p>Asignada a:   ' + $nombreCliente + '</p>' +
                 '</div>',
             width: 800,
         })
     } else {
         Swal.fire({
             html: '<div class="verCliente">' +
                 '<p>Descripcion :   ' + $descripcion + '</p>' +
                 '<p>Nombre Del Cliente:   ' + $nombreCliente + '</p>' +
                 '<p>Dni:   ' + $dni + '</p>' +
                 '</div>',
             width: 800,
         })
     }


 }

 ////////////estados de pedidos/////////////

 $('.cambiar-estado-espera').submit(function(e) {

     e.preventDefault();

     Swal.fire({
         title: 'Confirmar Cambio de Estado',
         text: "Si pulsa el boton Entrega se cambiara el Estado Del Alquiler",
         showCancelButton: true,
         confirmButtonText: 'Entrega',
         cancelButtonText: 'Cancelar',

         buttonsStyling: false,
         customClass: {
             confirmButton: 'btn-espera scal',
             cancelButton: 'btn-cancelar scal',
         }

     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();

         }
     })
     console.log('entrega');

 });
 $('.cambiar-estado-entrega').submit(function(e) {

     e.preventDefault();

     Swal.fire({
         title: 'Confirmar Cambio de Estado',
         text: "Si pulsa el boton Entregado se cambiara el Estado Del Alquiler",
         showCancelButton: true,
         confirmButtonText: 'Entregado',
         cancelButtonText: 'Cancelar',

         buttonsStyling: false,
         customClass: {
             confirmButton: 'btn-entregado scal',
             cancelButton: 'btn-cancelar scal',
         }

     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();

         }
     })
     console.log('espera');

 });
 $('.cambiar-estado-entregado').submit(function(e) {

     e.preventDefault();

     Swal.fire({
         title: 'Confirmar Cambio de Estado',
         text: "Si pulsa el boton Retirar se cambiara el Estado Del Alquiler",
         showCancelButton: true,
         confirmButtonText: 'Retirar',
         cancelButtonText: 'Cancelar',

         buttonsStyling: false,
         customClass: {
             confirmButton: 'btn-retirar scal',
             cancelButton: 'btn-cancelar scal',
         }

     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();
         }
     })

 });
 $('.cambiar-estado-retirar').submit(function(e) {
     e.preventDefault();
     Swal.fire({
         title: 'Confirmar Cambio de Estado',
         text: "Si pulsa el boton Retirado se cambiara el Estado Del Alquiler",
         showCancelButton: true,
         confirmButtonText: 'Retirado',
         cancelButtonText: 'Cancelar',

         buttonsStyling: false,
         customClass: {
             confirmButton: 'btn-retirarado scal',
             cancelButton: 'btn-cancelar scal',
         }

     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();
         }
     })

 });

 $('.cambiar-estado-retirado').submit(function(e) {
     e.preventDefault();
     Swal.fire({
         title: 'Confirmar Cambio de Estado',
         text: "Si pulsa el boton Archivar se cambiara el Estado Del Alquiler",
         showCancelButton: true,
         confirmButtonText: 'Archivar',
         cancelButtonText: 'Cancelar',

         buttonsStyling: false,
         customClass: {
             confirmButton: 'btn-archivado scal',
             cancelButton: 'btn-cancelar scal',
         }

     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();
         }
     })

 });

 var vencido = function(id) {
     var id = id

     $('.cambiar-estado-vencido').submit(function(e) {
         e.preventDefault();
         Swal.fire({
             title: 'Confirmar Cambio de Estado',
             text: "Si pulsa el boton Renovar se cambiara el Estado Del Alquiler",
             showCancelButton: true,
             confirmButtonText: 'Renovar',
             denyButtonText: `Retirar`,
             cancelButtonText: `Cancelar`,
             showDenyButton: true,

             buttonsStyling: false,
             customClass: {
                 confirmButton: 'btn-entregado scal',
                 cancelButton: 'btn-cancelar scal',
                 denyButton: 'btn-retirar scal',
             }
         }).then((result) => {
             if (result.isConfirmed) {
                 this.submit();
             } else if (result.isDenied) {
                 console.log(id)
                 window.location.href = "/vercambiarEstadoPedidoPFecha/" + id;
             }
         })

     });

 }




 //////script de TAREAS/////

 $('.cambiar-estado-pendiente').submit(function(e) {

     e.preventDefault();

     Swal.fire({
         title: 'Confirmar Cambio de Estado',
         text: "Si pulsa el boton Realizada se cambiara el Estado De la Tarea",
         showCancelButton: true,
         confirmButtonColor: '#28a745',
         confirmButtonText: 'Realizada',
         cancelButtonColor: '#2a2e57',
         cancelButtonText: 'Cancelar'
     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();

         }
     })

 });
 $('.cambiar-estado-realizado').submit(function(e) {

     e.preventDefault();

     Swal.fire({
         title: 'Confirmar Cambio de Estado',
         text: "Si pulsa el boton Pendiente se cambiara el Estado De la Tarea",
         showCancelButton: true,
         confirmButtonColor: '#f8ef6e',
         confirmButtonText: 'Pendiente',
         cancelButtonColor: '#2a2e57',
         cancelButtonText: 'Cancelar'

     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();

         }
     })

 });

 //////script de CAMBIOS/////

 $('.cambiar-estado-cambio-entrega').submit(function(e) {

     e.preventDefault();

     Swal.fire({
         title: 'Confirmar Cambio de Estado',
         text: "Si pulsa el boton Entregado se cambiara el Estado Del Cambio",
         showCancelButton: true,
         confirmButtonColor: '#28a745',
         confirmButtonText: 'Entregado',
         cancelButtonColor: '#2a2e57',
         cancelButtonText: 'Cancelar'
     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();

         }
     })

 });
 $('.cambiar-estado-cambio-retiro').submit(function(e) {

     e.preventDefault();

     Swal.fire({
         title: 'Confirmar Cambio de Estado',
         text: "Si pulsa el boton Retirado se cambiara el Estado Del Cambio",
         showCancelButton: true,
         confirmButtonColor: '#28a745',
         confirmButtonText: 'Retirado',
         cancelButtonColor: '#2a2e57',
         cancelButtonText: 'Cancelar'

     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();

         }
     })

 });


 ////////BTN PARA ELEGIR ENTRE VER PRESUPUESTO O VER LOS CONTRATO,PRESU,REMITO////////

 var verPdfs = function($id) {
     $urlTodo = '/pedidosDescargaPdfTodo/' + $id
     $urlPresu = '/pedidosDescargaPdfPresu/' + $id
     Swal.fire({
         title: 'Descargas',
         showDenyButton: true,
         showCancelButton: true,

         cancelButtonText: 'Cancelar',

         confirmButtonText: 'Ver Presupuesto',
         confirmButtonColor: '#2a2e57',

         denyButtonText: 'Ver Todo',
         denyButtonColor: '#2a2e57',

     }).then((result) => {
         if (result.isConfirmed) {
             window.open($urlPresu, '_blank');

         } else if (result.isDenied) {
             window.open($urlTodo, '_blank');
         }
     })
 }

 ////////BTN PARA INVENTARIO DE REVISAR Y REPARACION////////


 $('.cambiar-estado-revisar').submit(function(e) {
     e.preventDefault();
     Swal.fire({
         title: 'Confirmar Cambio de Estado',
         text: "Si pulsa el boton Reparacion se cambiara el Estado Del Equipo",
         showCancelButton: true,
         confirmButtonText: 'Reparacion',
         cancelButtonText: 'Cancelar',

         buttonsStyling: false,
         customClass: {
             confirmButton: 'btn-revisar scal',
             cancelButton: 'btn-cancelar scal',
         }
     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();

         }
     })
 });
 $('.cambiar-estado-reparacion').submit(function(e) {
     e.preventDefault();
     Swal.fire({
         title: 'Confirmar Cambio de Estado',
         text: "Si pulsa el boton Disponible se cambiara el Estado Del Equipo",
         showCancelButton: true,
         confirmButtonText: 'Disponible',
         cancelButtonText: 'Cancelar',

         buttonsStyling: false,
         customClass: {
             confirmButton: 'btn-disponible scal',
             cancelButton: 'btn-cancelar scal',
         }
     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();

         }
     })
 });
 $('.cambiar-estado-reparacion-vencido').submit(function(e) {
     e.preventDefault();
     Swal.fire({
         title: 'Confirmar Cambio de PH Del Tubo',
         text: "Si pulsa el boton Cambiar PH se redirigirá a un Formulario para cambiar el PH",
         showCancelButton: true,
         confirmButtonText: 'Cambiar PH',
         cancelButtonText: 'Cancelar',

         buttonsStyling: false,
         customClass: {
             confirmButton: 'btn-disponible scal',
             cancelButton: 'btn-cancelar scal',
         }
     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();

         }
     })
 });


 ////////BTN PARA CAMBIAR EL ESTADO DE REPOSICION DE GARANTIA////////

 $('.formulario-archivar').submit(function(e) {
     e.preventDefault();
     Swal.fire({
         title: 'Archivar Reposicion de Garantia',
         text: "Si pulsa el boton Archivar se Archivara la Reposicion",
         showCancelButton: true,
         confirmButtonText: 'Archivar',
         cancelButtonText: 'Cancelar',

         buttonsStyling: false,
         customClass: {
             confirmButton: 'btn-archivado scal',
             cancelButton: 'btn-cancelar scal',
         }
     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();

         }
     })
 });


 ////////////////CAMBIAR ESTADO DE FACTURA- SI O NO///////////////


 $('.cambiar-estado-factura-si').submit(function(e) {
     e.preventDefault();

     Swal.fire({
         title: 'Confirmar Cambio de Estado',
         text: "Si pulsa el boton 'No' se cambiara el Estado De la Entrada",
         showCancelButton: true,
         confirmButtonText: 'NO',
         cancelButtonText: 'Cancelar',

         buttonsStyling: false,
         customClass: {
             confirmButton: 'btn-retirar scal',
             cancelButton: 'btn-cancelar scal',
         }

     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();
         }
     })

 });
 $('.cambiar-estado-factura-no').submit(function(e) {
     e.preventDefault();

     Swal.fire({
         title: 'Confirmar Cambio de Estado',
         text: "Si pulsa el boton 'SI' se cambiara el Estado De la Entrada",
         showCancelButton: true,
         confirmButtonText: 'SI',
         cancelButtonText: 'Cancelar',

         buttonsStyling: false,
         customClass: {
             confirmButton: 'btn-entregado scal',
             cancelButton: 'btn-cancelar scal',
         }

     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();
         }
     })

 });


 ////////BTN PARA VER EL INFORME DE CAJA////////

 var verInformes = function($fechaInicio, $fechaFin, $Inicio, $Fin) {
     $url = '/verInformeCaja/' + $fechaInicio + '/' + $fechaFin
     Swal.fire({
         title: 'Informe de Caja',
         html: '<h3>Fecha Inicio:      ' + $Inicio + '</h3>' +
             '<h3>Fecha Fin:      ' + $Fin + '</h3>',

         showCancelButton: true,

         cancelButtonText: 'Cancelar',

         confirmButtonText: 'Ver Informe',
         confirmButtonColor: '#2a2e57',

         buttonsStyling: false,
         customClass: {
             confirmButton: 'btn-disponible scal',
             cancelButton: 'btn-cancelar scal',
         }
     }).then((result) => {
         if (result.isConfirmed) {
             window.open($url, '_blank');
         }
     })
 }

 ///////////// BTN DE CAJA MDOIFICA FECHA DE INCIO O FIN//////////



 var informe = function($id) {
     var btnAbrir = 'btn-abrir-popup-caja-' + $id
     var overlay = 'overlay-caja-' + $id
     var popup = 'popup-caja-' + $id
     var btnCerrar = 'btn-cerrar-popup-caja-' + $id

     var btnAbrirPopupCaja = document.getElementById(btnAbrir),
         overlayCaja = document.getElementById(overlay),
         popupCaja = document.getElementById(popup),
         btnCerrarPopupCaja = document.getElementById(btnCerrar)

     if (btnAbrirPopupCaja) {
         btnAbrirPopupCaja.addEventListener('click', function() {
             overlayCaja.classList.add('active');
             popupCaja.classList.add('active');

         })
     }
     if (btnCerrarPopupCaja) {
         btnCerrarPopupCaja.addEventListener('click', function() {
             overlayCaja.classList.remove('active');
             popupCaja.classList.remove('active');

         })
     }
     $(overlayCaja).on("click", function(e) {
         var contentformulario = $('.content-formulario')

         if (!contentformulario.is(e.target) && contentformulario.has(e.target).length === 0) {
             overlayCaja.classList.remove('active');
             popupCaja.classList.remove('active');
         }
     });
 }

 $('.enviar-archivos').submit(function(e) {
     e.preventDefault();
     Swal.fire({
         title: 'Confirmar Envio de archivos',
         text: "Si pulsa el boton Enviar se Enviara el Correo con los Archivos",
         showCancelButton: true,
         confirmButtonText: 'Enviar',
         cancelButtonText: 'Cancelar',

         buttonsStyling: false,
         customClass: {
             confirmButton: 'btn-disponible scal',
             cancelButton: 'btn-cancelar scal',
         }
     }).then((result) => {
         if (result.isConfirmed) {
             this.submit();

         }
     })
 });