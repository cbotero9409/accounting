<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "economic_activity".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @property TaxClassification[] $taxClassifications
 */
class Economicactivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'economic_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 6],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Código',
            'name' => 'Nombre Actividad',
        ];
    }

    /**
     * Gets query for [[TaxClassifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxClassifications()
    {
        return $this->hasMany(Taxclassification::className(), ['fk_economic_activity' => 'id']);
    }
}
