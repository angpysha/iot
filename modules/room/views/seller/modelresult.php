<?php
/* @var $this yii\web\View */

//use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\select2\Select2;

$this->title = Yii::t('user', 'Результати');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Продавець'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пошук'), 'url' => ['modelsearch']];
$this->params['breadcrumbs'][] = $this->title;

?>
    <h1>Пошук</h1>
<?= $this->render('_menu') ?>

<div>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model,'ean')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\app\models\Product::find()->all(), 'ean', 'ean'),
            'language' => 'uk',
            'options' => ['placeholder' => 'Ввести код продукту'],

            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 0,
            ],

        ]) ?>

        <?= $form->field($model, 'model_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\app\models\ProductModel::find()->all(), 'model_id', 'model_name'),
            'language' => 'uk',
            'options' => ['placeholder' => 'Знайти модель'],

            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 0,
            ],

        ]) ?>

    <?= $form->field($model, 'notebook')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Product::find()->all(), 'notebook', 'notebook'),
        'language' => 'uk',
        'options' => ['placeholder' => 'Знайти за внутрішнім номером'],

        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 0,
        ],

    ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
</div>

<div class="model-result">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
    ]) ?>
    <div class="row">
        <?php foreach ($products as $arr) {?>

            <div class="col-sm-4 col-md-4" style="height: 400pt;">
                <div class="thumbnail">
                    <?php
                    $size = \app\models\Size::findOne(['size_id'=>$arr->size_id]);

                    //                    var_dump($size);

                    $pm = \app\models\ProductModel::findOne(['model_id'=>$arr->model_id]);
                    $loc = \app\models\Location::findOne(['location_id'=>$arr->location_id]);
                    $long = \app\models\ModelLong::findOne(['long_id'=>$pm->long_id]);
                    //var_dump($pm);
                    if($pm->image)  {
                        echo '<img src="http://mink.com.ua/image'.$pm->image.'" width="200px" title="'.$pm->description.'">';
                    }
                    else
                    {
                        echo '<img src="../../images/default.jpg" width="155px" >';
                    }
                    ?>
                    <div class="caption">
                        <h3><?= $loc->location_name ?></span><span style="color: #aa0000;font-size: 12pt">&nbsp;&nbsp;&nbsp; <span title="Довжина"><?= $long["long_name"] ?><span> / <span title="Український розмір"><?= $size["UKR"] ?></span> / <span title="Міжнародний розмір"><?= $size["INT"] ?></span></h3>
                        <div style="display: block">
                            <div style="text-align: left;font-size: larger"><?= $arr->notebook ?>&nbsp;(<?= $pm->model_name ?>)</div>
                            <div style="text-align: right;color: #00aa00; font-weight: bolder; font-size: large"><?= $arr->price ?></div>
                        </div>
                        <p>
                            <!-- <a href="company/view?id=//= $arr->id <!--"  class="btn btn-primary" role="button">Картка</a>-->
                            <a href="productview?id=<?= $arr->product_id ?>" rel="nofollow" target="_blank" class="btn btn-primary" role="button">Картка </a>
                            &nbsp;&nbsp;
                            <span style="text-align: right;font-size: 12pt"><?= $arr->ean ?></span>

                        </p>
                    </div>
                </div>
            </div>
        <?php }  ?>
        <?php
            if(count($products) == 0) {
                echo '<h3>Товарів цієї моделі немає у наявності! </h3>';
        }

        ?>
    </div>

    <?= \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
    ]) ?>

</div>


