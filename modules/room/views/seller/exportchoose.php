<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\select2\Select2;

$this->title = Yii::t('user', 'Продавець');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Продавець'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Каталог'), 'url' => ['catalog']];
$this->params['breadcrumbs'][] = $this->title;

$location = \app\models\Location::find()->asArray()->all();
//var_dump($location);
?>

<h1>Кабінет продавця</h1>
<?= $this->render('_menu') ?>
<h3>Оформити переміщення до </h3>
<div class="row">
    <?php
    foreach ($location as $loc){
        echo '<div class="col-xs-3 col-md-3 col-lg-3">';
        echo '<a href="export?id='.$loc["location_id"].'" style="font-weight: bold;font-size:20px; text-align: center">';
        echo '<div class="alert alert-info">'.$loc["location_name"].'</div>';
        echo '</a>';
        echo '</div>';
    }
    ?>
</div>
<?php

//    var_dump($parr);
?>





