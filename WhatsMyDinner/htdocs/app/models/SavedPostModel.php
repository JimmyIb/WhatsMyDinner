<?php 
	class SavedPostModel extends Model{

		public function isSaved($id = -1){
			$STH = $this->_connection->prepare("SELECT * FROM savedPost WHERE post_id = ? AND profile_id = ?");
			$STH->setFetchMode(PDO::FETCH_ASSOC);
			$STH->bindParam(1, $id);
			$STH->bindParam(2, $_SESSION['profile_id']);
			$STH->execute();
			if($row = $STH->fetch()){
				return true;
			}
			return false;
		}
		public function isSavedPost($id){
			$STH = $this->_connection->prepare("SELECT * 
												FROM savedPost 
												WHERE post_id = :post_id AND profile_id = :profile_id");
			$STH->execute(['post_id'=>$id, 'profile_id'=>$_SESSION['profile_id']]);
			if($STH->fetch() == null){
				return false;
			}
			return true;
		}
		public function deleteAllSavedPost($id){
			$STH = $this->_connection->prepare("DELETE FROM savedPost WHERE profile_id = ?");
			$STH->bindParam(1, $id);
			$STH->execute();
		}
		public function removeSavedPost($id){
			$STH = $this->_connection->prepare("DELETE FROM savedPost WHERE post_id = ? AND profile_id = ?");
			$STH->bindParam(1, $id);
			$STH->bindParam(2, $_SESSION['profile_id']);
			$STH->execute();
		}
		public function savePost($id = -1){
			$STH = $this->_connection->prepare("INSERT INTO savedPost(post_id, profile_id) VALUES (?,?)");
			$STH->bindParam(1, $id);
			$STH->bindParam(2, $_SESSION['profile_id']);
			$STH->execute();
		}
		public function deleteSavedPostFromPost($id){
			$STH = $this->_connection->prepare("DELETE FROM savedPost WHERE post_id = ?");
			$STH->bindParam(1, $id);
			$STH->execute();
		}
	}