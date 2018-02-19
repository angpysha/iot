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

//$session = Yii::$app->session;
//$session->open();
//$location =  \app\models\Location::findOne(['location_id' => $session->get('locationchoose')]);
?>
<h1>Кабінет продавця</h1>
<?= $this->render('_menu') ?>
<h3>Прийом товарів"</h3>
<div class="row">
    <div class="col-xs-0 col-md-8 col-lg-8">


    </div>
    <div class="col-xs-12 col-md-4 col-lg-4">
        <div href="stocktakingindepth?session=&balance=1" style="font-weight: bold;font-size:24px; text-align: center"><div class="alert alert-success"-->
                <?= count($iarr) ?>
            </div></div>
    </div>
</div>

<div class="row">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-6">
        <?= $form->field($model,'ean', [
            'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control transparent']
        ])->textInput() ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'notebook')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\app\models\Sandbox::find()->all(), 'notebook', 'notebook'),
            'language' => 'uk',
            'options' => ['placeholder' => 'Знайти за внутрішнім номером'],

            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 0,
            ],
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-9">
        <a href="../seller/approvesession?sid=iarr&lid=" class="btn btn-success" role="button">Прийняти </a>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <a href="../seller/resetsession?sid=iarr" class="btn btn-default" role="button">Скинути </a>&nbsp;&nbsp;&nbsp;
            <?= Html::submitButton('Додати', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<?php

//    var_dump($iarr);
?>
<div class="row">
    <?php  if(isset($iarr)){ ?>
        <?php foreach ($iarr as $arr) {?>

            <div class="col-sm-3 col-md-3" style="height: 375pt;">
                <div class="thumbnail ">
                    <?php

                    $p  = \app\models\Product::findOne(['product_id'=>$arr]);
                    $pm = \app\models\ProductModel::findOne(['model_id'=>$p->model_id]);
                    $size = \app\models\Size::findOne(['size_id'=>$p->size_id]);

                    if($pm->image)
                        echo '<img src="http://mink.com.ua/image'.$pm->image.'" width="200px" title="'.$pm->description.'">';
                    else
                        echo '<img src="../../images/default.jpg" width="180px" >';

                    ?>
                    <div class="caption">
                        <h3><?= $p->ean ?></h3>
                        <div style="display: block">
                            <div style="text-align: left;font-size: larger"><?= $p->notebook ?>&nbsp;(<?= $pm->model_name ?>)</div>
                            <div style="text-align: right;color: #00aa00; font-weight: bolder; font-size: large"><?= $p->price ?></div>
                        </div>
                        <p>
                            <a href="../seller/productview?id=<?= $p->product_id ?>" rel="nofollow" target="_blank" class="btn btn-primary" role="button">Картка </a>
                            &nbsp;&nbsp;
                            <span style="color: #aa0000;font-size: larger">&nbsp;&nbsp;&nbsp;&nbsp; <?= $size["UKR"] ?> (<?= $size["INT"] ?>)</span>

                        </p>
                    </div>
                </div>

            </div>
        <?php }//foreach  ?>
    <?php }//isset  ?>
</div>

