<?php
    use yii\helpers\Html;

$this->title = Yii::t('user', 'Кабінет користувача');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Менеджер'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="room-default-index">
    <h1>Тека користувача</h1>
    <div class="row">
        <div class="col-xs-12">

                    <div class="alert alert-success">
                        <?= 'Ви зайшли в кабінет налаштувань системи дегідратації' ?>
                    </div>
        </div>
    </div>
    <?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= Html::encode($profile['name']) ?>
                </div>
                <div class="panel-body">
                    <img src="http://gravatar.com/avatar/<?= $profile['gravatar_id'] ?>?s=200" />
                    <div >
                        <h4><?= $this->title ?></h4>
                        <ul style="padding: 0; list-style: none outside none;">
                            <?php if (!empty($profile['location'])): ?>
                                <li><i class="glyphicon glyphicon-map-marker text-muted"></i> <?= Html::encode($profile['location']) ?></li>
                            <?php endif; ?>
                            <?php if (!empty($profile['phone'])): ?>
                                <li><i class="glyphicon glyphicon-phone text-muted"></i> <?= Html::encode($profile['phone']) ?></li>
                            <?php endif; ?>
                            <?php if (!empty($profile['public_email'])): ?>
                                <li><i class="glyphicon glyphicon-envelope text-muted"></i> <?= Html::a(Html::encode($profile['public_email']), 'mailto:' . Html::encode($profile['public_email'])) ?></li>
                            <?php endif; ?>

                        </ul>
<!--                        --><?php //if (!empty($profile['bio'])): ?>
<!--                            <p>--><?//= Html::encode($profile['bio']) ?><!--</p>-->
<!--                        --><?php //endif; ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Обрати роль
                </div>
                <div class="panel-body">
                    <?php
                        foreach($roles as $role){
                            echo '<h4>&nbsp;&nbsp;<a href="room/'.$role->name.'/index">'.$role->description.'</a></h4>';
                        //var_dump($role);
                           // echo "<br/>$role->name";
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>


</div>
