<?php

	function getUsers($id) {
		$sql = "select * FROM users WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$user = $stmt->fetchObject();
			unset($user->id);
			$user->first = getChampionSlim($user->first);
			$user->second = getChampionSlim($user->second);
			$user->third = getChampionSlim($user->third);

			return $user;
		} catch(PDOException $e) {
			return null;
		}
	}