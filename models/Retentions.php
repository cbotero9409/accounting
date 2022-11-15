<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "retentions".
 *
 * @property int $id
 * @property int|null $fk_parent_retention
 * @property string $code
 * @property string $name
 * @property string $validity_start
 * @property string $calculation_type
 * @property float|null $value
 * @property float|null $min_base_value
 * @property int $auto_calculation
 * @property int $movement_type
 * @property int|null $bill_to_pay
 * @property int $how_affects
 * @property int $payment_date_table
 * @property int $third_party_alias
 * @property int|null $expense_account
 * @property int|null $cost_center
 * @property int|null $obsolete
 *
 * @property ChartAccounts $billToPay
 * @property CostCenter $costCenter
 * @property ChartAccounts $expenseAccount
 * @property Retentions $fkParentRetention
 * @property PayrollTaxes[] $payrollTaxes
 * @property Retentions[] $retentions
 * @property TaxesConfiguration[] $taxesConfigurations
 * @property TaxesConfiguration[] $taxesConfigurations0
 * @property TaxesConfiguration[] $taxesConfigurations1
 * @property TaxesConfiguration[] $taxesConfigurations2
 * @property TaxesConfiguration[] $taxesConfigurations3
 * @property TaxesConfiguration[] $taxesConfigurations4
 * @property TaxesConfiguration[] $taxesConfigurations5
 * @property TaxesLiquidation[] $taxesLiquidations
 */
class Retentions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'retentions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['calculation_type', 'fk_parent_retention', 'auto_calculation', 'movement_type', 'bill_to_pay', 'how_affects', 'payment_date_table', 'third_party_alias', 'expense_account', 'cost_center', 'obsolete'], 'integer'],
            [['fk_parent_retention', 'value', 'min_base_value', 'bill_to_pay', 'code', 'name', 'validity_start', 'calculation_type', 'movement_type', 'how_affects', 'payment_date_table', 'third_party_alias'], 'required'],
            [['validity_start'], 'safe'],
            [['value', 'min_base_value'], 'number'],
            [['code'], 'string', 'max' => 15],
            [['code'], 'match', 'pattern'=> '/^[A-Z0-9]+$/'],
            [['name'], 'string', 'max' => 50],
            [['fk_parent_retention'], 'exist', 'skipOnError' => true, 'targetClass' => Retentions::className(), 'targetAttribute' => ['fk_parent_retention' => 'id']],
            [['bill_to_pay'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['bill_to_pay' => 'id']],
            [['expense_account'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['expense_account' => 'id']],
            [['cost_center'], 'exist', 'skipOnError' => true, 'targetClass' => Costcenter::className(), 'targetAttribute' => ['cost_center' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_parent_retention' => 'Concepto Padre',
            'code' => 'Código',
            'name' => 'Nombre',
            'validity_start' => 'Inicio de Vigencia',
            'calculation_type' => 'Tipo de Cálculo',
            'value' => 'Valor',
            'min_base_value' => 'Valor Base Mínimo',
            'auto_calculation' => 'Cálculo Automático',
            'movement_type' => 'Tipo de Movimiento',
            'bill_to_pay' => 'Cuenta por Pagar/Cobrar',
            'how_affects' => 'Cómo Afecta el Pago ',
            'payment_date_table' => 'Tabla de Fecha de Pago',
            'third_party_alias' => 'Identificación del Tercero',
            'expense_account' => 'Cuenta de Egreso',
            'cost_center' => 'Centro de Costos',
            'obsolete' => 'Obsoleto',
        ];
    }

    /**
     * Gets query for [[BillToPay]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBillToPay()
    {
        return $this->hasOne(Chartaccounts::className(), ['id' => 'bill_to_pay']);
    }

    /**
     * Gets query for [[CostCenter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCostCenter()
    {
        return $this->hasOne(Costcenter::className(), ['id' => 'cost_center']);
    }

    /**
     * Gets query for [[ExpenseAccount]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseAccount()
    {
        return $this->hasOne(Chartaccounts::className(), ['id' => 'expense_account']);
    }

    /**
     * Gets query for [[FkParentRetention]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkParentRetention()
    {
        return $this->hasOne(Retentions::className(), ['id' => 'fk_parent_retention']);
    }

    /**
     * Gets query for [[PayrollTaxes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayrollTaxes()
    {
        return $this->hasMany(Payrolltaxes::className(), ['concept' => 'id']);
    }

    /**
     * Gets query for [[Retentions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRetentions()
    {
        return $this->hasMany(Retentions::className(), ['fk_parent_retention' => 'id']);
    }

    /**
     * Gets query for [[TaxesConfigurations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxesConfigurations()
    {
        return $this->hasMany(Taxesconfiguration::className(), ['other_2' => 'id']);
    }

    /**
     * Gets query for [[TaxesConfigurations0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxesConfigurations0()
    {
        return $this->hasMany(Taxesconfiguration::className(), ['iva' => 'id']);
    }

    /**
     * Gets query for [[TaxesConfigurations1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxesConfigurations1()
    {
        return $this->hasMany(Taxesconfiguration::className(), ['retention' => 'id']);
    }

    /**
     * Gets query for [[TaxesConfigurations2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxesConfigurations2()
    {
        return $this->hasMany(Taxesconfiguration::className(), ['rete_ica' => 'id']);
    }

    /**
     * Gets query for [[TaxesConfigurations3]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxesConfigurations3()
    {
        return $this->hasMany(Taxesconfiguration::className(), ['tax_cree' => 'id']);
    }

    /**
     * Gets query for [[TaxesConfigurations4]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxesConfigurations4()
    {
        return $this->hasMany(Taxesconfiguration::className(), ['auto_retention' => 'id']);
    }

    /**
     * Gets query for [[TaxesConfigurations5]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxesConfigurations5()
    {
        return $this->hasMany(Taxesconfiguration::className(), ['other' => 'id']);
    }

    /**
     * Gets query for [[TaxesLiquidations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxesLiquidations()
    {
        return $this->hasMany(Taxesliquidation::className(), ['concept' => 'id']);
    }
}
