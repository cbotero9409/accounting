<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payroll_taxes".
 *
 * @property int $id
 * @property int|null $concept
 * @property int|null $fk_chart_account
 *
 * @property Retentions $concept0
 * @property ChartAccounts $fkChartAccount
 */
class Payrolltaxes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payroll_taxes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['concept', 'fk_chart_account'], 'integer'],
            [['concept'], 'exist', 'skipOnError' => true, 'targetClass' => Retentions::className(), 'targetAttribute' => ['concept' => 'id']],
            [['fk_chart_account'], 'exist', 'skipOnError' => true, 'targetClass' => Chartaccounts::className(), 'targetAttribute' => ['fk_chart_account' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'concept' => 'Concepto',
            'fk_chart_account' => 'Plan de Cuenta',
        ];
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
     * Gets query for [[FkChartAccount]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkChartAccount()
    {
        return $this->hasOne(Chartaccounts::className(), ['id' => 'fk_chart_account']);
    }
}
