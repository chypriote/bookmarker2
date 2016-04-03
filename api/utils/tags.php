<?php

namespace Tags;

	function getAll() {
		$sql = "select * FROM tags";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$tags = $stmt->fetchAll(\PDO::FETCH_OBJ);

			foreach ($tags as $tag) {
				$cat = \Categories\get($tag->category_id);
				$tag->category = $cat->slug;
			}
			return $tags;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function get($id) {
		$sql = "select * FROM tags WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$tag = $stmt->fetchObject();
			return $tag;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function post($tag) {
		$sql = "INSERT INTO tags (category_id, name) VALUES (:category_id, :name)";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("category_id", $tag['category_id']);
			$stmt->bindParam("name", $tag['name']);
			$stmt->execute();
			$tag['id'] = $db->lastInsertId();
			$db = null;
			return $tag;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function getPosts($id) {
		$tag = get($id);

		$sql = "select * FROM posts WHERE tag_id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$tag->posts = $stmt->fetchAll(\PDO::FETCH_OBJ);
			$db = null;
			return $tag;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
