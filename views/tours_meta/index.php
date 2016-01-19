<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ToursMetaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tours Metas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tours-meta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tours Meta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tour_id',
            'tour_key',
            'tour_value',
            'description',
             'order_sort',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
