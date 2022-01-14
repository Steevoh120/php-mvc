<?php
/*
 * Copyright (c) 2022.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Core\Middlewares;

abstract class BaseMiddleware
{
    abstract public function execute();
}