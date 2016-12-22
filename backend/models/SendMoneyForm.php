<?php
namespace backend\models;

use common\models\Operations;
use Yii;
use yii\base\Model;
use common\models\Balance;
use common\models\User;


class SendMoneyForm extends Model
{
    public $email;
    public $amount;
    public $current_id;
    public $sender_id;


    public function rules()
    {
        $current_balance = new Balance();

        $current_id = $this -> sender_id;
        $current_balance = $current_balance->getUserBalance($this -> sender_id);
        $currentuser = User::findOne([
            'id' => $current_id
        ]);

        $current_email = $currentuser->email;

        return [
            // username and password are both required
            [['email', 'amount'], 'required'],
            ['email', 'trim'],
            ['email', 'required','message' => 'Пожалуйста, введите адрес получателя'],
            ['email', 'email','message' => 'Пожалуйста, введите адрес правильно'],
            ['email', 'string', 'max' => 100],
            ['email', 'exist', 'targetClass' => '\common\models\User', 'message' => 'Такого адреса нет в системе'],
            ['email', 'compare', 'compareValue' => $current_email, 'operator' => '!='],

            [ 'amount','double', 'message' => 'Пожалуйста, введите число'],
            [ 'amount','double','min'=>0.01, 'message' => 'Сумма не может быть меньше 1 копейки'],
            [ 'amount','double','message' => 'Сумма отправки не может превышать сумму средств на вашем счету','max'=>$current_balance, ],

        ];
    }

    public function sendMoney($id)
    {
        $admin_id = Yii::$app->user->id;

        $sender_id = $this -> sender_id;
        $sender = User::findOne([
            'id' => $sender_id
        ]);
        $sender_mail = $sender->email;


        $recipient = User::findOne([
            'email' => $this->email
        ]);
        $recipient_id = $recipient->id;
        $balance = new Balance();


        if ($this->validate()) {
            $operations = new Operations();
            $operations->money = $this->amount;

            $operations->sender_id = $sender_id;

            $operations->recipient_id = $recipient_id;

            $operations->creator_role = 'admin';
            $operations->creator_id = $admin_id;

            $balance->takeMoney($sender_id, $this->amount);
            $balance->putMoney($recipient_id, $this->amount );

            $operations->sender_balance = $balance->getUserBalance($sender_id);
            $operations->recipient_balance = $balance->getUserBalance($recipient_id);

            return $operations->save() ? $operations : null;
        } else {
            return false;
        }
    }



}
