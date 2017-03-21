<?php
namespace gis\yii\rest;

use yii\web\ForbiddenHttpException;

class ActiveController extends \yii\rest\ActiveController
{

    public function checkAccess($action, $model = null, $params = [])
    {
        parent::checkAccess($action, $model, $params);
        if (!\Yii::$app->user->can('route', [
            'route' => static::getControllerPermissionName() . '.' . $action,
        ])
        ) {
            throw new ForbiddenHttpException('You do not have access to this action', 403);
        }
    }

    public function beforeAction($action)
    {
        $this->checkAccess($this->action->id);
        return parent::beforeAction($action);
    }
}