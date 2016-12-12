<?php

namespace common\models;

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

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    public function getUserBalance($id){
        $balance = Balance::findOne([
            'user_id' => $id,
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