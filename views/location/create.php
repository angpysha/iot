<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Location */

$this->title = Yii::t('user', 'Створити нове місцезнаходження');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['/room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Адмін'), 'url' => ['/room/admin/index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Номенклатура'), 'url' => ['/room/manager/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Місця'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
