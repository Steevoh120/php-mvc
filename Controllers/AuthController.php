<?php
/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Login;
use App\Models\User;


class AuthController extends Controller
{
    public function login(Request $request, Response $response)
    {
        $this->setLayout('auth');

        $login = new Login();
        if($request->IsPost()){
            $login -> loadData($request->getBody());
            if($login->validate() && $login->Login()){
               $response->redirect('/');
               return;
            }

            return $this->renderView('login', [
                'model' => $login
            ]);
        }
        return $this->renderView('login', [
            'model' => $login
        ]);
    }

    public function register(Request $request, Response $response)
    {
        $this->setLayout('auth');
        $user = new User();
        if ($request->IsPost()) {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'Thanks for Registering');
                Application::$app->response->redirect('/');
                exit;
            }

            return $this->renderView('register', [
                'model' => $user
            ]);
        }
        return $this->renderView('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
}

