<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Html;
use kartik\widgets\SwitchInput;
use kartik\widgets\TouchSpin;

$this->title = Yii::t('user', 'Оператор');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Менеджер'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//var_dump($setup[6]["value"]);
?>
<h1>Кабінет оператора</h1>
<?= $this->render('_menu') ?>
<h3>Ручне керування</h3>
<div class="row1">
    <?php if($setup[6]["value"] == '0') {  ?>
        <p><a class="btn btn-success btn-lg" href="manualactivate?action=activate"><span class="glyphicon glyphicon-wrench"></span> Активувати &raquo;</a></p>

    <?php }  else if($setup[6]["value"] == '2') { ?>
    <p><a class="btn btn-default btn-lg" href="manualactivate?action=deactivate"><span class="glyphicon glyphicon-wrench"></span> Деактивувати &raquo;</a></p>
    <?php $form = ActiveForm::begin([
        'id' => 'favorite-form',
        'enableAjaxValidation' => false,
    ]); ?>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<?= $form->field($model, 'list_ids')
//    ->listBox($items, ['multiple' => true, 'size' => 30])
    /* or, you may use a checkbox list instead */
    ->checkboxList($items)
    ->hint('Слід відмітити галочками необхідні категорії');
?>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'angle_valve_in')->widget(TouchSpin::classname(),[
        'name' => 't1',
        'pluginOptions' => [
//            'initval' => 0,
            'min' => 0,
            'max' => 90,
            'step' => 5,
            'decimals' => 0,
//            'boostat' => 5,
            'maxboostedstep' => 10,
            'prefix' => '&deg;',
            'buttonup_class' => 'btn btn-primary',
            'buttondown_class' => 'btn btn-primary',
            'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
            'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
        ],
    ]) ?>

    <?= $form->field($model, 'angle_valve_out')->widget(TouchSpin::classname(),[
        'name' => 't2',
        'pluginOptions' => [
//            'initval' => 0,
            'min' => 0,
            'max' => 90,
            'step' => 5,
            'decimals' => 0,
//            'boostat' => 5,
            'maxboostedstep' => 10,
            'prefix' => '&deg;',
            'buttonup_class' => 'btn btn-primary',
            'buttondown_class' => 'btn btn-primary',
            'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
            'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
        ],
    ]) ?>

    <?= $form->field($model, 'angle_valve_cyr')->widget(TouchSpin::classname(),[
        'name' => 't3',
        'pluginOptions' => [
//            'initval' => 0,
            'min' => 0,
            'max' => 90,
            'step' => 5,
            'decimals' => 0,
//            'boostat' => 5,
            'maxboostedstep' => 10,
            'prefix' => '&deg;',
            'buttonup_class' => 'btn btn-primary',
            'buttondown_class' => 'btn btn-primary',
            'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
            'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
        ],
    ]) ?>

    <?= $form->field($model, 'vent_engine')->widget(TouchSpin::classname(),[
        'name' => 't4',
        'pluginOptions' => [
//            'initval' => 0,
            'min' => 0,
            'max' => 100,
            'step' => 20,
            'decimals' => 0,
//            'boostat' => 5,
            'maxboostedstep' => 20,
            'prefix' => '%',
            'buttonup_class' => 'btn btn-success',
            'buttondown_class' => 'btn btn-success',
            'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
            'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
        ],
    ]) ?>

    <?= $form->field($model, 'pump_circulator')->widget(TouchSpin::classname(),[
        'name' => 't5',
        'pluginOptions' => [
//            'initval' => 0,
            'min' => 0,
            'max' => 100,
            'step' => 20,
            'decimals' => 0,
//            'boostat' => 5,
            'maxboostedstep' => 20,
            'prefix' => '%',
            'buttonup_class' => 'btn btn-warning',
            'buttondown_class' => 'btn btn-warning',
            'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
            'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
        ],
    ]) ?>

    <?= $form->field($model, 'pump_cold')->widget(TouchSpin::classname(),[
        'name' => 't6',
        'pluginOptions' => [
//            'initval' => 0,
            'min' => 0,
            'max' => 100,
            'step' => 20,
            'decimals' => 0,
//            'boostat' => 5,
            'maxboostedstep' => 20,
            'prefix' => '%',
            'buttonup_class' => 'btn btn-warning',
            'buttondown_class' => 'btn btn-warning',
            'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
            'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
        ],
    ]) ?>

    <?= $form->field($model, 'pump_hot')->widget(TouchSpin::classname(),[
        'name' => 't7',
        'pluginOptions' => [
//            'initval' => 0,
            'min' => 0,
            'max' => 100,
            'step' => 20,
            'decimals' => 0,
//            'boostat' => 5,
            'maxboostedstep' => 20,
            'prefix' => '%',
            'buttonup_class' => 'btn btn-warning',
            'buttondown_class' => 'btn btn-warning',
            'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
            'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
        ],
    ]) ?>

    <?= Html::submitButton('Зберегти', [
        'class' => 'btn btn-primary'
    ]) ?>
    <?php ActiveForm::end(); ?>
</div>
<div class="col-md-12">

</div>

<?php ActiveForm::end(); ?>
<?php }  else { ?>
<p><a class="btn btn-danger btn-lg" href="manualactivate?action=activate"><span class="glyphicon glyphicon-wrench"></span> Активувати &raquo;</a></p>
<?php } ?>
</div>
