<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bill_to_pay".
 *
 * @property int $id
 * @property int|null $third_party
 * @property int|null $account
 * @property string $date_to_pay
 * @property string $number_of_fees
 * @property int|null $fk_inovice
 * @property int|null $fk_bill
 *
 * @property ChartAccounts $account0
 * @property BillOfSale $fkBill
 * @property Invoices $fkInovice
 * @property ChartAccounts $thirdParty
 */
class Billtopay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bill_to_pay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['third_party', 'account', 'fk_inovice', 'fk_bill'], 'integer'],
            [['date_to_pay'], 'safe'],
            [['number_of_fees'], 'string', 'max' => 3],
            [['number_of_fees'], 'match', 'pattern'=>'/^[\d]+$/'],
            [['account'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['account' => 'id']],
            [['fk_inovice'], 'exist', 'skipOnError' => true, 'targetClass' => Invoices::className(), 'targetAttribute' => ['fk_inovice' => 'id']],
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
            'third_party' => 'Tercero a pagar',
            'account' => 'Cuenta',
            'date_to_pay' => 'Fecha de Pago',
            'number_of_fees' => 'Cantidad de Cuotas',
            'fk_inovice' => 'Factura de Compra',
            'fk_bill' => 'Factura de Venta',
        ];
    }

    /**
     * Gets query for [[Account0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccount0()
    {
        return $this->hasOne(Chartaccounts::className(), ['id' => 'account']);
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
     * Gets query for [[FkInovice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkInovice()
    {
        return $this->hasOne(Invoices::className(), ['id' => 'fk_inovice']);
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
