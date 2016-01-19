<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?= Html::label('Tour name') ?>
        <h3><?= $tour->title ?></h3>

    </div>

    <?=
    $form->field($model, 'created')->widget(DatePicker::className(), ['clientOptions' => ['defaultDate' => date('d.m.Y')],
        'dateFormat' => 'dd.MM.yyyy',
        'language' => 'ru',

    ]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>
    <?php if ($model->isNewRecord) {
        foreach ($tour_meta as $meta) {
            ?>
            <div class="form-group">
                <?=
                Html::label($meta->description);
                echo Html::input($meta->tour_value == 'int' ? 'number' : '', 'Meta[' . $meta->id . ']', !empty($_POST["Meta[$meta->id]"])?Html::encode($_POST["Meta[$meta->id]"]):'', ['class' => 'form-control', 'required' => 'required']);?>
            </div>
        <?php
        }
    } else {
        foreach ($order_meta as $meta) {
            ?>
            <div class="form-group">
                <?=
                Html::label($meta->meta->description);
                echo Html::input($meta->meta->tour_value == 'int' ? 'number' : '', 'Meta[' . $meta->meta->id . ']', $meta->meta_val, ['class' => 'form-control', 'required' => 'required']);?>
            </div>
        <?php }
    } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
