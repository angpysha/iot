<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "heat_mode".
 *
 * @property integer $id
 * @property string $name
 * @property string $comment
 *
 * @property Heating[] $heatings
 */
class HeatMode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'heat_mode';
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
    public function getHeatings()
    {
        return $this->hasMany(Heating::className(), ['heat_mode' => 'id']);
    }
}
