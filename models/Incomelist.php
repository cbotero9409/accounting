<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "income_list".
 *
 * @property int $id
 * @property int|null $fk_chart_account
 * @property int|null $concept
 * @property float $price
 * @property int|null $fk_cost_center
 * @property int|null $fk_bill
 *
 * @property BillOfSale $fkBill
 * @property ChartAccounts $fkChartAccount
 * @property CostCenter $fkCostCenter
 */
class Incomelist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'income_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_chart_account', 'fk_cost_center', 'fk_bill'], 'integer'],
            [['concept', 'price'], 'required'],
            [['price'], 'number'],
            [['concept'], 'string', 'max' => 100],
            [['fk_chart_account'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['fk_chart_account' => 'id']],
            [['fk_cost_center'], 'exist', 'skipOnError' => true, 'targetClass' => Costcenter::className(), 'targetAttribute' => ['fk_cost_center' => 'id']],
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
            'fk_chart_account' => 'Cuenta de Ingresos',
            'concept' => 'Concepto',
            'price' => 'Valor',
            'fk_cost_center' => 'Centro de Costos',
            'fk_bill' => 'Factura de Venta',
        ];
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
     * Gets query for [[FkChartAccount]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkChartAccount()
    {
        return $this->hasOne(Chartaccounts::className(), ['id' => 'fk_chart_account']);
    }

    /**
     * Gets query for [[FkCostCenter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkCostCenter()
    {
        return $this->hasOne(Costcenter::className(), ['id' => 'fk_cost_center']);
    }
}
