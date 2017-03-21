<?php
namespace api\controllers;

use api\forms\site\LoginForm;
use api\models\Test;
use Yii;
use yii\rest\Controller;
use yii\web\ServerErrorHttpException;

class SiteController extends Controller
{

    public $modelClass = '';

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'login' => ['POST'],
        ];
    }

    public function init()
    {
        $this->modelClass = Test::className();
        parent::init();
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->login() === false) {
            if (!$model->hasErrors()) {
                throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
            }
            Yii::$app->response->dataErrors = $model->getErrors();
            Yii::$app->response->setStatusCode(400);
            return [];
        }

        return [
            'token' => $model->getUser()->getAuthKey(),
        ];
    }
}
