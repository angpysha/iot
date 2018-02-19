<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Сервісний сайт IoT</h1>

        <p class="lead">Радіотехнічні пристрої та системи Інтернету Речей</p>

<!--        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>IoT Applications</h2>

                <p>Основою для реалізації IoT застосувань є мікрокомп'ютери та мікроконтролери з добре реалізованими
                    енергозберігаючими режимами. Базовою платформою мікрокомп'ютера у нас є <a href="http://mikrotik.kpi.ua/index.php/courses-list/category-raspberry">Raspberry Pi</a> .
                    Мікроконтролери використовуємо з архітектурою <a href="http://mikrotik.kpi.ua/index.php/courses-list/mcu-cortex-novoton">ARM Cortex-M0</a> .</p>

                <p><a class="btn btn-default" href="http://mikrotik.kpi.ua/index.php/courses-list/iot">Applications &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Cloud Storage</h2>

                <p>Платформа дозволить розробникам IoT застосувань під'єднувати свої пристрої до хмари. У цьому разі з'являється можливість реалізувати
                    справжній потенціал Інтернету речей (IoT), оскільки дані, що генеруються сенсорами можуть аналізуватися в
                    реальному часі на графіках, діаграмах та картах.</p>

                <p><a class="btn btn-default" href="http://iot.kpi.ua">Cloud &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>RESTful API</h2>

                <p>Для обміну даними між хмарою та численними пристроями IoT використовується RESTful вебсервіс. RESTful API
                    є уніфікованим інтерфейсом між слієнтами та серверами. При цьому розробка клієнської та серверної частини
                    може проводитись незалежно і не впливає один на одного.</p>

                <p><a class="btn btn-default" href="http://iot.kpi.ua">&nbsp;&nbsp;API&nbsp;&nbsp; &raquo;</a></p>
            </div>
        </div>

        <?php
        use miloschuman\highcharts\Highmaps;
        use yii\web\JsExpression;


        // To use Highcharts Map Collection, we must register those files separately.
        // The 'depends' option ensures that the main Highmaps script gets loaded first.
        $this->registerJsFile('http://code.highcharts.com/mapdata/countries/ua/ua-all.js', [
            'depends' => 'miloschuman\highcharts\HighchartsAsset'
        ]);

        echo Highmaps::widget([
            'options' => [
                'title' => [
                    'text' => '',
                ],
                'mapNavigation' => [
                    'enabled' => true,
                    'buttonOptions' => [
                        'verticalAlign' => 'bottom',
                    ]
                ],
                'colorAxis' => [
                    'min' => 0,
                ],
                'series' => [
                    [
                        'data' => [
                            ['hc-key' => 'ua-kc', 'value' => 0],
                            ['hc-key' => 'ua-zt', 'value' => 1],
                            ['hc-key' => 'ua-sm', 'value' => 2],
                            ['hc-key' => 'ua-dt', 'value' => 3],
                            ['hc-key' => 'ua-kk', 'value' => 4],
                            ['hc-key' => 'ua-lh', 'value' => 5],
                            ['hc-key' => 'ua-ch', 'value' => 6],
                            ['hc-key' => 'ua-cv', 'value' => 7],
                            ['hc-key' => 'ua-tp', 'value' => 8],
                            ['hc-key' => 'ua-zk', 'value' => 9],
                            ['hc-key' => 'ua-ck', 'value' => 10],
                            ['hc-key' => 'ua-kv', 'value' => 11],
                            ['hc-key' => 'ua-my', 'value' => 12],
                            ['hc-key' => 'ua-vi', 'value' => 13],

                        ],
                        'mapData' => new JsExpression('Highcharts.maps["countries/ua/ua-all"]'),
                        'joinBy' => 'hc-key',
                        'name' => 'Random data',
                        'states' => [
                            'hover' => [
                                'color' => '#BADA55',
                            ]
                        ],
                        'dataLabels' => [
                            'enabled' => true,
                            'format' => '{point.name}',
                        ]
                    ]
                ]
            ]
        ]);

        ?>
    </div>
</div>
