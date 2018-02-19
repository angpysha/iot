<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Category;
use app\models\Filter;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = Yii::t('user', 'Картка товару');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Продавець'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Каталог'), 'url' => ['catalog']];
$this->params['breadcrumbs'][] = $this->title;

//$this->title = $model->product_id;
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Картка товару</h1>
<?= $this->render('_menu') ?>
<h3>Детальна інформація про товар <?=$model->ean ?> </h3>

<div class="product-view">
    <div class="row">
        <div class="col-lg-4">
            <h2>Зображення</h2>
            <?php

                if($productmodel->image){
                    echo '<img src="http://mink.com.ua/image'.$productmodel->image.'" height="460px" />';
                }
                else{
                    echo '<img src="../../images/default.jpg" height="460px" />';
                }

            ?>

            <!--p>
                <?= Html::a('Update', ['productupdate', 'id' => $model->product_id], ['class' => 'btn btn-success']) ?>
            </p-->
        </div>

        <div class="col-lg-4">
            <h2>Інформація</h2>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'product_id',
                    'notebook',
                    'model.model_name',
                    'model.model_id',
                    'ean',
//                    'mpn',
//                    'product_name',
                    //'description:ntext',
                    'location.location_name',

                    'size.UKR',
                    'size.INT',
                    //'manufacturer.manufacturer_name',
//                    'dealer.dealer_name',
                    'price',
                    'status.status_name',
//                    'date_added',
//                    'date_modified',
                ],
            ]) ?>

        </div>
        <div class="col-lg-4">
            <h2>Модель</h2>
            <h4>G<?=$productmodel->model_id?> <?= $productmodel->model_name ?></h4>
            
            <h2>Опис</h2>
            <?= $productmodel->description ?>

            <h2>Категорії</h2>
            <ul>
            <?php
                foreach ($categories as $cat){
                    $category = Category::findOne($cat["category_id"]);
                    //var_dump($category);
                    echo "<li><b>".$category["category_name"]."</b></li>";
                }
            ?>
            </ul>


            <h2>Фільтри</h2>
            <ul>
                <?php
                foreach ($filters as $fil){
                    $filter = Filter::findOne($fil["filter_id"]);
                    //var_dump($filter);
                    echo "<li><b>".$filter["filter_name"]."</b></li>";
                }
                ?>
            </ul>

            <!--?= Html::a('Редагувати інф. про модель', ['modelupdate', 'id' => $productmodel->model_id], ['class' => 'btn btn-default']) ?-->

        </div>

    </div>

    <div class="row">
        <h2>Операції з товаром</h2>

        <div class="col-xs-12 col-md-6 col-lg-3">
            <a href="action?id=<?= $model->product_id ?>&op=2" style="font-weight: bold ">
            <div class="alert alert-success">
                    Оформлення продажу
                </div></a>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <a href="action?id=<?= $model->product_id ?>&op=4" style="font-weight: bold "><div class="alert alert-warning">
                    Оформлення кредиту
                </div></a>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-2">
            <a href="action?id=<?= $model->product_id ?>&op=3" style="font-weight: bold "><div class="alert alert-info">
                    Відкласти
                </div></a>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-2">
            <a href="action?id=<?= $model->product_id ?>&op=8" style="font-weight: bold "><div class="alert alert-info">
                    Переміщення
                </div>
        </div></a>
        <div class="col-xs-12 col-md-6 col-lg-2">
            <a href="action?id=<?= $model->product_id ?>&op=7" style="font-weight: bold "><div class="alert alert-danger">
                    Повернення
                </div>
        </div></a>
        <!--?php
//        $statuses = \app\models\ProductStatus::find()->asArray()->all();
//        foreach ($statuses as $key=>$item){
//            echo $item["status_name"];
//        }
//        //                    //echo "<li><b>".$category["category_name"]."</b></li>";
//
//        ?-->
    </div>


            <!--?= Html::a('Редагувати товар', ['productupdate', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?-->
            <!--?= Html::a('Видалити', ['productdelete', 'id' => $model->product_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?-->



</div>
