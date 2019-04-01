<?php
require_once __DIR__ . '/../src/bootstrap.php';

use Model\ParkPlace;

$pathInfo = substr($_SERVER['REQUEST_URI'], strlen($_SERVER['BASE']));
if (strpos($pathInfo, '?')) {
    $pathInfo = substr($pathInfo, 0, strpos($pathInfo, '?'));
}
if (strpos($pathInfo, '#')) {
    $pathInfo = substr($pathInfo, 0, strpos($pathInfo, '#'));
}

switch ($pathInfo) {
    case '/':
    case '':
        (new ParkPlace())->homepageAction();
        return;
    case '/update':
        (new ParkPlace())->updateAction();
        return;
    case '/delete':
        (new ParkPlace())->deleteAction();
        return;
    case '/create':
        (new ParkPlace())->createAction();
        return;
    default:
        include __DIR__ . '/404.html';
}