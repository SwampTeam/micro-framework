<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = include __DIR__ .'/../config/config.php';

Database\DBConnection::setConnection($config['DB']);
$pdo = Database\DBConnection::getConnection();