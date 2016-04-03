<?php

namespace Categories;

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
		$sql = "INSERT INTO categories (name, slug, icon, color) VALUES (:name, :slug, :icon, :color)";

		$slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($category['name'])));

		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("name", $category['name']);
			$stmt->bindParam("slug", $slug);
			$stmt->bindParam("icon", $category['icon']);
			$stmt->bindParam("color", $category['color']);
			$stmt->execute();
			$category['id'] = $db->lastInsertId();
			$db = null;
			return $category;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function getTags($id) {
		$category = get($id);

		$sql = "select * FROM tags WHERE category_id=:id";
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
