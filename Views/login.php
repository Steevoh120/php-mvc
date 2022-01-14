<?php
use App\Core\form\Form;
/** @var  $model */
$this->title = 'Login';
?>
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">

            <?php $form = Form::begin('/login', 'post'); ?>

            <?php echo $form->field($model, 'email'); ?>
            <?php echo $form->field($model, 'password')->PasswordInput(); ?>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            <?php Form::end(); ?>
        </div>
    </div>
</div>
