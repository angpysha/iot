<?php
/* @var $this yii\web\View */

use yii\bootstrap\Nav;
use yii\web\View;
use dektrium\user\models\User;

$this->title = Yii::t('user', 'Маркетинг');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Статистика'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h1>Загальна статистика</h1>
<?= $this->render('_menu') ?>
<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
<div class="row">
    <div class="col-md-3">
        <?= $this->render('marketingsubmenu') ?>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
