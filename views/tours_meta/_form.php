<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\ToursMeta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tours-meta-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?=Html::label('Tour name')?>
    <?= Html::activeDropDownList($model, 'tour_id',
        ArrayHelper::map(\app\models\Tours::find()->all(), 'id', 'title'),['class'=>'form-control']) ?>
    </div>

    <?= $form->field($model, 'tour_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tour_value')->dropDownList(
                [
                    'int' => 'Integer',
                    'string' => 'String',

                ]

            ); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
