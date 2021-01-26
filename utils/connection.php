<?php

try {
	$pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', 'mysql');
} catch (PDOException $e) {
	exit('Database error.');
};
