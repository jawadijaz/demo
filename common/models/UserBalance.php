<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_balance".
 *
 * @property integer $id
 * @property integer $user_id
 * @property double $balance
 *
 * @property User $user
 */
class UserBalance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $add_balance;

    public static function tableName()
    {
        return 'user_balance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'add_balance'], 'required'],
            [['id'], 'integer'],
            [['balance'], 'number'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'balance' => 'Balance',
            'add_balance' => 'Add Balance'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param $user_id the newly created user id
     **/
    public static function addBalance($user_id)
    {
        $model = new UserBalance();
        $model->user_id = $user_id;
        $model->save(false);
    }

    public static function subtractMyBalance($balance)
    {
        $model = self::find()->where(["user_id" => Yii::$app->user->id])->one();

        $model->balance = $model->balance - $balance;
        
        if($model->save(false)) {
            return true;
        } else {
            return false;
        }
    }

    public static function fillMyBalanceBack($balance)
    {
        $model = self::find()->where(["user_id" => Yii::$app->user->id])->one();
        $model->balance = $model->balance + $balance;
        
        if($model->save(false)) {
            return true;
        } else {
            return false;
        }
    }

    public static function getUsers()
    {
        $model = self::find()->where("user_id != :myId",[":myId" => Yii::$app->user->id])->all();
        $temp = [];
        foreach ($model as $key => $user) {
            array_push($temp,[
                'id' =>    $user->user->id,
                'username' => $user->user->username,
            ]);
        }

        return $temp;
    }
}
