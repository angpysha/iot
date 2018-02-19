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
            'url' => ['/room/admin/dogovor', 'id' => ''],
            'options' => [
                //'class' => 'disabled',
                //'onclick' => 'return false;'
            ],
        ],
        ['label' => Yii::t('user', 'Квоти за спеціальностями'),
            'url' => ['/room/admin/request', 'id' => ''],
            'options' => [
                'class' => 'text-success',
                'data-method' => 'post',
            ],
        ],
        ['label' => Yii::t('user', 'Перевірка квот'),
            'url' => ['/room/admin/check'],//, 'id' => ''
            'options' => [
                'class' => 'text-success',
                'data-method' => 'post',
            ],
        ],

        '<hr>',
        [
            'label' => Yii::t('user', 'Договори практики'),
            'url'   => ['/room/admin/allcontracts'],//, 'id' => ''
                'linkOptions' => [
                'class' => 'text-success',
                'data-method' => 'post',
            ],
        ],
        [
            'label' => Yii::t('user', 'Договори співпраці'),
            'url'   => ['/room/admin/allcolaboration'],//, 'id' => ''
                'linkOptions' => [
                'class' => 'text-success',
                'data-method' => 'post',
            ],
        ],
        [
            'label' => Yii::t('user', 'Гарантійні листи'),
            'url'   => ['/room/admin/allletters'],//, 'id' => ''
                'linkOptions' => [
                'class' => 'text-success',
                'data-method' => 'post',
            ],
        ],
    ]
]) ?>
            </div>
</div>