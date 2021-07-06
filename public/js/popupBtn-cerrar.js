var btnAbrirPopup = document.getElementById('btn-abrir-popup'),
    overlay = document.getElementById('overlay'),
    popup = document.getElementById('popup'),
    btnCerrarPopup = document.getElementById('btn-cerrar-popup')


if (btnAbrirPopup) {
    btnAbrirPopup.addEventListener('click', function() {
        overlay.classList.add('active');
        popup.classList.add('active');
    })
}
if (btnCerrarPopup) {
    btnCerrarPopup.addEventListener('click', function() {
        overlay.classList.remove('active');
        popup.classList.remove('active');


    })
}
$(overlay).on("click", function(e) {
    var contentformulario = $('.content-formulario')

    if (!contentformulario.is(e.target) && contentformulario.has(e.target).length === 0) {
        overlay.classList.remove('active');
        popup.classList.remove('active');

    }
});



//BTN DE FORMULARIO DE AGREGAR GASTO  

var btnAbrirPopupGasto = document.getElementById('btn-abrir-popup-gasto'),
    overlayGasto = document.getElementById('overlay-gasto'),
    popupGasto = document.getElementById('popup-gasto'),
    btnCerrarPopupGasto = document.getElementById('btn-cerrar-popup-gasto')

if (btnAbrirPopupGasto) {
    btnAbrirPopupGasto.addEventListener('click', function() {
        overlayGasto.classList.add('active');
        popupGasto.classList.add('active');
    })
}
if (btnCerrarPopupGasto) {
    btnCerrarPopupGasto.addEventListener('click', function() {
        overlayGasto.classList.remove('active');
        popupGasto.classList.remove('active');
    })
}
$(overlayGasto).on("click", function(e) {
    var contentformulario = $('.content-formulario')

    if (!contentformulario.is(e.target) && contentformulario.has(e.target).length === 0) {
        overlayGasto.classList.remove('active');
        popupGasto.classList.remove('active');
    }
});

/// BTN DE FORMULARIO DE VIST DE RETIRO CALENDARIO

var btnAbrirPopup2 = document.getElementById('btn-abrir-popup2'),
    overlay2 = document.getElementById('overlay2'),
    popup2 = document.getElementById('popup2'),
    btnCerrarPopup2 = document.getElementById('btn-cerrar-popup2')

if (btnAbrirPopup2) {
    btnAbrirPopup2.addEventListener('click', function() {
        overlay2.classList.add('active');
        popup2.classList.add('active');

    })
}
if (btnCerrarPopup2) {
    btnCerrarPopup2.addEventListener('click', function() {
        overlay2.classList.remove('active');
        popup2.classList.remove('active');

    })
}
$(overlay2).on("click", function(e) {
    var contentformulario = $('.content-formulario')

    if (!contentformulario.is(e.target) && contentformulario.has(e.target).length === 0) {
        overlay2.classList.remove('active');
        popup2.classList.remove('active');
    }
});
/// BTN DE FORMULARIO DE VIST DE TAREA CALENDARIO

var btnAbrirPopup3 = document.getElementById('btn-abrir-popup3'),
    overlay3 = document.getElementById('overlay3'),
    popup3 = document.getElementById('popup3'),
    btnCerrarPopup3 = document.getElementById('btn-cerrar-popup3')

if (btnAbrirPopup3) {
    btnAbrirPopup3.addEventListener('click', function() {
        overlay3.classList.add('active');
        popup3.classList.add('active');

    })
}
if (btnCerrarPopup3) {
    btnCerrarPopup3.addEventListener('click', function() {
        overlay3.classList.remove('active');
        popup3.classList.remove('active');

    })
}
$(overlay3).on("click", function(e) {
    var contentformulario = $('.content-formulario')

    if (!contentformulario.is(e.target) && contentformulario.has(e.target).length === 0) {
        overlay3.classList.remove('active');
        popup3.classList.remove('active');
    }
});
/// BTN DE FORMULARIO DE BUSCAR ALQUILER

var btnAbrirPopupBuscar = document.getElementById('btn-abrir-popup-buscar'),
    overlayBuscar = document.getElementById('overlay-buscar'),
    popupBuscar = document.getElementById('popup-buscar'),
    btnCerrarPopupBuscar = document.getElementById('btn-cerrar-popup-buscar')

if (btnAbrirPopupBuscar) {
    btnAbrirPopupBuscar.addEventListener('click', function() {
        overlayBuscar.classList.add('active');
        popupBuscar.classList.add('active');

    })
}
if (btnCerrarPopupBuscar) {
    btnCerrarPopupBuscar.addEventListener('click', function() {
        overlayBuscar.classList.remove('active');
        popupBuscar.classList.remove('active');
    })
}
$(overlayBuscar).on("click", function(e) {
    var contentformulario = $('.content-formulario-busca')

    if (!contentformulario.is(e.target) && contentformulario.has(e.target).length === 0) {
        overlayBuscar.classList.remove('active');
        popupBuscar.classList.remove('active');
    }
});
/// BTN DE CAMBIO
var urlCambio = document.getElementById('urlCambio')

if (urlCambio) {
    urlCambio.addEventListener('click', function() {
        window.location.href = '/adminCambios'

    })
}

/////// BTN DE FORMULARIO DE AGREGAR TAREA

var btnAbrirPopupTarea = document.getElementById('btn-abrir-popup-tarea'),
    overlayTarea = document.getElementById('overlay-tarea'),
    popupTarea = document.getElementById('popup-tarea'),
    btnCerrarPopupTarea = document.getElementById('btn-cerrar-popup-tarea')

if (btnAbrirPopupTarea) {
    btnAbrirPopupTarea.addEventListener('click', function() {
        overlayTarea.classList.add('active');
        popupTarea.classList.add('active');

    })
}
if (btnCerrarPopupTarea) {
    btnCerrarPopupTarea.addEventListener('click', function() {
        overlayTarea.classList.remove('active');
        popupTarea.classList.remove('active');

    })
}
$(overlayTarea).on("click", function(e) {
    var contentformulario = $('.content-formulario')

    if (!contentformulario.is(e.target) && contentformulario.has(e.target).length === 0) {
        overlayTarea.classList.remove('active');
        popupTarea.classList.remove('active');
    }
});

/////// BTN DE FORMULARIO DE MODIFICAR RENTABILIDAD  

var btnAbrirPopupRenta = document.getElementById('btn-abrir-popup-renta'),
    overlayRenta = document.getElementById('overlay-renta'),
    popupRenta = document.getElementById('popup-renta'),
    btnCerrarPopupRenta = document.getElementById('btn-cerrar-popup-renta')

if (btnAbrirPopupRenta) {
    btnAbrirPopupRenta.addEventListener('click', function() {
        overlayRenta.classList.add('active');
        popupRenta.classList.add('active');

    })
}
if (btnCerrarPopupRenta) {
    btnCerrarPopupRenta.addEventListener('click', function() {
        overlayRenta.classList.remove('active');
        popupRenta.classList.remove('active');
    })
}
$(overlayRenta).on("click", function(e) {
    var contentformulario = $('.content-formulario-busca')

    if (!contentformulario.is(e.target) && contentformulario.has(e.target).length === 0) {
        overlayRenta.classList.remove('active');
        popupRenta.classList.remove('active');
    }
});
/// BTN DE CALENDARIO
var urlCalendario = document.getElementById('urlCalendario')

if (urlCalendario) {
    urlCalendario.addEventListener('click', function() {
        window.location.href = '/adminCalendario'
    })
}




///////////// BTN DE AGREGAR REPOSICION

var btnAbrirPopupReposicion = document.getElementById('btn-abrir-popup-reposicion'),
    overlayReposicion = document.getElementById('overlay-reposicion'),
    popupReposicion = document.getElementById('popup-reposicion'),
    btnCerrarPopupReposicion = document.getElementById('btn-cerrar-popup-reposicion')

if (btnAbrirPopupReposicion) {
    btnAbrirPopupReposicion.addEventListener('click', function() {
        overlayReposicion.classList.add('active');
        popupReposicion.classList.add('active');

    })
}
if (btnCerrarPopupReposicion) {
    btnCerrarPopupReposicion.addEventListener('click', function() {
        overlayReposicion.classList.remove('active');
        popupReposicion.classList.remove('active');

    })
}

$(overlayReposicion).on("click", function(e) {
    var contentformulario = $('.content-formulario')

    if (!contentformulario.is(e.target) && contentformulario.has(e.target).length === 0) {
        overlayReposicion.classList.remove('active');
        popupReposicion.classList.remove('active');
    }
});

///////////// BTN DE AGREGAR COSTO FIJO

var btnAbrirPopupCostoFijo = document.getElementById('btn-abrir-popup-CostoFijo'),
    overlayCostoFijo = document.getElementById('overlay-CostoFijo'),
    popupCostoFijo = document.getElementById('popup-CostoFijo'),
    btnCerrarPopupCostoFijo = document.getElementById('btn-cerrar-popup-CostoFijo')

if (btnAbrirPopupCostoFijo) {
    btnAbrirPopupCostoFijo.addEventListener('click', function() {
        overlayCostoFijo.classList.add('active');
        popupCostoFijo.classList.add('active');

    })
}
if (btnCerrarPopupCostoFijo) {
    btnCerrarPopupCostoFijo.addEventListener('click', function() {
        overlayCostoFijo.classList.remove('active');
        popupCostoFijo.classList.remove('active');

    })
}
$(overlayCostoFijo).on("click", function(e) {
    var contentformulario = $('.content-formulario')

    if (!contentformulario.is(e.target) && contentformulario.has(e.target).length === 0) {
        overlayCostoFijo.classList.remove('active');
        popupCostoFijo.classList.remove('active');
    }
});
///////////// BTN DE AGREGAR FONDO HH

var btnAbrirPopupFondoHH = document.getElementById('btn-abrir-popup-fondoHH'),
    overlayFondoHH = document.getElementById('overlay-fondoHH'),
    popupFondoHH = document.getElementById('popup-fondoHH'),
    btnCerrarPopupFondoHH = document.getElementById('btn-cerrar-popup-fondoHH')

if (btnAbrirPopupFondoHH) {
    btnAbrirPopupFondoHH.addEventListener('click', function() {
        overlayFondoHH.classList.add('active');
        popupFondoHH.classList.add('active');

    })
}
if (btnCerrarPopupFondoHH) {
    btnCerrarPopupFondoHH.addEventListener('click', function() {
        overlayFondoHH.classList.remove('active');
        popupFondoHH.classList.remove('active');

    })
}
$(overlayFondoHH).on("click", function(e) {
    var contentformulario = $('.content-formulario')

    if (!contentformulario.is(e.target) && contentformulario.has(e.target).length === 0) {
        overlayFondoHH.classList.remove('active');
        popupFondoHH.classList.remove('active');
    }
});
///////////// BTN DE COMENTARIOS DE ALQUILERES VENCIDO//////////



var comentarios = function($id) {
    var btnAbrir = 'btn-abrir-popup-comentarios-' + $id
    var overlay = 'overlay-comentarios-' + $id
    var popup = 'popup-comentarios-' + $id
    var btnCerrar = 'btn-cerrar-popup-comentarios-' + $id

    var btnAbrirPopupComentarios = document.getElementById(btnAbrir),
        overlayComentarios = document.getElementById(overlay),
        popupComentarios = document.getElementById(popup),
        btnCerrarPopupComentarios = document.getElementById(btnCerrar)

    if (btnAbrirPopupComentarios) {
        btnAbrirPopupComentarios.addEventListener('click', function() {
            overlayComentarios.classList.add('active');
            popupComentarios.classList.add('active');

        })
    }
    if (btnCerrarPopupComentarios) {
        btnCerrarPopupComentarios.addEventListener('click', function() {
            overlayComentarios.classList.remove('active');
            popupComentarios.classList.remove('active');

        })
    }
    $(overlayComentarios).on("click", function(e) {
        var contentformulario = $('.content-formulario')

        if (!contentformulario.is(e.target) && contentformulario.has(e.target).length === 0) {
            overlayComentarios.classList.remove('active');
            popupComentarios.classList.remove('active');
        }
    });
}

///////////// BTN DE CALENDARIO ORDENES DE RETIROS Y ENTREGAS//////////



var orden = function($id) {
    var btnAbrir = 'btn-abrir-popup-orden-' + $id
    var overlay = 'overlay-orden-' + $id
    var popup = 'popup-orden-' + $id
    var btnCerrar = 'btn-cerrar-popup-orden-' + $id


    var btnAbrirPopupOrden = document.getElementById(btnAbrir),
        overlayOrden = document.getElementById(overlay),
        popupOrden = document.getElementById(popup),
        btnCerrarPopupOrden = document.getElementById(btnCerrar)

    if (btnAbrirPopupOrden) {
        btnAbrirPopupOrden.addEventListener('click', function() {
            overlayOrden.classList.add('active');
            popupOrden.classList.add('active');

        })
    }
    if (btnCerrarPopupOrden) {
        btnCerrarPopupOrden.addEventListener('click', function() {
            overlayOrden.classList.remove('active');
            popupOrden.classList.remove('active');

        })
    }
    $(overlayOrden).on("click", function(e) {
        var contentformulario = $('.content-formulario')

        if (!contentformulario.is(e.target) && contentformulario.has(e.target).length === 0) {
            overlayOrden.classList.remove('active');
            popupOrden.classList.remove('active');
        }
    });
}