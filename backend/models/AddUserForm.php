<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;




class addUserForm extends Model
{
    public $email;
    public $password;


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

        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' =>
                ['class' => TimestampBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at','updated_at']],
                    'value' => function() { return date('U');},
                ]
        ];
    }

    public function addUser()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->email = $this->email;
        $user->role = 1;
        $user->password = $this->password;
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}
