<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use yii\data\Pagination;
use common\models\Balance;
use backend\models\AddUserForm;
use backend\models\AddMoneyForm;
use backend\models\SendMoneyForm;
use common\models\Operations;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
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
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin'],
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
     * @inheritdoc
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
        $query = User::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $users = $query->joinWith('balance')->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('index', [
            'users' => $users,
            'pagination' => $pagination,
        ]);
    }

    public function actionAboutUser($id)
    {
        $user = User::findOne(['id' => $id]);
        $balance = Balance::findOne(['user_id' => $id]);
        $operation = new Operations();
        $operation_list = $operation->getUserOperation($id);


        return $this->render('about', [
            'user' => $user,
            'balance' => $balance -> balance,
            'operations' => $operation_list,
        ]);
    }


    public function actionOperations()
    {
        $operation = Operations::find();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $operation->count(),
        ]);

        $operation_list = $operation->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('operations', [
            'operations' => $operation_list,
            'pagination' => $pagination,
        ]);
    }

    public function actionAddUser()
    {
        $balance = new Balance();

        $model = new AddUserForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->addUser()) {
                $balance->user_id = $user->id;
                $balance->save();
                return $this->goHome();
            }
        }
        return $this->render('adduser', [
            'model' => $model,
        ]);
    }

    public function actionAddMoney($id)
    {
        $balance = new Balance();
        $balance_num = $balance->getUserBalance($id);
        $model = new AddMoneyForm();

        if ($model->load(Yii::$app->request->post()) && $model->addMoney($id)) {
            return $this->goBack();
        } else {
            return $this->render('addmoney', [
                'balance' => $balance_num,
                'model' => $model,
            ]);
        }
    }

    public function actionSendMoney($id)
    {
        $balance = new Balance();
        $balance_num = $balance->getUserBalance($id);
        $currentuser = User::findOne([
            'id' => $id
        ]);

        $current_email = $currentuser->email;

        $model = new SendMoneyForm();
        $model -> sender_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->sendMoney($id)) {
            return $this->goBack();
        } else {
            return $this->render('sendMoney', [
                'balance' => $balance_num,
                'current_email' => $current_email,
                'model' => $model,
            ]);
        }

    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('..\..\..\frontend\views\site\login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
