<?php
	class App{
		protected $controller = 'post'; //default controller
		protected $method = 'dashboard'; //default method
		protected $params = []; //params to pass

		public function __construct(){
			$url = $this->parseUrl(); //call parseUrl()
			if(file_exists('app/controllers/' . $url[0] . '.php')){ //check if file exist
				$this->controller = $url[0]; //replace $controller with proper controller
				unset($url[0]); //removes url[0] from the array
			}
			require_once 'app/controllers/' . $this->controller . '.php'; //go to specified controller
			$this->controller = new $this->controller; //create object of controller
			if(isset($url[1])){
				if(method_exists($this->controller, $url[1])){
					$this->method = $url[1];
					unset($url[1]);
				}
			}
			$this->params = $url ? array_values($url) : []; //check if url has content
			call_user_func_array([$this->controller, $this->method], $this->params);
		}

		public function parseUrl(){
			if(isset($_GET['url'])){
				return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
			}
		}
	}