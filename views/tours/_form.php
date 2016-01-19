<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tours */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tours-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


<?php if(!$model->isNewRecord){
    foreach($tour_meta as $meta){?>
    <div class="form-group">
        <?=Html::label($meta->description.' "position"');
       echo Html::input('number','Meta['.$meta->tour_key.']',$meta->order_sort,['class'=>'form-control']);?>
        </div>
  <?php  }
}?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
