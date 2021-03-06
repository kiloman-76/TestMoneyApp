<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;
    public $login_error;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email','email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !password_verify($this->password, $user->password)) {
                $this->addError($attribute, 'Неправильный адрес или пароль.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */

    public function getPassword($user, $password){
        if($password != $user->password){
            return false;
        } else {
            return true;
        }
    }

    public function login()
    {
        $user = User::findByEmail($this->email);

        if ($this->validate() ) {
            if(!$user->role == 0){
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            } else {
                $this->login_error = true;
                return false;
            }

        } else {
            return false;
        }
    }


    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
