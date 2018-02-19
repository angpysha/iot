<?php
/* @var $this yii\web\View */

$this->title = Yii::t('user', 'Оформлення продажу');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Продавець'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Каталог'), 'url' => ['catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Картка товару'), 'url' => ['productview', 'id' => 1]];//$model->model_id
$this->params['breadcrumbs'][] = $this->title;

?>
<h1>Дія з товаром</h1>
<?= $this->render('_menu') ?>
<!--<h3>Довідка</h3>-->

<?php
$wizard_config = [
    'id' => 'stepwizard',
    'steps' => [
        1 => [
            'title' => 'Ціна реалізації',
            'icon' => 'glyphicon glyphicon-euro',//barcode
            'content' => '<h3>Ціна реалізації</h3>This is step 1',
//            'buttons' => [
//                'next' => [
//                    'title' => 'Forward',
//                    'options' => [
//                        'class' => 'disabled'
//                    ],
//                ],
//            ],
        ],
        2 => [
            'title' => 'Дисконтна програма',
            'icon' => 'glyphicon glyphicon-earphone',
            'content' => '<h3>Дисконтна програма</h3>This is step 2',
            'skippable' => true,
        ],
        3 => [
            'title' => 'Квитанція',
            'icon' => 'glyphicon glyphicon-print',
            'content' => '<h3>Квитанція</h3>This is step 3',
        ],
    ],
    'complete_content' => "Функціонал ще не реалізовано!", // Optional final screen
    'start_step' => 1, // Optional, start with a specific step
];
?>

<?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>

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
