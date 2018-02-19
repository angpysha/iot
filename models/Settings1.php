<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $param_id
 * @property string $value
 * @property integer $receipt_id
 * @property integer $active
 * @property string $date_created
 * @property string $date_modified
 *
 * @property Param $param
 * @property Receipt $receipt
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param_id', 'value', 'receipt_id'], 'required'],
            [['param_id', 'receipt_id', 'active'], 'integer'],
            [['date_created', 'date_modified'], 'safe'],
            [['value'], 'string', 'max' => 16],
            [['param_id'], 'exist', 'skipOnError' => true, 'targetClass' => Param::className(), 'targetAttribute' => ['param_id' => 'param_id']],
            [['receipt_id'], 'exist', 'skipOnError' => true, 'targetClass' => Receipt::className(), 'targetAttribute' => ['receipt_id' => 'receipt_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'param_id' => 'Param ID',
            'value' => 'Value',
            'receipt_id' => 'Receipt ID',
            'active' => 'Active',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParam()
    {
        return $this->hasOne(Param::className(), ['param_id' => 'param_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceipt()
    {
        return $this->hasOne(Receipt::className(), ['receipt_id' => 'receipt_id']);
    }
}
