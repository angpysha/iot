<?php
/* @var $this yii\web\View */
//use Yii;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('user', 'Оформлення продажу');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Продавець'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Каталог'), 'url' => ['catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Картка товару'), 'url' => ['productview', 'id' => $model->product_id]];//$model->model_id
$this->params['breadcrumbs'][] = $this->title;

$location = \app\models\Location::findOne(['location_id' => $model->location_id]);
$pm = \app\models\ProductModel::findOne(['model_id' => $model->model_id]);
?>
<h1>Оформлення продажу <?= $model->ean ?> (<?= $model->notebook ?>)</h1>
<!--?= $this->render('_menu') ?-->
<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
<?php $form = ActiveForm::begin(); ?>
<?php

$content1 = ''.$form->field($actionform,'price')->textInput();
$content2 = ''.$form->field($actionform,'client_id')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+38(999)999-99-99',
    ]);
//$content2 = 'La-La-La2';
$content3 = '
<hr class="more">
<table width="100%">
    <tr>
        <td><img align="left" width="500px" src="http://gate.mink.com.ua/web/images/FARAON-01.jpg"></td>
        <td>
            <h3 class="check">Магазин хутра та шкіри "Фараон"</h3>
            <h5 class="check">http://mink.com.ua</h5>
            <h4 class="check">'.$location['location_name'].'</h4>
            <h4 class="check">'.$location['address'].'</h4>
            <h4 class="check">'.$location['telephone'].'</h4>
            
        </td>
    </tr>
</table> 
 <h4 class="check">Товарний чек № ___ від '.date("d.m.Y ").'</h4><br/>
<table border="1" class="check" width="100%">
    <tr><td>Код товару</td><td>Найменування</td><td>Ціна</td><td>Знижка</td><td>Разом</td></tr>
    <tr><td>'.$model->ean.' ('.$model->notebook.')</td><td>'.$pm['model_name'].'</td><td>'.$model->price.'</td><td> </td><td> </td></tr>
</table><br/>';//.Html::submitButton('Submit', ['class' => 'btn btn-primary'])   // '.$pm['description'].'
//$content3 .= '
//<p align="center"><strong>Пам\'ятка по догляду за хутряними виробами</strong></p>
//<p align="justify">1. Вироби не рекомендується носити під час дощу і мокрого снігу.</p>
//<p align="justify">2. Намокший виріб необхідно просушити за кімнатної температури в розправленому вигляді подалік від нагрівальних приладів.</p>
//<p align="justify">3. Під час тривалого зберігання виробу рекомендується його періодично провітрювати то просушувати. Регулярно проводити заміну засобів проти молі.</p>
//<p align="justify">4. Не зберігайте вироби в поліетиленовому пакеті. Хутро любить наявність повітряного простору. Це забезпечить збереження первісного вигляду.</p>
//<p align="justify">5. Під час носіння і зберігання уникайте механічного пошкодження і тертя поверхні виробу об жорсткі або гострі предмети.</p>
//<p align="justify">6. Під час носіння виробу можлива поява потертостей в місцях найбільшої експлуатації. Це не погіршує фізико-механічні властивості виробу, а навпаки підтверджує його натуральність.</p>
//<p align="justify">7. У разі неправильної експлуатації (хімічно-агресивні середовища), неправильному зберіганні та у разі несвоєчасного пред\'явлення претензій виріб обміну і поверненню на підлягає.</p>
//<p align="justify">8. Потребує спеціалізової чистки.</p>';

$content3 .= '<div><div class="col-lg-4" >Продавець</div><div class="col-lg-4" >   __________      </div><div class="col-lg-4" >_______________</div></div>';
?>
<?php

$wizard_config = [
    'id' => 'stepwizard',

    'steps' => [
        1 => [
            'title' => 'Ціна реалізації',
            'icon' => 'glyphicon glyphicon-euro',//barcode
            'content' => '<h3>Ціна реалізації</h3><br/>'.$content1,
            'buttons' => [
                'next' => [
                    'title' => 'Далі',
                    'options' => [
                        'class' => 'btn btn-default'
                    ],
                ],
            ],
        ],
        2 => [
            'title' => 'Дисконтна програма',
            'icon' => 'glyphicon glyphicon-earphone',
            'content' => '<h3>Дисконтна програма</h3><br/>'.$content2,
            'skippable' => true,
        ],
        3 => [
            'title' => 'Квитанція',
            'icon' => 'glyphicon glyphicon-print',
            'content' => '<h3>Інформація про виконувану операцію</h3><br/>'.$content3,
            'buttons' => [
                'save' => [
                    'title' => 'Зберегти',
                    'options' => [
                        'class' => 'btn btn-default',
                        'data-confirm' => Yii::t('user', 'Ви впевнені, що хочете закінчити проведення операції продажу?')
                    ],
                ],
            ],
        ],
    ],
    'complete_content' => "Для завершення операції продажу слід натистути на кнопку \"Зберегти\"!", // Optional final screen
    'start_step' => 1, // Optional, start with a specific step
];
?>

<?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>

<?php ActiveForm::end(); ?>
<!--dl>
    <dt>"<strong>Дисконтна програма</strong>"</dt>
    <dd>У цьому розділі виконується призначення практики, серед списків необхідно звірити і додати лише тих хто наразі навчається і реально буде проходити практику. </dd>
    <br>

    <dt>"<strong>Рух товарів</strong>"</dt>
    <dd>У розділі "Бази практики" додаються компанії, що можкть бути базами практики та оформлюються договори, також у цьому розділі можливо проконтролювати всі запити та квоти по спеціальностям.</dd>
    <br>

    <dt>"<strong>Баланс</strong>"</dt>
    <dd>У розділі "Розподіл на практику", обравши компанію та групу у ручному режимі можливо призначити студентам практику. </dd>
    <br>

    <dt><strong>Зіти</strong>"</dt>
    <dd>У розділі "Керівники практики", студентам призначаються керівники практики від факультету. Серед опцій можливо обрати гру3пування студентів як по групам так і по компаніям. У цьому разі легко виконати розподіл так, щоб на одну компанію був лише один керівник практики від факультету. </dd>
    <br>


</dl-->
