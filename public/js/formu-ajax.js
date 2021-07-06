moment.locale('es');
$(document).ready(function() {


    //para activar el boton de enviar formulario de agregar alquiler
    $('.completo').on('keyup change focus', function() {
        checkeo = true;
        $(".completo").each(function() {
            /*console.log('/////////////////')
            console.log($(this).attr('id'))
            console.log($(this).val())*/

            if ($(this).val() == "") {
                checkeo = false
            }
        });
        var res = $("#NumeroDispoER").val()
        var ars = $("#NumeroDispoEA").val()
        var yuw = $("#NumeroDispoEY").val()
        console.log(res, ars, yuw);

        if (checkeo) {
            if ($.trim(res && ars && yuw)) {

                if (res != 0 && ars == 0 && yuw == 0) {
                    $(".button-completo").removeAttr("disabled");
                } else if (ars != 0 && res == 0 && yuw == 0) {
                    $(".button-completo").removeAttr("disabled");
                } else if (yuw != 0 && res == 0 && ars == 0) {
                    $(".button-completo").removeAttr("disabled");
                } else {
                    $(".button-completo").attr("disabled", "disabled");
                }
            } else {
                $(".button-completo").removeAttr("disabled");
            }
        } else {
            $(".button-completo").attr("disabled", "disabled");
        }
    });

    $('#idServicio').on('change', function() {

        //para activar el boton de enviar formulario de agregar alquiler
        $('span').on('change', function() {
            checkeo = true;
            $(".completo").each(function() {
                /* console.log('/////////////////')
                    console.log($(this).attr('id'))
                    console.log($(this).val())*/

                if ($(this).val() == "") {
                    checkeo = false
                }
            });
            var res = $("#NumeroDispoER").val()
            var ars = $("#NumeroDispoEA").val()
            var yuw = $("#NumeroDispoEY").val()
                //console.log(res, ars, yuw);

            if (checkeo) {
                if ($.trim(res && ars && yuw)) {

                    if (res != 0 && ars == 0 && yuw == 0) {
                        $(".button-completo").removeAttr("disabled");
                    } else if (ars != 0 && res == 0 && yuw == 0) {
                        $(".button-completo").removeAttr("disabled");
                    } else if (yuw != 0 && res == 0 && ars == 0) {
                        $(".button-completo").removeAttr("disabled");
                    } else {
                        $(".button-completo").attr("disabled", "disabled");
                    }
                } else {
                    $(".button-completo").removeAttr("disabled");
                }
            } else {
                $(".button-completo").attr("disabled", "disabled");
            }
        });


        var idserv = $(this).val();

        $.ajax({ //ACTUALIZA LA TABLA DE DISPONIBILIDAD
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/adminServiciosActua',
            method: 'post',
            data: {
                _token: $('input[name="_token"]').val()
            }
        });

        if ($.trim(idserv) != '') {
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: '/adminPedidosserv',
                method: 'post',
                data: {
                    idserv: idserv,
                    _token: $('input[name="_token"]').val()
                }
            }).done(function(res) {
                var arreglo = JSON.parse(res)

                $('#descripcion').empty();
                $('#costoServ').empty();
                $('#garantia').empty();
                $('#dispoER').empty();
                $('#dispoEA').empty();
                $('#dispoEY').empty();
                $('#dispoT1').empty();
                $('#dispoT415').empty();
                $('#dispoO').empty();
                $('#imgServ').empty();


                $('#descripcion').append(
                    "<label for='descripcion'>Descripcion</label>" +
                    "<input  class='controls' readonly  type='text' name='descripcion' id='descripcion' autocomplete='off' value='" + arreglo.servi.descripcion + "' >" +
                    "<input type='hidden' name='nombreServ' id='nombreServ' value='" + arreglo.servi.nombreServ + "'>");

                $('#costoServ').append(
                    "<label for='costoServ'>Costo de Servicio</label>" +
                    "<input readonly type='number' min='0' name='costoServ' id='costoServ' autocomplete='off' value='" + arreglo.servi.costoServ + "' >");

                $('#garantia').append(
                    "<label for='garantia'>Garantia</label>" +
                    "<input   readonly type='number' min='0' name='garantia' id='garantiaValor' autocomplete='off' value='" + arreglo.servi.garantia + "' >");





                $('#dispoER').replaceWith(
                    "<input type='hidden' name='dispoER' id='dispoER' value='" + arreglo.servi.dispoER + "' >");

                $('#dispoEA').replaceWith(
                    "<input type='hidden' name='dispoEA' id='dispoEA' value='" + arreglo.servi.dispoEA + "' >");

                $('#dispoEY').replaceWith(
                    "<input type='hidden' name='dispoEY' id='dispoEY' value='" + arreglo.servi.dispoEY + "' >");

                $('#dispoT1').replaceWith(
                    "<input type='hidden' name='dispoT1' id='dispoT1' value='" + arreglo.servi.dispoT1 + "' >");

                $('#dispoT415').replaceWith(
                    "<input type='hidden' name='dispoT415' id='dispoT415' value='" + arreglo.servi.dispoT415 + "' >");

                $('#dispoO').replaceWith(
                    "<input type='hidden' name='dispoO' id='dispoO' value='" + arreglo.servi.dispoO + "' >");

                $('#imgServ').replaceWith(
                    "<input type='hidden' name='imgServ' id='imgServ' value='" + arreglo.servi.imgServ + "' >");

                var dispoER = arreglo.servi.dispoER;
                var dispoEA = arreglo.servi.dispoEA;
                var dispoEY = arreglo.servi.dispoEY;
                var dispoT1 = arreglo.servi.dispoT1;
                var dispoT415 = arreglo.servi.dispoT415;
                var dispoO = arreglo.servi.dispoO;


                //console.log(arreglo.elegirT1)

                if ($.trim(dispoER) != '') {
                    //console.log('este es la cantidad de equipos', arre.siDispo)
                    if (dispoER == 1) {
                        if (arreglo.servER.siDispo >= 1) {
                            //console.log('si hay disponible');
                            // $('#con-res').replaceWith(" <span id='con-res' class='span-barra'><i class='fas fa-check'></i></span>");

                            if ($('#PedidoDispoER').val() != 0 && $.trim($('#PedidoDispoER').val())) {
                                PedidoDispoER = $('#PedidoDispoER').val()
                                var txt =
                                    "<i class='fas fa-check'></i>" +
                                    "<select class='completo' name='NumeroDispoER' id='NumeroDispoER' >" +
                                    "<option value=''>N°</option>" +
                                    "<option value='0' class='option-NoUsa'>No Usa</option>" +
                                    "<option value='" + PedidoDispoER + "'>R" + PedidoDispoER + " / Reservado - ACTUAL</option>"
                            } else {
                                var txt =
                                    "<i class='fas fa-check'></i>" +
                                    "<select class='completo' name='NumeroDispoER' id='NumeroDispoER'>" +
                                    "<option value=''>N°</option>" +
                                    "<option value='0' class='option-NoUsa'>No Usa</option>"

                            }
                            $('#con-res').empty();
                            $('#con-res').append(function() {
                                var content = ""

                                $.each(arreglo.elegirER, function(index, value) {
                                    if (value['estado'] != 'Disponible') {
                                        disabled = 'disabled';
                                    } else {
                                        disabled = '';
                                    }

                                    content = content + "<option " + disabled + " class=" + 'option-' + value['estado'] + " value=" + value['idEquipo'] + ">" + 'R' + value['idEquipo'] + ' / ' + value['estado']
                                    "</option>"
                                    disabled = '';
                                })
                                content = txt + content + "</select>"
                                return content
                            })


                        } else {
                            //console.log('no hya disponible')
                            $('#con-res').replaceWith(
                                "<span id='con-res' class='span-barra'>" +
                                "<i class='fas fa-times'></i>" +
                                "<select class='completo' name='NumeroDispoER' id='NumeroDispoER'>" +
                                "<option value='0' class='option-NoUsa'>No Usa</option>" +
                                "</select>" +
                                "</span>"
                            );

                        }
                    } else {
                        //console.log('no usa');
                        $('#con-res').replaceWith(
                            "<span id='con-res' class='span-barra'>" +
                            "<i class='fas fa-ban'></i>" +
                            "<input type='hidden' name='NumeroDispoER' value='0' >" +
                            "</span>"
                        );
                    }
                }
                if ($.trim(dispoEA) != '') {
                    //console.log('este es la cantidad de equipos', arre.siDispo)
                    if (dispoEA == 1) {
                        if (arreglo.servEA.siDispo >= 1) {
                            //console.log('si hay disponible');
                            //$('#con-ars').replaceWith(" <span id='con-ars' class='span-barra'><i class='fas fa-check'></i></span>");

                            if ($('#PedidoDispoEA').val() != 0 && $.trim($('#PedidoDispoEA').val())) {
                                PedidoDispoEA = $('#PedidoDispoEA').val()
                                var txt =
                                    "<i class='fas fa-check'></i>" +
                                    "<select class='completo' name='NumeroDispoEA' id='NumeroDispoEA'>" +
                                    "<option value=''>N°</option>" +
                                    "<option value='0' class='option-NoUsa'>No Usa</option>" +
                                    "<option value='" + PedidoDispoEA + "'>A" + PedidoDispoEA + " / Reservado - ACTUAL</option>"
                            } else {
                                var txt =
                                    "<i class='fas fa-check'></i>" +
                                    "<select class='completo' name='NumeroDispoEA' id='NumeroDispoEA'>" +
                                    "<option value=''>N°</option>" +
                                    "<option value='0' class='option-NoUsa'>No Usa</option>"
                            }
                            $('#con-ars').empty();
                            $('#con-ars').append(function() {
                                var content = ""

                                $.each(arreglo.elegirEA, function(index, value) {
                                    if (value['estado'] != 'Disponible') {
                                        disabled = 'disabled';
                                    } else {
                                        disabled = '';
                                    }

                                    content = content + "<option " + disabled + " class=" + 'option-' + value['estado'] + " value=" + value['idEquipo'] + ">" + 'A' + value['idEquipo'] + ' / ' + value['estado']
                                    "</option>"
                                    disabled = '';
                                })
                                content = txt + content + "</select>"
                                return content
                            })


                        } else {
                            //console.log('no hya disponible')
                            $('#con-ars').replaceWith(
                                "<span id='con-ars' class='span-barra'>" +
                                "<i class='fas fa-times'></i>" +
                                "<select class='completo' name='NumeroDispoEA' id='NumeroDispoEA'>" +
                                "<option value='0' class='option-NoUsa'>No Usa</option>" +
                                "</select>" +
                                "</span>"
                            );

                        }
                    } else {
                        //console.log('no usa');
                        $('#con-ars').replaceWith(
                            "<span id='con-ars' class='span-barra'>" +
                            "<i class='fas fa-ban'></i>" +
                            "<input type='hidden' name='NumeroDispoEA' value='0' >" +
                            "</span>"
                        );
                    }
                }
                if ($.trim(dispoEY) != '') {
                    //console.log('este es la cantidad de equipos', arre.siDispo)
                    if (dispoEY == 1) {
                        if (arreglo.servEY.siDispo >= 1) {
                            //console.log('si hay disponible');
                            //$('#con-yuw').replaceWith(" <span id='con-yuw' class='span-barra'><i class='fas fa-check'></i></span>");

                            if ($('#PedidoDispoEY').val() != 0 && $.trim($('#PedidoDispoEY').val())) {
                                PedidoDispoEY = $('#PedidoDispoEY').val()
                                var txt =
                                    "<i class='fas fa-check'></i>" +
                                    "<select class='completo' name='NumeroDispoEY' id='NumeroDispoEY'>" +
                                    "<option value=''>N°</option>" +
                                    "<option value='0' class='option-NoUsa'>No Usa</option>" +
                                    "<option value='" + PedidoDispoEY + "'>Y" + PedidoDispoEY + " / Reservado - ACTUAL</option>"
                            } else {
                                var txt =
                                    "<i class='fas fa-check'></i>" +
                                    "<select class='completo' name='NumeroDispoEY' id='NumeroDispoEY'>" +
                                    "<option value=''>N°</option>" +
                                    "<option value='0' class='option-NoUsa'>No Usa</option>"
                            }
                            $('#con-yuw').empty();
                            $('#con-yuw').append(function() {
                                var content = ""

                                $.each(arreglo.elegirEY, function(index, value) {
                                    if (value['estado'] != 'Disponible') {
                                        disabled = 'disabled';
                                    } else {
                                        disabled = '';
                                    }

                                    content = content + "<option " + disabled + " class=" + 'option-' + value['estado'] + " value=" + value['idEquipo'] + ">" + 'Y' + value['idEquipo'] + ' / ' + value['estado']
                                    "</option>"
                                    disabled = '';
                                })
                                content = txt + content + "</select>"
                                return content
                            })

                        } else {
                            //console.log('no hya disponible')
                            $('#con-yuw').replaceWith(
                                "<span id='con-yuw' class='span-barra'>" +
                                "<i class='fas fa-times'></i>" +
                                "<select class='completo' name='NumeroDispoEY' id='NumeroDispoEY'>" +
                                "<option value='0' class='option-NoUsa'>No Usa</option>" +
                                "</select>" +
                                "</span>"
                            );

                        }
                    } else {
                        //console.log('no usa');
                        $('#con-yuw').replaceWith(
                            "<span id='con-yuw' class='span-barra'>" +
                            "<i class='fas fa-ban'></i>" +
                            "<input type='hidden' name='NumeroDispoEY' value='0' >" +
                            "</span>"
                        );
                    }
                }
                if ($.trim(dispoT1) != '') {
                    //console.log('este es la cantidad de equipos', arre.siDispo)
                    if (dispoT1 == 1) {
                        if (arreglo.servT1.siDispo >= 1) {
                            // console.log('si hay disponible');
                            //$('#tubo1m').replaceWith(" <span id='tubo1m' class='span-barra'><i class='fas fa-check'></i></span>");

                            if ($('#PedidoDispoT1').val() != 0 && $.trim($('#PedidoDispoT1').val())) {
                                PedidoDispoT1 = $('#PedidoDispoT1').val()
                                var txt =
                                    "<i class='fas fa-check'></i>" +
                                    "<select class='completo' name='NumeroDispoT1'>" +
                                    "<option value='" + PedidoDispoT1 + "'>T" + PedidoDispoT1 + " / Reservado - ACTUAL</option>"
                            } else {
                                var txt =
                                    "<i class='fas fa-check'></i>" +
                                    "<select class='completo' name='NumeroDispoT1'>" +
                                    "<option value=''>N°</option>"
                            }
                            $('#tubo1m').empty();
                            $('#tubo1m').append(function() {
                                var content = ""

                                $.each(arreglo.elegirT680L, function(index, value) {
                                    if (value['estado'] != 'Disponible') {
                                        disabled = 'disabled';
                                    } else {
                                        disabled = '';
                                    }

                                    content = content + "<option " + disabled + " class=" + 'option-' + value['estado'] + " value=" + value['idTubo'] + ">" + 'T' + value['idTubo'] + ' / ' + value['estado']
                                    "</option>"
                                    disabled = '';
                                })
                                content = txt + content + "</select>"
                                return content
                            })


                        } else {
                            //console.log('no hya disponible')
                            $('#tubo1m').replaceWith(
                                "<span id='tubo1m' class='span-barra'>" +
                                "<i class='fas fa-times'></i>" +
                                "<select class='completo' name='NumeroDispoT1' >" +
                                "<option value=''>N°</option>" +
                                "</select>" +
                                "</span>"
                            );
                        }
                    } else {
                        //console.log('no usa');
                        $('#tubo1m').replaceWith(
                            "<span id='tubo1m' class='span-barra'>" +
                            "<i class='fas fa-ban'></i>" +
                            "<input type='hidden' name='NumeroDispoT1' value='0' >" +
                            "</span>"
                        );

                    }

                }
                if ($.trim(dispoT415) != '') {
                    if (dispoT415 == 1) {
                        if (arreglo.servT415.siDispo >= 1) {
                            //console.log('si hay disponible');
                            //$('#tubo415').replaceWith(" <span id='tubo415' class='span-barra'><i class='fas fa-check'></i></span>");

                            if ($('#PedidoDispoT415').val() != 0 && $.trim($('#PedidoDispoT415').val())) {
                                PedidoDispoT415 = $('#PedidoDispoT415').val()
                                var txt =
                                    "<i class='fas fa-check'></i>" +
                                    "<select class='completo' name='NumeroDispoT415'>" +
                                    "<option value='" + PedidoDispoT415 + "'>T" + PedidoDispoT415 + " / Reservado - ACTUAL</option>"
                            } else {
                                var txt =
                                    "<i class='fas fa-check'></i>" +
                                    "<select class='completo' name='NumeroDispoT415'>" +
                                    "<option value=''>N°</option>"
                            }
                            $('#tubo415').empty();
                            $('#tubo415').append(function() {
                                var content = ""

                                $.each(arreglo.elegirT415L, function(index, value) {
                                    if (value['estado'] != 'Disponible') {
                                        disabled = 'disabled';
                                    } else {
                                        disabled = '';
                                    }

                                    content = content + "<option " + disabled + " class=" + 'option-' + value['estado'] + " value=" + value['idTubo'] + ">" + 'T' + value['idTubo'] + ' / ' + value['estado']
                                    "</option>"
                                    disabled = '';
                                })
                                content = txt + content + "</select>"
                                return content
                            })


                        } else {
                            //console.log('no hya disponible')
                            $('#tubo415').replaceWith(
                                "<span id='tubo415' class='span-barra'>" +
                                "<i class='fas fa-times'></i>" +
                                "<select class='completo' name='NumeroDispoT415' >" +
                                "<option value=''>N°</option>" +
                                "</select>" +
                                "</span>"
                            );

                        }
                    } else {
                        //console.log('no usa');
                        $('#tubo415').replaceWith(
                            "<span id='tubo415' class='span-barra'>" +
                            "<i class='fas fa-ban'></i>" +
                            "<input type='hidden' name='NumeroDispoT415' value='0' >" +
                            "</span>"
                        );
                    }
                }
                if ($.trim(dispoO) != '') {
                    if (dispoO == 1) {
                        if (arreglo.servO.siDispo >= 1) {
                            // console.log('si hay disponible');
                            //$('#oximetro').replaceWith(" <span id='oximetro' ><i class='fas fa-check'></i></span>");


                            if ($('#PedidoDispoO').val() != 0 && $.trim($('#PedidoDispoO').val())) {
                                PedidoDispoO = $('#PedidoDispoO').val()
                                var txt =
                                    "<i class='fas fa-check'></i>" +
                                    "<select class='completo' name='NumeroDispoO'>" +
                                    "<option value='" + PedidoDispoO + "'>X" + PedidoDispoO + " / Reservado - ACTUAL</option>"
                            } else {
                                var txt =
                                    "<i class='fas fa-check'></i>" +
                                    "<select class='completo' name='NumeroDispoO'>" +
                                    "<option value=''>N°</option>"
                            }
                            $('#oximetro').empty();
                            $('#oximetro').append(function() {
                                var content = ""

                                $.each(arreglo.elegirO, function(index, value) {
                                    if (value['estado'] != 'Disponible') {
                                        disabled = 'disabled';
                                    } else {
                                        disabled = '';
                                    }

                                    content = content + "<option " + disabled + " class=" + 'option-' + value['estado'] + " value=" + value['idOximetro'] + ">" + 'X' + value['idOximetro'] + ' / ' + value['estado']
                                    "</option>"
                                    disabled = '';
                                })
                                content = txt + content + "</select>"
                                return content
                            })


                        } else {
                            //console.log('no hya disponible')
                            $('#oximetro').replaceWith(
                                "<span id='oximetro' class='span-barra'>" +
                                "<i class='fas fa-times'></i>" +
                                "<select class='completo' name='NumeroDispoO' >" +
                                "<option value=''>N°</option>" +
                                "</select>" +
                                "</span>"
                            );

                        }
                    } else {
                        //console.log('no usa');
                        $('#oximetro').replaceWith(
                            " <span id='oximetro'>" +
                            "<i class='fas fa-ban'></i>" +
                            "<input type='hidden' name='NumeroDispoO' value='0' >" +
                            "</span>"
                        );
                    }
                }



                ///FOMRULARIO DE CARGA DE ALUILAR PARA OBETENR LA GARANTIA

                var garantiaValor = $('#garantiaValor').val();
                //console.log(garantiaValor)

                if (garantiaValor == 0) {
                    $('.medioPagoG').empty();
                    $('.medioPagoG').replaceWith(
                        "<select  name='medioPagoGarantia' id='medioPago' class='medioPagoG'>" +
                        "<optgroup label='Garantia'>" +
                        "<option value='No Se Cobra' >No Se Cobra</option>" +
                        "</select>"
                    )
                } else {
                    $('.medioPagoG').empty();
                    $('.medioPagoG').replaceWith(
                        "<select name='medioPagoGarantia' id='medioPago' class='medioPagoG'>" +
                        "<optgroup label='Garantia'>" +
                        "<option value='' >Seleccione Medio De Pago</option>" +
                        "<option value='Efectivo' >Efectivo</option>" +
                        "<option value='Bank' >Bank</option>" +
                        "<option value='Mercado Pago' >Mercado Libre</option>" +
                        "<option value='Uala' >Uala</option>" +
                        "<option value='A Confirmar' >A Confirmar</option>" +
                        "</select>"
                    )
                }



                //para activar el boton de enviar formulario de agregar alquiler
                checkeo = true;
                $(".completo").each(function() {
                    /*console.log('/////////////////')
                    console.log($(this).attr('id'))
                    console.log($(this).val())*/

                    if ($(this).val() == "") {
                        checkeo = false
                    }
                });
                var res = $("#NumeroDispoER").val()
                var ars = $("#NumeroDispoEA").val()
                var yuw = $("#NumeroDispoEY").val()
                    //console.log(res, ars, yuw);

                if (checkeo) {
                    if ($.trim(res && ars && yuw)) {

                        if (res != 0 && ars == 0 && yuw == 0) {
                            $(".button-completo").removeAttr("disabled");
                        } else if (ars != 0 && res == 0 && yuw == 0) {
                            $(".button-completo").removeAttr("disabled");
                        } else if (yuw != 0 && res == 0 && ars == 0) {
                            $(".button-completo").removeAttr("disabled");
                        } else {
                            $(".button-completo").attr("disabled", "disabled");
                        }
                    } else {
                        $(".button-completo").removeAttr("disabled");
                    }
                } else {
                    $(".button-completo").attr("disabled", "disabled");
                }
            })
        }
    });

    $('#fechaInicio').on('change', function() {

        var fechaInicio = $('#fechaInicio').val();
        var fecha = moment(fechaInicio);
        var dias = $('#dias').val();
        //dias = dias * 30
        if ($.trim(fechaInicio)) {

            if (dias == 15) {
                var fechaFin = fecha.clone().add(dias, 'days').format('DD/MM/YYYY');
                var fechaFinB = fecha.clone().add(dias, 'days').format('DD-MM-YYYY');

            } else {

                var fechaFin = fecha.clone().add(dias, 'months').format('DD/MM/YYYY');
                var fechaFinB = fecha.clone().add(dias, 'months').format('DD-MM-YYYY');
            }

            $('#fechaFin').empty();
            $('#fechaFin').append(
                "<label for='fechaFin'>Fecha Finalizacion</label>" +
                "<input class='controls' readonly type='text'   autocomplete='off' value='" + fechaFin + "'  >" +
                "<input class='controls' readonly type='hidden'  name='fechaFin' autocomplete='off' value='" + fechaFinB + "'  >");
        }
    });
    $('#dias').on('change', function() {

        var fechaInicio = $('#fechaInicio').val();
        var fecha = moment(fechaInicio);
        var dias = $('#dias').val();
        //dias = dias * 30
        if ($.trim(fechaInicio)) {

            if (dias == 15) {
                var fechaFin = fecha.clone().add(dias, 'days').format('DD/MM/YYYY');
                var fechaFinB = fecha.clone().add(dias, 'days').format('DD-MM-YYYY');

            } else {

                var fechaFin = fecha.clone().add(dias, 'months').format('DD/MM/YYYY');
                var fechaFinB = fecha.clone().add(dias, 'months').format('DD-MM-YYYY');
            }

            $('#fechaFin').empty();
            $('#fechaFin').append(
                "<label for='fechaFin'>Fecha Finalizacion</label>" +
                "<input class='controls' readonly type='text'    autocomplete='off' value='" + fechaFin + "'  >" +
                "<input class='controls' readonly type='hidden'  name='fechaFin'  autocomplete='off' value='" + fechaFinB + "'  >");
        }
    });


    $('#fciChange').on('change', function() {
        var porcen = $(this).val();
        var garantiaActivaDispo = $('#garantiaActivaDispo').val();


        var fci = (porcen * garantiaActivaDispo) / 100;
        var garantiaActivaDispo = garantiaActivaDispo - fci;

        $('#fci').empty();
        $('#fci').replaceWith(
            "<input readonly type='number' name='fci' id='fci' value='" + fci + "'>"
        );

        $('#garantiaActivaDispo').empty();
        $('#garantiaActivaDispo').replaceWith(
            "<input readonly type='number' name='garantiaActivaDispo' id='garantiaActivaDispo' value='" + garantiaActivaDispo + "'>"
        );


        $('#fciChange').empty();
        $('#fciChange').replaceWith(
            "<select disabled name='fciChange' id='fciChange'>" +
            "<option value='' >Selecciona El Porcentaje de FCI</option>" +
            "</select>" +
            "<input type='hidden' name='fciChange' value=" + porcen + ">"

        );

    });

    $('#plazoFijoChange').on('change', function() {
        var porcen = $(this).val();
        var garantiaActivaDispo = $('#garantiaActivaDispo').val();

        var plazoFijo = (porcen * garantiaActivaDispo) / 100;
        var garantiaActivaDispo = garantiaActivaDispo - plazoFijo;
        console.log(plazoFijo, garantiaActivaDispo)

        $('#plazoFijo').empty();
        $('#plazoFijo').replaceWith(
            "<input readonly type='number' name='plazoFijo' id='plazoFijo' value='" + plazoFijo + "'>"
        );

        $('#garantiaActivaDispo').empty();
        $('#garantiaActivaDispo').replaceWith(
            "<input readonly type='number' name='garantiaActivaDispo' id='garantiaActivaDispo' value='" + garantiaActivaDispo + "'>"
        );

        $('#plazoFijoChange').empty();
        $('#plazoFijoChange').replaceWith(
            "<select disabled name='plazoFijoChange' id='plazoFijoChange'>" +
            "<option value='' >Selecciona El Porcentaje de Plazo Fijo</option>" +
            "</select>" +
            "<input type='hidden' name='plazoFijoChange' value=" + porcen + ">"


        );


    });

    ///FORM DE ADMINSALIDA
    $('#cuenta').on('change', function() {
        var cuentaId = $(this).val();
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/CajaSalidaVerUsuarioConGarantia',
            method: 'post',
            data: {
                cuentaId: cuentaId,
                _token: $('input[name="_token"]').val()
            }
        }).done(function(res) {
            var arreglo = JSON.parse(res)
                //console.log(arreglo)

            if (arreglo.res == true) {
                $('#tipo').empty();
                $('#tipo').replaceWith(
                    "<select name='tipo' id='tipo'>" +
                    "<option value=''>Seleccione un Concepto</option>" +
                    "<option value='propioUsuario'>Propio del Usuario</option>" +
                    "<option value='garantiaActivas'>Garantias Activas</option>" +
                    "</select>"
                );

                $('#dineroGarantiaLiquidas').empty();
                $('#dineroGarantiaLiquidas').replaceWith(
                    "<input readonly type='text' id='dineroGarantiaLiquidas' value='" + arreglo.liquidasHoy + "'>"
                );
                $('#tipo').on('change', function() {
                    var tipo = $(this).val();
                    //console.log(tipo)
                    //console.log(arreglo.tipo)

                    if (tipo == 'garantiaActivas') {
                        if (arreglo.tipo == 'Control Digital') {
                            $('#medioPagoGasto').empty();
                            $('#medioPagoGasto').replaceWith(
                                "<select name='medioPago' id='medioPagoGasto'>" +
                                "<option value='Bank'>Bank</option>" +
                                "</select>"
                            );
                        } else {
                            if (arreglo.tipo == 'Control de Efectivo') {
                                $('#medioPagoGasto').empty();
                                $('#medioPagoGasto').replaceWith(
                                    "<select name='medioPago' id='medioPagoGasto'>" +
                                    "<option value='Efectivo'>Efectivo</option>" +
                                    "</select>"
                                );
                            }
                        }
                    } else {
                        $('#medioPagoGasto').empty();
                        $('#medioPagoGasto').replaceWith(
                            "<select name='medioPago' id='medioPagoGasto'>" +
                            "<option value=''>Selecciona Medio De Pago</option>" +
                            "<option value='Efectivo' >Efectivo</option>" +
                            "<option value='Bank' >Bank</option>" +
                            "<option value='Mercado Pago' >Mercado Pago</option>" +
                            "<option value='Uala' >Ualá</option> " +
                            "</select>"
                        );
                    }
                })

            } else {
                $('#tipo').empty();
                $('#tipo').replaceWith(
                    "<select name='tipo' id='tipo'>" +
                    "<option value=''>Seleccione un Concepto</option>" +
                    "<option value='propioUsuario'>Propio del Usuario</option>" +
                    "</select>"
                );

                $('#dineroGarantiaLiquidas').empty();
                $('#dineroGarantiaLiquidas').replaceWith(
                    "<input readonly type='text' id='dineroGarantiaLiquidas' value='No Hay Garantias Liquidas'>"
                );
                $('#tipo').on('change', function() {
                    var tipo = $(this).val();

                    if (tipo == 'propioUsuario') {

                        $('#medioPagoGasto').empty();
                        $('#medioPagoGasto').replaceWith(
                            "<select name='medioPago' id='medioPagoGasto'>" +
                            "<option value=''>Selecciona Medio De Pago</option>" +
                            "<option value='Efectivo' >Efectivo</option>" +
                            "<option value='Bank' >Bank</option>" +
                            "<option value='Mercado Pago' >Mercado Pago</option>" +
                            "<option value='Uala' >Ualá</option> " +
                            "</select>"
                        );
                    }
                })
            }
        })
        $('#medioPagoGasto').empty();
        $('#medioPagoGasto').replaceWith(
            "<select disabled name='medioPago' id='medioPagoGasto'>" +
            "<option value=''>Selecciona Medio De Pago</option>" +
            "<option value='Efectivo' >Efectivo</option>" +
            "<option value='Bank' >Bank</option>" +
            "<option value='Mercado Pago' >Mercado Pago</option>" +
            "<option value='Uala' >Ualá</option> " +
            "</select>"
        );

    });


    ////////FORM DE UBICACION DE GARANTIA
    medioG()

    function medioG() {
        var medioPagoGarantia = $('#medioPagoGarantia').val()
        var estadoPedido = $('#estadoPedido').val()
            //console.log(estadoPedido)


        if (medioPagoGarantia != "") {


            if (estadoPedido == 'Entrega') {

                var idUsuarioG = $('#idUsuarioG').val()
                var estaEnCajaG = $('#estaEnCajaG').val()
                console.log(idUsuarioG, estaEnCajaG)

                $('#idUsuario').empty()
                $('#idUsuario').replaceWith(
                    "<select name='idUsuario' id='idUsuario'>" +
                    "<option value=" + idUsuarioG + "> " + estaEnCajaG + "</option>" +
                    "</select>"
                )




            } else {

                if (medioPagoGarantia == 'Bank' || medioPagoGarantia == 'Mercado Pago' || medioPagoGarantia == 'Uala') {

                    var perfilFinanciero = 'Control Digital'
                    var idPedido = $("#idPedido").val()
                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        url: '/UserAsignacionDelDineroGarantia',
                        method: 'post',
                        data: {
                            perfilFinanciero: perfilFinanciero,
                            idPedido: idPedido,
                            _token: $('input[name="_token"]').val()
                        }
                    }).done(function(res) {
                        var arreglo = JSON.parse(res)
                        var hola = "<select name='idUsuario' id='idUsuario'>" +
                            "<option value=''> Seleccione Una Cuenta</option>"

                        $('#idUsuario').empty();
                        $('#idUsuario').replaceWith(function() {
                            var content = ""

                            $.each(arreglo.usuarios, function(index, value) {
                                content = content + "<option value=" + value['id'] + ">" + value['name'] + ' ' + value['apellido'] + "</option>  "
                            })
                            content = hola + content + "</select>"
                            return content
                        })
                    })
                } else {
                    if (medioPagoGarantia == 'Efectivo') {

                        var perfilFinanciero = 'Control de Efectivo'

                        $.ajax({
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            url: '/UserAsignacionDelDineroGarantia',
                            method: 'post',
                            data: {
                                perfilFinanciero: perfilFinanciero,
                                _token: $('input[name="_token"]').val()
                            }
                        }).done(function(res) {
                            var arreglo = JSON.parse(res)

                            var hola = "<select name='idUsuario' id='idUsuario'>" +
                                "<option value=''>Seleccione una Cuenta</option>"

                            $('#idUsuario').empty();
                            $('#idUsuario').replaceWith(function() {
                                var content = ""

                                $.each(arreglo.usuarios, function(index, value) {
                                    content = content + "<option value=" + value['id'] + ">" + value['name'] + ' ' + value['apellido'] + "</option>  "
                                })
                                content = hola + content + "</select>"
                                return content
                            })
                        })
                    } else {
                        if (medioPagoGarantia == 'No Se Cobra') {
                            $('#idUsuario').empty();
                            $('#idUsuario').replaceWith(
                                "<select  name='idUsuario' id='idUsuario'>" +
                                "<option value='0'> No Se Cobra</option>" +
                                "</select>"
                            )
                        }
                    }

                }

            }
        } else {

            console.log('NO EXISTE')

            $('#medioPagoGarantia').on('change', function() {
                var medioPagoGarantia = $(this).val();

                if (medioPagoGarantia == 'Bank' || medioPagoGarantia == 'Mercado Pago' || medioPagoGarantia == 'Uala') {

                    var perfilFinanciero = 'Control Digital'

                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        url: '/UserAsignacionDelDineroGarantia',
                        method: 'post',
                        data: {
                            perfilFinanciero: perfilFinanciero,
                            _token: $('input[name="_token"]').val()
                        }
                    }).done(function(res) {
                        var arreglo = JSON.parse(res)

                        var hola = "<select name='idUsuario' id='idUsuario'>" +
                            "<option value=''>Seleccione una Cuenta</option>"

                        $('#idUsuario').empty();
                        $('#idUsuario').replaceWith(function() {
                            var content = ""

                            $.each(arreglo.usuarios, function(index, value) {
                                content = content + "<option value=" + value['id'] + ">" + value['name'] + ' ' + value['apellido'] + "</option>  "
                            })
                            content = hola + content + "</select>"
                            return content
                        })
                    })
                } else {
                    if (medioPagoGarantia == 'Efectivo') {

                        var perfilFinanciero = 'Control de Efectivo'

                        $.ajax({
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            url: '/UserAsignacionDelDineroGarantia',
                            method: 'post',
                            data: {
                                perfilFinanciero: perfilFinanciero,
                                _token: $('input[name="_token"]').val()
                            }
                        }).done(function(res) {
                            var arreglo = JSON.parse(res)

                            var hola = "<select name='idUsuario' id='idUsuario'>" +
                                "<option value=''>Seleccione una Cuenta</option>"

                            $('#idUsuario').empty();
                            $('#idUsuario').replaceWith(function() {
                                var content = ""

                                $.each(arreglo.usuarios, function(index, value) {
                                    content = content + "<option value=" + value['id'] + ">" + value['name'] + ' ' + value['apellido'] + "</option>  "
                                })
                                content = hola + content + "</select>"
                                return content
                            })
                        })
                    }
                }
            });
        }
    }

})