<?php
	class Review extends Controller{
		public function addReview($id = -1){
			if($id == -1 || !isset($_SESSION['user_id'])){
				$this->redirect('post', 'dashboard');
			}
			//models
			$postModel = $this->model('PostModel');
			$reviewModel = $this->model('ReviewModel');
			$post = $postModel->getPost($id);
			if($post == null){
				$this->redirect('post', 'dashboard');
			}
			
			if(isset($_POST['submit'])){
				if(isset($_POST['review'])){
					$reviewModel->addReview($_POST['review'], $id, $_POST['rating']);
					$this->redirect('post', 'viewPost', array($id));
				}
			}
		}

		public function deleteReview($id = -1, $post_id){
			if($id == -1 && !isset($_SESSION['user_id']) && $post_id == null){
				$this->redirect('post', 'dashboard');
			}
			//models
			$reviewModel = $this->model('ReviewModel');
			$postModel = $this->model('PostModel');
			$post = $postModel->getPost($post_id);
			$review = $reviewModel->getReview($id);
			if($review['profile_id'] == $_SESSION['profile_id'] || isset($_SESSION['isAdmin'])){
				$reviewModel->deleteReview($review['review_id']);
				$this->redirect('post', 'viewPost', array($post_id));
			}
			$this->redirect('post', 'dashboard');
		}

		public function index($profile_id){
			//models
			$profileModel = $this->model('ProfileModel');
			$reviewModel = $this->model('ReviewModel');

			$profile = $profileModel->getProfileByProfileId($profile_id);
			if($profile == null){
				$this->redirect('post','dashboard');
			}
			$reviews = $reviewModel->getAllReviews($profile->profile_id);
			$this->view('review','index', $reviews);

		}
	}