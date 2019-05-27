<?php

	require_once ('app/views/layout/layout.php'); 
	
	class Controller{
		public function model($model){
			require_once 'app/models/' . $model . '.php';
			return new $model(); //return an object of model
		}

		public function view($view, $method, $data = []){ //view name and pass data to the view
			require_once 'app/views/' . $view  . "/" . $method . '.php'; 
		}


		public function redirect($controller, $method = "login", $args = array()){
			$location = '/' .  $controller . "/" . $method . "/" . implode("/", $args);
			header("Location: " . $location);
			exit;
		}
	}