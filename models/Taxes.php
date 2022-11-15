<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "taxes".
 *
 * @property int $id
 * @property string $tax
 * @property string $type
 * @property float $value
 * @property string $year
 *
 * @property ChartAccounts[] $chartAccounts
 * @property Services[] $services
 */
class Taxes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taxes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tax', 'type', 'value', 'year'], 'required'],
            [['value'], 'number'],
            [['tax', 'type'], 'string', 'max' => 30],
            [['tax'], 'match', 'pattern'=>'/^[\a-zA-Z\s\ñ\á-ú\Á-Ú]+$/'],
            [['year'], 'string', 'max' => 4],
            [['year'], 'match', 'pattern'=>'/^[\d]{4}/'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tax' => 'Impuesto',
            'type' => 'Tipo de Impuesto',
            'value' => 'Valor (%)',
            'year' => 'Año',
        ];
    }

    /**
     * Gets query for [[ChartAccounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChartAccounts()
    {
        return $this->hasMany(ChartAccounts::className(), ['fk_tax' => 'id']);
    }

    /**
     * Gets query for [[Services]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Services::className(), ['fk_tax' => 'id']);
    }
}
