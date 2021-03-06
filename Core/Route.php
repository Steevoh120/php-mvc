<?php
namespace  App\Core;
/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

use App\Core\Exceptions\ForbiddenException;
use App\Core\Exceptions\NotFoundException;
use function Composer\Autoload\includeFile;

class Route
{
    public Request $request;
    public Response $response;
    protected array  $routes = [];

    /**
     * @param Request $request
     * @param Response $response
     */

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback){
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback){
        $this->routes['post'][$path] = $callback;
    }


    public function resolve()
    {
       $path =  $this->request->getPath();
       $method = $this->request->method();

       $callback = $this->routes[$method][$path] ?? false;

       if($callback === false){
           $this->response->setStatusCode(404);
           throw new NotFoundException();
       }

       if(is_string($callback)){
           return  Application::$app->view->renderView($callback);
       }
       if(is_array($callback)){
           /**
            * @var \App\Core\Controller $controller
            */
           $controller = new $callback[0]();
           Application::$app->controller = $controller;
           $controller->action = $callback[1];
           $callback[0] = $controller;

           foreach ($controller->getMiddlwares() as $middleware){
               $middleware->execute();
           }
       }
       return call_user_func($callback, $this->request, $this->response);
    }

}