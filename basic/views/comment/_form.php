<?php

use app\models\Lookup;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */
/* @var $form yii\widgets\ActiveForm */
/* @var $post */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin([
            'id' => "comment-form",
            'enableAjaxValidation' => true,
    ]); ?>

    <!--?= $form->field($model, 'id')->textInput() ?-->

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model,'status')->dropDownList(Lookup::items('CommentStatus')); ?>

    <!--?= $form->field($model, 'create_time')->textInput() ?-->

    <!--?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?-->

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'post_id')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
