<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tours_meta".
 *
 * @property integer $id
 * @property integer $tour_id
 * @property string $tour_key
 * @property string $tour_value
 * @property string $description
 * @property integer $order_sort
 *
 * @property OrderMeta[] $orderMetas
 * @property Tours $tour
 */
class ToursMeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tours_meta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tour_id', 'tour_key', 'tour_value', 'description',], 'required'],
            [['tour_id', 'order_sort'], 'integer'],
            [['tour_key'], 'string', 'max' => 50],
            [['tour_value', 'description'], 'string', 'max' => 255],
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
            'tour_key' => 'Tour Key',
            'tour_value' => 'Tour Value',
            'description' => 'Description',
            'order_sort' => 'Order Sort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderMetas()
    {
        return $this->hasMany(OrderMeta::className(), ['meta_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tours::className(), ['id' => 'tour_id']);
    }
    public function getFields($id)
    {
        return self::find()
        ->where('tour_id=:tour_id',[':tour_id'=>$id])
        ->orderBy(['order_sort'=>SORT_ASC])
        ->all();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if(empty($this->order_sort)){
                $this->order_sort=1;
            }
            return true;
        } else {
            return false;
        }
    }
}
