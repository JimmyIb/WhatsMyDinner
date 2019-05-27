<?php
	class Picture extends Model{
		/*
			add image to src folder
		*/
		public function addPictureToFile($picture){
			$extension = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
			if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif'){ //get correct img extensions
				$uploads_dir = '../htdocs/app/images'; //src folder
				$tmp_name = $_FILES['picture']['tmp_name'];
				$name = uniqid() . basename($_FILES['picture']['name']);
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
				$this->addPictureToDatabase("/app/images/$name");
				return true;
			}
			return false;
		}

		/*
			add picture to db
		*/
		private function addPictureToDatabase($path){
			$STH = $this->_connection->prepare("INSERT INTO picture(path) VALUES (:path)");
			$STH->bindParam(':path', $path);
			$STH->execute();
		}
		/*
			returns last Inserted picture
		*/
		public function getLastId(){
			return $this->_connection->lastInsertId();
		}

		/*
			returns image path
		*/
		public function getPicture($id){
			$STH = $this->_connection->prepare("SELECT path FROM picture WHERE picture_id = :id");
			$STH->bindParam(':id', $id);
			$STH->execute();
			$row = $STH->fetch();
			return $row['path'];
		}

		/*
			delete image from db & folder src
		*/
		public function deletePicture($id){
			if($id != 1 && $id != 2){ 
			//id 1 : logo 
			//id 2: image no profile 
			//Cannot delete these two files
				$picturePath = $this->getPicture($id);
				unlink($_SERVER['DOCUMENT_ROOT'] . $picturePath); //delete image from folder
				$STH = $this->_connection->prepare("DELETE FROM picture WHERE picture_id = :id");
				$STH->bindParam(':id', $id);
				$STH->execute();
			}
		}
	}