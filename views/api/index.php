<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductActionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Actions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-action-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product Action', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
