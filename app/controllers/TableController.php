<?php
use Phalcon\Http\Response;
class TableController extends ControllerBase{

	public function initialize(){
		$this->tag->setTitle("Historial Reg");
		$this->view->setTemplateAfter('main');
		parent::initialize();
	}

	public function indexAction(){
		if(!$this->session->get('userdata')){
            $response = new Response();
            $response->redirect("index/index");
            $response->send();
        }
		$modelH = new Historial();

		$historial1 = $modelH->getHistorialforTable();
		$historial2 = $modelH->getPorNombre();
		$historial3 = $modelH->getUniqs();
		$historial4 = $modelH->getNoVotantes();
		$historial5 = $modelH->getContador();

		if($historial1 && $historial2 && $historial3 && $historial4 && $historial5){
			$this->view->Registro1 = $historial1;
			$this->view->Registro2 = $historial2;
			$this->view->Registro3 = $historial3;
			$this->view->Registro4 = $historial4;
			$this->view->Registro5 = $historial5;
		}
	}
}