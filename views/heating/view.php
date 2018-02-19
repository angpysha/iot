<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Heating */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Heatings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="heating-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'heat_mode',
            'charging',
            'temp_chamber',
            'temp_supply',
            'temp_hot',
            'temp_cold',
            'time_added',
        ],
    ]) ?>

</div>
