<?php
namespace backend\models;

use common\models\Operations;
use Yii;
use yii\base\Model;
use common\models\Balance;
use common\models\User;


class AddMoneyForm extends Model
{
    public $amount;
    public $current_id;


    public function rules()
    {
        return [
            // username and password are both required

            [ 'amount','double', 'message' => 'Пожалуйста, введите число'],
            [ 'amount','double','min'=>0, 'message' => 'Сумма не может быть меньше нуля'],


        ];
    }

    public function addMoney($id)
    {
        $current_id = Yii::$app->user->id;
        $current_email = Yii::$app->user->identity->email;;

        $recipient_id = $id;
        $recipient = User::findOne([
            'id' => $id
        ]);
        $recipient_mail = $recipient->email;
        $balance = new Balance();


        if ($this->validate()) {
            $operations = new Operations();
            $operations->money = $this->amount;

            $operations->recipient_id = $recipient_id;
            $operations->recipient_mail = $recipient_mail;

            $operations->creator_role = 'admin';
            $operations->creator_id = $current_id;
            $operations->creator_mail = $current_email;

            $balance->putMoney($recipient_id, $this->amount );
            $operations->recipient_balance = $balance->getUserBalance($recipient_id);

            return $operations->save() ? $operations : null;
        } else {
            return false;
        }
    }



}
