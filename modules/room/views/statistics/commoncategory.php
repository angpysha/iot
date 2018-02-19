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
    <h3>Залишок товару за категоріями<sup style="color: red">*</sup></h3>
    <table border="1" class="table">
        <thead>
        <tr><td>#</td><td>Категорія</td><td>Моделей всього</td><td>Продано</td><td>Залишок</td></tr>
        </thead>
        <tbody>
        <?php
        $cnt = 0;
//        var_dump($cat);
                        foreach ($pc as $key=>$s){
                            $cnt++;
                            $catalog = \app\models\Category::findOne((int)$s["category_id"]);
                            echo "<tr><td>".$cnt."</td><td>".$catalog->category_name."</td><td>".$s['cnt']."</td><td><a href='../manager/productindex?ProductSearch[status]=Продано' target='_blank'>".$cat[$s["category_id"]]['sale']."</a></td><td><a href='../manager/productindex?ProductSearch[status]=У+наявності' target='_blank'>".$cat[$s["category_id"]]['available']."</a></td></tr>";

                        }

        ?>
        </tbody>
    </table>
    ------------<br/>
    <sup style="color: red">*</sup>Товари однієї і тієї ж моделі можуть фігурувати у різних категоріях!
</div>

<?php $this->endContent() ?>




