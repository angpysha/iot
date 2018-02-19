<?php
/* @var $this yii\web\View */
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

$this->title = Yii::t('user', 'Загальні показники');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Статистика'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginContent('@app/modules/room/views/statistics/commontemplate.php') ?>

<div>
    <h3>Залишок товару: діаграма </h3>
    <?php


    //var_dump($pr[0]["cnt"]);
    echo Highcharts::widget([
        'scripts' => [
            'modules/exporting',
            'themes/grid-light',
        ],
        'options' => [
            'title' => [
                'text' => 'Загальні показники',
            ],
            'xAxis' => [
                'categories' => ['Apples', 'Oranges', 'Pears', 'Bananas', 'Plums'],
            ],
            'labels' => [
                'items' => [
                    [
                        'html' => 'Кількість товару',
                        'style' => [
                            'left' => '20px',
                            'top' => '5px',
                            'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                        ],
                    ],
                    [
                        'html' => 'Об\'єм продажів',
                        'style' => [
                            'left' => '350px',
                            'top' => '5px',
                            'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                        ],
                    ],
                ],
            ],
            'series' => [
                [
                    'type' => 'pie',
                    'name' => 'У наявності ',
                    'data' => [
                        [
                            'name' => 'Київ',
                            'y' => intval($pr[2]["cnt"]),
                            'color' => new JsExpression('Highcharts.getOptions().colors[0]'), // Jane's color
                        ],
                        [
                            'name' => 'Бердичів',
                            'y' => intval($pr[0]["cnt"]),
                            'color' => new JsExpression('Highcharts.getOptions().colors[1]'), // John's color
                        ],
                        [
                            'name' => 'Козятин',
                            'y' => intval($pr[1]["cnt"]),
                            'color' => new JsExpression('Highcharts.getOptions().colors[2]'), // Joe's color
                        ],
                        [
                            'name' => 'Novus',
                            'y' => intval($pr[3]["cnt"]),
                            'color' => new JsExpression('Highcharts.getOptions().colors[3]'), // Joe's color
                        ],
//                        [
//                            'name' => 'Лівобережна',
//                            'y' => intval($pr[4]["cnt"]),
//                            'color' => new JsExpression('Highcharts.getOptions().colors[4]'), // Joe's color
//                        ],
                    ],
                    'center' => [100, 100],
                    'size' => 200,
                    'showInLegend' => false,
                    'dataLabels' => [
                        'enabled' => false,
                    ],
                ],
                [
                    'type' => 'pie',
                    'name' => 'Продано одиниць ',
                    'data' => [
                        [
                            'name' => 'Київ',
                            'y' => intval($pract[2]["cnt"]),
                            'color' => new JsExpression('Highcharts.getOptions().colors[0]'), // Jane's color
                        ],
                        [
                            'name' => 'Бердичів',
                            'y' => intval($pract[0]["cnt"]),
                            'color' => new JsExpression('Highcharts.getOptions().colors[1]'), // John's color
                        ],
                        [
                            'name' => 'Козятин',
                            'y' => intval($pract[1]["cnt"]),
                            'color' => new JsExpression('Highcharts.getOptions().colors[2]'), // Joe's color
                        ],
                        [
                            'name' => 'Novus',
                            'y' => intval($pract[3]["cnt"]),
                            'color' => new JsExpression('Highcharts.getOptions().colors[3]'), // Joe's color
                        ],
                        [
                            'name' => 'Лівобережна',
                            'y' => intval($pract[4]["cnt"]),
                            'color' => new JsExpression('Highcharts.getOptions().colors[4]'), // Joe's color
                        ],
                    ],
                    'center' => [350, 100],
                    'size' => 200,
                    'showInLegend' => false,
                    'dataLabels' => [
                        'enabled' => false,
                    ],
                ],
            ],
        ]
    ]);
    ?>
</div>
<div>
    <h3>Залишок товару: місцеположення - к-ть </h3>
    <table border="1" class="table">
        <thead>
        <tr><td>#</td><td>Місце</td><td>Залишок товару</td><td>Об'єм продажів всього</td></tr>
        </thead>
        <tbody>
        <?php
        $cnt = 0;
//        var_dump($pract);
                        foreach ($pr as $key=>$s){
                            $cnt++;
                            $loc = \app\models\Location::findOne((int)$s["location_id"]);
                            echo "<tr><td>".$cnt."</td><td>".$loc->location_name."</td><td><a href='../manager/productindex?ProductSearch[location]=".$loc->location_name."&ProductSearch[status]=У+наявності' target='_blank'>".$s['cnt']."</a></td><td><a href='../manager/productindex?ProductSearch[location]=".$loc->location_name."&ProductSearch[status]=продано' target='_blank'>".$pract[$key]['cnt']."</a></td></tr>";

                        }

        ?>
        </tbody>
    </table>
</div>

<?php $this->endContent() ?>




