<?php
namespace nemozar\yii2ActionLog\traits;

use Yii;

trait LogsTrait
{

    public function beforeAction($action)
    {
        $url = Yii::$app->request->url;
        return parent::beforeAction($action);
    }
}