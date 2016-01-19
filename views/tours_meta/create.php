<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ToursMeta */

$this->title = 'Create Tours Meta';
$this->params['breadcrumbs'][] = ['label' => 'Tours Metas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tours-meta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
