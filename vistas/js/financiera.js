/*=============================================
EVENTOS DE LOS MODALES DE FINANCIERA
=============================================*/

// 1. Botón Guardar / Aceptar (genérico para varios modales)
$(document).on("click", ".btn-accion-guardar", function() {
    $("#modalNotificacionSuccess .modal-body p").html("<strong><i class='fas fa-check'></i> Informacion guardada correctamente</strong>");
    $("#modalNotificacionSuccess").modal("show");
});

// 2. Botón Enviar a Financiera (Validar/Rechazar)
$(document).on("click", ".btn-enviar-financiera", function() {
    $("#modalNotificacionSuccess .modal-body p").html("<strong><i class='fas fa-check'></i> Documento enviado</strong><br><br>Documentos:<br>• Formato_de_terceros_Pepito<br>• Valores a comprometer<br>Estado: Enviado<br><br>El documento fue enviado con exito al area financiera");
    $("#modalNotificacionSuccess").modal("show");
});

// 3. Botón Notificar Aprendiz (Info Bancaria)
$(document).on("click", ".btn-notificar", function() {
    $("#modalNotificacionSuccess .modal-body p").html("<strong><i class='fas fa-check'></i> Se notificó al aprendiz</strong>");
    $("#modalNotificacionSuccess").modal("show");
});

// 4. Botón Reporte por aprendiz (.xls)
$(document).on("click", ".btn-reporte-xls", function() {
    $('#modalDescargarReportes').modal('hide');
    $("#modalNotificacionSuccess .modal-body p").html("<strong><i class='fas fa-check'></i> reporte \"apoyo ___.xls\" descargado correctamente</strong>");
    $("#modalNotificacionSuccess").modal("show");
});

// 5. Botón Reporte en excel (.zip)
$(document).on("click", ".btn-reporte-zip", function() {
    $('#modalDescargarReportes').modal('hide');
    $("#modalNotificacionSuccess .modal-body p").html("<strong><i class='fas fa-check'></i> reporte \"aprendices ___.zip\" descargado correctamente</strong>");
    $("#modalNotificacionSuccess").modal("show");
});
