<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "param".
 *
 * @property integer $param_id
 * @property string $param_name
 * @property string $param_type
 * @property string $comment
 *
 * @property Settings[] $settings
 * @property Receipt[] $receipts
 */
class Param extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'param';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param_name', 'param_type', 'comment'], 'required'],
            [['param_name'], 'string', 'max' => 16],
            [['param_type'], 'string', 'max' => 6],
            [['comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'param_id' => 'Param ID',
            'param_name' => 'Param Name',
            'param_type' => 'Param Type',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasMany(Settings::className(), ['param_id' => 'param_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceipts()
    {
        return $this->hasMany(Receipt::className(), ['receipt_id' => 'receipt_id'])->viaTable('settings', ['param_id' => 'param_id']);
    }
}
