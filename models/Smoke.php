<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "smoke".
 *
 * @property string $id
 * @property string $fume
 * @property string $temp
 * @property integer $location
 * @property string $time
 */
class Smoke extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smoke';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fume', 'temp'], 'required'],
            [['location'], 'integer'],
            [['time'], 'safe'],
            [['fume', 'temp'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fume' => 'Fume',
            'temp' => 'Temp',
            'location' => 'Location',
            'time' => 'Time',
        ];
    }
}
