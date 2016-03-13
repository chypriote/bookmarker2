<?php


	function getCategories() {
		$sql = "select * FROM categories";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$categories = $stmt->fetchAll(PDO::FETCH_OBJ);
			foreach ($categories as $category) {
				$ret[$category->id] = $category;
			}
			return $ret;
		} catch(PDOException $e) {
			return null;
		}
	}
	function getCategory($id) {
		$sql = "select * FROM categories WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$category = $stmt->fetchObject();
			return $category;
		} catch(PDOException $e) {
			return null;
		}
	}
	function getTags() {
		$sql = "select * FROM tags";
		try {
			$ret = [];
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$tags = $stmt->fetchAll(PDO::FETCH_OBJ);
			foreach ($tags as $tag) {
				$tag->category = getCategory($tag->category_id);
				$ret[$tag->id] = $tag;
			}
			return $ret;
		} catch(PDOException $e) {
			return null;
		}
	}

	$app->get('', function($req, $res, $args) {
		$args['categories'] = getCategories();
		$args['tags'] = getTags();

		return $this->renderer->render($res, 'index.phtml', $args);
	});
