<?php

namespace Tags;

require 'api/utils/tags.php';

$app->group('/tags', function () {

	$this->get('', function ($req, $res, $args) {
		$tags = getAll();

		if (is_array($tags))
			return $res->withStatus(200)->write(json_encode($tags));
		return $res->withStatus(400)->write($tags);
	});

	$this->get('/{id}', function($req, $res, $args) {
		$tag = get($args['id']);

		if (is_object($tag))
			return $res->withStatus(200)->write(json_encode($tag));
		return $res->withStatus(400)->write($tag);
	});

	$this->post('', function ($req, $res, $args) {
		$parsed = $req->getParsedBody();
		$tag = post($parsed);

		if (is_array($tag))
			return $res->withStatus(200)->write(json_encode($tag));
		return $res->withStatus(400)->write($tag);
	});

	//Récupération des posts pour un tag
	$this->get('/{id}/posts', function($req, $res, $args) {
		$tag = getPosts($args['id']);

		if (is_object($tag))
			return $res->withStatus(200)->write(json_encode($tag));
		return $res->withStatus(400)->write($tag);
	});
});
