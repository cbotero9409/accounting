<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "taxes_liquidation".
 *
 * @property int $id
 * @property int|null $concept
 * @property float $base_value
 * @property string|null $observation
 * @property float $price
 * @property int|null $account_to_affect
 * @property int|null $third_party
 * @property string|null $cc_active
 * @property string|null $payment_date
 * @property int|null $fk_invoice
 * @property int|null $fk_bill
 *
 * @property ChartAccounts $accountToAffect
 * @property Retentions $concept0
 * @property BillOfSale $fkBill
 * @property Invoices $fkInvoice
 * @property ChartAccounts $thirdParty
 */
class Taxesliquidation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taxes_liquidation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['concept', 'account_to_affect', 'third_party', 'fk_invoice', 'fk_bill'], 'integer'],
            [['base_value', 'price'], 'required'],
            [['base_value', 'price'], 'number'],
            [['payment_date'], 'safe'],
            [['observation'], 'string', 'max' => 200],
            [['cc_active'], 'string', 'max' => 20],
            [['concept'], 'exist', 'skipOnError' => true, 'targetClass' => Retentions::className(), 'targetAttribute' => ['concept' => 'id']],
            [['fk_invoice'], 'exist', 'skipOnError' => true, 'targetClass' => Invoices::className(), 'targetAttribute' => ['fk_invoice' => 'id']],
            [['account_to_affect'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['account_to_affect' => 'id']],
            [['third_party'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['third_party' => 'id']],
            [['fk_bill'], 'exist', 'skipOnError' => true, 'targetClass' => Billofsale::className(), 'targetAttribute' => ['fk_bill' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'concept' => 'Concept',
            'base_value' => 'Base Value',
            'observation' => 'Observación',
            'price' => 'Valor',
            'account_to_affect' => 'Cuenta a Afectar',
            'third_party' => 'Tercero CXC',
            'cc_active' => 'CC/Activo',
            'payment_date' => 'Fecha de Pago',
            'fk_invoice' => 'Factura de Compra',
            'fk_bill' => 'Factura de Venta',
        ];
    }

    /**
     * Gets query for [[AccountToAffect]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccountToAffect()
    {
        return $this->hasOne(Chartaccounts::className(), ['id' => 'account_to_affect']);
    }

    /**
     * Gets query for [[Concept0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConcept0()
    {
        return $this->hasOne(Retentions::className(), ['id' => 'concept']);
    }

    /**
     * Gets query for [[FkBill]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkBill()
    {
        return $this->hasOne(Billofsale::className(), ['id' => 'fk_bill']);
    }

    /**
     * Gets query for [[FkInvoice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkInvoice()
    {
        return $this->hasOne(Invoices::className(), ['id' => 'fk_invoice']);
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
