<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "atm".
 *
 * @property int $id
 * @property string $address
 * @property double $latitude
 * @property double $longitude
 */
class Atm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['address'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Address',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }

    public function hydrate(array $inputData)
    {
        $this->address = $inputData['fullAddressUa'];
        $this->latitude = $inputData['latitude'];
        $this->longitude = $inputData['longitude'];
    }
}
