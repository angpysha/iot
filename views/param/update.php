<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Param */

$this->title = 'Update Param: ' . $model->param_id;
$this->params['breadcrumbs'][] = ['label' => 'Params', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->param_id, 'url' => ['view', 'id' => $model->param_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="param-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
