<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Venting */

$this->title = 'Create Venting';
$this->params['breadcrumbs'][] = ['label' => 'Ventings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
