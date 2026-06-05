$(document).ready(function() {
    
    // =============================================================================
    // 0. INICIALIZAR DATATABLE PRINCIPAL
    // =============================================================================
    if ($('#tblConvocatorias').length > 0) {
        $('#tblConvocatorias').DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                }
            }
        });
    }

    // =============================================================================
    // LÓGICA DEL MODAL "AGREGAR/EDITAR CONVOCATORIA" Y FORMULARIO BAREMO
    // =============================================================================
    
    let baremoCounter = 0;

    // 1. Selector de Apoyo y Badge Dualidad
    $('#apoyo_id').on('change', function() {
        let option = $(this).find('option:selected');
        let duality = option.data('duality');
        let badge = $('#badge_duality');

        badge.removeClass('d-none badge-success badge-warning');
        
        if (duality === true) {
            badge.addClass('badge-success').html('<i class="fas fa-check-double mr-1"></i> Permite Dualidad');
        } else if (duality === false) {
            badge.addClass('badge-warning').html('<i class="fas fa-ban mr-1"></i> Sin Dualidad');
        } else {
            badge.addClass('d-none');
        }
    });

    // 2. Baremo Dinámico
    function checkEmptyState() {
        if ($('#baremoContainer').children().length === 0) {
            $('#baremoEmptyState').removeClass('d-none');
        } else {
            $('#baremoEmptyState').addClass('d-none');
        }
    }

    // Función principal para agregar fila al DOM
    function addBaremoRow(nombre = "", puntaje = "10.00", critico = 0) {
        baremoCounter++;
        let templateContent = $('#baremoRowTemplate').html();
        let newRow = $(templateContent);

        // Arreglar IDs de switch para que funcionen los eventos del label nativos de Bootstrap
        let switchId = 'switch_' + baremoCounter;
        let checkbox = newRow.find('.custom-control-input');
        
        checkbox.attr('id', switchId);
        newRow.find('.custom-control-label').attr('for', switchId);

        // Evento de toggle crítico
        newRow.find('.toggle-critico').on('change', function() {
            let hiddenInput = $(this).siblings('.hidden-critico-input');
            if ($(this).is(':checked')) {
                hiddenInput.val('1');
            } else {
                hiddenInput.val('0');
            }
        });

        // Evento eliminar fila
        newRow.find('.btn-eliminar-fila').on('click', function() {
            $(this).closest('.baremo-row').fadeOut(250, function() {
                $(this).remove();
                checkEmptyState();
            });
        });

        // Pre-llenar datos (si viene de Editar AJAX)
        if(nombre !== "") {
            newRow.find('.nombre-item-input').val(nombre);
            newRow.find('.puntaje-valor-input').val(puntaje);
            
            if(critico == 1 || critico == "1") {
                checkbox.prop("checked", true);
                newRow.find('.hidden-critico-input').val('1');
            }
        }

        // Insertar en DOM con animacion
        newRow.hide();
        $('#baremoContainer').append(newRow);
        newRow.fadeIn(250);
        checkEmptyState();
    }

    $('#btnAgregarCriterio').on('click', function() {
        addBaremoRow();
    });


    // =============================================================================
    // BOTÓN NUEVA CONVOCATORIA (Resetear Formulario)
    // =============================================================================
    $('.btnNuevaConvocatoria').on('click', function() {
        // Limpiamos todo rastro de ediciones previas
        $('#id_convocatoria_editar').val('');
        $('#estado_en_convocatoria').val('');
        $('#formConvocatoria')[0].reset();
        $('#baremoContainer').empty();
        
        $('#tituloModalConvocatoria').html('<i class="fas fa-clipboard-list mr-2"></i> Apertura de Convocatoria');
        $('#badge_duality').addClass('d-none');
        
        // Agregar un requisito vacío por defecto al limpiar (luego de un pequeño retraso para que limpie bien)
        setTimeout(() => {
            if ($('#baremoContainer').children().length === 0) {
                $('#btnAgregarCriterio').click();
            }
        }, 100);
    });

    // =============================================================================
    // BOTÓN EDITAR CONVOCATORIA (Petición AJAX)
    // =============================================================================
    $('#tblConvocatorias tbody').on('click', 'button.btnEditarConvocatoria', function() {
        let idConvocatoria = $(this).attr("idConvocatoria");
        
        // Limpiamos el form primero
        $('#formConvocatoria')[0].reset();
        $('#baremoContainer').empty();
        $('#tituloModalConvocatoria').html('<i class="fas fa-edit mr-2"></i> Editar Convocatoria');
        
        let datos = new FormData();
        datos.append("idConvocatoria", idConvocatoria);

        $.ajax({
            url: "ajax/convocatorias.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
                
                // Rellenar cabecera
                $('#id_convocatoria_editar').val(respuesta.convocatoria.id);
                $('#apoyo_id').val(respuesta.convocatoria.apoyo_id).trigger('change');
                $('#fecha_inicio').val(respuesta.convocatoria.fecha_inicio);
                $('#fecha_fin').val(respuesta.convocatoria.fecha_fin);
                $('#cupos_personas').val(respuesta.convocatoria.cupos_personas);
                $('#duracion_meses').val(respuesta.convocatoria.duracion_meses);
                $('#estado_en_convocatoria').val(respuesta.convocatoria.estado_en_convocatoria);
                
                // Rellenar filas de baremo_config dinámicamente
                if(respuesta.baremo && respuesta.baremo.length > 0) {
                    respuesta.baremo.forEach(function(item) {
                        addBaremoRow(item.nombre_item, item.puntaje_valor, item.es_critico);
                    });
                } else {
                    checkEmptyState();
                }
            },
            error: function(err) {
                console.error("Error trayendo datos AJAX", err);
            }
        });
    });

    // =============================================================================
    // CONTROL DE ESTADOS Y SUBMIT (Guardar Borrador y Publicar)
    // =============================================================================
    $('#btnBorrador').on('click', function() {
        let form = $('#formConvocatoria')[0];
        if (form.checkValidity()) {
            $('#estado_en_convocatoria').val('GUARDADA');
            form.submit(); // Llama al Controlador PHP
        } else {
            form.reportValidity();
        }
    });

    $('#btnPublicar').on('click', function() {
        if ($('#baremoContainer').children().length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes agregar al menos un documento o criterio en el baremo para poder publicar.'
            });
            return;
        }

        let form = $('#formConvocatoria')[0];
        if (form.checkValidity()) {
            Swal.fire({
                title: '¿Publicar Convocatoria?',
                text: "Una vez ABIERTA, los aprendices podrán visualizarla e iniciar sus inscripciones.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, publicar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#estado_en_convocatoria').val('ABIERTA');
                    form.submit(); // Llama al Controlador PHP
                }
            });
        } else {
            form.reportValidity();
        }
    });

});
