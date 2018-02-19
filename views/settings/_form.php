<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'param_id')->dropDownList(
        ArrayHelper::map(\app\models\Param::find()->all(), 'param_id', 'param_name'),//'speciality_id'
        ['prompt' => 'Параметр']
    ) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receipt_id')->dropDownList(
        ArrayHelper::map(\app\models\Receipt::find()->all(), 'receipt_id', 'receipt_name'),//'speciality_id'
        ['prompt' => 'Рецепт']
    ) ?>

    <?= $form->field($model, 'active')->dropDownList([ 0 => 'Не активний', 1 => 'Активний']) ?>

    <!--?= $form->field($model, 'date_created')->textInput() ?-->

    <!--?= $form->field($model, 'date_modified')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
