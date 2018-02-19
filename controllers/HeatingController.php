<?php

namespace app\controllers;

use Yii;
use app\models\Heating;
use app\models\HeatingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HeatingController implements the CRUD actions for Heating model.
 */
class HeatingController extends Controller
{
    /**
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
     * API for capturing sensors data from ESP8266
     * */
    public function actionApi($temp_chamber, $temp_supply, $temp_hot, $temp_cold)
    {
        $this->layout = 'label';

//        echo "<br/>";
//        echo "<br/>";
        $heat = new Heating();

        $heat->heat_mode = 1; //Current vent mode
        $heat->charging = 1;  //Current Charging id

        $heat->temp_chamber = $temp_chamber;
        $heat->temp_supply = $temp_supply;
        $heat->temp_hot = $temp_hot;
        $heat->temp_cold = $temp_cold;
//        $heat->valve_cyr = intval($valve_cyr);
//        var_dump($vent);

        $heat->save();
        echo "Response: ".$heat->id;
        return $this->render('heatresponse');
    }

    /**
     * Lists all Heating models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HeatingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Heating model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Heating model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Heating();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Heating model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Heating model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Heating model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Heating the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Heating::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
