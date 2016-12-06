<?php

namespace app\models;

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
    public static function sendedMoney($id)
    {
        $sender_operation = Operations::find()
            ->where(['sender_id' => $id])
            ->sum('money');




        return $sender_operation;
    }
    public static function takedMoney($id)
    {
        $recipient_operation = Operations::find()
            ->where(['recipient_id' => $id])
            ->sum('money');

        return $recipient_operation;

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