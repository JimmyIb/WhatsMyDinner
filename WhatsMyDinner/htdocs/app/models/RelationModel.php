<?php
	class RelationModel extends Model{
		public function addRelation($id_follow){
			$STH = $this->_connection->prepare("INSERT INTO relation(profile_id_follower, profile_id_follow) VALUES (?,?)");
			$STH->bindParam(1, $_SESSION['profile_id']);
			$STH->bindParam(2, $id_follow);
			$STH->execute();
		}
		public function removeRelation($id){
			$STH = $this->_connection->prepare("DELETE FROM relation WHERE profile_id_follower = ? AND profile_id_follow = ?");
			$STH->bindParam(1, $_SESSION['profile_id']);
			$STH->bindParam(2, $id);
			$STH->execute();
		}

		public function getRelation($id){
			$STH = $this->_connection->prepare("SELECT * FROM relation WHERE profile_id_follower = ? AND profile_id_follow = ?");
			$STH->bindParam(1, $_SESSION['profile_id']);
			$STH->bindParam(2, $id);
			$STH->execute();
			return $STH->fetch();
		}

		//deletes all relations that is related to a profile
		public function deleteAllRelations($id){
			$query = "DELETE 
					  FROM relation
					  WHERE profile_id_follow = :id OR profile_id_follower = :id";
			$STH = $this->_connection->prepare($query);
			$STH->execute(['id'=>$id]);
		}

		//returns the avg rating, picture path and the full name of a profile
		public function relations($id, $onlyFollowers = false){
			if(!$onlyFollowers){
				$whereClause = "WHERE profile_id_follower = :id";
				$selection = "relation.profile_id_follow";
			}else{
				$whereClause = "WHERE profile_id_follow = :id";
				$selection = "relation.profile_id_follower";
			}
			$query = "SELECT " . $selection . " as profile_id,
						(SELECT ROUND(AVG(rating),1)
						 FROM review INNER JOIN post USING (post_id)
	 					 WHERE post.profile_id = $selection
	 					 GROUP BY post.profile_id) as avg,

     					(SELECT picture.path 
      					FROM picture
      					WHERE picture.picture_id = (
          											SELECT picture_id 
          											FROM profile
          											WHERE profile.profile_id = $selection
      							 					)
      					) as path,
      					(SELECT CONCAT(profile.first_name,' ', profile.last_name)
      					 FROM profile
      					 WHERE profile_id = $selection) as name
					FROM relation " 
					. $whereClause;
			$STH = $this->_connection->prepare($query);
			$STH->setFetchMode(PDO::FETCH_CLASS,'RelationModel');
			$STH->execute(['id'=>$id]);
			return $STH->fetchAll();
		}
		public function getNumFollowing($id){
			$query = "SELECT COUNT(profile_id_follow) as numFollowing
					  FROM relation
					  WHERE profile_id_follower = :id";
			$STH = $this->_connection->prepare($query);
			$STH->setFetchMode(PDO::FETCH_CLASS,'RelationModel');
			$STH->execute(['id'=>$id]);
			return $STH->fetch();
		}
		
	}