<?php

use App\Controllers\PokeController;
use App\Controllers\UserController;
use App\Helper;
use FastRoute\RouteCollector;

define('ROOT_PATH', dirname(__DIR__));

require_once ROOT_PATH . '/vendor/autoload.php';

(Dotenv\Dotenv::createImmutable(ROOT_PATH))->load();

date_default_timezone_set('Europe/Vilnius');

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', PokeController::class . '/index');
    $r->addGroup('/user', function (RouteCollector $r) {
        $r->addRoute('POST', '/register', UserController::class . '/register');
        $r->addRoute('POST', '/login', UserController::class . '/login');
        $r->addRoute('POST', '/edit', UserController::class . '/edit');
        $r->addRoute('POST', '/logout', UserController::class . '/logout');
    });
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo Helper::responseError('Maršrutas nerastas.');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo Helper::responseError('Metodas neleidžiamas.');
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        list($class, $method) = explode('/', $handler, 2);
        echo call_user_func_array([new $class, $method], $vars);
        break;
}