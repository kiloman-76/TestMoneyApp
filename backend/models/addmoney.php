<?php
namespace backend\models;

use common\models\Operations;
use Yii;
use yii\base\Model;
use common\models\Balance;
use common\models\User;


class AddMoneyForm extends Model
{
    public $email;
    public $amount;
    public $recipient_id;
    public $current_id;


    public function rules()
    {
        $current_balance = new Balance();
        $current_id = Yii::$app->user->id;
        $current_balance = $current_balance->getUserBalance($current_id);
        $currentuser = User::find()->where(['id' => $current_id]);


        $current_email = Yii::$app->user->identity->email;;
        return [
            // username and password are both required

            [ 'amount','double', 'message' => 'Пожалуйста, введите число'],
            [ 'amount','double','min'=>0, 'message' => 'Сумма не может быть меньше нуля'],
            [ 'amount','double','message' => 'Сумма отправки не может превышать сумму средств на вашем счету','max'=>$current_balance, ],

        ];
    }

    public function addMoney()
    {
        $current_id = Yii::$app->user->id;
        $recipient = User::findOne([
            'email' => $this->email
        ]);
        $recipient_id = $recipient->id;
        $balance = new Balance();


        if ($this->validate()) {
            $operations = new Operations();
            $operations->money = $this->amount;
            $operations->sender_id = $current_id;
            $operations->sender_mail =Yii::$app->user->identity->email;
            $operations->recipient_id = $recipient_id;
            $operations->recipient_mail = $this->email;
            $operations->creator_role = 'user';
            $operations->creator_id = $current_id;
            $balance->takeMoney($current_id, $this->amount);
            $balance->putMoney($recipient_id, $this->amount );
            $operations->sender_balance = $balance->getUserBalance($current_id);
            $operations->recipient_balance = $balance->getUserBalance($recipient_id);

            return $operations->save() ? $operations : null;
        } else {
            return false;
        }
    }



}
