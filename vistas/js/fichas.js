$('#nuevoCodigoFicha').change(function() {

    let nuevoCodigoFicha = $(this).val();
    let datos = new FormData();
    datos.append("nuevoCodigoFicha", nuevoCodigoFicha);

    $.ajax({
        url: "ajax/fichas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta) {
                $("#nuevoCodigoFicha").val("");
                Swal.fire({
                    icon: 'error',
                    title: '¡La ficha ya existe!',
                    text: 'Por favor, ingrese un código diferente.',
                });
            }
        },
    });

});