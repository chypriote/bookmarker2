<?php

namespace Categories;

require 'api/utils/categories.php';

$app->group('/categories', function () {
	$this->get('', function ($req, $res, $args) {
		return getAll();
	});
	$this->get('/{id}', function($req, $res, $args) {
		return get($args['id']);
	});
	$this->post('', function ($req, $res, $args) {
		$cat = $req->getParsedBody();
		return post($cat);
	});
});
