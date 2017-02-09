<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_history".
 *
 * @property integer $id
 * @property integer $user_from
 * @property integer $user_to
 * @property integer $payment
 * @property string $timestamp
 *
 * @property User $userFrom
 * @property User $userTo
 */
class PaymentHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_from', 'user_to', 'payment'], 'required'],
            [['user_from', 'user_to', 'payment'], 'integer'],
            [['timestamp'], 'safe'],
            [['user_from'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_from' => 'id']],
            [['user_to'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_to' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_from' => 'Payment From',
            'user_to' => 'Payment To',
            'payment' => 'Payment',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFrom()
    {
        return $this->hasOne(User::className(), ['id' => 'user_from']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTo()
    {
        return $this->hasOne(User::className(), ['id' => 'user_to']);
    }

    public static function recordPayment($from, $to, $payment)
    {
        $model = new PaymentHistory();
        $model->user_to = $from;
        $model->user_from = $to;
        $model->payment = $payment;
        $model->save();
    }
}
