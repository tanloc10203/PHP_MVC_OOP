<?php

namespace app\core;

use app\core\middleware\AuthMiddleware;
use app\core\middleware\BaseMiddleware;

class Controller
{
  public string $layout = 'main';
  public string $action = '';
  protected array $middleware = [];

  public function __construct()
  {
    $this->registerMiddleware(new AuthMiddleware(['profile']));
  }

  public function render($view, $params = [])
  {
    return Application::$app->view->renderView($view, $params);
  }

  public function setLayout($layout)
  {
    $this->layout = $layout;
  }

  public function registerMiddleware(BaseMiddleware $middleware)
  {
    $this->middleware[] = $middleware;
  }

  public function getMiddleware(): array
  {
    return $this->middleware;
  }
}
