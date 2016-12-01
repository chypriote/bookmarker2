<?php

namespace Web;

	function getAll() {
		$sql = "select * FROM posts";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$web = $stmt->fetchAll(\PDO::FETCH_OBJ);
			return $web;
		} catch(PDOException $e) {
			return null;
		}
	}

	function get($id) {
		$sql = "select * FROM posts WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$champion = $stmt->fetchObject();
			return $champion;
		} catch(PDOException $e) {
			return null;
		}
	}

	function post($post) {
		$sql = "INSERT INTO posts (category_id, title, text, link, image) VALUES (:category_id, :title, :text, :link, :image)";

		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("title", $post['title']);
			$stmt->bindParam("category_id", $post['category_id']);
			$stmt->bindParam("text", $post['text']);
			$stmt->bindParam("link", $post['link']);
			$stmt->bindParam("image", $post['image']);
			$stmt->execute();
			$post['id'] = $db->lastInsertId();
			$db = null;
			return $post;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
