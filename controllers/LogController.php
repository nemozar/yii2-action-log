<?php

namespace nemozar\yii2ActionLog\controllers;

use Yii;
use nemozar\yii2ActionLog\models\ActionLogs;
use nemozar\yii2ActionLog\models\ActionLogsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LogController implements the CRUD actions for ActionLogs model.
 */
class LogController extends Controller
{

    /**
     * Lists all ActionLogs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActionLogsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
