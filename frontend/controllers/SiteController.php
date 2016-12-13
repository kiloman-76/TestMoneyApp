<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Balance;
use frontend\models\TranslateMoneyForm;
use common\models\User;
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
                        'actions' => ['signup', 'login', 'index', 'verificate-password'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $balance = new Balance();
        $operation = new Operations();
        $user_id = Yii::$app->user->id;

        $taked_money = $operation -> takedMoney($user_id);
        $sended_money = $operation -> sendedMoney($user_id);

        $balance = $balance->getUserBalance($user_id);

        return $this->render('index', [
            'balance' => $balance,
            'taked_money' => $taked_money,
            'sended_money' => $sended_money
        ]);
    }

    public function actionVerificatePassword($token, $email){
       $user = User::findOne([
           'email' => $email,
       ]);
        if($user -> auth_key == $token){
            $user -> role = 1;
            $user -> save();
            return $this->render('index', [
                'message' => "Вы успешно зарегистрировались на сайте. Теперь вы можете войти в приложение, используя адрес своей почты и пароль ",
            ]);
        }
    }

    public function actionOperations()
    {
        $operation = new Operations();
        $operation_list = $operation->getUserOperation(Yii::$app->user->id);

        return $this->render('operations', [
            'operations' => $operation_list,
        ]);
    }

    public function actionTranslateMoney()
    {
        $user_id = Yii::$app->user->id;
        $balance = new Balance();
        $balance_num = $balance->getUserBalance($user_id);
        $model = new TranslateMoneyForm();

        if ($model->load(Yii::$app->request->post()) && $model->addMoney()) {
            return $this->goBack();
        } else {
            return $this->render('translateMoney', [
                'balance' => $balance_num,
                'model' => $model,
            ]);
        }

    }

    /**
     * Logs in a user.
     *
     * @return mixed
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
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $balance = new Balance();

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $balance->user_id = $user->id;
                $balance->save();
                if ($model->verificationMail($user)){
                    return $this->render('signup', [
                        'message' => 'На ваш почтовый ящик отправлено письмо с дальнейшими инструкциями',
                    ]);
                } else{
                    return $this->render('signup', [
                        'model' => $model,
                    ]);
                }
//                if (Yii::$app->getUser()->login($user)) {
//
//                    return $this->goHome();
//                }
            }
        } else {
            return $this->render('signup', [
                'model' => $model,
            ]);
        }


    }

}
