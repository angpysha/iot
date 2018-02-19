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
    <h3>Залишок товару за категоріями</h3>
    <table border="1" class="table">
        <thead>
        <tr><td>#</td><td>Розміри</td><td>Стать</td><td>Продано</td><td>Залишок</td></tr>
        </thead>
        <tbody>
        <?php
        $cnt = 0;
//        var_dump($cat);
                        foreach ($sz as $key=>$s){
                            $cnt++;
//                            $catalog = \app\models\Category::findOne((int)$s["category_id"]);
                            echo "<tr><td>".$cnt."</td><td>".$s["together"]."</td><td>".$s["sex"]."</td><td><a href='../manager/productindex?ProductSearch[size]=".$s["together"]."&ProductSearch[status]=Продано' target='_blank'>".$size[$s["size_id"]]['sale']."</a></td><td><a href='../manager/productindex?ProductSearch[size]=".$s["together"]."&ProductSearch[status]=У+наявності' target='_blank'>".$size[$s["size_id"]]['available']."</a></td></tr>";

                        }

        ?>
        </tbody>
    </table>
</div>

<?php $this->endContent() ?>




