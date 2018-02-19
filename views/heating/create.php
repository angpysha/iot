<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Heating */

$this->title = 'Create Heating';
$this->params['breadcrumbs'][] = ['label' => 'Heatings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="heating-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
