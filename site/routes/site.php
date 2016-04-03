<?php


	// function getCategories() {
	// 	$sql = "select * FROM categories";
	// 	try {
	// 		$db = getConnection();
	// 		$stmt = $db->prepare($sql);
	// 		$stmt->execute();
	// 		$categories = $stmt->fetchAll(PDO::FETCH_OBJ);
	// 		foreach ($categories as $category) {
	// 			$ret[$category->id] = $category;
	// 		}
	// 		return $ret;
	// 	} catch(PDOException $e) {
	// 		return null;
	// 	}
	// }
	// function getCategory($id) {
	// 	$sql = "select * FROM categories WHERE id=:id";
	// 	try {
	// 		$db = getConnection();
	// 		$stmt = $db->prepare($sql);
	// 		$stmt->bindParam("id", $id);
	// 		$stmt->execute();
	// 		$category = $stmt->fetchObject();
	// 		return $category;
	// 	} catch(PDOException $e) {
	// 		return null;
	// 	}
	// }
	// function getTags() {
	// 	$sql = "select * FROM tags";
	// 	try {
	// 		$db = getConnection();
	// 		$stmt = $db->prepare($sql);
	// 		$stmt->execute();
	// 		$tags = $stmt->fetchAll(\PDO::FETCH_OBJ);

	// 		foreach ($tags as $tag) {
	// 			$cat = \Categories\get($tag->category_id);
	// 			$tag->category = $cat->name;
	// 		}
	// 		return $tags;
	// 	} catch(PDOException $e) {
	// 		return $e->getMessage();
	// 	}
	// }

	$app->get('', function($req, $res, $args) {
		$args['categories'] = \Categories\getAll();
		$args['tags'] = \Tags\getAll();

		return $this->renderer->render($res, 'index.phtml', $args);
	});
