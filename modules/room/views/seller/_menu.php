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
            'url'     => ['/room/seller/index'],
        ],
        [
            'label'   => Yii::t('user', 'Пошук'),
            'url'     => ['/room/seller/modelsearch'],
        ],
        [
            'label'   => Yii::t('user', 'Розміри'),
            'url'     => ['/room/seller/sizes'],
        ],
        [
            'label'   => Yii::t('user', 'Каталог'),
            'url'     => ['/room/seller/catalog'],
        ],
//        [
//            'label'   => Yii::t('user', 'Операції'),
//            'items'   => [
////                [
////                    'label'   => Yii::t('user', 'Продаж'),
////                    'url'     => ['/room/manager/modelindex'],
////                ],
////                [
////                    'label'   => Yii::t('user', 'Приходування'),
////                    'url'     => ['/room/manager/productindex'],
////                ],
//                [
//                    'label'   => Yii::t('user', 'Передача'),
//                    'url'     => ['/room/manager/manufacturesindex'],///user/admin/info
//                ],
//                [
//                    'label'   => Yii::t('user', 'Кредит'),
//                    'url'     => ['/room/manager/dealersindex'],///user/admin/info
//                ],
//                [
//                    'label'   => Yii::t('user', 'Резерв'),
//                    'url'     => ['/room/manager/modelcategories'],///user/admin/info
//                ],
//                [
//                    'label'   => Yii::t('user', 'Рехерв'),
//                    'url'     => ['/room/manager/filterindex'],///user/admin/info
//                ],
//            ]
//
//        ],
//        [
//            'label'   => Yii::t('user', 'Баланс'),
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
<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
