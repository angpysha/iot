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
<h3>Функціонал</h3>
<!--p>
    У кабінеті продавця можливо проконтолювати наявність товару, його місцезнаходження та всі операції з ним.
</p-->
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Кошик</h2>
        <p style="text-align: center; color: #0b93d5"><span style="font-size: 75px; " class="glyphicon glyphicon-shopping-cart"></span></p>
        <p>Оформити товари одним чеком.</p>
        <p> <a class="btn btn-default btn-lg" href="export"><span class="glyphicon glyphicon-shopping-cart gi-3x"></span> Оформити продаж &raquo;</a></p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Переміщення відправити</h2>
        <p style="text-align: center; color: #0b93d5"><span style="font-size: 75px; " class="glyphicon glyphicon-arrow-up"></span></p>
        <p>Відправити товар у інший магазин.</p>
        <p> <a class="btn btn-default btn-lg" href="export"><span class="glyphicon glyphicon-export gi-3x"></span> Відправити &raquo;</a></p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Переміщення прийняти</h2>
        <p style="text-align: center; color: #0b93d5"><span style="font-size: 75px; " class="glyphicon glyphicon-arrow-down"></span></p>
        <p>Прийняти товар з іншого магазину.</p>
        <p><a class="btn btn-default btn-lg" href="import"><span class="glyphicon glyphicon-import"></span> Прийняти &raquo;</a></p>
    </div>
    <!--div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Роздрукувати наклейки</h2>
        <p style="text-align: center; color: #0b93d5"><span style="font-size: 75px; " class="glyphicon glyphicon-barcode"></span></p>
        <p > Інтерфейс друку наклейок.</p>
        <p><a class="btn btn-default btn-lg" href="printlabel"><span class="glyphicon glyphicon-print"></span> Друкувати &raquo;</a></p>
    </div-->
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Номер моделі</h2>
        <p style="text-align: center; color: #0b93d5"><span style="font-size: 75px; " class="glyphicon glyphicon-search"></span></p>
        <p>Швидкий пошук за кодом з інтернету.</p>
        <p><a class="btn btn-default btn-lg" href="internetsearch"><span class="glyphicon glyphicon-search"></span> Gxxx &raquo;</a></p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2>Запит</h2>
        <p style="text-align: center; color: #0b93d5"><span style="font-size: 75px; " class="glyphicon glyphicon-wrench"></span></p>
        <p>Повідомити про несправність.</p>
        <p><a class="btn btn-default btn-lg" href="internetsearch"><span class="glyphicon glyphicon-wrench"></span> Технічна допомога &raquo;</a></p>
    </div>
</div>

<!--dl>
    <dt>"<strong>Пошук</strong>"</dt>
    <dd>У розділі пошук за штрих-кодом або за внутрішнім номером можливо знайти конкретний товар і виконати опереції по ньому (продаж, бронювання та ін.). У разі продажу можливо роздрукувати чек.</dd>
    <br>

    <dt>"<strong>Кошик</strong>"</dt>
    <dd>У разі, якщо покупець купляє за один раз декілька різних товарів слід скористатися закладкою "Кошик". У цій закладці слід знайти за штрих-кодом або внутрішнім номером всі товари, що продаються в одні руки та роздрукувати один чек на всі товари.</dd>
    <br>

    <dt>"<strong>Розміри</strong>"</dt>
    <dd>У розділі "Розміри" можливо знайти товари всіх моделей певного розміру. У разі якщо в магазині немає товару необхідного розміру, то саме у цій закладці можливо уточнити чи є необхіджний розмір у інших магазинах (<i>У розробці</i>). </dd>
    <br>

    <dt><strong>Каталог</strong>"</dt>
    <dd>У розділі "Каталог", студентам призначаються керівники практики від факультету. Серед опцій можливо обрати гру3пування студентів як по групам так і по компаніям. У цьому разі легко виконати розподіл так, щоб на одну компанію був лише один керівник практики від факультету. </dd>
    <br>


</--dl>
