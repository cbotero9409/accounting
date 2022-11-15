<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chart_accounts".
 *
 * @property int $id
 * @property string $code
 * @property string $account
 * @property int|null $handle_third_parties
 * @property int|null $controls_indebtedness
 * @property int|null $handle_references
 * @property int|null $discriminate_by_third_party
 * @property int|null $demands_base_value
 * @property int|null $visible_in_selection
 * @property int|null $local_account
 * @property int|null $niif_account
 * @property int|null $fk_account
 * @property int|null $use_niif_equivalent_account
 * @property int|null $fk_account_type
 * @property int $class
 * @property int|null $fk_tax
 *
 * @property BillToPay[] $billToPays
 * @property BillToPay[] $billToPays0
 * @property CashBank[] $cashBanks
 * @property Chartaccounts[] $chartaccounts
 * @property ExpenseList[] $expenseLists
 * @property Chartaccounts $fkAccount
 * @property AccountType $fkAccountType
 * @property Taxes $fkTax
 * @property Invoices[] $invoices
 * @property Invoices[] $invoices0
 * @property PayrollTaxes[] $payrollTaxes
 * @property Retentions[] $retentions
 * @property Retentions[] $retentions0
 * @property TaxesConfiguration[] $taxesConfigurations
 */
class Chartaccounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chart_accounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'account', 'class', 'fk_account_type'], 'required'],
            [['handle_third_parties', 'controls_indebtedness', 'handle_references', 'discriminate_by_third_party', 'demands_base_value', 'visible_in_selection', 'local_account', 'niif_account', 'use_niif_equivalent_account', 'fk_account_type', 'class', 'fk_tax'], 'integer'],
            [['code'], 'string', 'max' => 15],
            [['code'], 'match', 'pattern'=>'/^[\d]+$/'],
            [['account'], 'string', 'max' => 100],
            [['code'], 'unique', 'message' => 'Código ya existe!', 'on' => 'create'],
            [['fk_account_type'], 'exist', 'skipOnError' => true, 'targetClass' => Accounttype::className(), 'targetAttribute' => ['fk_account_type' => 'id']],
            [['fk_account'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['fk_account' => 'id']],
            [['fk_tax'], 'exist', 'skipOnError' => true, 'targetClass' => Taxes::className(), 'targetAttribute' => ['fk_tax' => 'id']],
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
            'account' => 'Nombre de la Cuenta',
            'handle_third_parties' => 'Maneja Terceros',
            'controls_indebtedness' => 'Controla Endeudamiento',
            'handle_references' => 'Maneja Referencias',
            'discriminate_by_third_party' => 'Discrimina por Tercero',
            'demands_base_value' => 'Exige Valor Base',
            'visible_in_selection' => 'Visible en Selección',
            'local_account' => 'Cuenta Local',
            'niif_account' => 'Cuenta NIIF',
            'fk_account' => 'Cuenta Equivalente',
            'use_niif_equivalent_account' => 'Usar Cuenta NIIF Equivalente',
            'fk_account_type' => 'Tipo de Cuenta',
            'class' => 'Clase de Cuenta',
            'fk_tax' => 'Impuesto',
        ];
    }

    /**
     * Gets query for [[BillToPays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBillToPays()
    {
        return $this->hasMany(Billtopay::className(), ['account' => 'id']);
    }

    /**
     * Gets query for [[BillToPays0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBillToPays0()
    {
        return $this->hasMany(Billtopay::className(), ['third_party' => 'id']);
    }

    /**
     * Gets query for [[CashBanks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCashBanks()
    {
        return $this->hasMany(Cashbank::className(), ['bank_account' => 'id']);
    }

    /**
     * Gets query for [[Chartaccounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChartAccounts()
    {
        return $this->hasMany(Chartaccounts::className(), ['fk_account' => 'id']);
    }

    /**
     * Gets query for [[ExpenseLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseLists()
    {
        return $this->hasMany(Expenselist::className(), ['fk_chart_account' => 'id']);
    }

    /**
     * Gets query for [[FkAccount]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkAccount()
    {
        return $this->hasOne(Chartaccounts::className(), ['id' => 'fk_account']);
    }

    /**
     * Gets query for [[FkAccountType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkAccountType()
    {
        return $this->hasOne(Accounttype::className(), ['id' => 'fk_account_type']);
    }

    /**
     * Gets query for [[FkTax]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkTax()
    {
        return $this->hasOne(Taxes::className(), ['id' => 'fk_tax']);
    }

    /**
     * Gets query for [[Invoices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoices::className(), ['third_party' => 'id']);
    }

    /**
     * Gets query for [[Invoices0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices0()
    {
        return $this->hasMany(Invoices::className(), ['account_cash' => 'id']);
    }

    /**
     * Gets query for [[PayrollTaxes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayrollTaxes()
    {
        return $this->hasMany(Payrolltaxes::className(), ['fk_chart_account' => 'id']);
    }

    /**
     * Gets query for [[Retentions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRetentions()
    {
        return $this->hasMany(Retentions::className(), ['bill_to_pay' => 'id']);
    }

    /**
     * Gets query for [[Retentions0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRetentions0()
    {
        return $this->hasMany(Retentions::className(), ['expense_account' => 'id']);
    }

    /**
     * Gets query for [[TaxesConfigurations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxesConfigurations()
    {
        return $this->hasMany(Taxesconfiguration::className(), ['fk_chart_account' => 'id']);
    }
}
