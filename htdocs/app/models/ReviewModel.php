<?php
	class ReviewModel extends Model{
		public function addReview($content, $post_id, $rating){
			$query = "INSERT INTO review(post_id, profile_id, review_content, rating) 
					  VALUES (?,?,?,?)";
			$STH = $this->_connection->prepare($query);
			$STH->bindParam(1, $post_id);
			$STH->bindParam(2, $_SESSION['profile_id']);
			$STH->bindParam(3, $content);
			$STH->bindParam(4, $rating);
			$STH->execute();
		}
		public function deleteAllReviews($id){
			$query = "DELETE FROM review WHERE post_id = :id";
			$STH = $this->_connection->prepare($query);
			$STH->bindParam(':id', $id);
			$STH->execute();
		}
		public function getReview($id){
			$query = "SELECT *
					  FROM review
					  WHERE review_id = ?";
			$STH = $this->_connection->prepare($query);
			$STH->bindParam(1, $id);
			$STH->execute();
			if($row = $STH->fetch()){
				return $row;
			}
			return null;
		}

		public function deleteAllReviewsFromProfile($id){
			$query = "DELETE FROM review WHERE profile_id = :id";
			$STH = $this->_connection->prepare($query);
			$STH->bindParam(':id', $id);
			$STH->execute();
		}

		public function getNumReviews($id){
			$query = "SELECT COUNT(review_id) as numReviews
					  FROM review
					  WHERE review.profile_id = :id";
			$STH = $this->_connection->prepare($query);
			$STH->execute(['id'=>$id]);
			$STH->setFetchMode(PDO::FETCH_CLASS, 'ReviewModel');
			return $STH->fetch();
		}
		public function deleteReview($id){
			$query = "DELETE FROM review WHERE review_id = ?";
			$STH = $this->_connection->prepare($query);
			$STH->bindParam(1, $id);
			$STH->execute();
		}

		public function displayReview($post){
			$query  = "
			SELECT review.*, picture.path, CONCAT(profile.first_name, ' ', profile.last_name) AS name
			FROM review
				INNER JOIN profile 
					ON review.profile_id = profile.profile_id
				INNER JOIN picture
					ON profile.picture_id = picture.picture_id
			WHERE post_id = :id";
			$STH = $this->_connection->prepare($query);
			$STH->setFetchMode(PDO::FETCH_CLASS, 'ReviewModel');
			$STH->execute(['id'=>$post->post_id]);

			return $STH->fetchAll();
		}
		public function getAllReviews($id){
			$query = "SELECT review.*, post.title,post.profile_id as 'author_id', picture.path, 
						CONCAT(profile.first_name, ' ', profile.last_name) as name,
							(SELECT CONCAT(profile.first_name, ' ', profile.last_name)
							 FROM profile
							 WHERE post.profile_id = profile.profile_id) as author,
							 (SELECT AVG(review.rating)
  							  FROM review
  							  WHERE post.post_id = review.post_id) as avg
					  FROM review
					  INNER JOIN post
						  ON post.post_id = review.post_id
					  INNER JOIN picture
						  ON picture.picture_id = post.picture_id
					  INNER JOIN profile
						  ON review.profile_id = profile.profile_id
					  WHERE review.profile_id = :id";
			$STH = $this->_connection->prepare($query);
			$STH->setFetchMode(PDO::FETCH_CLASS, 'ReviewModel');
			$STH->execute(['id'=>$id]);
			return $STH->fetchAll();
		}
	}