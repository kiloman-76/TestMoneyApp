<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\models\User;
use yii\behaviors\TimestampBehavior;
use Yii;
class Operations extends ActiveRecord
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */

    public static function tableName()
    {
        return 'operations';
    }

    public function getUserOperation($id){
//        $query = new Query();
//
//        $query1 = $query
//            ->select("money, sender_id, sender_balance,sender_mail, recipient_id, recipient_balance,recipient_mail, operation_date")
//            ->from('operations')
//            ->where(['recipient_id' => $id])->orWhere(['sender_id' => $id])->orderBy('operation_date') ->all();


        $query1 = Operations::find()
            ->select(['money', 'sender_id', 'sender_balance', 'sender_mail', 'recipient_id', 'recipient_balance', 'recipient_mail', 'operation_date', 'creator_role', 'creator_id', 'creator_mail'])
            ->where(['recipient_id' => $id])->orWhere(['sender_id' => $id])->orderBy('operation_date') ->all();


        return $query1;
    }

    public function sendedMoney($id)
    {
        $sender_operations_money = Operations::find()
            ->where(['sender_id' => $id])
            ->sum('money');
        if ($sender_operations_money){
            return $sender_operations_money;
        } else {
            return 0.00;
        }
    }

    public function takedMoney($id)
    {
        $recipient_operation_money = Operations::find()
            ->where(['recipient_id' => $id])
            ->sum('money');
        if ($recipient_operation_money){
            return $recipient_operation_money;
        } else {
            return 0.00;
        }

    }



    public function behaviors()
    {
        return [
            'timestamp' =>
                ['class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'operation_date',],
                'value' => function() { return date('U');},
                ]
            ];
        }
}