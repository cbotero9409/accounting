<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string $name
 * @property string|null $reference
 * @property string|null $clasification
 * @property string|null $construction
 * @property string|null $unit
 * @property float|null $unit_price
 * @property float $total_price
 * @property string|null $data_sheet
 * @property int|null $fk_company
 * @property int|null $fk_type
 * @property int|null $fk_municipality
 * @property int|null $fk_tax
 *
 * @property Company $fkCompany
 * @property Municipality $fkMunicipality
 * @property Taxes $fkTax
 * @property TypeService $fkType
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'total_price'], 'required'],
            [['unit_price', 'total_price'], 'number'],
            [['fk_company', 'fk_type', 'fk_municipality', 'fk_tax'], 'integer'],
            [['name', 'clasification'], 'string', 'max' => 30],
            [['reference'], 'string', 'max' => 50],
            [['construction'], 'string', 'max' => 100],
            [['unit', 'data_sheet'], 'string', 'max' => 20],
            [['fk_company'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_company' => 'id']],
            [['fk_municipality'], 'exist', 'skipOnError' => true, 'targetClass' => Municipality::className(), 'targetAttribute' => ['fk_municipality' => 'id']],
            [['fk_tax'], 'exist', 'skipOnError' => true, 'targetClass' => Taxes::className(), 'targetAttribute' => ['fk_tax' => 'id']],
            [['fk_type'], 'exist', 'skipOnError' => true, 'targetClass' => TypeService::className(), 'targetAttribute' => ['fk_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'reference' => 'Reference',
            'clasification' => 'Clasification',
            'construction' => 'Construction',
            'unit' => 'Unit',
            'unit_price' => 'Unit Price',
            'total_price' => 'Total Price',
            'data_sheet' => 'Data Sheet',
            'fk_company' => 'Fk Company',
            'fk_type' => 'Fk Type',
            'fk_municipality' => 'Fk Municipality',
            'fk_tax' => 'Fk Tax',
        ];
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
     * Gets query for [[FkMunicipality]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkMunicipality()
    {
        return $this->hasOne(Municipality::className(), ['id' => 'fk_municipality']);
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
     * Gets query for [[FkType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkType()
    {
        return $this->hasOne(TypeService::className(), ['id' => 'fk_type']);
    }
}
