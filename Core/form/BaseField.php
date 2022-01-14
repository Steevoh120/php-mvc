<?php
/*
 * Copyright (c) 2022.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Core\form;

use App\Models\BaseModel;

abstract class BaseField
{
    public BaseModel $model;
    public string $attribute;
    /**
     * @param BaseModel $model
     * @param string $attribute
     */
    public function __construct(BaseModel $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    abstract public function renderInput(): string;

    public function __toString()
    {
        return sprintf('
                    <div class="form-group">
                        <label class="form-label">%s</label>
                           %s
                        <div class="invalid-feedback">
                            %s
                        </div>
                    </div>',
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}