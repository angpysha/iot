<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
$this->title = Yii::t('user', 'Оператор');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Менеджер'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Кабінет оператора</h1>


<?php
//$script = <<< JS
//$(document).ready(function() {
//    setInterval(function(){ $("#refreshButton").click(); }, 3000);
//});
//JS;
//$this->registerJs($script);
?>

<?php //Pjax::begin(); ?>
    <?= $this->render('_menu') ?>
<?php //Pjax::end(); ?>

<!--h3>Головне меню</h3-->
<!--p>
    У кабінеті оператора можливо проконтолювати налаштування системи, реэструвати партії, створювати рецепти.
</p-->
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Моніторинг</h2>
        <p style="text-align: center; color: #0b93d5"><span style="font-size: 75px; " class="glyphicon glyphicon-search"></span></p>
        <p>Поточний сеанс</p>
        <p>
            <a class="btn btn-default btn-lg" href="monitoring"><span class="glyphicon glyphicon-eye-open"></span> Переглянути &raquo;</a>&nbsp;
        </p>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Сеанси</h2>
        <p style="text-align: center; color: #0b93d5"><span style="font-size: 75px; " class="glyphicon glyphicon-off"></span></p>

        <?php
             $last = \app\models\Charging::find()->where(['finished' => "0000-00-00 00:00:00"])->one();
        if(isset($last->id)){ //RUNNING
            $receipt = \app\models\Receipt::findOne($last->receipt_id);
            echo '<p>Сеанс "<b>'.$receipt->receipt_name.'</b>". ID сеансу: '.$last->id.'.</p><p>';
            echo '<a class="btn btn-danger btn-lg" href="../../charging/stop"><span class="glyphicon glyphicon-stop gi-3x"></span> Stop &raquo;</a>&nbsp;';
            echo '<a class="btn btn-default btn-lg" href="../../charging/view?id='.$last->id.'"><span class="glyphicon glyphicon-calendar"></span> &nbsp;'.date('Y-m-d H:i',strtotime($last->started)).'</a>';
            echo '</p>';
        }
        else { //Can start New Party
            echo '<p>Сеанси реєстрації параметрів.</p><p>';
            echo '<a class="btn btn-info btn-lg" href="../../charging/create"><span class="glyphicon glyphicon-play gi-3x"></span> New &raquo;</a>&nbsp;';
            echo '<a class="btn btn-default btn-lg" href="../../charging/index?sort=-id"><span class="glyphicon glyphicon-list"></span> &nbsp;Реєстр &nbsp;</a>';
            echo '</p>';
        }
        ?>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Налаштування </h2>
        <p style="text-align: center; color: #0b93d5"><span style="font-size: 75px; " class="glyphicon glyphicon-cog"></span></p>
        <p>Збережені налаштування системи.</p>
        <p>
            <a class="btn btn-info btn-lg" href="../../receipt/create"><span class="glyphicon glyphicon-floppy-disk gi-3x"></span> New &raquo;</a>&nbsp;
            <a class="btn btn-default btn-lg" href="../../receipt/index"><span class="glyphicon glyphicon-list"></span> List &raquo;</a>

        </p>
    </div>

    <!--div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Роздрукувати наклейки</h2>
        <p style="text-align: center; color: #0b93d5"><span style="font-size: 75px; " class="glyphicon glyphicon-barcode"></span></p>
        <p > Інтерфейс друку наклейок.</p>
        <p><a class="btn btn-default btn-lg" href="printlabel"><span class="glyphicon glyphicon-print"></span> Друкувати &raquo;</a></p>
    </div-->
    <!--div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Номер моделі</h2>
        <p style="text-align: center; color: #0b93d5"><span style="font-size: 75px; " class="glyphicon glyphicon-search"></span></p>
        <p>Швидкий пошук за кодом з інтернету.</p>
        <p><a class="btn btn-default btn-lg" href="internetsearch"><span class="glyphicon glyphicon-search"></span> Gxxx &raquo;</a></p>
    </div-->
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Профайл</h2>
        <p style="text-align: center; color: #0b93d5"><span style="font-size: 75px; " class="glyphicon glyphicon-wrench"></span></p>
        <p>Журнал подій.</p>
        <p><a class="btn btn-default btn-lg" href="../../settings/index"><span class="glyphicon glyphicon-wrench"></span> Переглянути &raquo;</a></p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Інструкція</h2>
        <p style="text-align: center; color: #0b93d5"><span style="font-size: 75px; " class="glyphicon glyphicon-info-sign"></span></p>
        <p>Технічна документація.</p>
        <p><a class="btn btn-default btn-lg" href="techbook"><span class="glyphicon glyphicon-education"></span> Переглянути &raquo;</a></p>
    </div>
</div>
<?= Html::a("Обновить", ['index'], ['class' => 'btn btn-lg btn-primary hidden', 'id' => 'refreshButton']);?>

