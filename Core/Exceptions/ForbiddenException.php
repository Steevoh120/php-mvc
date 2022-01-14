<?php
/*
 * Copyright (c) 2022.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Core\Exceptions;

class ForbiddenException extends \Exception
{
    protected $code = '403';
    protected $message  = 'You don\'t have Permission To access this Page';
}