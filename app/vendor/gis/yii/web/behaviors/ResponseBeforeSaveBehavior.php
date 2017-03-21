<?php
namespace gis\yii\web\behaviors;

use Yii;
use yii\base\Behavior;
use yii\web\Response;

class ResponseBeforeSaveBehavior extends Behavior
{

    public function events()
    {
        return [
            Response::EVENT_BEFORE_SEND => 'beforeSend',
        ];
    }

    public function beforeSend($event)
    {
        /**
         * @var \gis\yii\web\Response $response
         */
        $response = $event->sender;

        $response->data = [
            'success' => $response->isSuccessful,
            'data' => $response->data,
            'errors' => $response->dataErrors,
        ];
        if ($response->data !== null && Yii::$app->request->get('suppress_response_code')) {
            $response->statusCode = 200;
        }
    }
}