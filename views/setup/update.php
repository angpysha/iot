<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Setup */

$this->title = 'Update Setup: ' . $model->param;
$this->params['breadcrumbs'][] = ['label' => 'Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->param, 'url' => ['view', 'id' => $model->param]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="setup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
