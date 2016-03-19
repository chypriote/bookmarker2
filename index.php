<?php
if (PHP_SAPI == 'cli-server') {
		$file = __DIR__ . $_SERVER['REQUEST_URI'];
		if (is_file($file)) {
				return false;
		}
}

require 'vendor/autoload.php';
session_start();
$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);
$container = $app->getContainer();
$container['renderer'] = function($c) {
	return new Slim\Views\PhpRenderer('site/templates/');
};
$container['docrender'] = function($c) {
	return new Slim\Views\PhpRenderer('api/doc/');
};

require 'bootstrap/config.php';
require 'bootstrap/dependencies.php';

function getConnection() {
	global $server, $database, $user, $password;

	$dbh = new PDO("mysql:host=$server;dbname=$database", $user, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

$app->group('/', function() use ($app) {
	require 'site/routes/site.php';
});

$app->group('/api', function() use ($app) {
	require 'api/routes/users.php';
	// require 'api/routes/movies.php';
	require 'api/routes/web.php';
	// require 'api/routes/plugins.php';
	// require 'api/routes/games.php';
	$app->get('/doc/', function ($req, $res, $args) {
		return $this->docrender->render($res, 'index.phtml', $args);
	});
});

$app->run();
