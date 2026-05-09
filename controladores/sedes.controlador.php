<?php

class ControladorSedes{

	/*=============================================
	LISTAR SEDES
	=============================================*/
	static public function ctrListarSedes(){
		$respuesta = ModeloSedes::mdlListarSedes();
		return $respuesta;
	}

	/*=============================================
	MOSTRAR SEDE
	=============================================*/
	static public function ctrMostrarSedes($item, $valor){
		$tabla = "sedes";
		$respuesta = ModeloSedes::mdlMostrarSedes($tabla, $item, $valor);
		return $respuesta;
	}

	/*=============================================
	AGREGAR SEDE
	=============================================*/
	public function ctrAgregarSede(){

		if(isset($_POST["nuevaDescripcionSede"]) && isset($_POST["nuevaDireccionSede"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcionSede"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \-\#\.]+$/', $_POST["nuevaDireccionSede"])){

				$tabla = "sedes";

				$datos = array(
					"descripcionSede" => $_POST["nuevaDescripcionSede"],
					"direccionSede" => $_POST["nuevaDireccionSede"]
				);

				$respuesta = ModeloSedes::mdlAgregarSede($tabla, $datos);

				if($respuesta == "ok"){

					echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'La sede ha sido guardada correctamente',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = 'sedes';
                            }
                        });
                    </script>";

				} else {
					echo "<br><div class='alert alert-danger'>Error al agregar la sede</div>";
				}

			}else{

				echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: '¡La sede no puede ir vacía o llevar caracteres especiales!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = 'sedes';
                            }
                        });
                    </script>";

			}

		}

	}

}
