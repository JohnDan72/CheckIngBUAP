<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\Digit as DigitValidator;
use Phalcon\Mvc\Model\Query;


class Historial extends Model
{
    
	public $Id_Historial;
	public $Id_Registrado;
	public $Fecha_Hora;

	public function getFechaNow(){
		$query = $this->modelsManager->createQuery("SELECT now() as fecha from Persona LIMIT 1");
		//$result = $query->execute()[0]['fecha'];
		return $query->execute()[0]['fecha'];
	}
	
	/*SELECT para obtener todos los registros*/
	public function getHistorialforTable(){
		$query = $this->modelsManager->createQuery("
				SELECT persona.Id_Persona, persona.Nombre, persona.Ap_Paterno, persona.Ap_Materno, historial.Fecha_Hora
				FROM persona, historial
				WHERE 	persona.Id_Persona = historial.Id_Registrado
				ORDER BY historial.Fecha_Hora
			");

		$result = $query->execute();
		return (isset($result[0]))? $result:false;
	}
	/*Select en orden alfabético por nombre*/
	public function getPorNombre(){
		$query = $this->modelsManager->createQuery("
				SELECT persona.Id_Persona, persona.Nombre, persona.Ap_Paterno, persona.Ap_Materno, historial.Fecha_Hora
				FROM persona, historial
				WHERE 	persona.Id_Persona = historial.Id_Registrado
				ORDER BY persona.Nombre,persona.Ap_Paterno,persona.Ap_Materno,historial.Fecha_Hora
			");
		$result = $query->execute();
		return (isset($result[0]))? $result:false;
	}
	/*SELECT para obtener unicos*/
	public function getUniqs(){
		$query = $this->modelsManager->createQuery("
				SELECT persona.Id_Persona, CONCAT(persona.Nombre,' ',persona.Ap_Paterno,' ',persona.Ap_Materno) as Nombre_Com, historial.Fecha_Hora
				FROM persona, historial
		        WHERE 	persona.Id_Persona = historial.Id_Registrado
		        GROUP BY persona.Id_Persona
			");
		$result = $query->execute();
		return (isset($result[0]))? $result:false;
	}
	/*Select de Sin Votar usando php puro*/
	public function getNoVotantes(){
		$conexion = mysqli_connect("localhost","root","");
		mysqli_select_db( $conexion, "ingenieriavotos" ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
		mysqli_set_charset($conexion, "utf8");	//Establecer recuperacion de info en utf8 para acentos y tildes
		$sql = "
			SELECT persona.Id_Persona, persona.Nombre, persona.Ap_Paterno, persona.Ap_Materno
			FROM persona
			WHERE persona.Id_Persona NOT IN (SELECT DISTINCT Id_Registrado FROM historial)
			ORDER BY persona.Nombre,persona.Ap_Paterno,persona.Ap_Materno
			";
		$result = mysqli_query($conexion,$sql);
		$data = $result->fetch_all(MYSQLI_ASSOC);
		mysqli_close($conexion);
		return $data;	
	}
	/*SELECT para contar cuantas veces se han registrado los usuarios mostrado en orden descendente sobre el conteo*/
	public function getContador(){
		$query = $this->modelsManager->createQuery("
				SELECT COUNT(persona.Id_Persona) as Num_Reg,persona.Id_Persona, persona.Nombre, persona.Ap_Paterno, persona.Ap_Materno
				FROM persona, historial
				WHERE 	persona.Id_Persona = historial.Id_Registrado
                GROUP BY persona.Id_Persona
                ORDER BY COUNT(persona.Id_Persona) DESC, persona.Nombre,persona.Ap_Paterno,persona.Ap_Materno
			");
		$result = $query->execute();
		return (isset($result[0]))? $result:false;
	}
}