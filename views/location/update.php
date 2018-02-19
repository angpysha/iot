<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Location */

$this->title = 'Редагувати місце знаходження: ' . $model->location_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['/room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Адмін'), 'url' => ['/room/admin/index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Номенклатура'), 'url' => ['/room/manager/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Місця'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->location_id, 'url' => ['view', 'id' => $model->location_id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="location-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
