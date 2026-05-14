<?php

class ControladorSedes{

	/*=============================================
	MOSTRAR SEDES
	=============================================*/
	static public function ctrMostrarSedes($item, $valor){

		$tabla = "sedes";
		$respuesta = ModeloSedes::mdlMostrarSedes($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	LISTAR SEDES
	=============================================*/
	static public function ctrListarSedes(){

		return self::ctrMostrarSedes(null, null);

	}

	/*=============================================
	CREAR SEDE
	=============================================*/
	public function ctrCrearSede(){

		if(isset($_POST["nuevaDescripcionSede"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcionSede"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \-\#\.]+$/', $_POST["nuevaDireccionSede"])){

				$tabla = "sedes";

				$datos = array("descripcion_sede" => $_POST["nuevaDescripcionSede"],
					           "direccion_sede" => $_POST["nuevaDireccionSede"]);

				$respuesta = ModeloSedes::mdlIngresarSede($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>
					swal.fire({
						  icon: "success",
						  title: "La sede ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "sedes";

									}
								})
					</script>';

				}

			}else{

				echo'<script>
					swal.fire({
						  icon: "error",
						  title: "¡La sede no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "sedes";

							}
						})
			  	</script>';

			}

		}

	}

}