<?php

use app\models\Lookup;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */
/* @var $form yii\widgets\ActiveForm */
/* @var $post app\models\Post */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(['action' => ['comment/create']]); ?>

    <!--?= $form->field($model, 'id')->textInput() ?-->

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?php if (User::isAdmin()): ?>
        <?= $form->field($model,'status')->dropDownList(Lookup::items('CommentStatus')); ?>
    <?php endif ?>

    <!--?= $form->field($model, 'create_time')->textInput() ?-->

    <!--?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?-->

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_id', ['template' => '{input}'])->textInput(['value' => $post->id, 'type' => 'hidden']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
