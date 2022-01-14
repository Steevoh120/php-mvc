<?php

namespace  App\Core;

/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

use App\Core\Db\Database;
use App\Core\Db\DbModel;

class Application
{
    public string $layout = 'main';
    public string $userClass;
    public Route $route;
    public static string  $ROOT_DIR;
    public Request $request;
    public Response $response;
    public Database $db;
    public Session $session;
    public static Application $app;
    public ?Controller $controller = null   ;
    public View $view;
    Public ?User $user;

    public static function isGuest(): bool
    {
        return !self::$app->user;
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Route($this->request, $this->response);
        $this->view = new View();
        $this->db = new Database($config['db']);
        $this->session = new Session();

        $Primaryvalue = $this->session->get('user');

        if($Primaryvalue){
            $PrimaryKey = (new $this->userClass())->primaryKey();
            $this->user = (new $this->userClass())->findOne([$PrimaryKey => $Primaryvalue]);
        }else{
            $this->user = null;
        }

    }

    public function run()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        try {
            echo  $this->route->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            $this->response->setStatusCode(403);
            echo Application::$app->view->renderView('_error', [
                'exception' => $e
            ]);

        }
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primary_key = $user->primaryKey();
        $primary_value = $user->{$primary_key};
        $this->session->set('user', $primary_value);

        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}
