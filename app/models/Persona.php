 <?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\Digit as DigitValidator;
use Phalcon\Mvc\Model\Query;

//NOTA IMPORTANTE: Colocar en cada query los valores de retorno (* no se acepta en Phalcon)
//NOTA IMPORTANTE: Al recuperar la informacion de los campos de la consulta, se debe referenciar con la misma 
//				   etiqueta puesta dentro del SELECT
class Persona extends Model
{
    
	public $Id_Persona;
	public $Nombre;
	public $Ap_Paterno;
	public $Ap_Materno;
	public $Dentro;

    public function getFirstPersona(){
    		$query = $this->modelsManager->createQuery("
				SELECT Persona.nombre,Persona.ap_paterno 
				FROM Persona
			");

			return $query->execute()[0];
	    	//SELECT grupo.*, AES_DECRYPT(Clave_Grupo, 'ardogs123') as Contraseña_Grupo FROM grupo;
    }

    public function getPersonInfoById($id_person){
    	$dataPerson = $this->modelsManager->createQuery("
				SELECT Persona.Id_Persona, Persona.Nombre ,Persona.Ap_Paterno, Persona.Ap_Materno, Persona.Dentro
				FROM Persona
				WHERE Id_Persona = $id_person
    		")->execute();

    	if (!isset($dataPerson[0])) 
    	{
    		return false;
    	}
    	else
    	{
    		return $dataPerson;
    	}
    }

    public function updateDentro($dentro,$id_person){
    	$query = $this->modelsManager->createQuery("
				UPDATE Persona
				SET Persona.Dentro = :dent:
				WHERE Persona.Id_Persona = :id:
			");

			return $query->execute(
				[
					'dent' => $dentro,
					'id' => $id_person
				]
			);
    }



    

    
}