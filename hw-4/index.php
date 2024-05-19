<?php

use articles\Controller;
use system\Router;

include_once('init.php');

const BASE_URL = '/php2/hw-4/';
$router = new Router(BASE_URL);

$router->addRoute('', Controller::class);
$router->addRoute('article/1', Controller::class, 'item');
$router->addRoute('article/2', Controller::class, 'item'); // e t.c post/99, post/100 lol :))

$uri = $_SERVER['REQUEST_URI'];
$activeRoute = $router->resolvePath($uri);

$c = $activeRoute['controller'];
$m = $activeRoute['method'];

$c->$m();
$html = $c->render();
echo $html;
?>
<hr>
Menu
<a href="<?=BASE_URL?>">Home</a>
<a href="<?=BASE_URL?>article/1">Art 1</a>
<a href="<?=BASE_URL?>article/2">Art 2</a>