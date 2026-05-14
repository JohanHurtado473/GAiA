$('#nuevaDescripcionSede').change(function() {

    let nuevaDescripcionSede = $(this).val();
    let datos = new FormData();
    datos.append("nuevaDescripcionSede", nuevaDescripcionSede);

    $.ajax({
        url: "ajax/sedes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta) {
                $("#nuevaDescripcionSede").val("");
                Swal.fire({
                    icon: 'error',
                    title: '¡La sede ya existe!',
                    text: 'Por favor, ingrese una sede diferente.',
                });
            }
        },
    });

});