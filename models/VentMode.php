<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vent_mode".
 *
 * @property integer $id
 * @property string $name
 * @property string $comment
 *
 * @property Venting[] $ventings
 */
class VentMode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vent_mode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'comment'], 'required'],
            [['comment'], 'string'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentings()
    {
        return $this->hasMany(Venting::className(), ['vent_mode' => 'id']);
    }
}
