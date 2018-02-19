<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Venting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="venting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'vent_mode')->textInput() ?>

    <?= $form->field($model, 'charging')->textInput() ?>

    <?= $form->field($model, 'damp1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'damp2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'temp1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'temp2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valve_in')->textInput() ?>

    <?= $form->field($model, 'valve_out')->textInput() ?>

    <?= $form->field($model, 'valve_cyr')->textInput() ?>

    <?= $form->field($model, 'time_added')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
