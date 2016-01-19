<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tours */

$this->title = 'Update Tours: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tours-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tour_meta' => $tour_meta,
    ]) ?>

</div>
