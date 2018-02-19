<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Адміністратор'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Профілі'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Перегляд профіля</h1>
<?= $this->render('_menu') ?>
<div class="profile-view">

    <p>
        <?= Html::a('Редагувати', ['profileupdate', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?php
        $settings = \app\models\State::find()->where(['param' => 'uid_capture'])->one();
        if($settings["value"] == $model->user_id )
            echo Html::a('UID Capture', ['setcapture', 'id' => $model->user_id], ['class' => 'btn btn-success']);
        else
            echo Html::a('UID Capture', ['setcapture', 'id' => $model->user_id], ['class' => 'btn btn-default']);
        ?>
        <!--?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
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
            'user_id',
            'name',
            'public_email:email',
            'gravatar_email:email',
            'gravatar_id',
            'location',
            'website',
            'bio:ntext',
            'uid',
        ],
    ]) ?>

</div>
