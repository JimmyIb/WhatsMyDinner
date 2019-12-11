<?php
	class SavedPost extends Controller{
		
		public function index(){
			if(!isset($_SESSION['user_id'])){
				$this->redirect('home', 'login');
			}
			$postModel = Controller::model('PostModel');
			$query = "SELECT post.*, 
				IFNULL(ROUND(AVG(REVIEW.RATING),1),0) avg, type.description as typeDesc, picture.path, CONCAT(profile.first_name, ' ', profile.last_name) AS name,COUNT(review.post_id) as numReviews
			FROM post
			 LEFT JOIN review
				ON review.post_id = post.post_id
			 INNER JOIN type
			 	ON type.type_id = post.type_id
			 INNER JOIN picture
			 	ON picture.picture_id = post.picture_id
			 INNER JOIN profile
			 	ON profile.profile_id =  post.profile_id
             INNER JOIN savedpost
             	ON savedPost.post_id = post.post_id
             WHERE savedPost.profile_id = " . $_SESSION['profile_id'] ."
			GROUP BY post.post_id";

			$posts = $postModel->showPosts($query);
			$this->view('savedpost', 'index');
			$this->view('post', 'cards', $posts);
		}
	}