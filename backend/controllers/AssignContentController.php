<?php

namespace backend\controllers;

use backend\models\AssignContent;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use YII;

class AssignContentController extends \yii\web\Controller
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionActivate($id)
    {
        if (Yii::$app->request->isAjax){
            $model = $this->findModel($id);
            if ($model->status === 1) {
                $model->status = 0;
            } else {
                $model->status =1;
            }
            $model->save();

            if ($model->page_id !== 0){
                $retUrl = 'page/view';
                $retId =  $model->page_id;
            } else{
                $retUrl = 'sector/view';
                $retId = $model->sector_id;
            }

            //return $this->redirect([$retUrl, 'id' => $retId]);
        }


        //if (Yii::$app->request->isAjax) {
        // Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //return ['success' => true];
        //}
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->softDelete();
        if ($model->page_id !== 0){
            $retUrl = 'page/view';
            $retId =  $model->page_id;
        } else{
            $retUrl = 'sector/view';
            $retId = $model->sector_id;
        }

        return $this->redirect([$retUrl, 'id' => $retId]);
    }


    /**
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AssignContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AssignContent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested assign does not exist.');
    }
}
