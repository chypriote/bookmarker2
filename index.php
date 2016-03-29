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

require 'bootstrap/routes.php';

$app->run();
