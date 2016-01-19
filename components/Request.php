<?php
/**
 * Created by PhpStorm.
 * User: serglutsk81@gmail.com
 * Date: 18.01.16
 * Time: 14:04
 */
namespace app\components;

class Request extends \yii\web\Request
{
    public $web;


    public function getBaseUrl()
    {
        return str_replace($this->web, "", parent::getBaseUrl()) ;
    }


}