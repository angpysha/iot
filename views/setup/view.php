<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Setup */

$this->title = $model->param;
$this->params['breadcrumbs'][] = ['label' => 'Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setup-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->param], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->param], [
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
            'param',
            'value:ntext',
            'value_type',
            'comment',
        ],
    ]) ?>

</div>
