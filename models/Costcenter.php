<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cost_center".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $short_name
 * @property string|null $manager
 * @property int|null $class_cc
 * @property string|null $group_class
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int|null $fk_company
 * @property int|null $fk_headquarter
 * @property int|null $fk_cost_center
 *
 * @property BillOfSale[] $billOfSales
 * @property Costcenter[] $costcenters
 * @property ExpenseList[] $expenseLists
 * @property Company $fkCompany
 * @property Costcenter $fkCostCenter
 * @property Headquarters $fkHeadquarter
 * @property IncomeList[] $incomeLists
 * @property Invoices[] $invoices
 * @property Retentions[] $retentions
 */
class Costcenter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cost_center';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['class_cc', 'fk_company', 'fk_headquarter', 'fk_cost_center'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['code'], 'string', 'max' => 10],
            [['code'], 'match', 'pattern'=>'/^[\d]+$/'],
            [['name', 'manager'], 'string', 'max' => 50],
            [['short_name'], 'string', 'max' => 30],
            [['name', 'manager', 'short_name'], 'match', 'pattern'=>'/^[\w\á-úÁ-Ú\s\ñ().#-]+$/'],
            [['group_class'], 'string', 'max' => 20],
            [['fk_company'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_company' => 'id']],
            [['fk_headquarter'], 'exist', 'skipOnError' => true, 'targetClass' => Headquarters::className(), 'targetAttribute' => ['fk_headquarter' => 'id']],
            [['fk_cost_center'], 'exist', 'skipOnError' => true, 'targetClass' => Costcenter::className(), 'targetAttribute' => ['fk_cost_center' => 'id']],
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
            'name' => 'Nombre',
            'short_name' => 'Nombre Corto',
            'manager' => 'Responsable',
            'class_cc' => 'Clase de Centro de Costos',
            'group_class' => 'Grupo',
            'start_date' => 'Fecha Inicial Vigencia',
            'end_date' => 'Fecha Final Vigencia',
            'fk_company' => 'Empresa',
            'fk_headquarter' => 'Sede',
            'fk_cost_center' => 'Centro de Costos',
        ];
    }

    /**
     * Gets query for [[BillOfSales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBillOfSales()
    {
        return $this->hasMany(BillOfSale::className(), ['cost_center' => 'id']);
    }

    /**
     * Gets query for [[Costcenters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCostcenters()
    {
        return $this->hasMany(Costcenter::className(), ['fk_cost_center' => 'id']);
    }

    /**
     * Gets query for [[ExpenseLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseLists()
    {
        return $this->hasMany(Expenselist::className(), ['fk_cost_center' => 'id']);
    }

    /**
     * Gets query for [[FkCompany]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'fk_company']);
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
     * Gets query for [[FkHeadquarter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkHeadquarter()
    {
        return $this->hasOne(Headquarters::className(), ['id' => 'fk_headquarter']);
    }

    /**
     * Gets query for [[IncomeLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIncomeLists()
    {
        return $this->hasMany(Incomelist::className(), ['fk_cost_center' => 'id']);
    }

    /**
     * Gets query for [[Invoices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoices::className(), ['cost_center' => 'id']);
    }

    /**
     * Gets query for [[Retentions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRetentions()
    {
        return $this->hasMany(Retentions::className(), ['cost_center' => 'id']);
    }
}
