<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VentMode */

$this->title = 'Редагування "' . $model->name . '"';
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['/room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Оператор'), 'url' => ['/room/operator/index']];
$this->params['breadcrumbs'][] = ['label' => 'Режими вентиляції', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vent-mode-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
