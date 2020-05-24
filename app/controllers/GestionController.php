<?php
use Phalcon\Http\Response;

/**
 * 
 */
class GestionController extends ControllerBase
{
	public function initialize(){
		$this->tag->setTitle('Registro Votantes');
		$this->view->setTemplateAfter('main');
        parent::initialize();
	}

	public function indexAction(){
		if(!$this->session->get('userdata')){
            $response = new Response();
            $response->redirect("index/index");
            $response->send();
        }
	}

	public function logoutAction(){
		$response = new Response();
		$response->redirect('index/end');
		$response->send();
	}

	public function cambioRegistroAction(){
		if ($this->request->isPost()) {
			//echo "var_dump()  ".var_dump($this->request->getPost());
			$id_person = $this->request->getPost('Matricula');
			$dentro = $this->request->getPost('Id_Dentro');

			$modelH = new Historial();
			$modelP = new Persona();

				$fecha = $modelH->getFechaNow();

				//$accion = ($dentro == '0')?'E':'S';
				$post = [
					'Id_Registrado' => $id_person,
					'Fecha_Hora' => $fecha,
				];

				$modelH->save(
                            $post,
                            [	"Id_Historial",
                                "Id_Registrado",
								"Fecha_Hora"
                            ]
                        );
				if($dentro == '0')
				  	$modelP->updateDentro('1',$id_person);
                

                ($dentro == '0')? $this->view->Reg_Result = "(REGISTRO CORRECTO)":$this->view->Reg_Result = "(RE-REGISTRO HECHO)";
                return 	$this->dispatcher->forward([
			    				'controller'=> 'gestion',
			    				'action'	=> 'index'
			    			]);	
		}
		else{
			$response = new Response();
            $response->redirect("index/index");
            $response->send();
		}
	}

	public function ajaxVotanteAction(){
		$this->view->disable();

		if ($this->request->isGet()) {
			if(($this->request->getQuery('id_person'))>0){
				
				$modelAux = new Persona();
				$data = $modelAux->getPersonInfoById($this->request->getQuery('id_person'));
				
				if($data != false){
					//Informacion comun
					$dataAux["Id_Persona"] = $data[0]['Id_Persona'];
					$dataAux["Nombre"] = $data[0]['Nombre'];
					$dataAux["Ap_Paterno"] = $data[0]['Ap_Paterno'];
					$dataAux["Ap_Materno"] = $data[0]['Ap_Materno'];
					$dataAux["Dentro"] = $data[0]['Dentro'];

					echo json_encode($dataAux);
				}
				else{
					echo json_encode("Error Votante no Existe");
				}
			}
			else{
				echo json_encode("Error al introducir matricula");
			}
		}
		else{
			echo json_encode("Error No es GET");
		}
	}


	//FUNCION PARA PROBAR LOS QUERYS EN CASO DE USAR AJAX (ya que con ajax no te deja ver directamente el error, si es que existe!)
	public function dataBasePruebaAction($id_persona){

		$modelAux = new Persona();
		//$data = Persona::findFirst(["Id_Persona = $id_persona"]);
		$data = $modelAux->getPersonInfoById($id_persona);

		if($data != false){
			echo "Encontro info: ";
		}
		else{
			echo "No encontro algo";
		}
	}
}