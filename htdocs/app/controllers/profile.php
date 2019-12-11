<?php

	class Profile extends Controller{
		/*
			Create Profile
		*/
		public function create(){
			if(!isset($_SESSION['user_id'])){ //not logged in
				$this->redirect('home', 'login');
			}

			$profileModel = $this->model('ProfileModel');
			$profile = $profileModel->getProfile($_SESSION['user_id']);
			if($profile == null){ //if no profile allow create
				if(isset($_POST['submit'])){
					if(isset($_POST['fname']) && isset($_POST['lname'])){
						$profileModel->createProfile( $_POST['fname'],$_POST['lname'] );
						$_SESSION['profile_id'] = $profileModel->getLastId();
						$this->redirect('post', 'dashboard');
					}
				}
			}else{
				$this->redirect('post', 'dashboard');	
			}

			$this->view('profile', 'create');
		}
		
		/*
			Displays a profile based on profile_id
		*/
		public function index($id = -1){
			//models
			$profileModel  = $this->model('ProfileModel');
			$postModel     = $this->model('PostModel');
			$relationModel = $this->model('RelationModel');	
			$reviewModel   = $this->model('ReviewModel');

			//if no routing variable entered, display logged in user  
			if(isset($_SESSION['user_id']) && $id == -1){ 
				$profile = $profileModel->getProfile($_SESSION['user_id']);
				$id = $_SESSION['profile_id'];
			}
			$profile = $profileModel->getProfileData($id); //get profile 
			if($profile == null){ //no profile found
				$this->redirect('post','dashboard');
			}
			$postQuery = "SELECT post.*, ROUND(AVG(REVIEW.RATING),1) avg, type.description as typeDesc, picture.path, CONCAT(profile.first_name, ' ', profile.last_name) AS name,
				COUNT(review.post_id) as numReviews
			FROM post
			 LEFT JOIN review
				ON review.post_id = post.post_id
			 INNER JOIN type
			 	ON type.type_id = post.type_id
			 INNER JOIN picture
			 	ON picture.picture_id = post.picture_id
			 INNER JOIN profile
			 	ON profile.profile_id =  post.profile_id
			WHERE post.profile_id = " . $profile->profile_id ."
			GROUP BY post.post_id";
			
			$posts = $postModel->showPosts($postQuery);
			$numFollowing = $relationModel->getNumFollowing($id);
			$numReviews = $reviewModel->getNumReviews($id);
			$this->view('profile', 'index', [$profile, $numFollowing, $numReviews]);
			$this->view('post', 'cards', $posts);

		}
		/*
			edit profile
		*/
		public function edit($id = -1){
			
			if(!isset($_SESSION['profile_id']) && $_SESSION['profile_id'] != $id)
				$this->redirect('post','dashboard');

				$profileModel = $this->model('ProfileModel');
				$profile = $profileModel->getProfile($_SESSION['user_id']);

					if(isset($_POST['editProfile'])){
						$profileModel->updateProfile( $_POST['fname'],$_POST['lname']);
						if(file_exists($_FILES['picture']['tmp_name']) || is_uploaded_file($_FILES['picture']['tmp_name'])){
							$this->changePicture($id);
						}
						if(isset($_POST['removePic'])){
							$profileModel->deleteProfilePicture();
						}
						$this->redirect('profile', 'index');
					}
			
			
			$this->view('profile', 'edit',$profile);
		}
		//delete a profile
		public function delete($id = -1){
			if(isset($_SESSION['profile_id']) && ($_SESSION['profile_id'] == $id || $_SESSION['isAdmin'])){
				$this->view('profile', 'delete');
				if(isset($_POST['yes'])){
					$profileModel = $this->model('ProfileModel');
					$pictureModel = $this->model('Picture');
					$relationModel = $this->model('RelationModel');
					$postModel = $this->model('PostModel');
					$reviewModel = $this->model('ReviewModel');
					$savedPostModel = $this->model('savedPostModel');
					$userModel = $this->model('User');

					$profile = $profileModel->getProfileByProfileId($id);
					//delete reviews
					$reviewModel->deleteAllReviewsFromProfile($id);
					//delete posts
					$postModel->deleteAllPosts($id);
					//delete relations
					$relationModel->deleteAllRelations($id);

					//delete savedPosts
					$savedPostModel->deleteAllSavedPost($id);

					//delete profile
					$profileModel->deleteProfile($id);
					//delete picture
					$pictureModel->deletePicture($profile->picture_id);
					//delete user
					$userModel->deleteUser($profile->user_id);
					if(isset($_SESSION['isAdmin']) && $_SESSION['profile_id'] != $id){
						$this->redirect('post', 'dashboard');
					}
					$this->redirect('home', 'logout');
				}elseif(isset($_POST['no'])){
					$this->redirect('profile', 'index');
				}
			}else{
				$this->redirect('post','dashboard');
			}
		}
		/*
			Change profile picture
		*/
		private function changePicture($id = -1){
				//models 
				$profileModel = $this->model('ProfileModel');
				$pictureModel = $this->model('Picture');
				//getProfile
				$profile = $profileModel->getProfileByProfileId($id);
				if($_SESSION['user_id'] == $profile->user_id){
					$picture_id = 1; //default picture
					$currentPicture = $profile->picture_id;
					$isAdded = $pictureModel->addPictureToFile($_FILES['picture']);
					if($isAdded){
						$picture_id = $pictureModel->getLastId();
						$profileModel->changePicture($picture_id);
						$pictureModel->deletePicture($currentPicture);
					}
				}
		}
	}