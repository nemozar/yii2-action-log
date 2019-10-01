<?php
namespace nemozar\yii2ActionLog\traits;

use nemozar\yii2ActionLog\models\ActionLogs;
use Yii;

trait LogsTrait
{

    public function beforeAction($action)
    {
        try {
            if (Yii::$app->getModule('logs') && Yii::$app->getModule('logs')->enabled) {
                $log = new ActionLogs();
                $log->url = Yii::$app->request->url;
                $log->post_data = json_encode(Yii::$app->request->post());
                $log->id_user = Yii::$app->user->id;
                $log->controller = $action->controller->className();
                $log->action = $action->actionMethod;
                $log->referer = Yii::$app->request->referrer;
                $log->save();
            }
        } catch (\Exception $e) {

        }
        return parent::beforeAction($action);
    }
}