<?php

	function getAllWeb() {
		$sql = "select * FROM post WHERE category_id=2";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$web = $stmt->fetchAll(PDO::FETCH_OBJ);
			return $web;
		} catch(PDOException $e) {
			return null;
		}
	}

	function getChampion($id) {
		$sql = "select * FROM champions WHERE id=:id";
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

	function addChampion($champion) {
		$sql = "INSERT INTO champions (name, slug) VALUES (:name, :slug)";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("name", $champion['name']);
			$stmt->bindParam("slug", $champion['slug']);
			$stmt->execute();
			$champion['id'] = $db->lastInsertId();
			$champion['games'] = 0;
			$champion['bans'] = 0;
			$champion['wins'] = 0;
			$db = null;
			return $champion;
		} catch(PDOException $e) {
			return null;
		}
	}

	function getChampionSlim($id) {
		$sql = "select id, name, slug FROM champions WHERE id=:id";
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
