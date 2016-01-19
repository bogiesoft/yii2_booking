<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ToursMetaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tours-meta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tour_id') ?>

    <?= $form->field($model, 'tour_key') ?>

    <?= $form->field($model, 'tour_value') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'order_sort') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
