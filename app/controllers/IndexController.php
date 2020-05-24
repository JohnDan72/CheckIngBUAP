<?php
use Phalcon\Http\Response;

class IndexController extends ControllerBase
{

	public function initialize(){
		$this->tag->setTitle('Inicio Sesión');
		
        parent::initialize();
	}

    public function indexAction(){
    	if($this->session->get('userdata')){
            $response = new Response();
            $response->redirect("gestion/index");
            $response->send();
        }
    }

    public function dataRegistry($user_data){

    	$this->session->set('userdata', $user_data);

    }

    public function loginAction(){
    	if($this->session->get('userdata')){
            $response = new Response();
            $response->redirect("gestion/index");
            $response->send();
        }
    	else{
    		if ($this->request->isPost()) {

    			$accesoModel = new Acceso();
	    		$id_user = $this->request->getPost('Identificador');
	    		$passw = $this->request->getPost('Password');
	    		$user = $accesoModel->getUserLogin($id_user,$passw,$this->Clave_Encriptacion['key']);
	    		

	    		if($user){
	    			$this->dataRegistry($user);

	    			$response = new Response();
	    			$response->redirect('gestion/index');
	    			$response->send();
	    		}
	    		else{
	    			$this->view->session_error = "Identificador o contraseña incorrecto(s)";
	    			
	    			return 	$this->dispatcher->forward([
			    				'controller'=> 'index',
			    				'action'	=> 'index'
			    			]);
	    		}
	    	}
	    	else{

	    	}
    	}
    }

    public function endAction(){
    	$this->session->remove('userdata');
        //$this->flash->success('Goodbye!');

        return $this->dispatcher->forward(
            [
                "controller" => "index",
                "action"     => "index",
            ]
        );
    }

}

