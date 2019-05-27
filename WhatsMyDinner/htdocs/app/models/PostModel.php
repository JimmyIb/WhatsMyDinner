<?php 
class PostModel extends Model{
	/*
	 param: $id is the post id
	 returns the post if exists else return null
	*/
	 
	public function getPost($id){
		$STH = $this->_connection->prepare("SELECT * FROM post WHERE post_id = :id");
		$STH->setFetchMode(PDO::FETCH_CLASS, 'PostModel');
		$STH->execute(['id'=>$id]);
		return $STH->fetch();
	}
	public function addPost($picture_id, $profile_id, $type_id, $title, $description, $ingredients, $time,$directions, $portions, $prepTime){
		$query = "INSERT INTO post(picture_id, profile_id, type_id, title, description, 
									ingredients, time, directions,portions, preperation_time)
		 			VALUES (:picture_id,:profile_id,:type_id,:title,:description,
		 					:ingredients,:time,:directions,:portions,:prepTime)";
		$STH = $this->_connection->prepare($query);
		$STH->execute(['picture_id'=>$picture_id,
						'profile_id'=>$profile_id, 
						'type_id'=>$type_id,
					    'title'=>htmlEntities($title, ENT_QUOTES),
					    'description'=> htmlEntities($description,ENT_QUOTES),
					    'ingredients'=>htmlEntities($ingredients, ENT_QUOTES),
					    'time'=>$time, 'directions'=>htmlEntities($directions, ENT_QUOTES),
					    'portions'=>$portions,
					    'prepTime'=>$prepTime
					]);
	}

	public function editPost($picture_id, $type_id, $title, $description, $ingredients, $time,$directions, $portions, $prepTime, $post_id){
		$SQLquery = "UPDATE post 
					 SET picture_id = :picture_id, type_id = :type_id, title = :title, description = :description, ingredients = :ingredients, time = :time, directions = :directions, portions = :portions, preperation_time = :prepTime
					 WHERE post_id = :post_id AND profile_id = :profile_id";
		$STH = $this->_connection->prepare($SQLquery);

		$STH->execute(['picture_id'=>$picture_id, 
					   'type_id'=>$type_id, 'title'=>$title,
					   'description'=>htmlEntities($description, ENT_QUOTES),
					   'ingredients'=>htmlEntities($ingredients, ENT_QUOTES),
					   'time'=>$time, 'directions'=>htmlEntities($directions, ENT_QUOTES), 'portions'=>$portions,
					   'prepTime'=>$prepTime,
					   'post_id'=>$post_id, 
					   'profile_id'=>$_SESSION['profile_id']
					]);
	}
	public function deletePost($id){
		//models
		$reviewModel    = Controller::model('ReviewModel');
		$pictureModel   = Controller::model('Picture');
		$savedPostModel = Controller::model('SavedPostModel');

		$picture_id = $this->getPost($id)->picture_id; //picture id of post
		$post = $this->getPost($id);
		$savedPostModel->deleteAllSavedPost($id);
		$reviewModel->deleteAllReviews($post->post_id);
		$STH = $this->_connection->prepare("DELETE FROM post WHERE post_id = :id");
		$STH->execute(['id'=>$id]);
		$pictureModel->deletePicture($picture_id);
	}

	public function deleteAllPosts($id){
		$query = "SELECT * 
				  FROM post
				  WHERE post.profile_id = :id";
		$STH = $this->_connection->prepare($query);
		$STH->setFetchMode(PDO::FETCH_CLASS, 'PostModel');
		$STH->execute(['id'=>$id]);
		$allPosts = $STH->fetchAll();
		foreach($allPosts as $data){
			$this->deletePost($data->post_id);
		}	
	}
	/*
		Display posts
	*/
	public function showPosts($query, $search = ''){
		if($search != ''){
			$query = "SELECT post.*,  picture.path,
				IFNULL(ROUND(AVG(REVIEW.RATING),1),0) avg, type.description as typeDesc, 
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
			WHERE post.title LIKE  :search OR post.ingredients LIKE :search
			GROUP BY post.post_id";
		}
		$STH = $this->_connection->prepare($query);
		$STH->setFetchMode(PDO::FETCH_CLASS,'PostModel');
		if($search != ''){
			$safe_var = preg_replace("/[^a-zA-Z]/", "", $search);
			if($safe_var == ""){
				return null;
			}
			$safe_var = str_replace(" ", "%", $search);
			$STH->execute(['search'=>'%'.$safe_var.'%']);
		}else{
			$STH->execute();
		}
		return $STH->fetchAll();
	}

/*
	Display one specific post
*/
	public function viewFullPost($post){

		$query = "
		SELECT post.*, type.description as descriptionType, picture.path, CONCAT(profile.first_name, ' ' ,profile.last_name) AS name, ROUND(AVG(review.rating),1) AS avgRating,
			(SELECT savedpost.post_id
		     FROM savedpost
		     WHERE savedpost.profile_id = :profile_id AND post.post_id = savedpost.post_id) as isSaved,
		     COUNT(review.post_id) as numReviews
		FROM post
		INNER JOIN profile
			ON post.profile_id = profile.profile_id
		INNER JOIN picture
			ON post.picture_id = picture.picture_id
		INNER JOIN type
			ON post.type_id = type.type_id
        INNER JOIN review
        	ON post.post_id = review.post_id
		WHERE post.post_id = :id";
		$STH = $this->_connection->prepare($query);
		$STH->setFetchMode(PDO::FETCH_CLASS,'PostModel');
		
		if(isset($_SESSION['profile_id'])){
			$pid = $_SESSION['profile_id'];
		}else{
			$pid = -999;
		}
		$STH->bindParam(':id', $post->post_id);
		$STH->bindParam(':profile_id', $pid);
		$STH->execute();

		return $STH->fetch();
	}
}