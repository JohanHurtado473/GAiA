$('#nuevoDocumento').change(function() {

    let nuevoDocumento = $(this).val();
    console.log("este es el documento a ingresar: " +nuevoDocumento);
    let datos = new FormData();
    datos.append("nuevoDocumento", nuevoDocumento);
    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log(respuesta);
            if (respuesta) {
                $("#nuevoDocumento").val("");
                Swal.fire({
                    icon: 'error',
                    title: '¡El documento ya existe!',
                    text: 'Por favor, ingrese un documento diferente.',
                });
            }
        },
    }); //ajax



}); //fin de nuevoDocumento.change

$(document).on("click", ".btnActivarUsuario", function(){
    let boton = $(this);
    let estadoActual = boton.attr("data-estadoUsuario");
    let idUsuario = boton.attr("data-idUsuario");
    // console.log("estadoUsuario", estadoActual);
    // console.log("idUsuario", idUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: {
            idUsuarioEstado: idUsuario,
            estado: estadoActual
        },
        success: function (respuesta) {
            // console.log(respuesta);

            if (respuesta.trim()==="ok"){
                if (estadoActual === "activo") {
                    boton.removeClass("btn-danger");
                    boton.addClass("btn-success");
                    boton.html("activo");
                    boton.attr("data-estadoUsuario","inactivo");
                } else {
                    boton.removeClass("btn-success");
                    boton.addClass("btn-danger");
                    boton.html("inactivo");
                    boton.attr("data-estadoUsuario","activo");
                }
            }
        }
    });

});

// Mostrar ocultar ficha según rol
$('#nuevoRol').change(function() {
    let rol = $(this).val();
    if (rol === "Aprendiz") {
        $('#divFicha').show();
        $('#inputFicha').attr('required', true);
    } else {
        $('#divFicha').hide();
        $('#inputFicha').val('');
        $('#nuevaFicha').val('');
        $('#inputFicha').removeAttr('required');
        $('#divDescripcionFicha').hide();
        $('#descripcionFicha').val('');
    }
});

// Autocompletar descripcion ficha
$('#inputFicha').on('input', function() {
    let val = $(this).val();
    let option = $('#listaFichas option').filter(function() {
        return this.value === val;
    });

    if (option.length) {
        let idFicha = option.attr('data-id');
        let programa = option.attr('data-programa');
        $('#nuevaFicha').val(idFicha);
        $('#descripcionFicha').val(programa);
        $('#divDescripcionFicha').show();
    } else {
        $('#nuevaFicha').val('');
        $('#descripcionFicha').val('');
        $('#divDescripcionFicha').hide();
    }
});

//===========================================
// EDITAR USUARIO
//===========================================
$(document).on("click", ".btnEditarUsuario", function() {
    let idUsuario = $(this).attr("data-idUsuario");
    let datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#idUsuarioEditar").val(respuesta["id"]);
            $("#editarTipoDocumento").val(respuesta["tipo_documento"]);
            $("#editarDocumento").val(respuesta["documento_id"]);
            $("#editarNombre").val(respuesta["nombres"]);
            $("#editarApellido").val(respuesta["apellidos"]);
            $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
            $("#editarCorreo").val(respuesta["correo"]);
            
            // Seleccionar el rol (ignorando mayúsculas/minúsculas)
            let rolDB = respuesta["rol"].toUpperCase();
            $("#editarRol option").each(function() {
                if($(this).val().toUpperCase() === rolDB) {
                    $(this).prop("selected", true);
                }
            });

            $("#passwordActual").val(respuesta["password"]);
            $("#fotoActualEditar").val(respuesta["foto"]);

            if(respuesta["foto"] != "" && respuesta["foto"] != null){
                $(".previsualizarEditar").attr("src", respuesta["foto"]);
            } else {
                $(".previsualizarEditar").attr("src", "documentos/anonimo/anonimo.png");
            }

            // Mostrar opcion de eliminar foto si no es la por defecto
            if(respuesta["foto"] != "" && respuesta["foto"] != "documentos/anonimo/anonimo.png" && respuesta["foto"] != null){
                $("#divEliminarFoto").show();
                $("#eliminarFotoUsuario").prop("checked", false);
            } else {
                $("#divEliminarFoto").hide();
                $("#eliminarFotoUsuario").prop("checked", false);
            }

            // Lógica para Aprendiz
            if(respuesta["rol"] === "Aprendiz" || respuesta["rol"] === "APRENDIZ"){
                $("#divEditarFicha").show();
                $("#inputEditarFicha").attr('required', true);
                
                // Si trae ficha guardada, pre-cargar el input
                if(respuesta["ficha_id"]){
                    let fichaOption = $('#listaFichas option[data-id="'+respuesta["ficha_id"]+'"]');
                    if(fichaOption.length > 0){
                        $("#inputEditarFicha").val(fichaOption.attr('value'));
                        $("#editarFicha").val(respuesta["ficha_id"]);
                        $("#descripcionEditarFicha").val(fichaOption.attr('data-programa'));
                        $("#divDescripcionEditarFicha").show();
                    }
                }
            }else{
                $("#divEditarFicha").hide();
                $("#inputEditarFicha").removeAttr('required');
                $("#inputEditarFicha").val('');
                $("#editarFicha").val('');
                $("#divDescripcionEditarFicha").hide();
                $("#descripcionEditarFicha").val('');
            }
        }
    });
});

// Mostrar ocultar ficha según rol en EDICIÓN
$('#editarRol').change(function() {
    let rol = $(this).val();
    if (rol === "Aprendiz" || rol === "APRENDIZ") {
        $('#divEditarFicha').show();
        $('#inputEditarFicha').attr('required', true);
    } else {
        $('#divEditarFicha').hide();
        $('#inputEditarFicha').val('');
        $('#editarFicha').val('');
        $('#inputEditarFicha').removeAttr('required');
        $('#divDescripcionEditarFicha').hide();
        $('#descripcionEditarFicha').val('');
    }
});

// Autocompletar descripcion ficha en EDICIÓN
$('#inputEditarFicha').on('input', function() {
    let val = $(this).val();
    let option = $('#listaFichas option').filter(function() {
        return this.value === val;
    });

    if (option.length) {
        let idFicha = option.attr('data-id');
        let programa = option.attr('data-programa');
        $('#editarFicha').val(idFicha);
        $('#descripcionEditarFicha').val(programa);
        $('#divDescripcionEditarFicha').show();
    } else {
        $('#editarFicha').val('');
        $('#descripcionEditarFicha').val('');
        $('#divDescripcionEditarFicha').hide();
    }
});

//===========================================
// CONSULTAR USUARIO
//===========================================
$(document).on("click", ".btnConsultarUsuario", function() {
    let idUsuario = $(this).attr("data-idUsuario");
    let datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#consultarTipoDocumento").val(respuesta["tipo_documento"]);
            $("#consultarDocumento").val(respuesta["documento_id"]);
            $("#consultarNombre").val(respuesta["nombres"]);
            $("#consultarApellido").val(respuesta["apellidos"]);
            $("#consultarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
            $("#consultarCorreo").val(respuesta["correo"]);
            $("#consultarRol").val(respuesta["rol"]);

            // Lógica para Aprendiz (Ficha)
            if(respuesta["rol"] === "Aprendiz" || respuesta["rol"] === "APRENDIZ"){
                $("#divConsultarFicha").show();
                
                // Buscar ficha en el datalist para mostrar el programa
                if(respuesta["ficha_id"]){
                    let fichaOption = $('#listaFichas option[data-id="'+respuesta["ficha_id"]+'"]');
                    if(fichaOption.length > 0){
                        $("#inputConsultarFicha").val(fichaOption.attr('value')); // código
                        $("#descripcionConsultarFicha").val(fichaOption.attr('data-programa'));
                        $("#divDescripcionConsultarFicha").show();
                    } else {
                        $("#inputConsultarFicha").val(respuesta["ficha_id"]);
                        $("#divDescripcionConsultarFicha").hide();
                    }
                } else {
                    $("#inputConsultarFicha").val("Sin ficha asignada");
                    $("#divDescripcionConsultarFicha").hide();
                }
            } else {
                $("#divConsultarFicha").hide();
                $("#divDescripcionConsultarFicha").hide();
                $("#inputConsultarFicha").val('');
                $("#descripcionConsultarFicha").val('');
            }
        }
    });
});

/*=============================================
SUBIENDO LA FOTO DEL USUARIO (PREVISUALIZACIÓN Y VALIDACIÓN)
=============================================*/
$(document).on("change", ".nuevaFoto", function() {
    let imagen = this.files[0];
    if (!imagen) {
        $(this).next('.custom-file-label').html('Seleccionar imagen');
        return;
    }

    // Actualizar el label del custom-file-input
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').html(fileName);

    /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/
    if (imagen["type"] !== "image/jpeg" && imagen["type"] !== "image/png") {
        $(this).val("");
        Swal.fire({
            icon: 'error',
            title: '¡Error al subir la imagen!',
            text: 'La imagen debe estar en formato JPG o PNG',
            confirmButtonText: 'Cerrar'
        });
    } else if (imagen["size"] > 4194304) { // 4MB MAX
        $(this).val("");
        Swal.fire({
            icon: 'error',
            title: '¡Error al subir la imagen!',
            text: 'La imagen no debe pesar más de 4MB',
            confirmButtonText: 'Cerrar'
        });
    } else {
        let datosImagen = new FileReader();
        datosImagen.readAsDataURL(imagen);

        let inputElement = $(this);
        $(datosImagen).on("load", function(event) {
            let rutaImagen = event.target.result;
            // Busca la imagen previsualizar correspondiente dentro del mismo form-group
            inputElement.closest(".form-group").find(".previsualizar").attr("src", rutaImagen);
            inputElement.closest(".form-group").find(".previsualizarEditar").attr("src", rutaImagen);
        });
    }
});