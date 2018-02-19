<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Venting */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ventings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venting-view">

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
            'vent_mode',
            'charging',
            'damp1',
            'damp2',
            'temp1',
            'temp2',
            'valve_in',
            'valve_out',
            'valve_cyr',
            'time_added',
        ],
    ]) ?>

</div>
