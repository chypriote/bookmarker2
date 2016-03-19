<?php

require 'api/utils/web.php';

$app->group('/web', function () {
	$this->get('', function($req, $res, $args) {
		return $res->withStatus(200)->write(json_encode(getAllWeb()));
	});
});
