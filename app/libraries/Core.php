<?php
/**
 * Main App Core Class
 Creates URL and loads core controller
 URL FORMAT -/controller/method/paras
 */
class Core
{
	
	protected $currentController = 'pages';
	protected $currentMethod = 'index';
	protected $params = [];

	public function __construct(){
		//print_r($this->getUrl()) ;
		$url = $this->getUrl();

		if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
			//if file exists, set as controller
			$this->currentController = ucwords($url[0]);
			unset($url[0]);
		}
		//Requires the controller
		require_once '../app/controllers/'. $this->currentController . '.php';

		//Instantiate controller class
		$this->currentController = new $this->currentController;

		//Check for the second part of url
		if(isset($url[1])){
			//check if the method exist in the controller
			if(method_exists($this->currentController, $url[1])){
				$this->currentMethod = $url[1];
				unset($url[1]);
			}
		}

		//Get the params
		$this->params = $url ? array_values($url) : [];

		//call the callback function
		call_user_func_array([$this->currentController, $this->currentMethod], $this->params); 
	}

	public function getUrl(){
		if(isset($_GET['url'])){
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			return $url;
		}
	}
}

?>