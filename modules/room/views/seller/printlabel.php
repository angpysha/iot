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
<h3>Print label</h3>
<p>
    У кабінеті продавця можливо проконтолювати наявність товару, його місцезнаходження та всі операції з ним.
</p>

