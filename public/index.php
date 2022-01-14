<?php

/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

use App\Core\Application;
use App\Controllers\SiteController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;

require_once __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    'userClass' => \App\Models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];
$app = new Application(dirname(__DIR__), $config);

function extracted(Application $app): void
{
    $app->route->get('/', [HomeController::class, 'home']);
    $app->route->get('/home', [HomeController::class, 'home']);
    $app->route->get('/login', [AuthController::class, 'login']);
    $app->route->post('/login', [AuthController:: class, 'login']);
    $app->route->get('/register', [AuthController::class, 'register']);
    //$app->route->get('/register/([a-zA-Z]+) ', [AuthController::class, 'serve']);
    $app->route->post('/register', [AuthController::class, 'register']);
    $app->route->get('/contact', [HomeController::class, 'contact']);
    $app->route->post('/contact', [HomeController::class, 'contact']);
    $app->route->get('/logout', [AuthController::class, 'logout']);
    $app->route->get('/profile', [HomeController::class, 'profile']);
    $app->route->post('/profile', [HomeController::class, 'profile']);
    $app->route->post('/pay', [App\Controllers\Payments\Mpesa::class, 'lnmo']);

}

extracted($app);
$app->run();