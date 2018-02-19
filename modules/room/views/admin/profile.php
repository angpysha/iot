<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user', 'Профілі');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Адміністратор'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Профілі'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Профілі користувачів</h1>
<?= $this->render('_menu') ?>
<div class="profile-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!--?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?-->
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'name',
            'public_email:email',
//            'gravatar_email:email',
//            'gravatar_id',
            // 'location',
            // 'website',
            // 'bio:ntext',
             'uid',
            [
                'header' => Yii::t('user', ''),
                'value' => function ($dataProvider) {
                    return Html::a(Yii::t('user', ''), ['profileview', 'id' => $dataProvider->user_id], [
                        'class' => 'glyphicon glyphicon-play text-mute',
                        'data-method' => 'post',
                    ]);
                },'format' => 'raw',
            ],
            [
                'header' => Yii::t('user', ''),
                'value' => function ($dataProvider) {
                    return Html::a(Yii::t('user', ''), ['profileupdate', 'id' => $dataProvider->user_id], [
                        'class' => 'glyphicon glyphicon-pencil text-mute',
                        'data-method' => 'post',
                    ]);
                },'format' => 'raw',
            ],
//            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
