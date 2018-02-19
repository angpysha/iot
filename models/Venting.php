<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "venting".
 *
 * @property integer $id
 * @property integer $vent_mode
 * @property integer $charging
 * @property string $damp1
 * @property string $damp2
 * @property string $temp1
 * @property string $temp2
 * @property integer $valve_in
 * @property integer $valve_out
 * @property integer $valve_cyr
 * @property string $time_added
 *
 * @property VentMode $ventMode
 * @property Charging $charging0
 */
class Venting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'venting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vent_mode', 'charging'], 'required'],//'id',
            [['id', 'vent_mode', 'charging', 'valve_in', 'valve_out', 'valve_cyr'], 'integer'],
            [['time_added'], 'safe'],
            [['damp1', 'damp2'], 'string', 'max' => 6],
            [['temp1', 'temp2'], 'string', 'max' => 8],
            [['vent_mode'], 'exist', 'skipOnError' => true, 'targetClass' => VentMode::className(), 'targetAttribute' => ['vent_mode' => 'id']],
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
            'vent_mode' => 'Vent Mode',
            'charging'  => 'Загрузка / Партія',
            'damp1'     => 'сенсор волог. 1',
            'damp2'     => 'сенсор волог. 2',
            'temp1'     => 'темп. з сенс. 1',
            'temp2'     => 'темп. з сенс. 2',
            'valve_in'  => 'Клапан впускний %',
            'valve_out' => 'Клапан випускний %',
            'valve_cyr' => 'Клапан циркуляційний %',
            'time_added' => 'Time Added',
            'ventMode.name' => 'Режим',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentMode()
    {
        return $this->hasOne(VentMode::className(), ['id' => 'vent_mode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharging0()
    {
        return $this->hasOne(Charging::className(), ['id' => 'charging']);
    }
}
