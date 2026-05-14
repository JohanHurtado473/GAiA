<?php

class ControladorFichas{

	/*=============================================
	LISTAR FICHAS
	=============================================*/
	static public function ctrListarFichas(){
		$respuesta = ModeloFichas::mdlListarFichas();
		return $respuesta;
	}

	/*=============================================
	MOSTRAR FICHA
	=============================================*/
	static public function ctrMostrarFichas($item, $valor){
		$tabla = "fichas";
		$respuesta = ModeloFichas::mdlMostrarFichas($tabla, $item, $valor);
		return $respuesta;
	}

	/*=============================================
	AGREGAR FICHA
	=============================================*/
	public function ctrAgregarFicha(){

		if(isset($_POST["nuevoCodigoFicha"])){

			if(preg_match('/^[a-zA-Z0-9\- ]+$/', $_POST["nuevoCodigoFicha"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevaSedeFicha"])){

				$tabla = "fichas";

				$datos = array(
					"codigo" => $_POST["nuevoCodigoFicha"],
					"sedeId" => $_POST["nuevaSedeFicha"]
				);

				$respuesta = ModeloFichas::mdlAgregarFicha($tabla, $datos);

				if($respuesta == "ok"){

					echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'La ficha ha sido guardada correctamente',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = 'fichas';
                            }
                        });
                    </script>";

				} else {
					echo "<br><div class='alert alert-danger'>Error al agregar la ficha</div>";
				}

			}else{

				echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: '¡El código de la ficha no puede ir vacío o llevar caracteres especiales!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = 'fichas';
                            }
                        });
                    </script>";

			}

		}

	}

}