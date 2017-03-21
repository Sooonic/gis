<?php
namespace api\models;


use gis\yii\db\activerecord\ActiveRecord;

class Test extends ActiveRecord
{

    public static function tableName()
    {
        return 'test';
    }
}