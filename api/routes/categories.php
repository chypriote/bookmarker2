<?php

namespace Categories;

require 'api/utils/categories.php';

$app->group('/categories', function () {
	$this->get('', function ($req, $res, $args) {
		$categories = getAll();
		if (is_array($categories))
			return $res->withStatus(200)->write(json_encode($categories));
		return $res->withStatus(400)->write($categories);
	});

	$this->get('/{id}', function($req, $res, $args) {
		$category = get($args['id']);
		if (is_object($category))
			return $res->withStatus(200)->write(json_encode($category));
		return $res->withStatus(400)->write($category);
	});

	$this->post('', function ($req, $res, $args) {
		$cat = $req->getParsedBody();
		$category = post($cat);
		if (is_array($category))
			return $res->withStatus(200)->write(json_encode($category));
		return $res->withStatus(400)->write($category);
	});

	//Récupération des posts pour une catégorie
	$this->get('/{id}/posts', function($req, $res, $args) {
		$category = getPosts($args['id']);

		if (is_object($category))
			return $res->withStatus(200)->write(json_encode($category));
		return $res->withStatus(400)->write($category);
	});
});
