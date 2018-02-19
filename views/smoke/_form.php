<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Smoke */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smoke-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'temp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
