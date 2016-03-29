<?php

require 'api/utils/posts.php';

$app->group('/posts', function () {
	$this->get('', function($req, $res, $args) {
		return $res->withStatus(200)->write(json_encode(\Web\getAll()));
	});
});
