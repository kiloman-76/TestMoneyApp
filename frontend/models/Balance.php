<?php

namespace app\models;

use yii\db\ActiveRecord;
use common\models\User;
use Yii;
class Balance extends ActiveRecord
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return 'balance';
    }

    public function getUserBalance(){
        $user_id = Yii::$app->user->id;
        $balance = Balance::findOne([
            'user_id' => $user_id,
        ])->balance;
        return $balance;
    }

    public function takeMoney($id,$money){
        $balance = Balance::findOne([
            'user_id' => $id,
        ]);
        $balance->balance -= $money;
        $balance->save();
    }

    public function putMoney($id,$money){
        $balance = Balance::findOne([
            'user_id' => $id,
        ]);
        $balance->balance += $money;
        $balance->save();
    }
}