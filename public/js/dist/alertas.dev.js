"use strict";

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var ver = function ver($var) {
  Swal.fire({
    text: $var,
    heightAuto: 'false'
  });
};

var ver2 = function ver2($ver2) {
  Swal.fire({
    title: ' ',
    text: ' ',
    imageUrl: 'img/' + $ver2,
    imageWidth: 300,
    imageHeight: 300,
    imageAlt: 'image'
  });
};

$('.formulario-eliminar').submit(function (e) {
  var _this = this;

  e.preventDefault();
  Swal.fire({
    title: '¿Confirmar Baja?',
    text: "Si pulsa el boton Eliminar se eliminara del Inventario",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Eliminar',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar'
  }).then(function (result) {
    if (result.isConfirmed) {
      _this.submit();
    }
  });
});

var verServ = function verServ($id, $nombreServ, $descripcion, $img, $ER, $EA, $T1, $T415, $O) {
  if ($ER == 0) {
    $ER = '  --';
  }

  if ($EA == 0) {
    $EA = '  --';
  }

  if ($T1 == 0) {
    $T1 = '  --';
  }

  if ($T415 == 0) {
    $T415 = '  --';
  }

  if ($O == 0) {
    $O = '  --';
  }

  Swal.fire({
    html: '<div class="verServ">' + '<h1>Servicio Numero: A' + $id + '</h1>' + '<h1>Nombre del Servicio: ' + $nombreServ + '</h1>  ' + '<h1>Descripcion del Servicio: ' + $descripcion + '</h1>  ' + '<h1>Se esta usando el Concen. Respironics N°: ' + $ER + '</h1>  ' + '<h1>Se esta usando el Concen. Airsep N°: ' + $EA + '</h1>  ' + '<h1>Se esta usando el Tubo 1/M N°: T' + $T1 + '</h1>  ' + '<h1>Se esta usando el Tubo 415 N°: T' + $T415 + '</h1>  ' + '<h1>Se esta usando el Oximetro N°: X' + $O + '</h1>  ' + '</div>',
    imageUrl: 'img/' + $img,
    imageWidth: 300,
    imageHeight: 300,
    width: 800,
    heightAuto: true,
    imageAlt: 'image'
  });
};

var verClien = function verClien($nombre, $dni, $dire, $local, $tel, $email, $recibe) {
  Swal.fire({
    html: '<div class="verCliente">' + '<h1>Nombre del Cliente:   ' + $nombre + '</h1>' + '<p>DNI:   ' + $dni + '</p>' + '<p>Direccion:   ' + $dire + '</p>' + '<p>Localidad:   ' + $local + '</p>' + '<p>Telefono:   ' + $tel + '</p>' + '<p>Email:   ' + $email + '</p>' + '<p>Recibe el Equipo:  ' + $recibe + '</p>' + '</div>',
    width: 800
  });
};

$('.cambiar-estado-espera').submit(function (e) {
  var _this2 = this;

  e.preventDefault();
  Swal.fire({
    title: 'Confirmar Cambio de Estado',
    text: "Si pulsa el boton Entregado se cambiara el Estado Del Alquiler",
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    confirmButtonText: 'Entregado',
    cancelButtonColor: '#2a2e57',
    cancelButtonText: 'Cancelar'
  }).then(function (result) {
    if (result.isConfirmed) {
      _this2.submit();
    }
  });
  console.log('espera');
});
$('.cambiar-estado-entregado').submit(function (e) {
  var _this3 = this;

  e.preventDefault();
  Swal.fire({
    title: 'Confirmar Cambio de Estado',
    text: "Si pulsa el boton Retirar se cambiara el Estado Del Alquiler",
    showCancelButton: true,
    confirmButtonColor: '#d33',
    confirmButtonText: 'Retirar',
    cancelButtonColor: '#2a2e57',
    cancelButtonText: 'Cancelar'
  }).then(function (result) {
    if (result.isConfirmed) {
      _this3.submit();
    }
  });
});
$('.cambiar-estado-retirar').submit(function (e) {
  var _this4 = this;

  e.preventDefault();
  Swal.fire({
    title: 'Confirmar Cambio de Estado',
    text: "Si pulsa el boton Retirado se cambiara el Estado Del Alquiler",
    showCancelButton: true,
    confirmButtonColor: '##55acee',
    confirmButtonText: 'Retirado',
    cancelButtonColor: '#2a2e57',
    cancelButtonText: 'Cancelar'
  }).then(function (result) {
    if (result.isConfirmed) {
      _this4.submit();
    }
  });
});
$('.cambiar-estado-retirado').submit(function (e) {
  var _this5 = this;

  e.preventDefault();
  Swal.fire({
    title: 'Confirmar Cambio de Estado',
    text: "Si pulsa el boton Retirado se cambiara el Estado Del Alquiler",
    showCancelButton: true,
    confirmButtonColor: '#d33',
    confirmButtonText: 'Eliminar',
    cancelButtonColor: '#2a2e57',
    cancelButtonText: 'Cancelar'
  }).then(function (result) {
    if (result.isConfirmed) {
      _this5.submit();
    }
  });
});
$('.cambiar-estado-vencido').submit(function (e) {
  var _Swal$fire,
      _this6 = this;

  e.preventDefault();
  id = $('#id').val();
  Swal.fire((_Swal$fire = {
    title: 'Confirmar Cambio de Estado',
    text: "Si pulsa el boton Renovar se cambiara el Estado Del Alquiler",
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    confirmButtonText: 'Renovar',
    //cancelButtonColor: '#d33',
    //cancelButtonText: 'Retirar',
    denyButtonColor: '#d33',
    showDenyButton: true
  }, _defineProperty(_Swal$fire, "showCancelButton", false), _defineProperty(_Swal$fire, "denyButtonText", "Retirar"), _Swal$fire)).then(function (result) {
    if (result.isConfirmed) {
      _this6.submit();
    } else if (result.isDenied) {
      // alert(id)
      window.location.href = "/cambiarPedidoARetirar/" + id;
    }
  });
});