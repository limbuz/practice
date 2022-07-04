<?php

use app\models\Lookup;
use app\models\Post;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--?= $form->field($model, 'id')->textInput() ?-->

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <?php if (User::isAdmin()): ?>
        <?= $form->field($model,'status')->dropDownList(Lookup::items('PostStatus')); ?>
    <?php endif; ?>

    <!--?= $form->field($model, 'create_time')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'update_time')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'author_id')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
