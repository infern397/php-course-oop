<?php
namespace system;

use exceptions\FatalException;
use exceptions\NotFoundException;

class Router{
	protected string $baseUrl;
	protected int $baseShift;
	protected array $routes = [];

	public function __construct(string $baseUrl = ''){
		$this->baseUrl = $baseUrl;
		$this->baseShift = strlen($this->baseUrl);
	}

	public function addRoute(string $url, string $controllerName, string $controllerMethod = 'index'){
		$this->routes[] = [
			'path' => $url,
			'c' => $controllerName,
			'm' => $controllerMethod
		];
	}

	public function resolvePath(string $url) : array{
		$relativeUrl = substr($url, $this->baseShift);
		$route = $this->findPath($relativeUrl);
        if ($route == null) {
            throw new NotFoundException('404 Error');
        }
		$params = explode('/', $relativeUrl);
		$controller = new $route['c']();
        if (!($controller instanceof IController)) {
            throw new FatalException('Wrong type of controller');
        }
		$controller->setEnvironment($params);
		return [
			'controller' => $controller,
			'method' => $route['m']
		];
	}

	protected function findPath(string $url) : ?array{
		$activeRoute = null;

		foreach($this->routes as $route){
			if($url === $route['path']){
				$activeRoute = $route;
			}
		}

		return $activeRoute;
	}
}