<?php

use app\models\City;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
/* @var $data string */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_city')->widget(AutoComplete::className(), [
            'clientOptions' => [
                    'source' => new JsExpression("
                        function( request, response ) {
                            response( $.ui.autocomplete.filter(" . $data . ", request.term.split( /,\s*/ ).pop()) );
                        }"),
                    'autoFill' => true,
	                'select' => new JsExpression("
	                    function( event, ui ) {
                            var terms = this.value.split( /,\s*/ );
                            terms.pop();
                            terms.push( ui.item.value );
                            terms.push( '' );
                            this.value = terms.join( ', ' );
                            return false;
                        }"),
            ],
            'options' => [
                    'class' => 'form-control'
            ]
    ]) ?>

    <?php $this->registerJs('console.log(' . $data . ')') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rating')->dropDownList([1, 2, 3, 4, 5]) ?>

    <?= $form->field($model, 'img')->fileInput() ?>

    <!--?= $form->field($model, 'id_author')->textInput() ?-->

    <!--?= $form->field($model, 'date_create')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
