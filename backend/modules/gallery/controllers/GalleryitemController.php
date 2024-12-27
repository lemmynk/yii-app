<?php

namespace app\modules\gallery\controllers;

use common\helpers\Myfunctions;
use Yii;
use app\modules\gallery\models\Galleryitem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GalleryitemController implements the CRUD actions for Galleryitem model.
 */
class GalleryitemController extends Controller
{
    /**
     * {@inheritdoc}
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

    /**
     * Lists all Galleryitem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Galleryitem::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Galleryitem model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Galleryitem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //
        $model = new Galleryitem();
        if (Yii::$app->request->isPost){
            //Myfunctions::echoArray(Yii::$app->request->post('GalleryItem')['name']);
            $urls = explode(',',Yii::$app->request->post('GalleryItem')['name']);
            //Myfunctions::echoArray($urls);
            foreach ($urls as $key=>$value){
                $model = new Galleryitem();
                $model->name = $value;
                $model->status = 1;
                $model->category_id = 0;
                $model->save();
                unset($model);
            }
            return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Galleryitem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Galleryitem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->softDelete();

        return $this->redirect(['index']);
    }

    /**
     * Changes status of model
     * @param $id
     * @return \yii\web\Response
     */
    public function actionActivate($id)
    {
        $model = $this->findModel($id);
        if ($model->status === $model::STATUS_ACTIVE){
            $model->status = $model::STATUS_INACTIVE;
        }
        else{
            $model->status = $model::STATUS_ACTIVE;
        }
        $model->save();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Galleryitem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Galleryitem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Galleryitem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
