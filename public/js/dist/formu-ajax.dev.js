"use strict";

$(document).ready(function () {
  $('#idServicio').on('change', function () {
    var idserv = $(this).val();
    $.ajax({
      //ACTUALIZA LA TABLA DE DISPONIBILIDAD
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/adminServiciosActua',
      method: 'post',
      data: {
        _token: $('input[name="_token"]').val()
      }
    });

    if ($.trim(idserv) != '') {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/adminPedidosserv',
        method: 'post',
        data: {
          idserv: idserv,
          _token: $('input[name="_token"]').val()
        }
      }).done(function (res) {
        var arreglo = JSON.parse(res);
        $('#descripcion').empty();
        $('#costoServ').empty();
        $('#garantia').empty();
        $('#dispoER').empty();
        $('#dispoEA').empty();
        $('#dispoT1').empty();
        $('#dispoT415').empty();
        $('#dispoO').empty();
        $('#descripcion').append("<label for='descripcion'>Descripcion</label>" + "<input  class='controls' readonly  type='text' name='descripcion' id='descripcion' autocomplete='off' value='" + arreglo.servi.descripcion + "' placeholder='" + arreglo.servi.descripcion + "'>" + "<input type='hidden' name='nombreServ' id='nombreServ' value='" + arreglo.servi.nombreServ + "'>");
        $('#costoServ').append("<label for='costoServ'>Costo de Servicio</label>" + "<input class='controls' readonly type='number' min='0' name='costoServ' id='costoServ' autocomplete='off' value='" + arreglo.servi.costoServ + "' placeholder='" + arreglo.servi.costoServ + "'>");
        $('#garantia').append("<label for='garantia'>Garantia</label>" + "<input class='controls' readonly type='number' min='0' name='garantia' id='garantia' autocomplete='off' value='" + arreglo.servi.garantia + "' placeholder='" + arreglo.servi.garantia + "'>");
        $('#dispoER').replaceWith("<input type='hidden' name='dispoER' id='dispoER' value='" + arreglo.servi.dispoER + "' >");
        $('#dispoEA').replaceWith("<input type='hidden' name='dispoEA' id='dispoEA' value='" + arreglo.servi.dispoEA + "' >");
        $('#dispoT1').replaceWith("<input type='hidden' name='dispoT1' id='dispoT1' value='" + arreglo.servi.dispoT1 + "' >");
        $('#dispoT415').replaceWith("<input type='hidden' name='dispoT415' id='dispoT415' value='" + arreglo.servi.dispoT415 + "' >");
        $('#dispoO').replaceWith("<input type='hidden' name='dispoO' id='dispoO' value='" + arreglo.servi.dispoO + "' >");
        var dispoER = arreglo.servi.dispoER;
        var dispoEA = arreglo.servi.dispoEA;
        var dispoT1 = arreglo.servi.dispoT1;
        var dispoT415 = arreglo.servi.dispoT415;
        var dispoO = arreglo.servi.dispoO;
        console.log(arreglo.servER.siDispo);
        console.log(arreglo.servEA.siDispo);
        console.log(arreglo.servT1.siDispo);
        console.log(arreglo.servT415.siDispo);
        console.log(arreglo.servO.siDispo);

        if ($.trim(dispoER) != '') {
          //console.log('este es la cantidad de equipos', arre.siDispo)
          if (dispoER == 1) {
            if (arreglo.servER.siDispo >= 1) {
              //console.log('si hay disponible');
              $('#con-res').replaceWith(" <span id='con-res' class='span-barra'><i class='fas fa-check'></i></span>");
            } else {
              //console.log('no hya disponible')
              $('#con-res').replaceWith(" <span id='con-res' class='span-barra'><i class='fas fa-times'></i></span>");
            }
          } else {
            //console.log('no usa');
            $('#con-res').replaceWith(" <span id='con-res' class='span-barra'><i class='fas fa-ban'></i></span>");
          }
        }

        if ($.trim(dispoEA) != '') {
          //console.log('este es la cantidad de equipos', arre.siDispo)
          if (dispoEA == 1) {
            if (arreglo.servEA.siDispo >= 1) {
              //console.log('si hay disponible');
              $('#con-ars').replaceWith(" <span id='con-ars' class='span-barra'><i class='fas fa-check'></i></span>");
            } else {
              //console.log('no hya disponible')
              $('#con-ars').replaceWith(" <span id='con-ars' class='span-barra'><i class='fas fa-times'></i></span>");
            }
          } else {
            //console.log('no usa');
            $('#con-ars').replaceWith(" <span id='con-ars' class='span-barra'><i class='fas fa-ban'></i></span>");
          }
        }

        if ($.trim(dispoT1) != '') {
          //console.log('este es la cantidad de equipos', arre.siDispo)
          if (dispoT1 == 1) {
            if (arreglo.servT1.siDispo >= 1) {
              // console.log('si hay disponible');
              $('#tubo1m').replaceWith(" <span id='tubo1m' class='span-barra'><i class='fas fa-check'></i></span>");
            } else {
              //console.log('no hya disponible')
              $('#tubo1m').replaceWith(" <span id='tubo1m' class='span-barra'><i class='fas fa-times'></i></span>");
            }
          } else {
            //console.log('no usa');
            $('#tubo1m').replaceWith(" <span id='tubo1m' class='span-barra'><i class='fas fa-ban'></i></span>");
          }
        }

        if ($.trim(dispoT415) != '') {
          if (dispoT415 == 1) {
            if (arreglo.servT415.siDispo >= 1) {
              //console.log('si hay disponible');
              $('#tubo415').replaceWith(" <span id='tubo415' class='span-barra'><i class='fas fa-check'></i></span>");
            } else {
              //console.log('no hya disponible')
              $('#tubo415').replaceWith(" <span id='tubo415' class='span-barra'><i class='fas fa-times'></i></span>");
            }
          } else {
            //console.log('no usa');
            $('#tubo415').replaceWith(" <span id='tubo415' class='span-barra'><i class='fas fa-ban'></i></span>");
          }
        }

        if ($.trim(dispoO) != '') {
          if (dispoO == 1) {
            if (arreglo.servO.siDispo >= 1) {
              // console.log('si hay disponible');
              $('#oximetro').replaceWith(" <span id='oximetro' ><i class='fas fa-check'></i></span>");
            } else {
              //console.log('no hya disponible')
              $('#oximetro').replaceWith(" <span id='oximetro'  ><i class='fas fa-times'></i></span>");
            }
          } else {
            //console.log('no usa');
            $('#oximetro').replaceWith(" <span id='oximetro' ><i class='fas fa-ban'></i></span>");
          }
        }
      });
    }
  });
  $('#dias').on('change', function () {
    var fechaInicio = $('#fechaInicio').val();
    var fecha = new Date(fechaInicio);
    var dias = $('#dias').val();
    fecha.setDate(fecha.getDate() + 1);
    fecha.setMonth(fecha.getMonth() + parseInt(dias));

    if ($.trim(fechaInicio)) {
      d = fecha.getDate();
      m = fecha.getMonth();
      a = fecha.getFullYear(); //console.log(a,m,d);    

      dateF = new Date(a, m, d);
      df = dateF.getDate();
      mf = dateF.getMonth() + 1;
      af = dateF.getFullYear();

      if (df < 10) {
        df = "0" + df;
      }

      if (mf < 10) {
        mf = "0" + mf;
      }

      fechaFin = af + "-" + mf + "-" + df;
      $('#fechaFin').empty();
      $('#fechaFin').append("<label for='fechaFin'>Fecha Finalizacion</label>" + "<input class='controls' readonly type='date'  name='fechaFin' id='fechaFin' autocomplete='off' value='" + fechaFin + "'  >");
    }
  });
  $('#fechaInicio').on('change', function () {
    var fechaInicio = $('#fechaInicio').val();
    var fecha = new Date(fechaInicio);
    var dias = $('#dias').val();
    fecha.setDate(fecha.getDate() + 1);
    fecha.setMonth(fecha.getMonth() + parseInt(dias));

    if ($.trim(fechaInicio)) {
      d = fecha.getDate();
      m = fecha.getMonth();
      a = fecha.getFullYear(); //console.log(a,m,d);    

      dateF = new Date(a, m, d);
      df = dateF.getDate();
      mf = dateF.getMonth() + 1;
      af = dateF.getFullYear();

      if (df < 10) {
        df = "0" + df;
      }

      if (mf < 10) {
        mf = "0" + mf;
      }

      fechaFin = af + "-" + mf + "-" + df;
      $('#fechaFin').empty();
      $('#fechaFin').append("<label for='fechaFin'>Fecha Finalizacion</label>" + "<input class='controls' readonly type='date'  name='fechaFin' id='fechaFin' autocomplete='off' value='" + fechaFin + "'  >");
    }
  });
});