<?php

	function getPostsFromTag($tag) {
		$cat = getCategoryFromTag($tag);
		if ($cat )
	}

	function getCategoryFromTag($tag) {
		$sql = 'SELECT * FROM tags_posts WHERE id_tag=:tag';
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $tag);
			$stmt->execute();
			$obj = $stmt->fetchObject();
			$db = null;
			return $obj->id_category;
		} catch(PDOException $e) {
			return $null;
		}
	}
