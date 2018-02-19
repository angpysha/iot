<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Documents;
use app\models\Speciality;
use app\models\Company;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form ActiveForm */
?>
<?php $this->beginContent('@app/modules/room/views/admin/contract.php') ?>
<div class="request">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->dropDownList(
        ArrayHelper::map(Company::find()->all(), 'id', 'fullname'),//'speciality_id'
        ['prompt' => 'Компанія']
    ) ?>

    <?= $form->field($model, 'year') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>


<div class="company-form">

    <h3>Квоти за спеціальностями</h3>
    <p>У таблиці відображаються вже введені квоти. Зверніть увагу, що квоти можуть визначатись не лише за спеціальностями (групами), але і за напрямами (потоками)</p>
    <?php if(isset($dataProvider)) {   ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'layout'  => "{items}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'author.name'
            'speciality.code',
            [
                'header' => Yii::t('user', 'Спеціальність'),
                'value'  =>  'speciality.name',
            ],
//                'company.site:url',

            [
                'header' => Yii::t('user', 'Квота'),
                'value' => 'count',
            ],
            [
                'header' => Yii::t('user', 'Договір'),
                'value' => 'document.reg_num',
            ],
            [
                'header' => Yii::t('user', 'Дата від'),
                'value' => 'document.reg_date',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => ' {delete}',//{update}
            ],
        ],
    ]); ?>
    <?php  }  ?>

</div>

<?php $this->endContent() ?>