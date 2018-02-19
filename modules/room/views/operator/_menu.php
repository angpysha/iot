<?php

/* 
 * This file is part of the Dektrium project
 * 
 * (c) Dektrium project <http://github.com/dektrium>
 * 
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>
<?php
$script2 = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshMenu").click(); }, 30000);
});
JS;
$this->registerJs($script2);
?>

<?= Nav::widget([
    'encodeLabels' => false,
    'options' => [
        'class' => 'nav-tabs',
        'style' => 'margin-bottom: 15px'
    ],
    'items' => [
        [
            'label' => '<span class="glyphicon glyphicon-th"></span> ',
            'url'     => ['/room/operator/index'],
        ],
//        [
//            'label'   => Yii::t('user', 'PID-регулятор'),
//            'url'     => ['/room/operator/modelindex'],
//        ],
//        [
//            'label'   => Yii::t('user', ''),
//            'url'     => [''],
//        ],
//        [
//            'label'   => Yii::t('user', ''),
//            'url'     => [''],
//        ],
        [
            'label'   => Yii::t('user', 'Контроль'),
            'items'   => [

                [
                    'label'   => Yii::t('user', 'Поточна загрузка'),
                    'url'     => ['/room/operator/monitoring'],///user/admin/info
//                    'linkOptions' => ['target' => '_blank']
                ],
                [
                    'label'   => Yii::t('user', 'Дані системи вентиляції'),
                    'url'     => ['/venting/index'],///user/admin/info
//                    'linkOptions' => ['target' => '_blank']
                ],
                [
                    'label'   => Yii::t('user', 'Дані системи терморегуляції'),
                    'url'     => ['/heating/index'],///user/admin/info
//                    'linkOptions' => ['target' => '_blank']
                ],
            ]
        ],
        [
            'label'   => Yii::t('user', 'Ручне керування'),
            'url'     => ['/room/operator/manualcontrol'],
        ],
//        [
//            'label'   => Yii::t('user', 'Установки'),
//            'items'   => [
//
//                [
//                    'label'   => Yii::t('user', 'Режими вентиляції'),
//                    'url'     => ['/ventmode/index'],///user/admin/info
//                    'linkOptions' => ['target' => '_blank']
//                ],
//                [
//                    'label'   => Yii::t('user', 'Режими терморегуляції'),
//                    'url'     => ['/heatmode/index'],///user/admin/info
//                    'linkOptions' => ['target' => '_blank']
//                ],
////                [
////                    'label'   => Yii::t('user', 'Назви рецептів'),
////                    'url'     => ['/receipt/index'],///user/admin/info
////                    'linkOptions' => ['target' => '_blank']
////                ],
//                [
//                    'label'   => Yii::t('user', 'Параметри рецептів'),
//                    'url'     => ['/param/index'],///user/admin/info
//                    'linkOptions' => ['target' => '_blank']
//                ],
//                [
//                    'label'   => Yii::t('user', 'Реєстр загрузок / партій '),
//                    'url'     => ['/charging/index'],///user/admin/info
//                    'linkOptions' => ['target' => '_blank']
//                ],
//                [
//                    'label'   => Yii::t('user', 'PID-регулятор'),
//                    'url'     => ['/pid/index'],
//                ],
////                [
////                    'label'   => Yii::t('user', 'Місця знаходження товарів'),
////                    'url'     => ['/location/index'],
////                ],
//
//            ]
//
//        ],
//        '<span style="margin: 8pt; text-align: center" class="col-lg-3 col-md-3 col-sm-4 col-xs-12 alert-warning pull-right">
//        Залишилось <b>'.date("H год i хв s сек", time()).'</b></span>',
//        Yii::t('user', '<b>02 год 45 хв.</b>'),


//        [
//            'label'   => ,
//            'url'     => ['/room/manager/balans'],
//        ],
//        [
//            'label'   => Yii::t('user', 'Локації'),
//            'url'     => ['/room/manager/location'],
//        ],
//
//        [
//            'label'   => Yii::t('user', 'Звіти'),
//            'url'     => ['/room/manager/report'],
//        ],
    ]
]) ?>
<?php Pjax::begin(); ?>
<?= Html::a("Обновить", ['index'], ['class' => 'btn btn-lg btn-primary hidden', 'id' => 'refreshMenu']);?>
<div class="submenu">
    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
<!--        <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">-->
            <?= \app\modules\room\controllers\OperatorController::getTime('progress')?>
<!--        </div>-->
    </div>
    <span style="margin: 2pt; text-align: center" class="col-lg-3 col-md-3 col-sm-5 col-xs-5 alert-warning pull-right">
        <?= \app\modules\room\controllers\OperatorController::getTime('remain')?></span>
</div>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
<?php Pjax::end(); ?>


