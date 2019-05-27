<?php
	class Relation extends Controller{
		public function index($id = -1){
			
			if($id == -1 && !isset($_SESSION['user_id'])){ //no routing variable & not logged in
				$this->redirect('post', 'index');
			}
			//model
			$relationModel = $this->model('RelationModel');
			$relations = $relationModel->relations($id);
			$this->view('relation', 'index');
			$this->view('profile' , 'profileCard', $relations);
		}
		public function addRelation($id = -1, $controller, $method, $arg){
			if(!isset($_SESSION['user_id'])){
				$this->redirect('home', 'login');
			}
			
			//models
			$profileModel = $this->model('ProfileModel');
			$relationModel = $this->model('RelationModel');
			$profile = $profileModel->getProfileByProfileId($id);

			if($id == -1 && $profile == null){
				$this->redirect('post', 'dashboard');
			}
			$relationModel->addRelation($id);
			$this->redirect($controller, $method, array($arg));
		}
		public function removeRelation($id = -1, $controller, $method, $args){
			if(!isset($_SESSION['user_id'])){
				$this->redirect('home', 'login');
			}

			$relationModel = $this->model('RelationModel');
			$relation = $relationModel->getRelation($id);
			if($relation == null){
				$this->redirect('relation', 'index');
			}
			$relationModel->removeRelation($id);
			$this->redirect($controller, $method, array($args));
		}
		public function followers($id){
			$relationModel = $this->model('RelationModel');
			$relations = $relationModel->relations($id, true);
			$this->view('relation', 'followers');
			$this->view('profile' , 'profileCard', $relations);
		}
	}