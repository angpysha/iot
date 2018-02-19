<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "heating".
 *
 * @property integer $id
 * @property integer $heat_mode
 * @property integer $charging
 * @property string $temp_chamber
 * @property string $temp_supply
 * @property string $temp_hot
 * @property string $temp_cold
 * @property string $time_added
 *
 * @property HeatMode $heatMode
 * @property Charging $charging0
 */
class Heating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'heating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['heat_mode', 'charging'], 'required'],//'id',
            [['id', 'heat_mode', 'charging'], 'integer'],
            [['time_added'], 'safe'],
            [['temp_chamber', 'temp_supply', 'temp_hot', 'temp_cold'], 'string', 'max' => 8],
            [['heat_mode'], 'exist', 'skipOnError' => true, 'targetClass' => HeatMode::className(), 'targetAttribute' => ['heat_mode' => 'id']],
            [['charging'], 'exist', 'skipOnError' => true, 'targetClass' => Charging::className(), 'targetAttribute' => ['charging' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'heat_mode' => 'Heat Mode',
            'charging' => 'Charging',
            'temp_chamber' => 'Температура камери',
            'temp_supply' => 'Темп. баку підготовки',
            'temp_hot' => 'Темп. гарячого баку',
            'temp_cold' => 'Темп. холодного баку',
            'time_added' => 'Time Added',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHeatMode()
    {
        return $this->hasOne(HeatMode::className(), ['id' => 'heat_mode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharging0()
    {
        return $this->hasOne(Charging::className(), ['id' => 'charging']);
    }
}
