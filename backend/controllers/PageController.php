<?php

namespace backend\controllers;

use backend\models\AssignContent;
use backend\models\AssignSector;
use backend\models\Content;
use backend\models\Sector;
use backend\models\Template;
use backend\models\Widget;
use common\helpers\Myfunctions;
use Yii;
use backend\models\Pages;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Pages model.
 */
class PageController extends Controller
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
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pages::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pages model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        //$assigns = new ArrayDataProvider([
            //'allModels' => AssignContent::findAll(['page_id' => $id, 'deleted' => 0])]);
        $assigns = new ActiveDataProvider([
            'query' => AssignContent::find()->where(['page_id' => $id, 'deleted' => 0]),
        ]);
        //Myfunctions::echoArray($assigns);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'assigns' => $assigns
        ]);
    }

    /**
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages();
        $templates = Template::getTemplateOptions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'templates' => $templates,
        ]);
    }

    /**
     * Updates an existing Pages model.
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
     * Deletes an existing Pages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Takes existing sectors and assign to template
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionAddContent($id)
    {
        $page = $this->findModel($id);
        $tpl = $page->template;
        $sectors = Sector::find()->where([
            'status' => 1,
            'deleted' => 0,
            'sector_type' => 'P',
            'tpl_id' => $tpl->id
        ])->all();

        $secOptions = [];
        foreach ($sectors as $sector){
            $secOptions[$sector->id] = $sector->name;
        }

        //$contents = Content::getContentOptions();
        $model = new AssignContent();

        if ($model->load(Yii::$app->request->post())){
            //Myfunctions::echoArray(Yii::$app->request->post());
            $model->page_id = $id;
            $model->save();
            return $this->redirect(['view', 'id' => $id]);

        }
        return $this->render('add-content', [
            'model' => $model,
            'sectors' => $secOptions,
            //'contents' => $contents,
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
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
