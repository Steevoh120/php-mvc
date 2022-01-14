<?php
/*
 * Copyright (c) 2022.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

use App\Core\form\Form;
use App\Core\form\RadioField;
use App\Core\form\SelectFields;
use App\Core\View;
use App\Models\Contact;
use App\Core\form\TextareaField;
/**
 * @var  $this View
 * @var $model Contact
 */
$this->title = 'Contact';
?>
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-6">

            <?php $form = Form::begin('/contact', 'post'); ?>

            <?php echo $form->field($model, 'email'); ?>
            <?php echo $form->field($model, 'subject'); ?>
            <?php echo new TextareaField($model, 'body'); ?>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            <?php Form::end(); ?>
        </div>
    </div>
</div>
