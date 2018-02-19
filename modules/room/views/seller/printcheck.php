<?php
/* @var $this yii\web\View */

$this->title = Yii::t('user', 'Продавець');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Продавець'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Каталог'), 'url' => ['catalog']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h1>Кабінет продавця</h1>
<?= $this->render('_menu') ?>
<h3>Довідка</h3>
<p>
    У кабінеті продавця можливо проконтолювати наявність товару, його місцезнаходження та всі операції з ним.
</p>
<dl>
    <dt>"<strong>Товари</strong>"</dt>
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


</dl>
