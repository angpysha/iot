<?php
/* @var $this yii\web\View */

use yii\bootstrap\Nav;
use yii\web\View;
use dektrium\user\models\User;
?>
<h1>Реєстрація компаній та договорів на практику</h1>
<?= $this->render('_menu') ?>
<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menudogovor') ?>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
