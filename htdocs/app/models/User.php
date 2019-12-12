<?php
	class User extends Model{
		public $username;
		public $password;
		public function searchUser($username){
			$STH = $this->_connection->prepare("SELECT * 
												FROM User 
												WHERE username = :username");
			$STH->bindParam(':username', $username);
			$STH->setFetchMode(PDO::FETCH_ASSOC);
			$STH->execute();
			return $STH->fetch();
		}

		public function searchUserbyID($id){
			$STH = $this->_connection->prepare("SELECT * 
												FROM User 
												WHERE user_id = :user_id");
			$STH->bindParam(':user_id', $id);
			$STH->setFetchMode(PDO::FETCH_CLASS, 'User');
			$STH->execute();
			return $STH->fetch();
		}

		public function addUser($username, $password){
			$STH = $this->_connection->prepare("INSERT INTO user(username,password) 
												VALUES(:username, :password)");
			$STH->bindParam(':password', $password);
			$STH->bindParam(':username', $username);
			$STH->execute();
		}
		public function getPrivilege(){
			$STH = $this->_connection->prepare("SELECT privilege_id
												FROM User
												WHERE user_id = ?");
			$STH->bindParam(1, $_SESSION['user_id']);
			$STH->execute();
			if($row = $STH->fetch()){
				return $row['privilege_id'];
			}
		}
		public function deleteUser($id){
			$query = "DELETE FROM user WHERE user_id = :id";
			$STH = $this->_connection->prepare($query);
			$STH->execute(['id'=>$id]);
		}
	}