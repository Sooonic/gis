<?php
namespace gii\yii\rest;

use gis\yii\base\ActiveForm;
use gis\yii\rest\Action;
use Yii;
use yii\web\ServerErrorHttpException;

class CreateAction extends Action
{
    /**
     * @var string the scenario to be assigned to the new model before it is validated and saved.
     */
    public $scenario = ActiveForm::SCENARIO_CREATE;


    /**
     * Creates a new model.
     * @return \yii\db\ActiveRecordInterface the model newly created
     * @throws ServerErrorHttpException if there is any error when creating the model
     */
    public function run()
    {
        /* @var $model ActiveForm */
        $model = new $this->modelClass([
            'scenario' => $this->scenario,
        ]);

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $model->view;
    }
}
