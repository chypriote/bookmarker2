<?php

require 'api/utils/users.php';

$app->group('/users', function () {
	//get users list
	$this->get('', function($req, $res, $args) {
		$sql = "select * FROM users";
		try {
			$db = getConnection();
			$stmt = $db->query($sql);
			$users = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			return $res->withStatus(200)->write(json_encode($users));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	})->setName('users');

	//get user with id
	$this->get('/{id}', function($req, $res, $args){
		$id = $args['id'];
		$sql = "SELECT * FROM users WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$user = $stmt->fetchObject();
			$db = null;
			return $res->withStatus(200)->write(json_encode($user));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	//post new user
	$this->post('', function($req, $res, $args) {
		$user = $req->getParsedBody();
		$sql = "INSERT INTO users (first, second, third) VALUES (:first, :second, :third)";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("first", $user['first']);
			$stmt->bindParam("second", $user['second']);
			$stmt->bindParam("third", $user['third']);
			$stmt->execute();
			$user['id'] = $db->lastInsertId();
			$db = null;
			return $res->withStatus(200)->write(json_encode($user));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	// update user with id
	$this->put('/{id}', function($req, $res, $args) {
		$id = $args['id'];
		$user = $req->getParsedBody();
		$sql = "UPDATE users SET 'first'=:first, 'second'=:second, 'third'=:third WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("first", $user['first']);
			$stmt->bindParam("second", $user['second']);
			$stmt->bindParam("third", $user['third']);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$db = null;
			return $res->withStatus(200)->write(json_encode($user));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	//delete user with id
	$this->delete('/{id}', function($req, $res, $args) {
		$id = $args['id'];
		$sql = "DELETE FROM users WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$db = null;
			return $res->withStatus(200);
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});
});