<?php

namespace app\controllers;

use Yii;
use app\models\Venting;
use app\models\VentingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VentingController implements the CRUD actions for Venting model.
 */
class VentingController extends Controller
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
    public function actionApi($damp1, $damp2, $temp1, $temp2, $valve_in, $valve_out, $valve_cyr)
    {
        $this->layout = 'label';

//        echo "<br/>";
//        echo "<br/>";
        $vent = new Venting();

        $vent->vent_mode = 1; //Current vent mode
        $vent->charging = 1;  //Current Charging id

        $vent->damp1 = $damp1;
        $vent->damp2 = $damp2;
        $vent->temp1 = $temp1;
        $vent->temp2 = $temp2;
        $vent->valve_in = intval($valve_in);
        $vent->valve_out = intval($valve_out);
        $vent->valve_cyr = intval($valve_cyr);
//        var_dump($vent);

        $vent->save();
        echo "Response: ".$vent->id;
        return $this->render('ventresponse');
    }

    /**
     * Lists all Venting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VentingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Venting model.
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
     * Creates a new Venting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Venting();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Venting model.
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
     * Deletes an existing Venting model.
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
     * Finds the Venting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Venting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Venting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
