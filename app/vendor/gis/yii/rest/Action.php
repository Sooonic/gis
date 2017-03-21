<?php
namespace gis\yii\rest;

use gis\yii\base\ActiveForm;
use yii\base\InvalidConfigException;
use yii\web\NotFoundHttpException;

abstract class Action extends \yii\base\Action
{

    /**
     * @var ActiveForm
     */
    public $modelClass;

    abstract public function run();

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if ($this->modelClass === null) {
            throw new InvalidConfigException(get_class($this) . '::$modelClass must be set.');
        }
        if (!($this->modelClass instanceof ActiveForm)) {
            throw new InvalidConfigException(get_class($this)
                . '::$modelClass must be instanced from '
                . ActiveForm::className());
        }
    }

    public function findModel($id): ActiveForm
    {
        $modelClass = $this->modelClass;
        $keys = $modelClass::primaryKey();
        if (count($keys) > 1) {
            $values = explode(',', $id);
            if (count($keys) === count($values)) {
                $model = $modelClass::findOne(array_combine($keys, $values));
            }
        } elseif ($id !== null) {
            $model = $modelClass::findOne($id);
        }

        if (isset($model)) {
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
}