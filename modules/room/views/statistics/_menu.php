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

?>

<?= Nav::widget([
    'options' => [
        'class' => 'nav-tabs',
        'style' => 'margin-bottom: 15px'
    ],
    'items' => [
        [
            'label'   => Yii::t('user', 'Довідка'),
            'url'   => ['/room/statistics/index'],
        ],
        [
            'label'   => Yii::t('user', 'Загальна'),
            'url'   => ['/room/statistics/commonplace'],
        ],
//        [
//            'label'   => Yii::t('user', 'Маркетинг'),
//            'url'   => ['/room/statistics/rest'],
//        ],
//        [
//            'label'   => Yii::t('user', 'Конверсія'),
//            'url'   => ['/room/statistics/conversion'],
//        ],
//        [
//            'label'   => Yii::t('user', 'Тренди'),
//            'url'   => ['/room/statistics/trends'],
//        ],
//        [
//            'label'   => Yii::t('user', 'Маркетинг'),
//            'items'   => [
//                [
//                    'label' =>  Yii::t('user', 'Залишок'),
//                    'url'   =>  ['/room/statistics/rest'],//, 'id' => '3'
//                    'linkOptions' => ['target' => '_blank']
//                ],
//                [
//                    'label' =>  Yii::t('user', 'Фараон Бердичів'),
//                    'url'   =>  ['/room/statistics/exel', 'id' => '1'],
////                    'linkOptions' => ['target' => '_blank']
//                ],
//                [
//                    'label' =>  Yii::t('user', 'Фараон Козятин'),
//                    'url'   =>  ['/room/statistics/exel', 'id' => '2'],
////                    'linkOptions' => ['target' => '_blank']
//                ],
////                [
////                    'label' =>  Yii::t('user', 'Категорії'),
////                    'url'   =>  ['/room/rediscount/categories'],
////                    'linkOptions' => ['target' => '_blank']
////                ],
////                [
////                    'label' =>  Yii::t('user', 'Моделі товарів'),
////                    'url'   =>  ['/room/rediscount/products'],
////                    'linkOptions' => ['target' => '_blank']
////                ],
//            ]
//        ],
//        [
//            'label'   => Yii::t('user', 'Маркетплейс'),
//            'items'   => [
//                [
//                    'label' =>  Yii::t('user', 'SvitStyle'),
//                    'url'   =>  ['/marketplace/svitstyle'],
//                    'linkOptions' => ['target' => '_blank']
//                ],
//                [
//                    'label' =>  Yii::t('user', 'Price.ua'),
//                    'url'   =>  ['/marketplace/priceua'],
//                    'linkOptions' => ['target' => '_blank']
//                ],
//            ]
//        ],


//        [
//            'label'   => Yii::t('user', 'Аукціон хутра'),
//            'url'     => ['/room/statistics/copengagen'],
//        ],
//        [
//            'label'   => Yii::t('user', 'Розсилка'),
//            'url'     => ['/room/broadcast/index'],
//        ],
    ]
]) ?>
