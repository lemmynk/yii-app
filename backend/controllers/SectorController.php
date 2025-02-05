<?php

namespace backend\controllers;

use backend\models\AssignContent;
use backend\models\Content;
use backend\models\Template;
use backend\models\Widget;
use common\helpers\Myfunctions;
use Yii;
use backend\models\Sector;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SectorController implements the CRUD actions for Sector model.
 */
class SectorController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => Yii::$app->user->identity->isAdmin()],
                ],

            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Sector models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Sector::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sector model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $assigns = new ActiveDataProvider([
            'query' => AssignContent::find()->where(['sector_id' => $id]),
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'assigns' => $assigns,
        ]);
    }

    /**
     * Creates a new Sector model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sector();
        $templates = Template::getTemplateOptions();
        $filePath = Yii::getAlias('@frontend/views/layouts');

        if ($model->load(Yii::$app->request->post())) {
            $model->file_name = Myfunctions::parseForSEO($model->name);
            $model->save();
            $fileName = $filePath . '/' . '_' . $model->file_name . '.php';
            fopen($fileName, 'x+');
            chmod($fileName, 0777);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'templates' => $templates,
        ]);
    }

    /**
     * Updates an existing Sector model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $templates = Template::getTemplateOptions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'templates' => $templates,
        ]);
    }

    /**
     * Deletes an existing Sector model.
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


    public function actionAddContent($id)
    {
        $model = new AssignContent();
        $sector = $this->findModel($id);
        //if (Yii::$app->request->isAjax){ }



        if ($model->load(Yii::$app->request->post())){
            $model->sector_id = $id;
            $model->save();
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->renderPartial('addcontent', [
            'model' => $model,
            'sector' => $sector
        ]);

    }


    public function actionContentWidget($id)
    {
        if ($id === 'C'){
            $ret = Content::getContentOptions();
        }else{
            $ret = Widget::getWidgetOptions();
        }
        $models = ArrayHelper::map($ret, 'id', 'name');

        foreach ($models as $key => $value){
            echo "<option value='$key'>$value</option>";
        }
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
     * Finds the Sector model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Sector the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sector::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
