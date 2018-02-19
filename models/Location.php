<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property integer $location_id
 * @property string $location_name
 * @property string $address
 * @property string $telephone
 * @property string $rfid_id
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_name', 'address'], 'required'],
            [['location_name', 'address', 'telephone'], 'string', 'max' => 255],
            [['rfid_id'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'location_id' => 'Location ID',
            'location_name' => 'Місцезнаходження',
            'address' => 'Адреса',
            'telephone' => 'Контактний телефон',
            'rfid_id' => 'RFID',
        ];
    }
}
