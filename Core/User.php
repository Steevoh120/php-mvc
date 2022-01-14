<?php
/*
 * Copyright (c) 2022.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Core;

use App\Core\Db\DbModel;

abstract class User extends DbModel
{

    abstract public function DisplayName(): string;
}