<?php

use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use nemozar\yii2ActionLog\models\ActionLogs;
use Symfony\Component\VarDumper\VarDumper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel nemozar\yii2ActionLog\models\ActionLogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Action Logs';
$this->params['breadcrumbs'][] = $this->title;

$model = $this->context->module->userModel;

$user_list = ArrayHelper::map($model::find()->all(), 'id', $this->context->module->modelUserName);
echo "<div style='display: none;'>";
VarDumper::dump(1);
echo "</div>";

$filterDate = DateRangePicker::widget([
    'name'=>'ActionLogsSearch[time]',
    // 'options'=>["style"=>"width:700px;"],
    'value'=> ''.$searchModel->time,
    'convertFormat'=>true,
    //'useWithAddon'=>true,
    // 'presetDropdown'=>true,
    'initRangeExpr'=>true,
    'hideInput'=>true,
    //    "containerOptions"=>[
    //        "style"=>"width:700px;",
    //    ],
    'pluginOptions'=>[
        'format'=>'d.m.Y',
        'separator'=>' - ',
        'opens'=>null,
        'locale'=>[
            'format'=>'d.m.Y',
        ],
        'ranges'=>[
            "Сегодня" => ["moment().startOf('day')", "moment()"],
            "Вчера" => ["moment().startOf('day').subtract(1,'days')", "moment().endOf('day').subtract(1,'days')"],
            "Эта неделя" => ["moment().startOf('week')", "moment()"],
            "Этот месяц" => ["moment().startOf('month')", "moment()"],
            "Этот год" => ["moment().startOf('year')", "moment()"],
            "Прошлая неделя" => ["moment().subtract(7, 'days').startOf('week')", "moment().subtract(7, 'days').endOf('week')"],
            "Прошлый месяц" => ["moment().subtract(1, 'month').startOf('month')", "moment().subtract(1, 'month').endOf('month')"],
            "Прошлый год" => ["moment().subtract(12, 'month').startOf('year')", "moment().subtract(12, 'month').endOf('year')"],
        ]
    ]
]);
?>
<div class="action-logs-index">

    <h1>
        <?= Html::encode($this->title) ?>
        <?= Html::a('Clear logs', Url::to(['clear']), [
            'class' => 'btn btn-warning',
            'style' => 'float: right;',
            'data-confirm' => 'All logs wiil be clear. Continue?'
        ])?>
    </h1>
<!--    --><?php //Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => [
                    'style' => 'width : 80px;'
                ]
            ],
            [
                'attribute' => 'time',
                'filter' => $filterDate,
                'options' => [
                    'style' => 'width : 300px;'
                ]
            ],
            'url:ntext',
            [
                'attribute' => 'post_data',
                'format' => 'html',
                'value' => function ($data) {
                    ob_start();
                    VarDumper::dump(json_decode($data->post_data));
//                    \yii\helpers\VarDumper::dump(json_decode($data->post_data),  2,  true);
                    $dump = ob_get_contents();
                    ob_end_clean();
                    return $dump;
                }
            ],

            [
                'attribute' => 'id_user',
                'value' => function ($data) use ($user_list){
                    return $user_list[$data->id_user];
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'id_user',
                    'data' => $user_list,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'options' => [
                        'placeholder' => 'User',
                    ],
                ])
            ],
            [
                'attribute' => 'controller',
                'value' => function ($data) {
                    return $data->controllerName;
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'controller',
                    'data' => ActionLogs::getControllerList(),
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'options' => [
                        'placeholder' => 'Controller',
                    ],
                ])

            ],
            [
                'attribute' => 'action',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'action',
                    'data' => ActionLogs::getActionList(),
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'options' => [
                        'placeholder' => 'Action',
                    ],
                ])
            ],
            //'referer:ntext',

            [
                'buttons' => [
                    'view' => function ($url, $data) use ($searchModel) {
                        $filter = $searchModel->attributes;
                        $filter['id'] = $data->id;
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', Url::to(['index', 'ActionLogsSearch' => $filter
                        ]));
                    }
                ],
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>
<!--    --><?php //Pjax::end(); ?>
</div>
<style>
    pre.sf-dump, pre.sf-dump .sf-dump-default {
        background: none;
        color: #000;
    }
    pre.sf-dump .sf-dump-public {
        color:#111;
    }
    pre.sf-dump .sf-dump-str {
        color:#888;
    }
</style>