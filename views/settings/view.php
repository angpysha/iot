<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */

$this->title = $model->param_id;
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'param_id' => $model->param_id, 'receipt_id' => $model->receipt_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'param_id' => $model->param_id, 'receipt_id' => $model->receipt_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'param_id',
            'value',
            'receipt_id',
            'active',
            'date_created',
            'date_modified',
        ],
    ]) ?>

</div>
