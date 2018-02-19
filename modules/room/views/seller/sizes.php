<?php
/* @var $this yii\web\View */

//use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\select2\Select2;

$this->title = Yii::t('user', 'Каталог');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Продавець'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Каталог'), 'url' => ['catalog']];
$this->params['breadcrumbs'][] = $this->title;

?>
    <h1>Пошук</h1>
<?= $this->render('_menu') ?>

    <div>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model,'category_id')->dropDownList(
            ArrayHelper::map(\app\models\ModelToCategory::find()->joinWith(['category'])->select(['*', 'category.category_name'])
                //->where('parent > 0')
                ->groupBy('model_to_category.category_id')
                ->all(), 'category_id', 'category.category_name'),//$array2,"id","name"
            [
                'prompt' => 'Обрати категорію',
                'onchange' =>
                    '$.post( "../../category/sizeavailable?id='.'"+$(this).val(), function( data ){
                                    $( "select#sellerform-size_id" ).html( data );
                                });'
            ]
        )
        ?>


        <?= $form->field($model,'size_id')->dropDownList(
            ArrayHelper::map(\app\models\Product::find()
                ->joinWith(['size'])
                ->select(['*', 'size.UKR', 'size.INT', 'size.sex'])//
                //->where('parent > 0')
                ->groupBy('product.size_id')
                ->orderBy('product.size_id')
                ->all(),  'size_id', 'size.UKR', 'size.sex'),//$array2,"id","name"
            [
                'prompt' => 'Обрати розмір',
//                'onchange' =>
//                    '$.post( "../../group/year?id='.'"+$(this).val(), function( data ){
//                                    $( "select#workform-group_id" ).html( data );
//                                });'
            ]
        )
        ?>

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

            <div class="col-sm-4 col-md-4" style="height: 375pt;">
                <div class="thumbnail">
                    <?php
                    $size = \app\models\Size::findOne(['size_id'=>$arr->size_id]);

//                    var_dump($size);

                    $pm = \app\models\ProductModel::findOne(['model_id'=>$arr->model_id]);
                    $loc = \app\models\Location::findOne(['location_id'=>$arr->location_id]);
                    $long = \app\models\ModelLong::findOne(['long_id'=>$pm->long_id]);
                    //var_dump($pm);
                    if($pm->image)  {
                        echo '<img src="http://mink.com.ua/image/'.$pm->image.'" width="200px" title="'.strip_tags($pm->description).'">';
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
    </div>
    <?= \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
    ]) ?>

</div>




