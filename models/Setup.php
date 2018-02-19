<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "setup".
 *
 * @property string $param
 * @property string $value
 * @property string $value_type
 * @property string $comment
 */
class Setup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param', 'value', 'value_type', 'comment'], 'required'],
            [['value'], 'string'],
            [['param'], 'string', 'max' => 16],
            [['value_type'], 'string', 'max' => 6],
            [['comment'], 'string', 'max' => 255],
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
            'value_type' => 'Value Type',
            'comment' => 'Comment',
        ];
    }
}
