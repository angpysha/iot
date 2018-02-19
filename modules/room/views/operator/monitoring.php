<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Html;
use kartik\widgets\SwitchInput;

$this->title = Yii::t('user', 'Оператор');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Менеджер'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 2000);
});
JS;
$this->registerJs($script);
?>
<h1>Моніторинг </h1>
<?= $this->render('_menu') ?>

<!--p>
    У кабінеті оператора можливо проконтолювати налаштування системи, реэструвати партії, створювати рецепти.
</p-->


    <div class="row">
    <?php Pjax::begin(); ?>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Параметри</h2>

        <?php
        //var_dump($model) ;
        echo '<table class="table table-striped">';
        echo '<thead>
      <tr>
        <th>Параметр</th>
        <th>Абревіатура</th>
        <th>Значення</th>
      </tr>
    </thead>
    <tbody>';
        foreach ($captures as $param){

            echo '<tr>
                <td>'.$param->comment.'</td>
                <td>'.$param->sensor_param.'</td>';
            if(\app\modules\room\controllers\OperatorController::getFreshness($param->sensor_param) > 5400)
                echo '<td><button type="button" class="btn btn-default btn-xs" title="'.$param->captured_time.'">'.$param->value.'</button></td>';
            else if(\app\modules\room\controllers\OperatorController::getFreshness($param->sensor_param) > 10)
                echo '<td><button type="button" class="btn btn-primary btn-xs" title="'.$param->captured_time.'">'.$param->value.'</button></td>';
            else
                echo '<td><button type="button" class="btn btn-success btn-xs" title="'.$param->captured_time.'">'.$param->value.'</button></td>';
              echo '</tr>';
        }
        echo '</tbody></table>';
        ?>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Рецепт <?= $time ?></h2>
        <?php
        //var_dump($model) ;
        echo '<table class="table table-striped">';
        echo '<thead>
      <tr>
        <th>Параметр</th>
        <!--th>Абревіатура</th-->
        <th>Значення</th>
      </tr>
    </thead>
    <tbody>';
        foreach ($setup as $param){

            echo '<tr>
                <td>'.$param->comment.'</td>
                <!--td>'.$param->setup_param.'</td-->
                <td><button type="button" class="btn btn-primary btn-xs">'.$param->value.'</button></td>
              </tr>';
        }
        echo '</tbody></table>';
        ?>

        <?= Html::a("Обновить", ['monitoring'], ['class' => 'btn btn-lg btn-primary hidden', 'id' => 'refreshButton']);?>
    </div>
        <?php Pjax::end(); ?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <h2>Настройки</h2>

            <?php
            //var_dump($model) ;
            echo '<table class="table table-striped">';
            echo '<thead>
      <tr>
        <th>Параметр</th>
        <!--th>Абревіатура</th-->
        <th>Значення</th>
      </tr>
    </thead>
    <tbody>';
            foreach ($settings as $param){

                echo '<tr>
                <td>'.$param["param"]->comment.'</td>
                <!--td>'.$param["param"]->param_name.'</td-->
                <td><button type="button" class="btn btn-primary btn-xs">'.$param->value.'</button></td>
              </tr>';
            }
            echo '</tbody></table>';
            ?>
        </div>

    </div>



