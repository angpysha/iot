<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\VentingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контроль системи вентиляції';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Venting', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ventMode.name',
            'charging',
            'damp1',
            'damp2',
            'temp1',
            'temp2',
            // 'valve_in',
            // 'valve_out',
            // 'valve_cyr',
            'time_added',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
