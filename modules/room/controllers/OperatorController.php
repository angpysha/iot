<?php

namespace app\modules\room\controllers;


use app\models\Captures;
use app\models\Charging;
use app\models\Param;
use app\models\Settings;
//use barcode\barcode\BarcodeGenerator as BarcodeGenerator;

use app\models\Setup;
use app\models\SetupForm;
use Yii;
use yii\validators;

use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

use yii\filters\VerbFilter;
use DateTime;
use DateInterval;
use  yii\bootstrap\Progress;

use yii\base\Exception;

class OperatorController extends \yii\web\Controller
{


    /**????????????????????????
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }



    /*
     *
     * */
    public function actionIndex()
    {
        if(Yii::$app->user->can('operator')) {
            return $this->render('index');
        }
        else
            throw new ForbiddenHttpException;
    }

    /*
     *
     * */
    public function actionMonitoring()
    {
        if(Yii::$app->user->can('operator')) {
            $captures = Captures::find()->all();//->asArray()->select(['sensor_param','value'])
            $setup = Setup::find()->all();//->asArray()->select(['sensor_param','value'])
            $time = date('H:i:s'); //extra

            // Find receipt params via charding settings
            $charging = Setup::find()
                ->where(['setup_param' => 'charging'])
                ->one();

            $receipt = Charging::findOne($charging["value"]);

            $settings = Settings::find()
                ->joinWith(['param'])
                ->where(['active' => 1, 'receipt_id' => $receipt["receipt_id"]])->all();//->asArray()

//            var_dump($setup);

            return $this->render('monitoring', [
                'time'  => $time,//extra
                'captures' => $captures,
                'settings' => $settings,
                'setup' => $setup,
            ]);
        }
        else
            throw new ForbiddenHttpException;
    }

    /*
     *
     * */
    public function actionTechbook()
    {
        if(Yii::$app->user->can('operator')) {

            $time = date('H:i:s'); //extra

            return $this->render('techbook', [
                'time'  => $time,//extra
            ]);
        }
        else
            throw new ForbiddenHttpException;
    }

    /*
     *
     * */
    public function actionManualcontrol()
    {
        if(Yii::$app->user->can('operator')) {
            $model = new SetupForm();
        //    echo "<BR/>";
        //    echo "<BR/>";
        //    echo "<BR/>";
           $setup = Setup::find()->asArray()->all();// extra
        //    var_dump($setup);
            $time = date('H:i:s'); //extra

            if ($model->load(Yii::$app->request->post()) ) {
                if ($model->validate()) {
//                    var_dump(Yii::$app->request->post()["SetupForm"]["list_ids"]);
//                    die();
                    $model->saveForm();
                    $model->list_ids = Yii::$app->request->post()["SetupForm"]["list_ids"];
                    $model->saveChecklist();
                    return $this->redirect(['manualcontrol']);
                }
            }
            $model->loadForm();
            $model->loadChecklist();
            $items = $model->getAvailableChecklist();
            return $this->render('manualcontrol', [
                'time'  => $time,//extra
                'model' => $model,
                'setup' => $setup,// extra
                'items' => $items,
             ]);
        }
        else
            throw new ForbiddenHttpException;
    }

    /*
     *  Activate manual control
     * */
    public function actionManualactivate($action)
    {
        if(Yii::$app->user->can('operator')) {

            $setup = Setup::findOne(['setup_param' => 'system_mode']);

            if($setup->value != '1'){// Check if possible to acvivate
                if($action == 'activate')
                    $setup->value = strval(2); // Activate manual control
                if($action == 'deactivate')
                    $setup->value = strval(0); // Deactivate manual control and Halt of System
                $setup->save();
            }
            else
                Yii::$app->getSession()->setFlash('danger', Yii::t('user', 'Активувати <b>ручний режим</b> можливо лише для системи, що зупинена'));

            return $this->redirect('manualcontrol');
        }
        else
            throw new ForbiddenHttpException;
    }


    /*
     * Time calculation for operator's cabinet
     * @return string
     * */
    public function getTime ($type)
    {
        $system_mode = Setup::find()
            ->where(['setup_param' => 'system_mode'])
            ->one();
        if($system_mode["value"] != "1" )
            $type = "halt";


        // Get `uptime` parametr from current receipt
        $charging = Setup::find()
            ->where(['setup_param' => 'charging'])
            ->one();

        $receipt = Charging::findOne($charging["value"]);//->where([''])
        $started = $receipt["started"];

        $params = Settings::find()
            ->where(['receipt_id' => $receipt["receipt_id"], 'param_id' => 2])
            ->one();
        $uptime = $params['value'];//uptime parametr
        if($uptime == 0)
            $type = 'error';

        $start_date = new DateTime($started);//'2007-09-01 04:10:58'
        $since_start = $start_date->diff(new DateTime(date("Y-m-d H:i:s",time())));

        $stop_date = $start_date;
        $stop_date->add(new DateInterval('PT'.$uptime.'H'));
        $remain = $stop_date->diff(new DateTime(date("Y-m-d H:i:s",time())));

        $hours = $since_start->days * 24*60;
        $hours += $since_start->h;

        $remains = $remain->days*24 + $remain->h;
        if($uptime != 0)
            $percent = round(($hours*60 + $since_start->i)/$uptime/60*100);
        else
            $percent = 0;

        switch ($type){
            case 'perc':
                $ret = $percent;
                break;
            case 'progress':
                $ret = Progress::widget([
                    'percent' => $percent,
                    'options' => ['class' => 'progress-striped '],//active
                    'label' => $percent.' %',//$hours." год ".$since_start->i.' хв.',
                ]);
                break;
            case 'remain':
                if($hours < $uptime)
                    $ret = 'Залишилось <b>'.$remains." год ".$remain->i.' хв.</b>';
                else
                    $ret = 'Понад запланованого <b>'.$remains." год ".$remain->i.' хв.</b>';
                break;
            case 'hours':
                $ret = $hours." год ".$since_start->i.' хв.';
                break;
            case 'error':
                Yii::$app->getSession()->setFlash('danger', Yii::t('user', 'Параметр "<b>uptime</b>" для рецепту <a href="../../settings/index?SettingsSearch[receipt_id]='.$receipt["receipt_id"].'">'.$receipt["receipt_id"].'</a> встановлений рівним нулю.'));
                $ret = "";
                break;
            default:
                $ret = "";
                break;
        }

        return $ret;

    }


    /*
         * Data freshness in the monitoring page of operator's cabinet
         * @return integer
         * */
    public function getFreshness ($parmame)
    {
        $captures = Captures::find()
            ->where(['sensor_param' => $parmame])
            ->one();

        $start_date = new DateTime($captures["captured_time"]);//'2007-09-01 04:10:58'
        $since_captured = $start_date->diff(new DateTime(date("Y-m-d H:i:s",time())));


        $sec = $since_captured->days*24*60*60;
        $sec += $since_captured->h*60*60;
        $sec += $since_captured->i*60;
        $sec += $since_captured->s;

        return $sec;

    }
}
