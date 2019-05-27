<?php
	class TypeModel extends Model{
		public function getTypeID($description){
			$STH = $this->_connection->prepare("SELECT * FROM type WHERE description = ?");
			$STH->bindParam(1, $description);
			$STH->setFetchMode(PDO::FETCH_ASSOC);
			$STH->execute();
			if($row = $STH->fetch()){
				return $row['type_id'];
			}
			return null;
		}
		public function getAllTypes(){
			$STH = $this->_connection->prepare("SELECT * FROM type");
			$STH->setFetchMode(PDO::FETCH_CLASS, 'TypeModel');
			$STH->execute();
			return $STH->fetchAll();
		}
		public function getType($id){
			$STH = $this->_connection->prepare("SELECT * FROM type WHERE type_id = ?");
			$STH->bindParam(1, $id);
			$STH->setFetchMode(PDO::FETCH_CLASS, 'TypeModel');
			$STH->execute();
			return $STH->fetch();
		}
	}