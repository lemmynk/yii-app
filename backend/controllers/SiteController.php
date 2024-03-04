<?php

namespace backend\controllers;

use backend\models\User;
use common\helpers\Myfunctions;
use common\models\LoginForm;
use backend\components\AdminUser;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
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
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                        //'roles' => ['0', '1'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'main-login';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $lastLT = date('Y-m-d H:i:s');
            $session = Yii::$app->session;
            $session->set('_last_login_on', $lastLT);


            return $this->goBack();
        }
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $session = Yii::$app->session;

        $id = Yii::$app->user->identity->id;
        $model = User::findOne(['id' => $id]);
        //$model->last_login_on = $session['_last_login_on'];
        if ($session['_last_login_on'] != null) {
            $model->updateAttributes(['last_login_on' => $session['_last_login_on']]);
        }

        //Myfunctions::echoArray($session['_last_login_on']);
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
