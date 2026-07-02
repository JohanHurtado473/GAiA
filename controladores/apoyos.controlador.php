<?php

class ControladorApoyos
{
    // MOSTRAR APOYOS
    static public function ctrMostrarApoyos($item, $valor)
    {
        $tabla = "apoyos";
        $respuesta = ModeloApoyos::mdlMostrarApoyos($tabla, $item, $valor);
        return $respuesta;
    }

    // MOSTRAR APOYOS ACTIVOS (apoyos cuyo estado es "activo")
    static public function ctrMostrarApoyosActivos($item, $valor)
    {
        $tabla = "apoyos";
        $respuesta = ModeloApoyos::mdlMostrarApoyosActivos($tabla, $item, $valor);
        return $respuesta;
    }

    // ACTUALIZAR APOYO DUAL U OTROS CAMPOS INDIVIDUALES
    static public function ctrActualizarApoyo($item1, $valor1, $item2, $valor2)
    {
        $tabla = "apoyos";
        $respuesta = ModeloApoyos::mdlActualizarApoyo($tabla, $item1, $valor1, $item2, $valor2);
        return $respuesta;
    }

    // CREAR APOYO
    public function ctrCrearApoyo()
    {
        if (isset($_POST["nuevaDescripcionApoyo"])) {
            // Validar campos según requisitos de seguridad
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcionApoyo"]) &&
                preg_match('/^[-a-zA-Z0-9 ]+$/', $_POST["nuevoApoyoIcono"])) {

                $tabla = "apoyos";
                
                // Manejo de booleano para apoyo dual
                $apoyo_dual = isset($_POST["nuevoApoyoDual"]) ? $_POST["nuevoApoyoDual"] : 0;

                // Manejo de booleano para estado del apoyo
                $estado_apoyo = isset($_POST["nuevoEstadoApoyo"]) ? $_POST["nuevoEstadoApoyo"] : 1;

                $datos = array(
                    "descripcion_apoyo" => $_POST["nuevaDescripcionApoyo"],
                    "apoyo_dual" => $apoyo_dual,
                    "estado_apoyo" => $estado_apoyo,
                    "informacion_apoyo" => $_POST["nuevaInformacionApoyo"], // Textarea no se restringe con regex estricto por la puntuación, confiamos en PDO para inyección
                    "apoyo_icono" => $_POST["nuevoApoyoIcono"]
                );

                $respuesta = ModeloApoyos::mdlCrearApoyo($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El apoyo ha sido guardado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "apoyos";
                        }
                    });
                    </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error al guardar el apoyo!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡La descripción o el icono no pueden ir vacíos o llevar caracteres no permitidos!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    });
                </script>';
            }
        }
    }

    // EDITAR APOYO
    public function ctrEditarApoyo()
    {
        if (isset($_POST["editarDescripcionApoyo"]) && isset($_POST["idApoyo"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionApoyo"]) &&
                preg_match('/^[-a-zA-Z0-9 ]+$/', $_POST["editarApoyoIcono"])) {

                $tabla = "apoyos";
                $apoyo_dual = isset($_POST["editarApoyoDual"]) ? $_POST["editarApoyoDual"] : 0;
                $estado_apoyo = isset($_POST["editarEstadoApoyo"]) ? $_POST["editarEstadoApoyo"] : 1;

                $datos = array(
                    "id_apoyo" => $_POST["idApoyo"],
                    "descripcion_apoyo" => $_POST["editarDescripcionApoyo"],
                    "apoyo_dual" => $apoyo_dual,
                    "estado_apoyo" => $estado_apoyo,
                    "informacion_apoyo" => $_POST["editarInformacionApoyo"],
                    "apoyo_icono" => $_POST["editarApoyoIcono"]
                );

                $respuesta = ModeloApoyos::mdlEditarApoyo($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El apoyo ha sido editado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "apoyos";
                        }
                    });
                    </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error al editar el apoyo!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡La descripción o el icono no pueden ir vacíos o llevar caracteres no permitidos!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    });
                </script>';
            }
        }
    }

    // BORRAR APOYO
    public function ctrBorrarApoyo()
    {
        if (isset($_GET["idApoyoEliminar"])) {
            $tabla = "apoyos";
            $datos = $_GET["idApoyoEliminar"];

            $respuesta = ModeloApoyos::mdlBorrarApoyo($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "El apoyo ha sido eliminado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
                        window.location = "apoyos";
                    }
                });
                </script>';
            }
        }
    }
}
