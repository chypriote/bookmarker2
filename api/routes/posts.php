<?php

require 'api/utils/posts.php';

$app->group('/posts', function () {
	$this->get('', function ($req, $res, $args) {
		return $res->withStatus(200)->write(json_encode(\Web\getAll()));
	});

	$this->get('/{id}', function ($req, $res, $args) {
		$post = get($args['id']);

		if (is_object($post))
			return $res->withStatus(200)->write(json_encode($post));
		return $res->withStatus(400)->write($post);
	});

	$this->post('', function ($req, $res, $args) {
		$parsed = $req->getParsedBody();
		$post = post($parsed);

		if (is_array($post))
			return $res->withStatus(200)->write(json_encode($post));
		return $res->withStatus(400)->write($post);
	});

});
