<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Smoke */

$this->title = 'Create Smoke';
$this->params['breadcrumbs'][] = ['label' => 'Smokes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smoke-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
