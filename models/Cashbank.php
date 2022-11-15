<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cash_bank".
 *
 * @property int $id
 * @property int|null $bank_account
 * @property int $movement_type
 * @property string|null $number
 * @property string $date
 * @property int|null $fk_invoice
 * @property int|null $fk_bill
 *
 * @property ChartAccounts $bankAccount
 * @property BillOfSale $fkBill
 * @property Invoices $fkInvoice
 */
class Cashbank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cash_bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_account', 'movement_type', 'fk_invoice'], 'integer'],            
            [['date'], 'safe'],
            [['number'], 'string', 'max' => 20],
            [['number'], 'match', 'pattern'=>'/^[\d]+$/'],
            [['bank_account'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['bank_account' => 'id']],
            [['fk_invoice'], 'exist', 'skipOnError' => true, 'targetClass' => Invoices::className(), 'targetAttribute' => ['fk_invoice' => 'id']],
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
            'bank_account' => 'Cuenta Banco',
            'movement_type' => 'Tipo de Movimiento',
            'number' => 'Número',
            'date' => 'Fecha Transacción',
            'fk_invoice' => 'Factura de Compra',
            'fk_bill' => 'Factura de Venta',
        ];
    }

    /**
     * Gets query for [[BankAccount]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBankAccount()
    {
        return $this->hasOne(Chartaccounts::className(), ['id' => 'bank_account']);
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
}
