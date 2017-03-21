<?php
/**
 * @author Stepan Okhorzin <stepan.okhorzin@gmail.com>
 * Date: 3/7/17
 * Time: 3:50 PM
 */
namespace gis\yii\db\activerecord;


use yii\helpers\StringHelper;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public static function getAlias()
    {
        return StringHelper::basename(static::className());
    }

    public static function find()
    {
        return parent::find()->from([static::getAlias() => static::tableName()]);
    }
}