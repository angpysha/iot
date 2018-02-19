<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property string $param
 * @property string $value
 * @property string $date_modified
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param', 'value'], 'required'],
            [['date_modified'], 'safe'],
            [['param'], 'string', 'max' => 64],
            [['value'], 'string', 'max' => 256],
            [['param'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'param' => 'Param',
            'value' => 'Value',
            'date_modified' => 'Date Modified',
        ];
    }
}
