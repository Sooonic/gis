<?php


namespace gis\yii\web;


use gis\yii\web\behaviors\ResponseBeforeSaveBehavior;

class Response extends \yii\web\Response
{

    public $dataErrors = [];

    public function behaviors()
    {
        return [
            'beforeSave' => [
                'class' => ResponseBeforeSaveBehavior::className(),
            ]
        ];
    }
}