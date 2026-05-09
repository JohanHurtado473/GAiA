<?php

require_once "conexion.php";

class ModeloSedes{

	/*=============================================
	LISTAR SEDES
	=============================================*/
	static public function mdlListarSedes(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM sedes");
		$stmt -> execute();
		return $stmt -> fetchAll();
	}

	/*=============================================
	MOSTRAR SEDE
	=============================================*/
	static public function mdlMostrarSedes($tabla, $item, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
	}

	/*=============================================
	AGREGAR SEDE
	=============================================*/
	static public function mdlAgregarSede($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion_sede, direccion_sede) VALUES (:descripcionSede, :direccionSede)");
		$stmt->bindParam(":descripcionSede", $datos["descripcionSede"], PDO::PARAM_STR);
		$stmt->bindParam(":direccionSede", $datos["direccionSede"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}
	}

}