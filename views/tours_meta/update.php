<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ToursMeta */

$this->title = 'Update Tours Meta: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tours Metas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tours-meta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,

    ]) ?>

</div>
