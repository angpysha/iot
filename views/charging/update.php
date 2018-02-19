<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Charging */

$this->title = 'Змінити інфо про партію № ' . $model->receipt_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['/room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Оператор'), 'url' => ['/room/operator/index']];
$this->params['breadcrumbs'][] = ['label' => 'Завантаження партій', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charging-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
