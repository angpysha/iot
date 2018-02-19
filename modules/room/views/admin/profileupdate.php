<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = 'Редагувати';
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Адміністратор'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Профілі'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['profileview', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Редагувати профіль</h1>
<?= $this->render('_menu') ?>

<div class="profile-update">

    <?= $this->render('profileform', [
        'model' => $model,
    ]) ?>

</div>
