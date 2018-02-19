<?php
/**
 * Created by PhpStorm.
 * User: nimda
 * Date: 06.05.2015
 * Time: 8:32
 */
use yii\bootstrap\Nav;
?>
<div class="panel panel-default">
            <div class="panel-body">
                <?= Nav::widget([
    'options' => [
        'class' => 'nav-pills nav-stacked'
    ],
    'items' => [
//        ['label' => Yii::t('user', 'Розподіл товару'),
//            'url' => ['/room/statistics/placement', 'id' => ''],
//            'options' => [
//                //'class' => 'disabled',
//                //'onclick' => 'return false;'
//            ],
//        ],
        ['label' => Yii::t('user', 'Залишок за категоріями'),
            'url' => ['/room/statistics/rest'],//, 'id' => ''
            'options' => [
                'class' => 'text-success',
                'data-method' => 'post',
            ],
        ],
        ['label' => Yii::t('user', 'Залишок за розмірами'),
            'url' => ['/room/statistics/check'],//, 'id' => ''
            'options' => [
                'class' => 'text-success',
                'data-method' => 'post',
            ],
        ],
        ['label' => Yii::t('user', 'Залишок за моделями'),
            'url' => ['/room/statistics/rest1'],//, 'id' => ''
            'options' => [
                'class' => 'text-success',
                'data-method' => 'post',
            ],
        ],
        '<hr>',
        [
            'label' => Yii::t('user', 'Очікується'),
            'url'   => ['/room/statistics/allcontracts'],//, 'id' => ''
                'linkOptions' => [
                'class' => 'text-success',
                'data-method' => 'post',
            ],
        ],
        [
            'label' => Yii::t('user', 'Повернення / Виявлено брак'),
            'url'   => ['/room/statistics/allcolaboration'],//, 'id' => ''
                'linkOptions' => [
                'class' => 'text-success',
                'data-method' => 'post',
            ],
        ],
//        [
//            'label' => Yii::t('user', 'Гарантійні листи'),
//            'url'   => ['/room/statistics/allletters'],//, 'id' => ''
//                'linkOptions' => [
//                'class' => 'text-success',
//                'data-method' => 'post',
//            ],
//        ],
    ]
]) ?>
            </div>
</div>