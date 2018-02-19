<?php

namespace app\modules\room\controllers;

use app\models\ModelToCategory;
use app\models\ModelToFilter;
use app\models\ProductModel;
use app\models\ProductStatus;
use app\models\Sandbox;
use app\models\Settings;
use dektrium\user\models\Profile;
use yii\data\Pagination;
use app\models\Product;
use app\models\SellerForm;
use dektrium\user\models\User;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use app\models\ActionForm;
use app\models\ProductAction;
use mPDF;

class SellerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if(Yii::$app->user->can('seller')) {
            return $this->render('index');
        }
        else
            throw new ForbiddenHttpException;

    }

    public function actionAction()
    {
        if(Yii::$app->user->can('seller')) {

            $op = $_GET['op'];
            $model = $this->findProductModel($_GET['id']);
            $status = ProductStatus::findOne(['status_id' => $model->status_id]);
            $cur = Settings::findOne('USD');

            $actionform = new ActionForm();
            $productaction = new ProductAction();
            $actionform->price = $model->price; // внесення у форму вартості за замовчуванням

            if ($actionform->load(Yii::$app->request->post()) && $actionform->validate()) {
                $productaction->user_id = Yii::$app->user->getId();
                $productaction->product_id = $model->product_id;
                $productaction->model_id = $model->model_id;
                $productaction->ean = $model->ean;
                $productaction->location_id = $model->location_id;
                $productaction->status_id = $op;//продаж at al
                $productaction->client_id = $actionform->client_id; //клієнт
                $productaction->rate = $actionform->price / $cur['value']*100; //клієнт
                $productaction->save();

                $model->status_id = $op;// продаж at al
                $model->save();

                switch($op){
                    case 2://у разі операції продажу
                        Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Товар успішно проведено'));
                        $this->actionPrintcheck($productaction);
                        break;
                    case 3://у разі операції бронювання
                        Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Товар успішно відкладено'));
                        break;
                    case 4://у разі операції оформленння кредиту
                        Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Товар оформлено у кредит'));
                        $this->actionPrintcheck($productaction);
                        break;
                    case 7://у разі операції запиту на повернення
                        Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Запит на повернення товару успішно сформований'));
                        break;
                    case 8://у разі операції запиту на переміщення
                        Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Запит на переміщення сформовано'));
                        break;

                }
                return $this->redirect('productview?id='.$_GET['id']);
            }
            else{ // Forbidden exception
                switch($op){
                    case 2://у разі операції продажу
                        if($model->status_id == 1 || $model->status_id == 3){
                            if($model->status_id == 3)
                                Yii::$app->getSession()->setFlash('warning', Yii::t('user', 'Зверніть увагу! Товар <b>"'.$status['status_name'].'"</b>, уточніть чи покупець є клієнтом який раніше відклав цей товар'));
                            return $this->render('selling', [
                                'actionform' => $actionform,
                                'model' => $model ,
                            ]);
                        }
                        else {
                            Yii::$app->getSession()->setFlash('danger', Yii::t('user', 'Оскільки товар <b>"'.$status['status_name'].'"</b> операцію продажу оформити не можливо'));
                            return $this->redirect('productview?id='.$_GET['id']);
                        }
                        break;
                    case 3://у разі операції відкласти
                        if($model->status_id == 1 ){//|| $model->status_id == 3
//                            if($model->status_id == 3)
//                                Yii::$app->getSession()->setFlash('warning', Yii::t('user', 'Зверніть увагу! Товар <b>"'.$status['status_name'].'"</b>, уточніть чи покупець є клієнтом який раніше відклав цей товар'));
                            return $this->render('setaside', [
                                'actionform' => $actionform,
                                'model' => $model ,
                            ]);
                        }
                        else {
                            Yii::$app->getSession()->setFlash('danger', Yii::t('user', 'Оскільки товар <b>"'.$status['status_name'].'"</b> операцію бронювання оформити не можливо'));
                            return $this->redirect('productview?id='.$_GET['id']);
                        }
                        break;
                    case 4://у разі операції оформлення кредиту
                        if($model->status_id == 1 || $model->status_id == 3 || $model->status_id == 4) {
                            if($model->status_id == 3)
                                Yii::$app->getSession()->setFlash('warning', Yii::t('user', 'Зверніть увагу! Товар <b>"'.$status['status_name'].'"</b>, уточніть чи покупець є клієнтом який раніше відклав цей товар'));
                            if($model->status_id == 4)
                                Yii::$app->getSession()->setFlash('warning', Yii::t('user', 'Зверніть увагу! Товар <b>"'.$status['status_name'].'"</b>, далі можливо проводити лише внески по кредиту'));
                            return $this->render('credit', [
                                'actionform' => $actionform,
                                'model' => $model,
                            ]);
                        }
                        else {
                            Yii::$app->getSession()->setFlash('danger', Yii::t('user', 'Оскільки товар <b>"'.$status['status_name'].'"</b> операцію оформити кредит не можливо'));
                            return $this->redirect('productview?id='.$_GET['id']);
                        }
                        break;
                    case 7://у разі операції повернення товару
                        if($model->status_id == 2 || $model->status_id == 4)
                            return $this->render('returnback', [
                                'actionform' => $actionform,
                                'model' => $model ,
                            ]);
                        else {
                            Yii::$app->getSession()->setFlash('danger', Yii::t('user', 'Оскільки товар <b>"'.$status['status_name'].'"</b> операцію продажу оформити не можливо'));
                            return $this->redirect('productview?id='.$_GET['id']);
                        }
                        break;
                    case 8://у разі операції запиту на переміщення
                        if($model->status_id == 1 || $model->status_id == 3)
                            return $this->render('moving', [
                                'actionform' => $actionform,
                                'model' => $model ,
                            ]);
                        else {
                            Yii::$app->getSession()->setFlash('danger', Yii::t('user', 'Оскільки товар <b>"'.$status['status_name'].'"</b> операцію запиту на переміщення оформити не можливо'));
                            return $this->redirect('productview?id='.$_GET['id']);
                        }
                        break;
                }
            }
        }
        else
            throw new ForbiddenHttpException;

    }

    public function actionPrintcheck($productaction)
    {
        $cur = Settings::findOne('USD');
        $location = \app\models\Location::findOne(['location_id' => $productaction->location_id]);
        $pm = \app\models\ProductModel::findOne(['model_id' => $productaction->model_id]);
        $notebook = \app\models\Product::findOne(['product_id' => $productaction->product_id]);

        $categories = ModelToCategory::find()->select("category_id")->where(['productmodel_id' => $productaction->model_id])->asArray()->all();//->leftJoin('category')
//        var_dump($categories[0]);
        $arr=[];
        foreach ($categories as $i=>$cat)
            $arr[$i] = $cat["category_id"];
//        var_dump($arr);
//        var_dump(in_array(26, $arr)) ;
//        die();

        $demp = round( $notebook['price'] - $productaction->rate*$cur['value']/100, 0, PHP_ROUND_HALF_UP);;
        $content3 = '
        <table width="100%">
            <tr>
                <td><img align="left" width="300px" src="http://gate.mink.com.ua/web/images/FARAON-01.jpg"></td>
                <td>
                    <h3 class="check">Магазин ексклюзивного одягу "Фараон"</h3>
                    <h5 class="check">http://mink.com.ua</h5>
                    <h4 class="check">'.$location['location_name'].'</h4>
                    <h4 class="check">'.$location['address'].'</h4>
                    <h4 class="check">'.$location['telephone'].'</h4>
                    
                </td>
            </tr>
        </table> 
         <p align="center">Товарний чек № '.$productaction->id.' від '.date("d.m.Y ").'</p><br/>
        <table border="1" class="check" width="100%">
            <tr><td>Код товару</td><td>Найменування</td><td>Ціна</td><td>Знижка</td><td>Разом</td></tr>
            <tr><td>'.$productaction->ean.' ('.$notebook["notebook"].')</td><td>'.$pm['model_name'].'</td><td>'.$pm['price'].'</td><td>'.$demp.'</td><td>'.$productaction->rate*$cur['value']/100 .'</td></tr>
        </table><br/>';//.Html::submitButton('Submit', ['class' => 'btn btn-primary'])   // '.$pm['description'].'

        $content3 .= '<div>Продавець&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_______________</div><br/>';

        if(in_array(1, $arr) || in_array(3, $arr))//Хутро - Жилетки
            $content3 .= '<div style="font-size: x-small"><p align="center"><strong>Пам\'ятка по догляду за хутряними виробами </strong></p >
<p align = "justify"> 1. Вироби не рекомендується носити під час дощу і мокрого снігу.</p >
<p align = "justify"> 2. Намокший виріб необхідно просушити за кімнатної температури в розправленому вигляді подалік від нагрівальних приладів.</p >
<p align = "justify"> 3. Під час тривалого зберігання виробу рекомендується його періодично провітрювати та просушувати. Регулярно проводити заміну засобів проти молі.</p >
<p align = "justify"> 4. Не зберігайте вироби в поліетиленовому пакеті. Хутро любить наявність повітряного простору. Це забезпечить збереження первісного вигляду.</p >
<p align = "justify"> 5. Під час носіння і зберігання уникайте механічного пошкодження і тертя поверхні виробу об жорсткі або гострі предмети.</p >
<p align = "justify"> 6. Під час носіння виробу можлива поява потертостей в місцях найбільшої експлуатації. Це не погіршує фізико - механічні властивості виробу, а навпаки підтверджує його натуральність.</p >
<p align = "justify"> 7. У разі неправильної експлуатації(хімічно - агресивні середовища), неправильному зберіганні та у разі несвоєчасного пред\'явлення претензій виріб обміну і поверненню на підлягає.</p>
<p align="justify">8. Потребує спеціалізової чистки.</p></div>';

        if(in_array(5, $arr))//Пуховики
            $content3 .= '<div style="font-size: x-small"><p align="center"><strong>Пам\'ятка щодо догляду за виробами з синтетичним утеплювачем </strong></p>
<p align = "justify"> 1. Прати за температури 30 градусів, використовуючи тільки м\'які порошки, які не містять відбілюючі компоненти або інші концентровані їдкі речовини.</p>
<p align = "justify"> 2. Виріб не варто замочувати і відбілювати.</p>
<p align = "justify"> 3. Виріб рекомендовано прати вручну або в пральній машині у режимі «делікатного прання».</p>
<p align = "justify"> 4. Виріб може піддаватися сушінню в барабанній сушарці за умови встановлення низької температури.</p></div>';

        if(in_array(6, $arr))//Пальто
            $content3 .= '<div style="font-size: x-small"><p align="center"><strong>Пам\'ятка по догляду за пальтом </strong></p>
<p align = "justify"> 1. Потребує спеціалізової чистки.</p>
<p align = "justify"> 2. Після впливу вологи просушити пальто в вертикальному положенні і для видалення бруду скористатися сухою щіткою.</p>
<p align = "justify"> 3. Відпарювати тканину тільки за допомогою парової праски.</p>
<p align = "justify"> 4. Щоб уникнути потертостей не рекомендується піддавати виріб ретельному тертю.</p>
<p align = "justify"> 5. Під час тривалого зберігання виробу рекомендується його періодично провітрювати та просушувати. Регулярно проводити заміну засобів проти молі.</p>
</div>';


        $mpdf=new mPDF('',    // mode - default ''
            'A5',    // format - A4, for example, default ''
            10,     // font size - default 0
            'Verdana',    // default font family
            10,    // margin_left
            10,    // margin right
            10,     // margin top
            10,    // margin bottom
            0,     // margin header
            0,     // margin footer
            'P');  // L - landscape, P - portrait
        $mpdf->WriteHTML($content3);
        $mpdf->Output();//'check.pdf', 'D'
//        exit;
    }

    /*
     * Search all Products by model name or one Product by ean or notebook
     * Null
     * array
     * */

    public function actionModelsearch()
    {
        if(Yii::$app->user->can('seller')) {
            $model = new SellerForm();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                if($model->ean)
                    $AllProducts = Product::find()->where(['ean'=>$model->ean]);//'status_id'=> 1,
                else if($model->notebook)
                    $AllProducts = Product::find()->where(['notebook'=>$model->notebook]);//'status_id'=> 1,
                else
                    $AllProducts = Product::find()->where(['model_id'=>$model->model_id, 'status_id'=> [1,3]]);//

//                if($AllProducts)
//                {
                    $pages = new Pagination(['totalCount' => $AllProducts->count(), 'pageSize' => 28]);
                    $products = $AllProducts->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
                    return $this->render('modelresult', [
                        'model'  => $model,
                        'products' => $products,
                        'pages' => $pages
                    ]);
//                }

            }
            else
            {
                return $this->render('modelsearch',[
                    'model'  => $model,
                ]);
            }

        }
        else
            throw new ForbiddenHttpException;

    }

    /*
     * Search all Products by model name or one Product by ean or notebook
     * Null
     * array
     * */

    public function actionInternetsearch()
    {
        if(Yii::$app->user->can('seller')) {
            $model = new SellerForm();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                $AllProducts = Product::find()->where(['model_id'=>$model->model_id, 'status_id'=> [1,3]]);//'status_id'=> 1,

                $pages = new Pagination(['totalCount' => $AllProducts->count(), 'pageSize' => 28]);
                $products = $AllProducts->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
                return $this->render('modelresult', [
                    'model'  => $model,
                    'products' => $products,
                    'pages' => $pages
                ]);
            }
            else
            {
                return $this->render('internetsearch',[
                    'model'  => $model,
                ]);
            }

        }
        else
            throw new ForbiddenHttpException;

    }

    /*
     *
     * */
    public function actionCatalog()
    {
        if(Yii::$app->user->can('seller')) {
            $model = new SellerForm();

            $session = Yii::$app->session;
            $session->open();
            $pmarray = [];
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                $session->set('category_id', $model->category_id);
                $session->set('filter_id', $model->filter_id);

                if($model->category_id && $model->filter_id){
                    $pm1 = ModelToCategory::find()->where(['category_id'=>$model->category_id])->asArray()->all();
                    foreach ($pm1 as $key=>$item){
                        $pmarray1[$key] = $item["productmodel_id"];
                    }
                    //var_dump($pmarray1);
                    $pmarray2 = [];
                    $pm2 = ModelToFilter::find()->where(['filter_id'=>$model->filter_id])->asArray()->all();
                    foreach ($pm2 as $key=>$item){
                        if (in_array($item["model_id"], $pmarray1))
                            $pmarray2[$key] = $item["model_id"];
                    }

                    //$pmarray = array_merge($pmarray1,$pmarray2);
                    $AllProducts = Product::find()->where(['model_id'=>$pmarray2, 'status_id' => [1, 3]]);
                }
                else{
                    if($model->category_id){
                        $pm = ModelToCategory::find()->where(['category_id'=>$model->category_id])->asArray()->all();
                        foreach ($pm as $key=>$item)
                            $pmarray[$key] = $item["productmodel_id"];
;
                        $AllProducts = Product::find()->where(['model_id'=>$pmarray, 'status_id' => [1, 3]]);
                    }
                    else{
                        $pm = ModelToFilter::find()->where(['filter_id'=>$model->filter_id])->asArray()->all();
                        foreach ($pm as $key=>$item)
                            $pmarray[$key] = $item["model_id"];

                        $AllProducts = Product::find()->where(['model_id'=>$pmarray, 'status_id' => [1, 3]]);
                    }
                }
            }
            else{

                $model->category_id = $session->get('category_id');
                $model->filter_id = $session->get('filter_id');

                if($model->category_id && $model->filter_id){
                    $pm1 = ModelToCategory::find()->where(['category_id'=>$model->category_id])->asArray()->all();
                    foreach ($pm1 as $key=>$item){
                        $pmarray1[$key] = $item["productmodel_id"];
                    }
                    //var_dump($pmarray1);
                    $pmarray2 = [];
                    $pm2 = ModelToFilter::find()->where(['filter_id'=>$model->filter_id])->asArray()->all();
                    foreach ($pm2 as $key=>$item){
                        if (in_array($item["model_id"], $pmarray1))
                            $pmarray2[$key] = $item["model_id"];
                    }

                    //$pmarray = array_merge($pmarray1,$pmarray2);
                    $AllProducts = Product::find()->where(['model_id'=>$pmarray2, 'status_id' => [1, 3]]);
                }
                else{
                    if($model->category_id){
                        $pm = ModelToCategory::find()->where(['category_id'=>$model->category_id])->asArray()->all();
                        foreach ($pm as $key=>$item)
                            $pmarray[$key] = $item["productmodel_id"];
                        ;
                        $AllProducts = Product::find()->where(['model_id'=>$pmarray, 'status_id' => [1, 3]]);
                    }
                    else{
                        $pm = ModelToFilter::find()->where(['filter_id'=>$model->filter_id])->asArray()->all();
                        foreach ($pm as $key=>$item)
                            $pmarray[$key] = $item["model_id"];

                        $AllProducts = Product::find()->where(['model_id'=>$pmarray, 'status_id' => [1, 3]]);
                    }
                }
            }


            $pages = new Pagination(['totalCount' => $AllProducts->count(), 'pageSize' => 27]);
            $products = $AllProducts->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
            return $this->render('catalog', [
                'model'  => $model,
                'products' => $products,
                'pages' => $pages
            ]);

        }
        else
            throw new ForbiddenHttpException;

    }

    /*
     *
     * */
    public function actionSizes()
    {
        if(Yii::$app->user->can('seller')) {
            $model = new SellerForm();

            $session = Yii::$app->session;
            $session->open();
            $pmarray = [];
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                $session->set('category_id', $model->category_id);
                $session->set('size_id', $model->size_id);

                if($model->category_id && $model->size_id){
                    $pm1 = ModelToCategory::find()->where(['category_id'=>$model->category_id])->asArray()->all();
                    foreach ($pm1 as $key=>$item){
                        $pmarray1[$key] = $item["productmodel_id"];
                    }
                    //var_dump($pmarray1);
//                    $pmarray2 = [];
//                    $pm2 = ModelToFilter::find()->where(['size_id'=>$model->size_id])->asArray()->all();
//                    foreach ($pm2 as $key=>$item){
//                        if (in_array($item["model_id"], $pmarray1))
//                            $pmarray2[$key] = $item["model_id"];
//                    }

                    //$pmarray = array_merge($pmarray1,$pmarray2);
                    $AllProducts = Product::find()->where(['model_id'=>$pmarray1, 'status_id' => [1, 3], 'size_id' => $model->size_id]);
                }
                else{
                    if($model->category_id){
                        $pm = ModelToCategory::find()->where(['category_id'=>$model->category_id])->asArray()->all();
                        foreach ($pm as $key=>$item)
                            $pmarray[$key] = $item["productmodel_id"];
;
                        $AllProducts = Product::find()->where(['model_id'=>$pmarray, 'status_id' => [1, 3]]);
                    }
                    else{
//                        $pm = ModelToFilter::find()->where(['size_id'=>$model->size_id])->asArray()->all();
//                        foreach ($pm as $key=>$item)
//                            $pmarray[$key] = $item["model_id"];

                        $AllProducts = Product::find()->where(['status_id' => [1, 3], 'size_id' => $model->size_id]);//'model_id'=>$pmarray,
                    }
                }
            }
            else{

                $model->category_id = $session->get('category_id');
                $model->size_id = $session->get('size_id');

                if($model->category_id && $model->size_id){
                    $pm1 = ModelToCategory::find()->where(['category_id'=>$model->category_id])->asArray()->all();
                    foreach ($pm1 as $key=>$item){
                        $pmarray1[$key] = $item["productmodel_id"];
                    }
                    //var_dump($pmarray1);
//                    $pmarray2 = [];
//                    $pm2 = ModelToFilter::find()->where(['size_id'=>$model->size_id])->asArray()->all();
//                    foreach ($pm2 as $key=>$item){
//                        if (in_array($item["model_id"], $pmarray1))
//                            $pmarray2[$key] = $item["model_id"];
//                    }

                    //$pmarray = array_merge($pmarray1,$pmarray2);
                    $AllProducts = Product::find()->where(['model_id'=>$pmarray1, 'status_id' => [1, 3], 'size_id' => $model->size_id]);
                }
                else{
                    if($model->category_id){
                        $pm = ModelToCategory::find()->where(['category_id'=>$model->category_id])->asArray()->all();
                        foreach ($pm as $key=>$item)
                            $pmarray[$key] = $item["productmodel_id"];

                        $AllProducts = Product::find()->where(['model_id'=>$pmarray, 'status_id' => [1, 3]]);
                    }
                    else{
//                        $pm = ModelToFilter::find()->where(['size_id'=>$model->size_id])->asArray()->all();
//                        foreach ($pm as $key=>$item)
//                            $pmarray[$key] = $item["model_id"];

                        $AllProducts = Product::find()->where(['status_id' => [1, 3], 'size_id' => $model->size_id]);//'model_id'=>$pmarray,
                    }
                }
            }


            $pages = new Pagination(['totalCount' => $AllProducts->count(), 'pageSize' => 27]);
            $products = $AllProducts->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
            return $this->render('sizes', [
                'model'  => $model,
                'products' => $products,
                'pages' => $pages
            ]);

        }
        else
            throw new ForbiddenHttpException;

    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionProductview($id)
    {
        if(Yii::$app->user->can('seller')) {

            $model = $this->findProductModel($id);
            $productmodel = $this->findModelModel($model->model_id);

            $categories = ModelToCategory::find()->where(['productmodel_id' => $model->model_id])->all();

            $filters = ModelToFilter::find()->where(['model_id' => $model->model_id])->all();

            return $this->render('productview', [
                'productmodel' => $productmodel,
                'categories' => $categories,
                'filters' => $filters,
                'model' => $model ,
            ]);
        }
        else
            throw new ForbiddenHttpException;

    }

    /*
     *
     * */
    public function actionForcecheck(){
        $mpdf=new mPDF();
        $mpdf->WriteHTML($this->renderPartial('index'));
        $mpdf->Output('MyPDF.pdf', 'D');
        exit;
    }

    /*
     *
     * */
    public function actionExport(){
        if(Yii::$app->user->can('seller')) {
            $session = Yii::$app->session;
            $session->open();
            $model = new SellerForm();

            if(isset($_GET['id']))
                $session->set('locationchoose', $_GET['id']);

            if(count($session->get('parr')) > 1)
                $parr=array_unique($session->get('parr'));
            else
                $parr=$session->get('parr');

            if($session->get('locationchoose') !== NULL)
            {
                if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                    if($model->ean)
                        $pitem = Product::find()->where(['ean'=>$model->ean])->one();
                    else
                        $pitem = Product::find()->where(['notebook'=>$model->notebook])->one();

                    $parr[] = $pitem["product_id"];

                    $sb = \app\models\Sandbox::findOne(['product_id'=>$pitem["product_id"]]);
                    $p = \app\models\Product::findOne(['product_id'=>$pitem["product_id"]]);
                    $location =  \app\models\Location::findOne(['location_id'=>$sb["location_id"]]);
                    $profile = Profile::findOne(['user_id' => $sb["user_id"]]);
//                var_dump($profile);
                    if(isset($sb)){
                        Yii::$app->getSession()->setFlash('warning', 'Товар '.$p["notebook"].' ('.$p["ean"].') вже переміщується до "'.$location["location_name"].'" користувачем '.$profile["name"]);
                    }else
                        $session->set('parr', $parr);

                    return $this->redirect('export');//session='.$session..$id
                }
                else
                    return $this->render('export',[
                        'model'  => $model,
                        'parr'   => $parr,
                    ]);
            }
            else
                return $this->render('exportchoose',[

                ]);
        }
        else
            throw new ForbiddenHttpException;
    }

//    /*
//     *
//     * */
//    public function actionExportchoose()
//    {
//        return $this->render('exportchoose',[
//
//        ]);
//    }

    /*
     *
     * */
    public function actionImport(){
        if(Yii::$app->user->can('seller')) {
            $session = Yii::$app->session;
            $session->open();
            $model = new SellerForm();

            if(count($session->get('iarr')) > 1)
                $iarr=array_unique($session->get('iarr'));
            else
                $iarr=$session->get('iarr');


            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                    if($model->ean)
                        $pitem = Product::find()->where(['ean'=>$model->ean])->one();
                    else
                        $pitem = Product::find()->where(['notebook'=>$model->notebook])->one();

                    $iarr[] = $pitem["product_id"];

                    $sb = \app\models\Sandbox::findOne(['product_id'=>$pitem["product_id"]]);
                    $p = \app\models\Product::findOne(['product_id'=>$pitem["product_id"]]);
                    if(!isset($sb)){
                        Yii::$app->getSession()->setFlash('warning', 'Для товару '.$p["notebook"].' ('.$p["ean"].') операція переміщення не ініційовувалась, повідомте про це менеджера!');
                    }
                    else
                        $session->set('iarr', $iarr);

                    return $this->redirect('import');//session='.$session..$id
            }
            else
                   return $this->render('import',[
                        'model'  => $model,
                        'iarr'   => $iarr,
                   ]);
         }
        else
            throw new ForbiddenHttpException;
    }

    /*
*
* */
    public function actionPrintlabel(){
        if(Yii::$app->user->can('seller')) {


            return $this->render('printlabel', [
//                'model' => $model ,
            ]);
        }
        else
            throw new ForbiddenHttpException;
    }

    /*
     *
     * */
    public function actionApprovesession($sid, $lid){
        if(Yii::$app->user->can('seller')) {
            $cur = Settings::findOne('USD');
            $session = Yii::$app->session;
            $session->open();

            $items = $session->get($sid);
            if(!is_null($items)){
                foreach ($items as $item){
                    $p  = \app\models\Product::findOne(['product_id'=>$item]);
                    switch ($sid){
                        case 'parr':
                            $sb = new Sandbox();// Save to SandBox
                            $sb->ean = $p["ean"];
                            $sb->user_id = Yii::$app->user->getId();
                            $sb->product_id = $p["product_id"];
                            $sb->notebook = $p["notebook"];
                            $sb->model_id = $p["model_id"];
                            $sb->location_id = $p["location_id"];;
                            $sb->destination = $lid;
                            $sb->save();

                            $pa  = new ProductAction;//Save to ProductActions
                            $pa->ean = $p["ean"];
                            $pa->user_id = Yii::$app->user->getId();
                            $pa->product_id = $p["product_id"];
                            $pa->model_id = $p["model_id"];
                            $pa->location_id = $p["location_id"];
                            $pa->rate = $p["price"] / $cur['value'] * 100;
                            $pa->status_id = 13; //New status of Product = "Переміщується"
                            $pa->save();
                            break;
                        case 'iarr':
                            $sb  = \app\models\Sandbox::findOne(['product_id'=>$item]);
//
                            $p->location_id = $sb["destination"];// New location
                            $p->save();

                            $pa  = new ProductAction;//Save to ProductActions
                            $pa->ean = $p["ean"];
                            $pa->user_id = Yii::$app->user->getId();
                            $pa->product_id = $p["product_id"];
                            $pa->model_id = $p["model_id"];
                            $pa->location_id = $sb["destination"]; // New location
                            $pa->rate = $p["price"] / $cur['value'] * 100;
                            $pa->status_id = 14; //New status of Product = "Прийнято"
                            $pa->save();

                            $sb->delete();
                            break;
                    }

                }
                switch ($sid){
                    case 'parr':
                        $location =  \app\models\Location::findOne(['location_id' => $lid]);
                        Yii::$app->getSession()->setFlash('success', 'Переміщення товарів до "'.$location->location_name.'" успішно оформлено!');
                        break;
                    case 'iarr':
//                        $location =  \app\models\Location::findOne(['location_id' => $lid]);
                        Yii::$app->getSession()->setFlash('success', 'Прийом товарів успішно оформлено!');
                        break;
                }

            }

            $session->set($sid, NULL);
            $session->set('locationchoose', NULL);
            $this->redirect("index");
        }
        else
            throw new ForbiddenHttpException;
    }

    /*
     *
     * */
    public function actionResetsession($sid){
        if(Yii::$app->user->can('seller')) {
            $session = Yii::$app->session;
            $session->open();
            $session->set($sid, NULL);
            $session->set('locationchoose', NULL);
            $this->redirect("export");

        }
        else
            throw new ForbiddenHttpException;
    }


    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProductModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelModel($id)
    {
        if (($model = ProductModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
