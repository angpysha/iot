<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Smoke */

$this->title = 'Update Smoke: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Smokes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="smoke-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
