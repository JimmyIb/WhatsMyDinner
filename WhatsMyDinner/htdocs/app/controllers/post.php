<?php
	class Post extends Controller{
		private function ordering($table,$id, $order = 'ASC'){
			return "ORDER BY $table$id $order";
		}
		//landing page/main page
		public function dashboard(){
			//models
			$typeModel = $this->model('TypeModel');
			$postModel = $this->model('PostModel');

			$sorting = "ORDER BY post_id DESC"; //default sort
			$whereQuery = '';

			if(isset($_GET['sortby']) && isset($_GET['type'])){ 
				$sort = strtolower($_GET['sortby']);
				$type = strtolower($_GET['type']);
				$type_id = $typeModel->getTypeID($type);
				$type_id_all = $typeModel->getTypeID('All');

				if($sort == 'newest' || $sort == 'oldest'){ //newest or oldest is selected
					if($sort == 'newest'){
						$sorting = $this->ordering("post.", "date_posted", "DESC");
					}else{
						$sorting = $this->ordering("post.", "date_posted"); //oldest
					}
				}elseif($sort == 'best' || $sort == 'worst'){ //best or worst is selected
					if($sort == 'best'){
						$sorting = $this->ordering("", "avg", "DESC");
					}else{
						$sorting = $this->ordering("", "avg", "ASC"); //worst
					}
				}

				if($type_id != null && $type_id != $type_id_all){
					$whereQuery = "WHERE post.type_id = " . $type_id;
				}
				
			}
			
			
			if(isset($_GET['follow']) && isset($_SESSION['profile_id'])){ //check if online & if follow is selected
				$whereQuery .= " AND  profile.profile_id IN (SELECT relation.profile_id_follow FROM relation WHERE relation.profile_id_follower =" . $_SESSION['profile_id'] .")";
			}
			
			$query = "SELECT post.*, 
							ROUND(AVG(REVIEW.RATING),1) as avg, type.description as typeDesc, picture.path, 
							COUNT(review.post_id) as numReviews,
							CONCAT(profile.first_name, ' ', profile.last_name) AS name
					FROM post
						 LEFT JOIN review
							ON review.post_id = post.post_id
						 INNER JOIN type
						 	ON type.type_id = post.type_id
						 INNER JOIN picture
						 	ON picture.picture_id = post.picture_id
						 INNER JOIN profile
						 	ON profile.profile_id =  post.profile_id
					$whereQuery
					GROUP BY post.post_id
					$sorting";
			
			$this->view('post', 'dashboard', $typeModel->getAllTypes());
			$this->view('post','cards', $postModel->showPosts($query));
		}

		
		public function edit($id = -1){
			//models
			$postModel = $this->model('PostModel');
			$typeModel = $this->model('TypeModel');

			//get post
			$post = $postModel->getPost($id);
			if($post == null || !isset($_SESSION['profile_id']) || $post->profile_id != $_SESSION['profile_id']){
				$this->redirect('post','dashboard');
			}

			if(isset($_POST['cancel'])){
				$this->redirect('post', 'viewPost', array($id));
			}
			if(isset($_POST['submit'])){
					//get all data in forms
					$cook_time = (int) $_POST['time'];
					$prep_time = (int) $_POST['prepTime'];
					$dataCookTime = $this->calculateTime($cook_time); //format the time to the db
					$dataPrepTime = $this->calculateTime($prep_time); //format the time to the db
					$picture_id = $post->picture_id;
					$type_id = $typeModel->getTypeID($_POST['type']);
					$isAdded = false;
					//picture added
					if(file_exists($_FILES['picture']['tmp_name']) || is_uploaded_file($_FILES['picture']['tmp_name'])){
							$pictureModel = $this->model('Picture');
							$isAdded = $pictureModel->addPictureToFile($_FILES['picture']);
							if($isAdded){
								$old = $picture_id;
								$picture_id = $pictureModel->getLastId();
							}
						}
					$postModel->editPost($picture_id, $type_id,  $_POST['title'],
										 $_POST['description'], $_POST['ingredients'], $dataCookTime,
										  $_POST['directions'], $_POST['portions'], $dataPrepTime, $post->post_id);
					if($isAdded){
						$pictureModel->deletePicture($old);
					}
					$this->redirect('post', 'viewPost' , array($post->post_id));
				}
				$types = $typeModel->getAllTypes();
				$recipeType = $typeModel->getType($post->type_id); //current type
			$this->view('post', 'edit', [$post, $types, $recipeType]);
		}
		private function calculateTime($timeMin){
			if($timeMin >= 60){
				$time = (int) ($timeMin / 60) . 'h' . ($timeMin % 60);
			}else{
				$time = $timeMin . ' minutes';
			}
			return $time;
		}
		public function delete($id = -1){
			//models
			$postModel      = $this->model('PostModel');
			$pictureModel   = $this->model('Picture');
			$savedPostModel = $this->model('SavedPostModel');

			//get post
			$post = $postModel->getPost($id);

			if($post != null && isset($_SESSION['profile_id']) &&
					($post->profile_id == $_SESSION['profile_id'] || $_SESSION['isAdmin'])){
				//post belongs to logged in user or admin is logged in
				$savedPostModel->deleteSavedPostFromPost($id);
				$postModel->deletePost($id);
			}
			$this->redirect('post', 'dashboard');
		}

		public function viewPost($id = -1){
			//models
			$postModel      = $this->model('PostModel');
			$savedPostModel = $this->model('SavedPostModel');
			$reviewModel    = $this->model('ReviewModel');

			$post = $postModel->getPost($id);
			
			if($post == null){ //post does not exist
				$this->redirect('post','dashboard');
			}
/*
			if(isset($_POST['add'])){ //savepost
				$savedPostModel->savePost($id);
			}elseif(isset($_POST['remove'])){ //remove saved post
				$savedPostModel->removeSavedPost($id);
			}
*/
			if(isset($_POST['add']) || isset($_POST['remove']) ){ //save or remove save post
				if(isset($_SESSION['profile_id'])){
					if($savedPostModel->isSavedPost($id)){
						$savedPostModel->removeSavedPost($id);
					}else{
							$savedPostModel->savePost($id);
					}
				}
			}
			
			$data   = $postModel->viewFullPost($post);
			$review = $reviewModel->displayReview($post);

			$this->view('post', 'viewPost', $data); //show full post
			$this->view('review','showReview', $review); //show all reviews
			if(isset($_SESSION['profile_id']))
				$this->view('review','addReview', $data); //if logged in show add review div
		}

		public function create(){
			if(!isset($_SESSION['user_id'])){
				$this->redirect('home', 'login');
			}
			//models
			$profileModel = $this->model('ProfileModel');
			$typeModel    = $this->model('TypeModel');
			$postModel    = $this->model('PostModel');

			$types = $typeModel->getAllTypes();
			try{
				if(isset($_POST['submit'])){
						//data to add into db
						$profile = $profileModel->getProfile($_SESSION['user_id']);
						$type_id = $typeModel->getTypeID($_POST['type']);
						$picture_id = 1; //default id for pictures
						$cook_time = (int) $_POST['time'];
						$prep_time = (int) $_POST['prepTime'];
						$dataCookTime = $this->calculateTime($cook_time);					
						$dataPrepTime = $this->calculateTime($prep_time);
						//add image to db & src file
						if(file_exists($_FILES['picture']['tmp_name']) || is_uploaded_file($_FILES['picture']['tmp_name'])){ //image exist
							$pictureModel = $this->model('Picture');
							$isAdded = $pictureModel->addPictureToFile($_FILES['picture']);
							if($isAdded){
								$picture_id = $pictureModel->getLastId();
							}
						}
						$postModel->addPost($picture_id, $profile->profile_id,$type_id,  $_POST['title'], $_POST['description'], $_POST['ingredients'], $dataCookTime, $_POST['directions'], $_POST['portions'], $dataPrepTime);
						$this->redirect('post', 'dashboard');
						
				}
			}catch(Exception $e){
				print $e->getMessage();
			}
			$this->view('post', 'create', $types);
		}

		public function search(){
			$this->view('post', 'search');
			//models
			$postModel    = $this->model('PostModel');
			$profileModel = $this->model("ProfileModel");

			if(isset($_GET['searchProfile'])){ //seach profiles selected
				$profiles = $profileModel->searchProfiles($_GET['search']);
			}elseif(isset($_GET['search'])){
				$posts = $postModel->showPosts(null, $_GET['search']);
			}else{ //go to dashboard if none selected
				$this->redirect('post', 'dashboard');
			}
			
			if(isset($posts)){
				$this->view('post', 'cards', $posts);
			}elseif(isset($profiles)){
				$this->view('profile', 'profileCard', $profiles);
			}
		}
	}