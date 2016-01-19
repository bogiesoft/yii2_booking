<?php

namespace app\controllers;

use app\models\OrderMeta;
use Yii;
use app\models\Orders;
use app\models\ToursMeta;
use app\models\Tours;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tour_id)
    {
        $model = new Orders();
        $tour_meta = new ToursMeta();
        $tour_meta = $tour_meta->getFields($tour_id);
        $tour = Tours::findOne($tour_id);
        $model->created = date('d.m.Y');
        $model->tour_id = $tour_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach ($_POST['Meta'] as $meta => $val) {
                $order_meta = new OrderMeta();
                $order_meta->order_id = $model->id;
                $order_meta->meta_id = $meta;
                $order_meta->meta_val = $val;
                if (!$order_meta->save()) {
                    return $this->render('create', [
                        'model' => $model,
                        'tour_meta' => $tour_meta,
                        'tour' => $tour,
                    ]);


                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'tour_meta' => $tour_meta,
                'tour' => $tour,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tour = Tours::findOne($model->tour_id);
        $order_meta = OrderMeta::find()
            ->where('order_id=:order_id', [':order_id' => $id])
            ->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach ($_POST['Meta'] as $meta => $val) {
                $order_meta = OrderMeta::find()
                    ->where('order_id=:order_id', [':order_id' => $model->id])
                    ->andWhere('meta_id=:meta_id', [':meta_id' => $meta])
                    ->one();

                $order_meta->meta_val = $val;
                if (!$order_meta->save()) {
                    return $this->render('update', [
                        'model' => $model,
                        'order_meta' => $order_meta,
                        'tour' => $tour,
                    ]);

                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'order_meta' => $order_meta,
                'tour' => $tour,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
