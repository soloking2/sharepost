<?php

/**
 * BAse Controller
 Loads the models and views
 */
class Controller
{
	//Load Model
	public function model($model){
		//Require model file
		require_once '../app/models/'. $model .'.php';
		//instantiates the model
		return new $model();
	}

	//Load View

	public function view($view, $data = []){
		//check for the view file
		if(file_exists('../app/views/' . $view . '.php')){
			require_once '../app/views/' . $view . '.php';
		} else {
			//Output an error
			die('View does not exist');
		}
	}
}


?>