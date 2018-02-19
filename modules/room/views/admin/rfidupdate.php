<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = 'Завантажити образ для RFID';
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Адміністратор'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Налаштування'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Обновити RFID образ</h1>
<?= $this->render('_menu') ?>

<div class="profile-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <!--?= $form->field($model, 'user_id')->textInput() ?-->
    <?= $form->field($model, 'file')->fileInput() ?><?= Html::submitButton('Upload', ['class' => 'btn btn-primary']) ?>

    <div class="form-group">

    </div>

    <?php ActiveForm::end(); ?>



</div>