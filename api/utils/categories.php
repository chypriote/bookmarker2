<?php

	function getAll() {
		$sql = "select * FROM categories";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$categories = $stmt->fetchAll(\PDO::FETCH_OBJ);

			return $categories;
		} catch(PDOException $e) {
			return $e->getMessage();
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
			return $category;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function post($category) {
		$sql = "INSERT INTO categories (name, slug, icon, created_at, updated_at) VALUES (:name, ::creation, :creation)";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("name", $category['name']);
			$stmt->bindParam("slug", $category['slug']);
			$stmt->bindParam("icon", $category['icon']);
			$stmt->bindParam("creation", date("Y-m-d H:i:s"));
			$stmt->execute();
			$category['id'] = $db->lastInsertId();
			$db = null;
			return $category;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function getPosts($id) {
		switch ($id) {
			case 1:
				$table = 'posts';
				break;
			case 2:
				$table = 'games';
				break;
		}

		$category = get($id);
		$sql = "select * FROM ".$table." WHERE category_id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$category->posts = $stmt->fetchAll(\PDO::FETCH_OBJ);
			$db = null;
			return $category;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
