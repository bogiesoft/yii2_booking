<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tours".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Orders[] $orders
 * @property ToursMeta[] $toursMetas
 */
class Tours extends \yii\db\ActiveRecord
{
    public static  $required_fields=['count_adults','count_children','count_babies'];
    protected  $is_insert=false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tours';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToursMetas()
    {
        return $this->hasMany(ToursMeta::className(), ['tour_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if($this->isNewRecord){
                $this->is_insert=true;
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if($this->is_insert){
            foreach(self::$required_fields as $f){

                $tour_meta=new ToursMeta();
                $tour_meta->tour_id=$this->id;
                $tour_meta->tour_key=$f;
                $tour_meta->tour_value='int';
                $tour_meta->description=str_replace('_',' ',$f);
                $tour_meta->save();
            }
        }
    }
}
