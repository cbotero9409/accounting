<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense_list".
 *
 * @property int $id
 * @property int|null $fk_chart_account
 * @property string $concept
 * @property float $price
 * @property int|null $fk_cost_center
 * @property int|null $fk_inovice
 *
 * @property ChartAccounts $fkChartAccount
 * @property CostCenter $fkCostCenter
 * @property Invoices $fkInovice
 */
class Expenselist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expense_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_chart_account', 'fk_cost_center', 'fk_inovice'], 'integer'],
            [['concept', 'price'], 'required'],
            [['price'], 'number'],
            [['concept'], 'string', 'max' => 100],
            [['fk_chart_account'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['fk_chart_account' => 'id']],
            [['fk_cost_center'], 'exist', 'skipOnError' => true, 'targetClass' => Costcenter::className(), 'targetAttribute' => ['fk_cost_center' => 'id']],
            [['fk_inovice'], 'exist', 'skipOnError' => true, 'targetClass' => Invoices::className(), 'targetAttribute' => ['fk_inovice' => 'id']],
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
            'concept' => 'Concepto de Ingresos',
            'price' => 'Valor',
            'fk_cost_center' => 'Centro de Costos a Pagar',
            'fk_inovice' => 'Factura de Compra',
        ];
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

    /**
     * Gets query for [[FkInovice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkInovice()
    {
        return $this->hasOne(Invoices::className(), ['id' => 'fk_inovice']);
    }
}
