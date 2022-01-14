<?php
/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller;
use App\Core\Middlewares\AuthMiddleware;
use App\Core\Request;
use App\Core\Response;
use App\Models\Contact;
use App\Models\Login;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function home()
    {
        $params = [
            'name' => 'Stephen',
        ];

        return $this->renderView('index', $params);
    }

    public function profile()
    {
        return $this->renderView('profile');
    }

    public function contact(Request $request, Response $response)
    {
        $this->setLayout('main');

        $contact = new contact();
        if($request->IsPost()){
            $contact -> loadData($request->getBody());
            if($contact->validate() && $contact->send()){
                Application::$app->session->setFlash('success', 'Thanks for Contacting Us');
                return $response->redirect('/contact');
            }

            return $this->renderView('contact', [
                'model' => $contact
            ]);
        }
        return $this->renderView('contact', [
            'model' => $contact
        ]);
    }
}