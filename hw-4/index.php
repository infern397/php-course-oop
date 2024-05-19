<?php

use articles\Controller as ArticleController;
use exceptions\FatalException;
use exceptions\NotFoundException;
use system\Router;

include_once('init.php');

const BASE_URL = '/php2/hw-4/';
$router = new Router(BASE_URL);

$router->addRoute('', ArticleController::class);
$router->addRoute('qwe', FatalException::class);
$router->addRoute('article/1', ArticleController::class, 'item');
$router->addRoute('article/2', ArticleController::class, 'item'); // e t.c post/99, post/100 lol :))
$router->addRoute('article/3', ArticleController::class, 'item'); // e t.c post/99, post/100 lol :))

try {
    $uri = $_SERVER['REQUEST_URI'];
    $activeRoute = $router->resolvePath($uri);

    $c = $activeRoute['controller'];
    $m = $activeRoute['method'];

    $c->$m();
    $html = $c->render();
    echo $html;
} catch (NotFoundException) {
    echo "<h1>Error 404</h1><div>Page not found</div>";
} catch (FatalException) {
    echo "<h1>Error 500</h1><div>FatalException</div>";
}

?>
<hr>
Menu
<a href="<?= BASE_URL ?>">Home</a>
<a href="<?= BASE_URL ?>article/1">Art 1</a>
<a href="<?= BASE_URL ?>article/2">Art 2</a>