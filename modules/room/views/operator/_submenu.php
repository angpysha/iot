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
        //['label' => Yii::t('user', 'Створити компанію'), 'url' => 'create-company'],//  'app/../../../company/create'
        ['label' => Yii::t('user', 'Ввести дані договору'),
            'url' => ['/room/manager/dogovor', 'id' => ''],
            'options' => [
                //'class' => 'disabled',
                //'onclick' => 'return false;'
            ],
        ],
        ['label' => Yii::t('user', 'Квоти за спеціальностями'),
            'url' => ['/room/manager/request', 'id' => ''],
            'options' => [
                'class' => 'text-success',
                'data-method' => 'post',
            ],
        ],
        ['label' => Yii::t('user', 'Перевірка квот'),
            'url' => ['/room/manager/check'],//, 'id' => ''
            'options' => [
                'class' => 'text-success',
                'data-method' => 'post',
            ],
        ],

        '<hr>',
        [
            'label' => Yii::t('user', 'Всі договори практики'),
            'url'   => ['/room/manager/allcontracts'],//, 'id' => ''
            //'visible' => !$user->isConfirmed,
            'linkOptions' => [
                'class' => 'text-success',
                'data-method' => 'post',
                //'data-confirm' => Yii::t('user', 'Are you sure you want to confirm this user?')
            ],
        ],
        [
            'label' => Yii::t('user', 'Договори 2015'),
            'url'   => ['/room/manager/allcontracts2015'],//, 'id' => ''
            //'visible' => !$user->isConfirmed,
            'linkOptions' => [
                'class' => 'text-success',
                'data-method' => 'post',
                //'data-confirm' => Yii::t('user', 'Are you sure you want to confirm this user?')
            ],
        ],
        [
            'label' => Yii::t('user', 'Договори 2016'),
            'url'   => ['/room/manager/allcontracts2016'],//, 'id' => ''
            //'visible' => !$user->isConfirmed,
            'linkOptions' => [
                'class' => 'text-success',
                'data-method' => 'post',
                //'data-confirm' => Yii::t('user', 'Are you sure you want to confirm this user?')
            ],
        ],
    ]
]) ?>
            </div>
</div>