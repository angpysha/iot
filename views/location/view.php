<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Location */

$this->title = Yii::t('user', 'Редагувати "').$model->location_name.'"';
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['/room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Адмін'), 'url' => ['/room/admin/index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Номенклатура'), 'url' => ['/room/manager/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Місця'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->location_id], ['class' => 'btn btn-primary']) ?>
        <?php
        $settings = \app\models\State::find()->where(['param' => 'rfid_capture'])->one();
        if($settings["value"] == $model->location_id )
            echo Html::a('RFID Capture', ['setcapture', 'id' => $model->location_id], ['class' => 'btn btn-success']);
        else
            echo Html::a('RFID Capture', ['setcapture', 'id' => $model->location_id], ['class' => 'btn btn-default']);
        ?>

        <!--?= Html::a('Delete', ['delete', 'id' => $model->location_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?-->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'location_id',
            'location_name',
            'address',
            'telephone',
            'rfid_id',
        ],
    ]) ?>

</div>
