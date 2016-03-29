<?php

$app->group('/', function() use ($app) {
	require 'site/routes/site.php';
});

$app->group('/api', function() use ($app) {
	require 'api/routes/users.php';
	require 'api/routes/categories.php';
	// require 'api/routes/movies.php';
	require 'api/routes/posts.php';
	// require 'api/routes/plugins.php';
	// require 'api/routes/games.php';
	$app->get('/doc/', function ($req, $res, $args) {
		return $this->docrender->render($res, 'index.phtml', $args);
	});
});
