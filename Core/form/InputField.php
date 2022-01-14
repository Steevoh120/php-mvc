<?php
/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Core\form;

use App\Models\BaseModel;

class InputField extends BaseField
{
    public const INPUT_TEXT = 'text';
    public const INPUT_PASSWORD = 'password';
    public const INPUT_NUMBER = 'number';
    public const INPUT_URL = 'url';
    public const INPUT_RADIO = 'radio';
    public const INPUT_CHECKBOX = 'checkbox';

    public BaseModel $model;
    public string $attribute;
    public string  $type;

    /**
     * @param BaseModel $model
     * @param string $attribute
     */
    public function __construct(BaseModel $model, string $attribute)
    {
        $this->type = self::INPUT_TEXT;
        parent::__construct($model, $attribute);
    }


    public function PasswordInput()
    {
        $this->type = self::INPUT_PASSWORD;
        return $this;
    }

    public function RadioInput()
    {
        $this->type = self::INPUT_RADIO;
        return $this;
    }

    public function CheckboxInput()
    {
        $this->type = self::INPUT_CHECKBOX;
        return $this;
    }

    public function UrlInput()
    {
        $this->type = self::INPUT_URL;
        return $this;
    }

    public function numberInput()
    {
        $this->type = self::INPUT_NUMBER;
        return $this;
    }


    public function renderInput(): string
    {
        return sprintf('<input type="%s" name="%s" value="%s" class="form-control%s">',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
        );
    }
}