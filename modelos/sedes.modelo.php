<?php

require_once "conexion.php";

class ModeloSedes{

	/*=============================================
	MOSTRAR SEDES
	=============================================*/
	static public function mdlMostrarSedes($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	INGRESAR SEDE
	=============================================*/
	static public function mdlIngresarSede($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion_sede, direccion_sede) VALUES (:descripcion_sede, :direccion_sede)");

		$stmt->bindParam(":descripcion_sede", $datos["descripcion_sede"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion_sede", $datos["direccion_sede"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

	}

}