<?php

namespace backend\controllers;


use backend\models\AssignSector;
use backend\models\Sector;
use common\helpers\Myfunctions;
use Yii;
use backend\models\Template;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TemplateController implements the CRUD actions for Template model.
 */
class TemplateController extends Controller
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
     * Lists all Template models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Template::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Template model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        //$sectors = AssignSector::find()->where(['deleted' => 0, 'status' => 1, '']);


        $sectors = new ArrayDataProvider([
            'allModels' => $model->sectors
        ]);

        return $this->render('view', [
            'model' => $model,
            'sectors' => $sectors
        ]);
    }

    /**
     * Creates a new Template model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Template();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Template model.
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
     * Deletes an existing Template model.
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
     * Takes existing sectors and assign to template
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionAddsector($id)
    {
        $sectors = Sector::getSectorsOptions('T');
        $model = new AssignSector();

        if ($model->load(Yii::$app->request->post())){
            $model->page_id = $id;
            $model->assign_type = 'T';
            $model->save();
            return $this->redirect(['view', 'id' => $id]);

        }
        return $this->render('addsector', [
           'model' => $model,
            'sectors' => $sectors
        ]);
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

        return $this->redirect('index');
    }

    /**
     * Finds the Template model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Template the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Template::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
