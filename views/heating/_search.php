<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HeatingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="heating-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'heat_mode') ?>

    <?= $form->field($model, 'charging') ?>

    <?= $form->field($model, 'temp_chamber') ?>

    <?= $form->field($model, 'temp_supply') ?>

    <?php // echo $form->field($model, 'temp_hot') ?>

    <?php // echo $form->field($model, 'temp_cold') ?>

    <?php // echo $form->field($model, 'time_added') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
