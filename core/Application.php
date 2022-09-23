<?php

namespace app\core;

use app\core\db\Database;
use app\models\User;

class Application
{
  public static string $ROOT_DIR;
  public static Application $app;

  public string $layout = 'main';
  public string $userClass;

  public Router $router;
  public Request $request;
  public Response $response;
  public Session $session;
  public Database $db;

  public ?User $user;
  public ?Controller $controller = null;
  public View $view;

  public function __construct($rootPath, array $config)
  {
    $this->userClass = $config['userClass'];
    self::$ROOT_DIR = $rootPath;
    self::$app = $this;

    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
    $this->db = new Database($config['db']);
    $this->session = new Session();
    $this->view = new View();

    $primaryValue = $this->session->get('user');
    if ($primaryValue) {
      $newUserClass = new $config['userClass']();
      $primaryKey = $newUserClass->primaryKey();
      $this->user = $newUserClass->findOne([$primaryKey => $primaryValue]);
    } else {
      $this->user = null;
    }
  }

  public function run()
  {
    try {
      echo $this->router->resolve();
    } catch (\Exception $e) {
      $this->response->setStatusCode($e->getCode());
      echo $this->view->renderView('_error', [
        'exception' => $e
      ]);
    }
  }

  public function login(User $user)
  {
    $this->user = $user;
    $primaryKey = $user->primaryKey();
    $primaryValue = $user->{$primaryKey};
    $this->session->set('user', $primaryValue);
    return true;
  }

  public function logout()
  {
    $this->user = null;
    $this->session->remove('user');
  }

  public static function isGuest()
  {
    return !self::$app->user;
  }
}
