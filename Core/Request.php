<?php
/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if($position === false){
            return $path;
        }
        return $path = substr($path, 0, $position);

    }

    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function IsGet(): string
    {
        return $this->method() === 'get';
    }

    public function IsPost(): string
    {
        return $this->method() === 'post';
    }

    public function getBody(): array
    {
        $body = [];

        if($this->method() === 'get'){
            foreach ($_GET as $key => $value){
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }
        if($this->method() === 'post'){
            foreach ($_POST as $key => $value){
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}