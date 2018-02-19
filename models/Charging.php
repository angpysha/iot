<?php

namespace app\models;

use Yii;
use dektrium\user\models\User;

/**
 * This is the model class for table "charging".
 *
 * @property integer $id
 * @property integer $receipt_id
 * @property integer $user_id
 * @property string $started
 * @property string $finished
 *
 * @property Receipt $receipt
 * @property Heating[] $heatings
 * @property Venting[] $ventings
 */
class Charging extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'charging';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['receipt_id', 'user_id'], 'required'],//, 'started', 'finished'
            [['receipt_id', 'user_id'], 'integer'],
            [['started', 'finished'], 'safe'],
            [['receipt_id'], 'exist', 'skipOnError' => true, 'targetClass' => Receipt::className(), 'targetAttribute' => ['receipt_id' => 'receipt_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'receipt_id' => 'Receipt ID',
            'user_id' => 'User ID',
            'started' => 'Started',
            'finished' => 'Finished',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceipt()
    {
        return $this->hasOne(Receipt::className(), ['receipt_id' => 'receipt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHeatings()
    {
        return $this->hasMany(Heating::className(), ['charging' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentings()
    {
        return $this->hasMany(Venting::className(), ['charging' => 'id']);
    }
}
