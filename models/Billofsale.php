<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bill_of_sale".
 *
 * @property int $id
 * @property int|null $fk_doc_type
 * @property string $doc_number
 * @property string $date
 * @property int $class
 * @property int|null $fk_municipality
 * @property string $detail
 * @property int|null $cost_center
 * @property int|null $client
 * @property int|null $seller
 * @property int $type_of_operation
 * @property string $purchase_order_number
 * @property string $observations
 * @property string $reference
 * @property float $total_price
 * @property float $cash
 * @property int|null $account_cash
 * @property float $cash_payment_bank
 * @property float $bill_to_pay
 *
 * @property ChartAccounts $accountCash
 * @property BillToPay[] $billToPays
 * @property BillsAttachedFiles[] $billsAttachedFiles
 * @property CashBank[] $cashBanks
 * @property ChartAccounts $client0
 * @property CostCenter $costCenter
 * @property DocumentType $fkDocType
 * @property Municipality $fkMunicipality
 * @property IncomeList[] $incomeLists
 * @property ChartAccounts $seller0
 * @property TaxesLiquidation[] $taxesLiquidations
 */
class Billofsale extends \yii\db\ActiveRecord
{    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bill_of_sale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_doc_type', 'class', 'cost_center', 'fk_municipality', 'client', 'seller', 'type_of_operation', 'account_cash'], 'integer'],
            [['fk_doc_type', 'doc_number', 'cost_center', 'date', 'detail', 'reference', 'total_price', 'client', 'seller', 'cost_center'], 'required'],
            [['date'], 'safe'],
            [['observations'], 'string'],
            [['total_price', 'cash', 'cash_payment_bank', 'bill_to_pay'], 'number'],
            [['doc_number', 'purchase_order_number', 'reference'], 'string', 'max' => 20],
            [['detail'], 'string', 'max' => 100],
            [['fk_municipality'], 'exist', 'skipOnError' => true, 'targetClass' => Municipality::className(), 'targetAttribute' => ['fk_municipality' => 'id']],
            [['fk_doc_type'], 'exist', 'skipOnError' => true, 'targetClass' => Documenttype::className(), 'targetAttribute' => ['fk_doc_type' => 'id']],
            [['client'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['client' => 'id']],
            [['seller'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['seller' => 'id']],
            [['cost_center'], 'exist', 'skipOnError' => true, 'targetClass' => Costcenter::className(), 'targetAttribute' => ['cost_center' => 'id']],
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
            'cost_center' => 'Centro de Costo',
            'client' => 'Cliente',
            'seller' => 'Vendedor',
            'type_of_operation' => 'Tipo de Operación',
            'purchase_order_number' => 'Número Orden de Compra',
            'observations' => 'Observaciones',
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
        return $this->hasMany(Billtopay::className(), ['fk_bill' => 'id']);
    }

    /**
     * Gets query for [[BillsAttachedFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBillsAttachedFiles()
    {
        return $this->hasMany(Billsattachedfiles::className(), ['fk_bill_of_sale' => 'id']);
    }

    /**
     * Gets query for [[CashBanks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCashBanks()
    {
        return $this->hasMany(Cashbank::className(), ['fk_bill' => 'id']);
    }

    /**
     * Gets query for [[Client0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient0()
    {
        return $this->hasOne(Chartaccounts::className(), ['id' => 'client']);
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
     * Gets query for [[IncomeLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIncomeLists()
    {
        return $this->hasMany(Incomelist::className(), ['fk_bill' => 'id']);
    }

    /**
     * Gets query for [[Seller0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeller0()
    {
        return $this->hasOne(Chartaccounts::className(), ['id' => 'seller']);
    }

    /**
     * Gets query for [[TaxesLiquidations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxesLiquidations()
    {
        return $this->hasMany(Taxesliquidation::className(), ['fk_bill' => 'id']);
    }
}
