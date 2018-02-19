<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VentingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="venting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'vent_mode') ?>

    <?= $form->field($model, 'charging') ?>

    <?= $form->field($model, 'damp1') ?>

    <?= $form->field($model, 'damp2') ?>

    <?php // echo $form->field($model, 'temp1') ?>

    <?php // echo $form->field($model, 'temp2') ?>

    <?php // echo $form->field($model, 'valve_in') ?>

    <?php // echo $form->field($model, 'valve_out') ?>

    <?php // echo $form->field($model, 'valve_cyr') ?>

    <?php // echo $form->field($model, 'time_added') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
