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
            'label'   => Yii::t('user', 'Налаштування'),
            'items'   => [
                [
                    'label' =>  Yii::t('user', 'Курс валют'),
                    'url'   =>  ['/room/admin/currency'],
                    'linkOptions' => ['target' => '_blank']
                ],
                [
                    'label' =>  Yii::t('user', 'Обновити RFID'),
                    'url'   =>  ['/room/admin/rfidupdate'],
//                    'linkOptions' => ['target' => '_blank']
                ],
                [
                    'label' =>  Yii::t('user', 'Місця'),
                    'url'   =>  ['/location/index'],
                    'linkOptions' => ['target' => '_blank']
                ],
//                [
//                    'label' =>  Yii::t('user', 'Категорії'),
//                    'url'   =>  ['/room/admin/categories'],
//                    'linkOptions' => ['target' => '_blank']
//                ],
//                [
//                    'label' =>  Yii::t('user', 'Моделі товарів'),
//                    'url'   =>  ['/room/admin/products'],
//                    'linkOptions' => ['target' => '_blank']
//                ],
            ]
        ],
//        [
//            'label'   => Yii::t('user', 'Експорт'),
//            'items'   => [
//                [
//                    'label' =>  Yii::t('user', 'Фільтри товарів'),
//                    'url'   =>  ['/room/admin/filters'],
//                    'linkOptions' => ['target' => '_blank']
//                ],
//                [
//                    'label' =>  Yii::t('user', 'Атрибути товарів'),
//                    'url'   =>  ['/room/admin/attributes'],
//                    'linkOptions' => ['target' => '_blank']
//                ],
//                [
//                    'label' =>  Yii::t('user', 'Опції'),
//                    'url'   =>  ['/room/admin/options'],
//                    'linkOptions' => ['target' => '_blank']
//                ],
//                [
//                    'label' =>  Yii::t('user', 'Категорії'),
//                    'url'   =>  ['/room/admin/categories'],
//                    'linkOptions' => ['target' => '_blank']
//                ],
//                [
//                    'label' =>  Yii::t('user', 'Моделі товарів'),
//                    'url'   =>  ['/room/admin/products'],
//                    'linkOptions' => ['target' => '_blank']
//                ],
//                [
//                    'label' =>  Yii::t('user', 'Моделі товарів Page2'),
//                    'url'   =>  ['/room/admin/products?page=2'],
//                    'linkOptions' => ['target' => '_blank']
//                ],
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
//                [
//                    'label' =>  Yii::t('user', 'Hotline'),
//                    'url'   =>  ['/marketplace/hotline'],
//                    'linkOptions' => ['target' => '_blank']
//                ],
//                [
//                    'label' =>  Yii::t('user', 'Мета Маркет'),
//                    'url'   =>  ['/marketplace/metaua'],
//                    'linkOptions' => ['target' => '_blank']
//                ],
//            ]
//        ],
        [
            'label'   => Yii::t('user', 'Користувачі'),
            'items'   => [
                [
                    'label' =>  Yii::t('user', 'Адміністрування користувачів'),
                    'url'   =>  ['/user/admin'],
                    'linkOptions' => ['target' => '_blank']
                ],
                [
                    'label' =>  Yii::t('user', 'Права доступу'),
                    'url'   =>  ['../admin/'],
                    'linkOptions' => ['target' => '_blank']
                ],
//                [
//                    'label' =>  Yii::t('user', 'Картки студентів'),
//                    'url'   =>  ['/room/admin/praxindex/'],
//                    //'linkOptions' => ['target' => '_blank']
//                ],
                [
                    'label' =>  Yii::t('user', 'Продавці'),
                    'url'   =>  ['/room/admin/profile'],
                    //'linkOptions' => ['target' => '_blank']
                ],
            ]
        ],

//        [
//            'label'   => Yii::t('user', 'Документи'),
//            'url'     => ['/room/admin/dogovor'],
//        ],
//        [
//            'label'   => Yii::t('user', 'Розсилка'),
//            'url'     => ['/room/broadcast/index'],
//        ],
    ]
]) ?>
<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>