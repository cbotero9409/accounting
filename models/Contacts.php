<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property string $name
 * @property string $person_type
 * @property string $cell_phone
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property int|null $fk_supplier
 * @property int|null $fk_company
 * 
 * @property Supplier $fkSupplier
 * @property Company $fkCompany
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_supplier', 'fk_company', 'fk_headquarter'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['name'], 'match', 'pattern'=>'/^[\a-zA-Z\s\ñ\á-ú\Á-Ú]+$/'],
            [['person_type'], 'string', 'max' => 10],
            [['cell_phone', 'phone'], 'string', 'max' => 20],
            [['cell_phone'], 'match', 'pattern'=>'/^[\d\#+-]+$/'],
            [['phone'], 'match', 'pattern'=>'/^[\d\#+-]+$/'],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['address'], 'string', 'max' => 100],
            [['web_page'], 'string', 'max' => 200],
            [['address'], 'match', 'pattern'=>'/^[\w\s\ñ().#-]+$/'],
            [['fk_supplier'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['fk_supplier' => 'id']],
            [['fk_company'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_company' => 'id']],
            [['fk_headquarter'], 'exist', 'skipOnError' => true, 'targetClass' => Headquarters::className(), 'targetAttribute' => ['fk_headquarter' => 'id']],
            [['fk_third'], 'exist', 'skipOnError' => true, 'targetClass' => Thirdparties::className(), 'targetAttribute' => ['fk_third' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'person_type' => 'Tipo de Persona',
            'cell_phone' => 'Celular',
            'phone' => 'Teléfono',
            'email' => 'Correo Electrónico',
            'address' => 'Dirección',
            'web_page' => 'Página Web',
            'fk_supplier' => 'Proveedor',
            'fk_company' => 'Empresa',
            'fk_headquarter' => 'Sede',
            'fk_third' => 'Tercero',
        ];
    }

    /**
     * Gets query for [[FkSupplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'fk_supplier']);
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
    
    public function getFkHeadquarter()
    {
        return $this->hasOne(Headquarters::className(), ['id' => 'fk_headquarter']);
    }
    
    public function getFkThird()
    {
        return $this->hasOne(Thirdparties::className(), ['id' => 'fk_third']);
    }
}
