<?php
	class ProfileModel extends Model{
		public function getProfile($id){
			$STH = $this->_connection->prepare("SELECT * FROM profile WHERE user_id = :id");
			$STH->setFetchMode(PDO::FETCH_CLASS, 'ProfileModel');
			$STH->execute(['id'=>$id]);
			return $STH->fetch();
				
		}
		/*
			get profile by profile id
		*/
		public function getProfileByProfileId($id){
			$STH = $this->_connection->prepare("SELECT * FROM profile WHERE profile_id = :id");
			$STH->setFetchMode(PDO::FETCH_CLASS, 'ProfileModel');
			$STH->execute(['id'=>$id]);
			return $STH->fetch();
		}
		/*
			Change profile picture
		*/
		public function changePicture($id){
			$query = "UPDATE profile 
					  SET picture_id = :picture_id
					  WHERE profile_id = :profile_id";
			$STH = $this->_connection->prepare($query);
			$STH->execute(['picture_id'=>$id,
						   'profile_id'=>$_SESSION['profile_id']
						 ]);
		}

		public function deleteProfilePicture(){
			$pictureModel = Controller::model('Picture');
			$profile = $this->getProfile($_SESSION['user_id']);
			$profilePictureId = $profile->picture_id;
			$query = "UPDATE profile 
					  SET picture_id = 2
					  WHERE profile_id = :profile_id";
			$STH = $this->_connection->prepare($query);
			$STH->execute(['profile_id'=>$_SESSION['profile_id']]);
			$pictureModel->deletePicture($profilePictureId);
		}
		/*
			Delete Profile
		*/
		public function deleteProfile($id){
			$query = "DELETE FROM profile
						WHERE profile_id = :id";
			$STH = $this->_connection->prepare($query);
			$STH->execute(['id'=>$id]);
		}
		/*
			returns full name
		*/
		public function getFullName($id){
			$STH = $this->_connection->prepare("SELECT * FROM profile WHERE profile_id = :id");
			$STH->setFetchMode(PDO::FETCH_ASSOC);
			$STH->bindParam(':id', $id);
			$STH->execute();
			if($row = $STH->fetch()){
				return $row['first_name'] . ' ' . $row['last_name'];
			}
			return null;
		}
		/*
			Create Profile
		*/
		public function createProfile($first_name, $last_name){
			$STH = $this->_connection->prepare("INSERT INTO profile (user_id, first_name, last_name) VALUES (?,?,?)");
			$STH->bindParam(1, $_SESSION['user_id']);
			$STH->bindParam(2, htmlEntities($first_name,ENT_QUOTES));
			$STH->bindParam(3, htmlEntities($last_name,ENT_QUOTES));
			
			$STH->execute();
		}
		/*
			Update Profile
		*/
		public function updateProfile($first_name, $last_name){
			$STH = $this->_connection->prepare("UPDATE profile 
												SET first_name = ?, last_name = ? 
												WHERE profile_id = ?");
			$STH->bindParam(1, $first_name);
			$STH->bindParam(2, $last_name);
			$STH->bindParam(3, $_SESSION['profile_id']);
			$STH->execute();

		}
		public function getLastId(){
			return $this->_connection->lastInsertId();
		}
		/*
			get profile data by profile id
		*/
		public function getProfileData($id){
			$impossibleNum = -999;
			$query = "SELECT *, picture.picture_id, CONCAT(profile.first_name, ' ', profile.last_name) as name,
						(SELECT ROUND(AVG(rating),1)
						 FROM review INNER JOIN post USING (post_id)
						 WHERE post.profile_id = :id
						 GROUP BY post.profile_id) as avg, 
			  			(SELECT relation.profile_id_follow
			     		 FROM relation
			    		 WHERE relation.profile_id_follower = :myProfile AND relation.profile_id_follow = :id) as following,
						(SELECT COUNT(relation.profile_id_follower)
						 FROM relation
						 WHERE profile_id_follow =  :id
						 GROUP BY profile_id_follow) as numFollowers
					FROM profile
					INNER JOIN picture
						ON profile.picture_id = picture.picture_id
					WHERE profile.profile_id = :id";
			$STH = $this->_connection->prepare($query);
			$STH->setFetchMode(PDO::FETCH_CLASS, 'ProfileModel');

			if(isset($_SESSION['profile_id'])){ //if logged in set profile_id
				$STH->bindParam(':myProfile', $_SESSION['profile_id']);
			}else{ //if not logged in set profile_id to an impossible id
				$STH->bindParam(':myProfile', $impossibleNum);
			}
			$STH->bindParam(':id', $id);
			$STH->execute();
			return $STH->fetch();
		}

		public function searchProfiles($search){
			$query = "SELECT profile_id, CONCAT(profile.first_name,' ' , profile.last_name) as name,
						(SELECT picture.path
					     FROM picture
					     WHERE profile.picture_id = picture.picture_id) as path,
					     
					     (SELECT ROUND(AVG(rating),1)
						  FROM review INNER JOIN post USING (post_id)
						  WHERE post.profile_id = profile.profile_id
						  GROUP BY post.profile_id) as avg
					FROM profile
					WHERE LOWER(profile.first_name) LIKE :search OR LOWER(profile.last_name) LIKE :search";

			$safe_var = trim(preg_replace("/[^a-zA-Z +-]/", "", $search));
			if($safe_var == ""){
				return null;
			}
			//replace all white spaces with '%' and add leading and trailing %
			$safe_var = "%" . str_replace(' ', '%', strtolower($safe_var)) . "%";
			$STH = $this->_connection->prepare($query);
			$STH->setFetchMode(PDO::FETCH_CLASS, 'ProfileModel');

			$STH->execute(['search'=>htmlEntities($safe_var, ENT_QUOTES)]);
			return $STH->fetchAll();
		}
	}