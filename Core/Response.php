<?php
/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Core;

class Response
{
    public function setStatusCode (int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        header('Location:'.$url);
    }

}