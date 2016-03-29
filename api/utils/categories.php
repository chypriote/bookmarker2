<?php

	function getAll() {
		$sql = "select * FROM categories";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$categories = $stmt->fetchAll(\PDO::FETCH_OBJ);

			return json_encode($categories);
		} catch(PDOException $e) {
			return null;
		}
	}

	function get($id) {
		$sql = "select * FROM categories WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$category = $stmt->fetchObject();

			return json_encode($category);
		} catch(PDOException $e) {
			return null;
		}
	}

	function post($category) {
		$sql = "INSERT INTO categories (name, created_at, updated_at) VALUES (:name, :creation, :creation)";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("name", $category['name']);
			$stmt->bindParam("creation", date("Y-m-d H:i:s"));
			$stmt->execute();
			$category['id'] = $db->lastInsertId();
			$db = null;
			return $category;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
