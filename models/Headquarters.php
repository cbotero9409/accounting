<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "headquarters".
 *
 * @property int $id
 * @property int|null $fk_company
 * @property string $code
 * @property string $name
 * @property string|null $short_name
 * @property string|null $manager
 * @property int|null $fk_municipality
 * @property string|null $address
 * @property int|null $default_category
 * @property int|null $cost_center_class
 * @property string|null $group_class
 * @property string|null $start_date
 * @property string|null $end_date
 *
 * @property CategoryList[] $categoryLists
 * @property Contacts[] $contacts
 * @property CostCenter[] $costCenters
 * @property Company $fkCompany
 * @property Municipality $fkMunicipality
 */
class Headquarters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'headquarters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_company', 'fk_municipality', 'default_category', 'cost_center_class'], 'integer'],
            [['code', 'name'], 'required'],
            [['start_date', 'end_date'], 'safe'],
            [['code'], 'string', 'max' => 10],
            [['name', 'address'], 'string', 'max' => 100],
            [['short_name'], 'string', 'max' => 20],
            [['manager', 'group_class'], 'string', 'max' => 30],
//            [['code'], 'unique'],
            [['name', 'address', 'short_name', 'manager'], 'match', 'pattern'=>'/^[\w\á-úÁ-Ú\s\ñ().#-]+$/'],
            [['fk_company'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_company' => 'id']],
            [['fk_municipality'], 'exist', 'skipOnError' => true, 'targetClass' => Municipality::className(), 'targetAttribute' => ['fk_municipality' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_company' => 'Empresa',
            'code' => 'Código',
            'name' => 'Nombre',
            'short_name' => 'Nombre Corto',
            'manager' => 'Responsable',
            'fk_municipality' => 'Municipio',
            'address' => 'Dirección',
            'default_category' => 'Categorías por Defecto',
            'cost_center_class' => 'Clase de CC',
            'group_class' => 'Grupo',
            'start_date' => 'Fecha Inicial',
            'end_date' => 'Fecha Finalización',
        ];
    }

    /**
     * Gets query for [[CategoryLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryLists()
    {
        return $this->hasMany(CategoryList::className(), ['fk_headquarter' => 'id']);
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['fk_headquarter' => 'id']);
    }

    /**
     * Gets query for [[CostCenters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCostCenters()
    {
        return $this->hasMany(CostCenter::className(), ['fk_headquarter' => 'id']);
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
}
