<?php

class Controller_Main extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->model = new Model_Main();
	}

	function action_index()
	{
		if($this->model->load($_GET)){
			if($this->model->validate()){
				$this->model->getData();
			}
		}
		$this->view->generate('main_view.php', 'template_view.php', ['model' => $this->model]);
	}

	function action_ajax(){
		if($this->model->load($_POST)){
			if($this->model->validate()){
				$this->model->getData();
			}
		}
		$this->view->generate('apartments_view.php', null, ['model' => $this->model]);
	}
}