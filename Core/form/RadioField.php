<?php
/*
 * Copyright (c) 2022.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Core\form;

class RadioField extends BaseField
{

    public function renderInput(): string
    {
        return sprintf('<input type="radio" name="%s" value="%s"> %s',
            '',
            '',
            'Male'
        );
    }
}