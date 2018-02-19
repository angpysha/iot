<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Charging */

$this->title = 'Перегляд інфо про партію № ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['/room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Оператор'), 'url' => ['/room/operator/index']];
$this->params['breadcrumbs'][] = ['label' => 'Завантаження партій', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charging-view">

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
            'receipt_id',
            'user_id',
            'started',
            'finished',
        ],
    ]) ?>

</div>
