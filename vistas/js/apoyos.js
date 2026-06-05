/*=============================================
VER MÁS INFO DEL APOYO
=============================================*/
$(".tablaApoyos").on("click", ".btnVerMas", function(e){
    e.preventDefault();
    let infoCompleta = $(this).attr("data-info");
    $("#textoInfoCompleta").text(infoCompleta);
});

/*=============================================
CAMBIAR ESTADO APOYO DUAL
=============================================*/
$(document).on("click", ".btnActivarDual", function(){
    let boton = $(this);
    let idApoyo = boton.attr("idApoyo");
    let estadoDual = boton.attr("estadoDual");

    let datos = new FormData();
    datos.append("idApoyoDual", idApoyo);
    datos.append("estadoDual", estadoDual);

    $.ajax({
        url: "ajax/apoyos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta.trim() === "ok"){
                if (estadoDual == 1) { // De 0 a 1 (Sí)
                    boton.removeClass("btn-danger");
                    boton.addClass("btn-success");
                    boton.html("Sí");
                    boton.attr("estadoDual", 0);
                } else { // De 1 a 0 (No)
                    boton.removeClass("btn-success");
                    boton.addClass("btn-danger");
                    boton.html("No");
                    boton.attr("estadoDual", 1);
                }
            }
        }
    });
});

/*=============================================
EDITAR APOYO
=============================================*/
$(".tablaApoyos").on("click", ".btnEditarApoyo", function(){
    let idApoyo = $(this).attr("idApoyo");
    let datos = new FormData();
    console.log(idApoyo);
    datos.append("idApoyo", idApoyo);

    $.ajax({
        url: "ajax/apoyos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log(respuesta);
            $("#idApoyo").val(respuesta["id_apoyo"]);
            $("#editarDescripcionApoyo").val(respuesta["descripcion_apoyo"]);
            $("#editarInformacionApoyo").val(respuesta["informacion_apoyo"]);
            
            // Nuevo selector dinámico de iconos
            $("#editarApoyoIcono").val(respuesta["apoyo_icono"]);
            $("#nombreEditarIcono").val(respuesta["nombre_icono"]);
            $("#previewEditarIcono").html(`<i class="${respuesta["apoyo_icono"]}"></i>`);

            if(respuesta["apoyo_dual"] == 1){
                $("#editarApoyoDualSi").prop("checked", true);
            } else {
                $("#editarApoyoDualNo").prop("checked", true);
            }
        }
    })
});

/*=============================================
ELIMINAR APOYO
=============================================*/
$(".tablaApoyos").on("click", ".btnEliminarApoyo", function(){
    let idApoyo = $(this).attr("idApoyo");

    Swal.fire({
        title: '¿Está seguro de borrar el apoyo?',
        text: "¡Si no lo está puede cancelar la acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar apoyo!'
    }).then(function(result){
        if(result.value){
            window.location = "index.php?ruta=apoyos&idApoyoEliminar="+idApoyo;
        }
    })
});

/*=============================================
MODAL DINÁMICO DE ICONOS
=============================================*/
let targetPreview = "";
let targetName = "";
let targetHidden = "";
let iconosCargados = false;

// Al abrir el modal de iconos
$(document).on("click", ".btnAbrirModalIconos", function(){
    targetPreview = $(this).attr("data-target-preview");
    targetName = $(this).attr("data-target-name");
    targetHidden = $(this).attr("data-target-hidden");

    if(!iconosCargados){
        $.ajax({
            url: "ajax/iconos.ajax.php",
            method: "POST",
            data: {cargarIconos: "ok"},
            dataType: "json",
            success: function(respuesta){
                let html = "";
                respuesta.forEach(function(icono){
                    html += `
                    <div class="col-3 col-md-2 text-center mb-3 item-icono" data-nombre="${icono.nombre}" data-codigo="${icono.codigo_fa}" style="cursor: pointer;">
                        <div class="p-2 border rounded shadow-sm bg-white text-dark">
                            <i class="${icono.codigo_fa} fa-2x"></i>
                            <p class="mt-2 mb-0 small text-truncate" title="${icono.nombre}">${icono.nombre}</p>
                        </div>
                    </div>`;
                });
                $("#contenedorIconos").html(html);
                iconosCargados = true;
            }
        });
    }
});

// Filtro de iconos en tiempo real
$("#buscadorIconos").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#contenedorIconos .item-icono").filter(function() {
        $(this).toggle($(this).attr('data-nombre').toLowerCase().indexOf(value) > -1);
    });
});

// Al seleccionar un icono
$(document).on("click", ".item-icono", function(){
    let codigo = $(this).attr("data-codigo");
    let nombre = $(this).attr("data-nombre");

    $("#" + targetHidden).val(codigo);
    $("#" + targetName).val(nombre);
    $("#" + targetPreview).html(`<i class="${codigo}"></i>`);

    $("#modalIconos").modal("hide");
});

/*=============================================
INSCRIBIRSE A APOYO
=============================================*/
$(document).on("click", ".btnAceptarApoyo", function(){
    let idApoyo = $(this).attr("idApoyo");
    let nombreApoyo = $(this).attr("nombreApoyo");

    Swal.fire({
        title: '¿Deseas inscribirte al apoyo?',
        text: `Te vas a inscribir al apoyo de: ${nombreApoyo}`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, inscribirme!'
    }).then(function(result){
        if(result.value){
            Swal.fire({
                icon: 'success',
                title: '¡Inscripción Exitosa!',
                text: `Te has inscrito correctamente al apoyo de ${nombreApoyo}. La funcionalidad de inscripción completa se encuentra en desarrollo.`,
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#28a745'
            });
        }
    });
});
