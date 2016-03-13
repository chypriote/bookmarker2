<?php

	$app->get('', function($req, $res, $args) {
		return $this->renderer->render($res, 'index.phtml', $args);
	});
