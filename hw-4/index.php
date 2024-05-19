<?php

use articles\Controller as ArticleController;
use exceptions\Controller as ExceptionController;
use exceptions\FatalException;
use exceptions\ForbiddenException;
use exceptions\NotFoundException;
use system\IController;
use system\Router;

include_once('init.php');

function callController(IController $controller, string $method) {

    $controller->$method();
    return $controller->render();
}

const BASE_URL = '/php2/hw-4/';
$router = new Router(BASE_URL);

$router->addRoute('', ArticleController::class);
$router->addRoute('article/1', ArticleController::class, 'item');
$router->addRoute('article/2', ArticleController::class, 'item'); // e t.c post/99, post/100 lol :))
$router->addRoute('article/3', ArticleController::class, 'item'); // e t.c post/99, post/100 lol :))


try {
    $uri = $_SERVER['REQUEST_URI'];
    $activeRoute = $router->resolvePath($uri);

    echo callController($activeRoute['controller'], $activeRoute['method']);
} catch (NotFoundException) {
    echo callController(new ExceptionController(), 'notFound');
} catch (FatalException) {
    echo callController(new ExceptionController(), 'fatal');
} catch (ForbiddenException) {
    echo callController(new ExceptionController(), 'forbidden');
}

?>
<hr>
Menu
<a href="<?= BASE_URL ?>">Home</a>
<a href="<?= BASE_URL ?>article/1">Art 1</a>
<a href="<?= BASE_URL ?>article/2">Art 2</a>