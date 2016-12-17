<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property string $role
 * @property integer $is_admin
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $date_create
 * @property string $date_update
 *
 * @property Balance[] $balances
 * @property Operations[] $operations
 * @property Operations[] $operations0
 * @property Operations[] $operations1
 */
class UserControl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            [['password', 'auth_key', 'email', 'role', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['email'], 'string', 'max' => 255],
            ['email', 'email'],
            [['password'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['role'], 'string', 'max' => 10],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'email' => 'Email',
            'status' => 'Status',
            'role' => 'Role',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBalances()
    {
        return $this->hasMany(Balance::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperations()
    {
        return $this->hasMany(Operations::className(), ['creator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperations0()
    {
        return $this->hasMany(Operations::className(), ['recipient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperations1()
    {
        return $this->hasMany(Operations::className(), ['sender_id' => 'id']);
    }
}
