<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ToursSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tours';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tours-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tours', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {order}',
                'buttons' => [
                    'update' => function ($url,$model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                $url,['target'=>'_blank']);
                        },
                    'order' => function ($url,$model,$key) {
                            return Html::a('<span >Create order</span>', '/web/orders/create?tour_id='.$model->id,['class'=>'view_m','data-id'=>$model->id]);
                        },
                ],
            ],
        ],
    ]); ?>
</div>
