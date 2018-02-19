<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Heating */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="heating-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'heat_mode')->textInput() ?>

    <?= $form->field($model, 'charging')->textInput() ?>

    <?= $form->field($model, 'temp_chamber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'temp_supply')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'temp_hot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'temp_cold')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time_added')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
