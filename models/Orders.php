<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_orders".
 *
 * @property integer $id
 * @property integer $tour_id
 * @property string $created
 * @property integer $user_id
 *
 * @property OrderMeta[] $orderMetas
 * @property Tours $tour
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tour_id', 'created', 'user_id'], 'required'],
            [['tour_id', 'user_id'], 'integer'],
            [['created'], 'safe'],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tours::className(), 'targetAttribute' => ['tour_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tour_id' => 'Tour ID',
            'created' => 'Created',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderMetas()
    {
        return $this->hasMany(OrderMeta::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tours::className(), ['id' => 'tour_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->created = date('Y-m-d',strtotime($this->created));


            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        $this->created = Yii::$app->formatter->asDate($this->created);


    }
}
