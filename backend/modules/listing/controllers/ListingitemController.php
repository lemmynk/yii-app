<?php

namespace app\modules\listing\controllers;

use backend\modules\listing\models\ListingCategory;
use common\helpers\Myfunctions;
use Yii;
use backend\modules\listing\models\ListingItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ListingitemController implements the CRUD actions for ListingItem model.
 */
class ListingitemController extends Controller
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
     * Lists all ListingItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $catId = Yii::$app->request->get('id');
        $cat = ListingCategory::findModelByFilename($catId);
        $dataProvider = new ActiveDataProvider([
            'query' => ListingItem::find()->where([
                'deleted' => 0,
                'category_id' => $cat->id,
            ])->orderBy(['created_on' => SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'category' => $cat

        ]);
    }

    /**
     * Displays a single ListingItem model.
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
     * Creates a new ListingItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ListingItem();
        $catId = Yii::$app->request->get('id');
        $cat = ListingCategory::findModelByFilename($catId);
        $model->category_id = $cat->id;

        if ($model->load(Yii::$app->request->post())) {
            if($model->item_date != null){
                $itemDate = str_replace(' ', '', $model->item_date);
                $dateNew = date_create($itemDate);
                $formatDate = date_format($dateNew, 'Y-m-d');
                $model->item_date = $formatDate;
            }else{
                $model->item_date = date('Y-m-d');
            }
            if ($model->item_author == null){
                $model->item_author = Yii::$app->user->identity->getUserFullName();
            }
            $model->save();
            Yii::$app->session->setFlash('success', 'Post is created successfully');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'category' => $cat,
        ]);
    }

    /**
     * Updates an existing ListingItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cat = ListingCategory::findOne($model->category_id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->item_date != null){
                $itemDate = str_replace(' ', '', $model->item_date);
                $dateNew = date_create($itemDate);
                $formatDate = date_format($dateNew, 'Y-m-d');
                $model->item_date = $formatDate;
            }else {
                $model->item_date = date('Y-m-d');;
            }
            $model->save();
            Yii::$app->session->setFlash('success', 'Post is updated successfully');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'category' => $cat,
        ]);
    }

    /**
     * Deletes an existing ListingItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $catId = $model->category_id;
        $cat = ListingCategory::findOne($model->category_id);
        $model->delete();

        return $this->redirect(['index', 'id' => $cat->cat_seo]);
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
        $cat = ListingCategory::findOne($model->category_id);

        return $this->redirect(['index', 'id' => $cat->cat_seo]);
    }

    /**
     * Finds the ListingItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ListingItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ListingItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
