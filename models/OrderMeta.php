<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_order_meta".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $meta_id
 * @property string $meta_val
 *
 * @property ToursMeta $meta
 * @property Orders $order
 */
class OrderMeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_order_meta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'meta_id', 'meta_val'], 'required'],
            [['order_id', 'meta_id'], 'integer'],
            [['meta_val'], 'string', 'max' => 255],
            [['meta_id'], 'exist', 'skipOnError' => true, 'targetClass' => ToursMeta::className(), 'targetAttribute' => ['meta_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'meta_id' => 'Meta ID',
            'meta_val' => 'Meta Val',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeta()
    {
        return $this->hasOne(ToursMeta::className(), ['id' => 'meta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }
}
