<?php
/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Core\form;

use App\Models\BaseModel;

class Form
{
    public static function begin ($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end ()
    {
        echo '</form> ';
    }

    public function field(BaseModel $model, $attribute)
    {
        return new InputField($model, $attribute);
    }
}