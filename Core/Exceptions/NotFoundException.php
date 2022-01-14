<?php
/*
 * Copyright (c) 2022.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Core\Exceptions;

class NotFoundException extends \Exception
{
    protected $code = '404';
    protected $message  = 'Page Not Found';
}