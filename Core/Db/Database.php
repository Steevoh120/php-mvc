<?php
/*
 * Copyright (c) 2022.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Core\Db;

use App\Core\Application;

class Database
{
public \PDO $pdo;
    public function __construct(array $config)
    {
        $dsn = $config['dsn'];
        $user = $config['user'];
        $password = $config['password'];
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function prepare($sql){
        return Application::$app->db->pdo->prepare($sql);
    }
}