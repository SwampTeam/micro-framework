<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = include __DIR__ .'/../config/local-config.php';

Database\DBConnection::setConnection($config['DB']);
