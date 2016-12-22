<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use Yii;



/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirm;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required', 'message' => 'Пожалуйста, введите адрес'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот адрес уже занят'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['confirm', 'required'],
            ['confirm', 'compare', 'compareAttribute' => 'password', 'operator' => '=='],

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function verificationMail($user){
        return Yii::$app->mailer->compose('verificatePassword',['user' => $user])
            ->setTo($user -> email)
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setSubject('Подтверждение аккаунта')
            ->send();
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->email = $this->email;
        $user->role = 0;
        $user->password = $this->password;
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }



}
