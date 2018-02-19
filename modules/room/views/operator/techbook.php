<?php
/* @var $this yii\web\View */
$this->title = Yii::t('user', 'Оператор');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Кабінет користувача'), 'url' => ['../room']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Менеджер'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Технічна документація</h1>
<?= $this->render('_menu') ?>
<!--h3>Головне меню</h3-->
<!--p>
    У кабінеті оператора можливо проконтолювати налаштування системи, реэструвати партії, створювати рецепти.
</p-->
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <dl>
            <dt>Необхідно реалізувати</dt>
            <dd>
                <ol>
                    <li>API повідомлень про аварійні стани з ESP модулів.</li>
                    <ul>
                        <li>Історія виникнення помилок.</li>
                        <li>Приймання помилок через API з ESP.</li>
                    </ul>
<!--					<li>Керування всією системою.</li>-->
<!--					<ul>-->
<!---->
<!--                    </ul>-->
                    <li>Уточнення параметрів керування дегідратором у різних режимах.</li>
                    <ul>
                        <li>Розписати параметри в JSON та реакцію на них на ESP</li>
                    </ul>

                </ol>
            </dd>
        </dl>
        <dl>
            <dt>Реалізувано не буде</dt>
            <dd>
                <ol>
                    <li>API повідомлень про аварійні стани з ESP модулів.</li>
                    <ul>
                        <li>Періодичний контроль з сервера та формування подій.</li>
                    </ul>
                    <li>Керування всією системою.</li>
                    <ul>

                        <li>Реєстрація/прив'язка сенсорів до параметрів системи.</li>
                    </ul>


                </ol>
            </dd>
        </dl>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <dl>
            <dt>Вже реалізувано</dt>
            <dd>
                <ol>
                    <li>API повідомлень про аварійні стани з ESP модулів.</li>
                    <ul>
                        <li>Рекомендації оператору, стосовно вирішення аварійних ситуацій.</li>
                        <li>Реєстр помилок в БД.</li>
                        <li>JSON responce.</li>
                    </ul>
                    <li>Керування всією системою.</li>
                    <ul>
                        <li>Функція визначенння часу, що минув у секундах для recorder_rate.</li>
                        <li>Керування діммером для двигунів замість {0,1} необхідено {0...5} 0,20,40,60,80,100% від максимальнгої потужності.</li>
                        <li>vent_engine	та vent_dimmer дублюють свої параметри.</li>
                        <li>Статична IP адреса.</li>
                        <li>Перемикання режимів: автоматичний, ручний з сервера, аварійний.</li>
                        <li>Графіки з параметрами, що передаються з сенсорів.</li>
                        <li>Запис в БД лише у разі коли режим не викненй.</li>
                    </ul>
                    <li>Параметри PID регулятора, розрахунок, прив'язка до рецепту.</li>
                    <ul>
                        <li>Коефіцієнти PID-контролера у вигляді профілів.</li>
                        <li>Стала часу PID-контролера як параметр.</li>
                        <li>Інтерфейс налаштування PID регулятора з сервеса.</li>
                        <li>Параметри в API для передачі на ESP.</li>
                        <li>Збереження та привязка коефіцієнтів до рецептів.</li>
                    </ul>
                    <li>Уточнення параметрів керування дегідратором у різних режимах.</li>
                    <ul>
                        <li>Перелік режимів</li>
                        <li>Параметри та їх відправка на ESP.</li>
                        <li>Розділення параметрів для різних підсистем.</li>
<!--                        <li>Алгоритми застосування параметрів підсистем.</li>-->
                    </ul>
                    <li>Гід встановлення/редагування параметрів для рецепту.</li>
                    <ul>
                        <li>Баг з діленням на 0, що заданий як значнняя параметру.</li>
                        <li>Форма для вводу параметрів.</li>
                        <li>Звести інформацію з різних таблиць БД в один інтерфейс.</li>
                    </ul>
                    <li>Інтерфейс керування загрузками:</li>
                    <ul>
                        <li>Час, що минув; час, що залишився.</li>
                        <li>Розпочати загрузку.</li>
                        <li>Рішення про завершення сеансу приймає оператор.</li>
                    </ul>

                    <li>API синхронізації параметрів системи з БД з ESP модулями.</li>
                    <ul>
                        <li>JSON responce.</li>
                    </ul>
                    <li>Сторінка моніторингу поточного стану з авто оновленням на стороні клієнта.</li>
                    <ul>
                        <li>Настройки відповідно до рецепту</li>
                        <li>таблиця поточних параметрів 'Captures'</li>
                        <li>вивід даних з таблиці на сторінку</li>
                        <li>оновлення  таблиці з API</li>
                    </ul>
                    <li>Інтерфейс керування приводами системи через веб сторінку (збер. в БД).</li>
                    <li>API передачі даних сенсорів від ESP модуля системи вентиляції.</li>
                    <li>API передачі даних сенсорів від ESP модуля системи терморегуляції.</li>
                    <li>CRUD для основних "сутностей" дегідратора</li>
                    <li>Кабінет оператора, авторизований доступ, ролі (RBAC).</li>
                </ol>
            </dd>
        </dl>
    </div>
</div>