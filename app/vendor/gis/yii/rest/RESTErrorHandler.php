<?php


namespace gis\yii\rest;

use gis\yii\web\Response;
use Yii;
use yii\web\ErrorHandler;
use yii\web\HttpException;

class RESTErrorHandler extends ErrorHandler
{

    protected function renderException($exception)
    {
        /**
         * @var $response Response
         */
        $response = Yii::$app->getResponse();
        $response->data = [];
        $response->dataErrors = [$this->convertExceptionToArray($exception)];
        if($exception instanceof HttpException) {
            $response->setStatusCode($exception->statusCode);
        } else {
            $response->setStatusCode(400);
        }
        $response->send();
    }
}