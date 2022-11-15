<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id
 * @property string $business_name
 * @property string $nit
 * @property string $phone
 * @property string $address
 * @property string $supplier_type
 *
 * @property Contacts[] $contacts
 * @property Notes[] $notes
 * @property Services[] $services
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['business_name', 'nit', 'phone', 'address', 'supplier_type'], 'required'],
            [['business_name', 'address'], 'string', 'max' => 100],
            [['business_name'], 'match', 'pattern'=>'/^[\w\s\ñ().#-]+$/'],
            [['nit'], 'string', 'max' => 15],
            [['nit'], 'match', 'pattern'=>'/^[\d\-\.]+$/'],
            [['phone', 'supplier_type'], 'string', 'max' => 20],
            [['phone'], 'match', 'pattern'=>'/^[\d\#+-]+$/'],
            [['address'], 'match', 'pattern'=>'/^[\w\s\ñ().#-]+$/'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'business_name' => 'Proveedor',
            'nit' => 'Nit',
            'phone' => 'Teléfono',
            'address' => 'Dirección',
            'supplier_type' => 'Tipo de Proveedor',
        ];
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['fk_supplier' => 'id']);
    }

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Notes::className(), ['fk_supplier' => 'id']);
    }

    /**
     * Gets query for [[Services]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Services::className(), ['fk_supplier' => 'id']);
    }
}
