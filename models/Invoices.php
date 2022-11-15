<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoices".
 *
 * @property int $id
 * @property int|null $fk_doc_type
 * @property string $doc_number
 * @property string $date
 * @property int|null $class
 * @property int|null $fk_municipality
 * @property string $detail
 * @property int|null $cost_center
 * @property int|null $third_party
 * @property string $reference
 * @property float $total_price
 * @property float $cash
 * @property int|null $account_cash
 * @property float $cash_payment_bank
 * @property float $bill_to_pay
 *
 * @property ChartAccounts $accountCash
 * @property BillToPay[] $billToPays
 * @property CashBank[] $cashBanks
 * @property CostCenter $costCenter
 * @property ExpenseList[] $expenseLists
 * @property DocumentType $fkDocType
 * @property Municipality $fkMunicipality
 * @property TaxesLiquidation[] $taxesLiquidations
 * @property ChartAccounts $thirdParty
 */
class Invoices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_doc_type', 'class', 'fk_municipality', 'cost_center', 'third_party', 'account_cash'], 'integer'],
            [['fk_doc_type', 'doc_number', 'date', 'detail', 'reference', 'total_price', 'cost_center', 'third_party'], 'required'],
            [['date'], 'safe'],
            [['total_price', 'cash', 'cash_payment_bank', 'bill_to_pay'], 'number'],
            [['doc_number'], 'string', 'max' => 20],
            [['detail'], 'string', 'max' => 100],
            [['reference'], 'string', 'max' => 20],
            [['fk_municipality'], 'exist', 'skipOnError' => true, 'targetClass' => Municipality::className(), 'targetAttribute' => ['fk_municipality' => 'id']],
            [['fk_doc_type'], 'exist', 'skipOnError' => true, 'targetClass' => Documenttype::className(), 'targetAttribute' => ['fk_doc_type' => 'id']],
            [['cost_center'], 'exist', 'skipOnError' => true, 'targetClass' => Costcenter::className(), 'targetAttribute' => ['cost_center' => 'id']],
            [['third_party'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['third_party' => 'id']],
            [['account_cash'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['account_cash' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_doc_type' => 'Tipo de Documento',
            'doc_number' => 'Número de Documento',
            'date' => 'Fecha',
            'class' => 'Clase',
            'fk_municipality' => 'Municipio',
            'detail' => 'Detalle',
            'cost_center' => 'Centro de Costos Base',
            'third_party' => 'Tercero',
            'reference' => 'Referencia',
            'total_price' => 'Valor Total',
            'cash' => 'Valor Efectivo (Caja)',
            'account_cash' => 'Cuenta Caja',
            'cash_payment_bank' => 'Valor Contado (Banco)',
            'bill_to_pay' => 'Valor Cuenta por Pagar',
        ];
    }

    /**
     * Gets query for [[AccountCash]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCash()
    {
        return $this->hasOne(Chartaccounts::className(), ['id' => 'account_cash']);
    }

    /**
     * Gets query for [[BillToPays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBillToPays()
    {
        return $this->hasMany(Billtopay::className(), ['fk_inovice' => 'id']);
    }

    /**
     * Gets query for [[CashBanks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCashBanks()
    {
        return $this->hasMany(Cashbank::className(), ['fk_invoice' => 'id']);
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
     * Gets query for [[ExpenseLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseLists()
    {
        return $this->hasMany(Expenselist::className(), ['fk_inovice' => 'id']);
    }

    /**
     * Gets query for [[FkDocType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkDocType()
    {
        return $this->hasOne(Documenttype::className(), ['id' => 'fk_doc_type']);
    }

    /**
     * Gets query for [[FkMunicipality]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkMunicipality()
    {
        return $this->hasOne(Municipality::className(), ['id' => 'fk_municipality']);
    }

    /**
     * Gets query for [[TaxesLiquidations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxesLiquidations()
    {
        return $this->hasMany(Taxesliquidation::className(), ['fk_invoice' => 'id']);
    }

    /**
     * Gets query for [[ThirdParty]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThirdParty()
    {
        return $this->hasOne(Chartaccounts::className(), ['id' => 'third_party']);
    }
}
