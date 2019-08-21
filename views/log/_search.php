<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model nemozar\yii2ActionLog\models\ActionLogsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="action-logs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'post_data') ?>

    <?= $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'controller') ?>

    <?php // echo $form->field($model, 'action') ?>

    <?php // echo $form->field($model, 'referer') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
