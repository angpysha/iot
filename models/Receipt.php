<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receipt".
 *
 * @property integer $receipt_id
 * @property string $receipt_name
 * @property string $date_created
 * @property string $date_modified
 *
 * @property Charging[] $chargings
 * @property Settings[] $settings
 * @property Param[] $params
 */
class Receipt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'receipt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['receipt_name'], 'required'],
            [['date_created', 'date_modified'], 'safe'],
            [['receipt_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'receipt_id' => 'Receipt ID',
            'receipt_name' => 'Receipt Name',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChargings()
    {
        return $this->hasMany(Charging::className(), ['receipt_id' => 'receipt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasMany(Settings::className(), ['receipt_id' => 'receipt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParams()
    {
        return $this->hasMany(Param::className(), ['param_id' => 'param_id'])->viaTable('settings', ['receipt_id' => 'receipt_id']);
    }
}
