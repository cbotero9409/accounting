<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "taxes_configuration".
 *
 * @property int $id
 * @property int|null $iva
 * @property int|null $retention
 * @property int|null $rete_ica
 * @property int|null $tax_cree
 * @property int|null $auto_retention
 * @property int|null $other
 * @property int|null $other_2
 * @property int|null $fk_chart_account
 *
 * @property Retentions $autoRetention
 * @property ChartAccounts $fkChartAccount
 * @property Retentions $iva0
 * @property Retentions $other0
 * @property Retentions $other2
 * @property Retentions $reteIca
 * @property Retentions $retention0
 * @property Retentions $taxCree
 */
class Taxesconfiguration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taxes_configuration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iva', 'retention', 'rete_ica', 'tax_cree', 'auto_retention', 'other', 'other_2', 'fk_chart_account'], 'integer'],
            [['other_2'], 'exist', 'skipOnError' => true, 'targetClass' => Retentions::className(), 'targetAttribute' => ['other_2' => 'id']],
            [['fk_chart_account'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['fk_chart_account' => 'id']],
            [['iva'], 'exist', 'skipOnError' => true, 'targetClass' => Retentions::className(), 'targetAttribute' => ['iva' => 'id']],
            [['retention'], 'exist', 'skipOnError' => true, 'targetClass' => Retentions::className(), 'targetAttribute' => ['retention' => 'id']],
            [['rete_ica'], 'exist', 'skipOnError' => true, 'targetClass' => Retentions::className(), 'targetAttribute' => ['rete_ica' => 'id']],
            [['tax_cree'], 'exist', 'skipOnError' => true, 'targetClass' => Retentions::className(), 'targetAttribute' => ['tax_cree' => 'id']],
            [['auto_retention'], 'exist', 'skipOnError' => true, 'targetClass' => Retentions::className(), 'targetAttribute' => ['auto_retention' => 'id']],
            [['other'], 'exist', 'skipOnError' => true, 'targetClass' => Retentions::className(), 'targetAttribute' => ['other' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iva' => 'IVA',
            'retention' => 'Retención',
            'rete_ica' => 'Rete-ICA',
            'tax_cree' => 'Impuesto CREE',
            'auto_retention' => 'Auto-retención',
            'other' => 'Otro',
            'other_2' => 'Otro 2',
            'fk_chart_account' => 'Plan de Cuenta',
        ];
    }

    /**
     * Gets query for [[AutoRetention]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutoRetention()
    {
        return $this->hasOne(Retentions::className(), ['id' => 'auto_retention']);
    }

    /**
     * Gets query for [[FkChartAccount]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkChartAccount()
    {
        return $this->hasOne(Chartaccounts::className(), ['id' => 'fk_chart_account']);
    }

    /**
     * Gets query for [[Iva0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIva0()
    {
        return $this->hasOne(Retentions::className(), ['id' => 'iva']);
    }

    /**
     * Gets query for [[Other0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOther0()
    {
        return $this->hasOne(Retentions::className(), ['id' => 'other']);
    }

    /**
     * Gets query for [[Other2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOther2()
    {
        return $this->hasOne(Retentions::className(), ['id' => 'other_2']);
    }

    /**
     * Gets query for [[ReteIca]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReteIca()
    {
        return $this->hasOne(Retentions::className(), ['id' => 'rete_ica']);
    }

    /**
     * Gets query for [[Retention0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRetention0()
    {
        return $this->hasOne(Retentions::className(), ['id' => 'retention']);
    }

    /**
     * Gets query for [[TaxCree]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxCree()
    {
        return $this->hasOne(Retentions::className(), ['id' => 'tax_cree']);
    }
}
