<?php
use App\Core\form\Form;
/** @var  $model  */
$this->title = 'Register';
?>
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            
            <?php $form = Form::begin('/register', 'post'); ?>
            <?php echo $form->field($model, 'firstname'); ?>
            <?php echo $form->field($model, 'lastname'); ?>
            <?php echo $form->field($model, 'email'); ?>
            <?php echo $form->field($model, 'password')->PasswordField(); ?>
            <?php echo $form->field($model, 'confirmpassword')->PasswordField(); ?>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            <?php Form::end(); ?>
        </div>
    </div>
</div>
 