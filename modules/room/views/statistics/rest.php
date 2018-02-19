<?php

/* 
 * This file is part of the Dektrium project
 * 
 * (c) Dektrium project <http://github.com/dektrium>
 * 
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Company;
/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $user
 */

?>
<?php $this->beginContent('@app/modules/room/views/statistics/marketingtemplate.php') ?>

    <div>
        <h3>Залишок товару: мысцеположення - к-ть </h3>
        <table border="1" class="table">
            <thead>
            <tr><td>#</td><td>Модель</td><td>Назва моделі</td><td>Дія</td></tr>
            </thead>
            <tbody>
            <?php
                $cnt = 0;
//                foreach ($sarr as $key=>$s){
//                    $cnt++;
//
//                    echo "<tr><td>".$cnt."</td><td><a href='../manager/productindex?ProductSearch[model_id]=".$s['model_id']."' target='_blank'>G".$s['model_id']."</a></td><td>".$s['model_name']."</td><td><a href='deletes?id=".$s['model_id']."'>[Видалити]</a></td></tr>";
//
//                }

            ?>
            </tbody>
        </table>
    </div>

<?php $this->endContent() ?>
