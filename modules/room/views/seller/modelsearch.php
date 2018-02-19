<?php
/* @var $this yii\web\View */

//use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\select2\Select2;

$this->title = Yii::t('user', 'Пошук');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Продавець'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Каталог'), 'url' => ['catalog']];
$this->params['breadcrumbs'][] = $this->title;

?>
    <h1>Пошук</h1>
<?= $this->render('_menu') ?>

    <div>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model,'ean', [
            'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control transparent']
        ])->textInput() ?>

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



