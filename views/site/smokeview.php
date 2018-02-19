<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Про проект';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'Концентрація тютюнового диму у часі',
        ],
//        'xAxis' => [
//            'categories' => ['Apples', 'Oranges', 'Pears', 'Bananas', 'Plums'],
//        ],
        'labels' => [
            'items' => [
                [
                    'html' => 'Автоматичний моніторинг якості повітря у публічних місцях',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
            [
                'type' => 'column',
                'name' => 'Дим',
                'data' => $fume,
            ],
            [
                'type' => 'column',
                'name' => 'Температура',
                'data' => $temp,
            ],

            [
                'type' => 'spline',
                'name' => 'Усереднення',
                'data' => $fume,
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[3]'),
                    'fillColor' => 'white',
                ],
            ],

        ],
    ]
]);

