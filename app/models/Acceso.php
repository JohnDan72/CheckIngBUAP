 <?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\Digit as DigitValidator;
use Phalcon\Mvc\Model\Query;


class Acceso extends Model
{
    public $Id_Acceso;
    public $Clave;

   

    public function getUserLogin($id_user = null, $passw = null,$encryptionkey = null){
    	if (($id_user != null) && ($passw != null) && ($encryptionkey != null)){
    		$query = $this->modelsManager->createQuery("
				SELECT AES_DECRYPT(Acceso.Clave, '$encryptionkey') as PasswA 
				FROM Acceso
				WHERE Acceso.Id_Acceso = $id_user
			");

			$claveAux = $query->execute();
			
			if(!isset($claveAux[0])){
				//Usuario no existe
				return false;
			}
			
			if ($claveAux[0]['PasswA'] == $passw) {
				$query = $this->modelsManager->createQuery("
					SELECT Acceso.Id_Acceso,AES_DECRYPT(Acceso.Clave, '$encryptionkey') as Clave
					FROM 	Acceso
					WHERE  	Acceso.id_acceso 	= $id_user
				");

				return $query->execute()[0];
			}
    	}
		
		return false;
    }


    
}
