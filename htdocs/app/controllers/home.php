<?php

	class Home extends Controller{

		public function login(){
			//if logged in go to dashboard
			if(isset($_SESSION['user_id'])){
				$this->redirect('post', 'dashboard');
			}

			
				try{
					if(isset($_POST['submit'])){
						$model = $this->model('User');
						$username = $_POST['username'];
						$password = $_POST['password'];
						
						$userData = $model->searchUser($username);

						if($userData != null){
							if(password_verify($password, $userData['password'])){
								$_SESSION['user_id'] = (int) $userData['user_id'];
								$profileModel = $this->model('ProfileModel');
								$profile = $profileModel->getProfile($_SESSION['user_id']);
								if($profile == null){ //no profile
									$this->redirect("profile","create");
								}else{ //has profile
									$_SESSION['profile_id'] = (int) $profile->profile_id;
									$userModel = $this->model('User');
									if($userModel->getPrivilege() == "1"){ //admin
										$_SESSION['isAdmin']  = true;
									}
									$this->redirect("post","dashboard");
								}	
							}
						}
						$this->redirect("home","login", array("invalid"));
					}

				}catch(Exception $e){
					$e->getMessage();
					print $e;
				}
			$this->view('home', 'login');
		}

		public function create(){
			//if logged in go to dashboard
			if(isset($_SESSION['user_id'])){
				$this->redirect('post', 'dashboard');
			}

			$this->view('home', 'create');
			try{
				if(isset($_POST['username']) && isset($_POST['password'])){
					$username = $_POST['username'];
					$userModel = $this->model('User');
					$row = $userModel->searchUser($username); //check if username exist

					if($row == null){	//username does not exist
						$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
						$userModel->addUser($username, $hashed_password);
						$this->redirect("home", "login");
					}else{
						$this->redirect("home", "create", array("invalid"));
					}
				}
			}catch(Exception $e){
				$e->getMessage();
				print $e;
			}

		}

		public function logout(){
			session_destroy();
			$this->redirect('home', 'login');
		}
	}
