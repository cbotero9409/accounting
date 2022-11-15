<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "third_parties".
 *
 * @property int $id
 * @property string $code
 * @property string $dv
 * @property int $doc_type
 * @property string $name
 * @property string $tradename
 * @property int $visible
 * @property int $juridical
 * @property int $branch_office
 * @property string|null $photo
 * @property int $supplier
 * @property int $client
 * @property int $employee
 * @property int $seller
 * @property int $interested
 * @property int $associate
 * @property string|null $treatment
 * @property string|null $profession
 * @property string|null $company
 * @property string $appointment
 * @property int $genre
 * @property string|null $birthday
 * @property string|null $quick_code
 * @property int $processing_personal_data
 * @property int $transactional_info
 * @property int $promotional_info
 * @property int|null $fk_municipality
 * @property string|null $address
 * @property int $standard_supplier
 * @property int $payroll_entity_supplier
 * @property int $block_payments
 * @property int|null $payment_deadline
 * @property string|null $account_holder
 * @property string|null $account_number
 * @property int|null $account_bank
 * @property int|null $account_type
 * @property string|null $account_payment_method
 * @property string|null $alternate_code
 * @property string|null $class
 * @property string|null $additional_notes
 * @property int|null $fk_third
 *
 * @property Contacts[] $contacts
 * @property Municipality $fkMunicipality
 * @property Thirdparties $fkThird
 * @property InventoryItems[] $inventoryItems
 * @property ProductsLines[] $productsLines
 * @property PurchasedProducts[] $purchasedProducts
 * @property TaxClassification[] $taxClassifications
 * @property ThirdAttachedFiles[] $thirdAttachedFiles
 * @property Thirdparties[] $thirdparties
 */
class Thirdparties extends \yii\db\ActiveRecord
{
    
    public $uploaded_photo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'third_parties';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'dv', 'doc_type', 'name', 'visible', 'juridical', 'branch_office', 'supplier', 'client', 'employee', 'seller', 'interested', 'associate', 'processing_personal_data', 'transactional_info', 'promotional_info', 'standard_supplier', 'payroll_entity_supplier', 'block_payments'], 'required'],
            [['doc_type', 'visible', 'juridical', 'branch_office', 'supplier', 'client', 'employee', 'seller', 'interested', 'associate', 'genre', 'processing_personal_data', 'transactional_info', 'promotional_info', 'fk_municipality', 'standard_supplier', 'payroll_entity_supplier', 'block_payments', 'payment_deadline', 'account_bank', 'account_type', 'fk_third'], 'integer'],
            [['birthday'], 'safe'],
            [['code'], 'unique'],
            [['additional_notes'], 'string'],
            [['code'], 'string', 'max' => 15],
            [['dv'], 'string', 'max' => 3],
            [['name', 'tradename', 'company'], 'string', 'max' => 50],
            [['photo', 'address'], 'string', 'max' => 100],
            [['treatment', 'account_number', 'account_payment_method', 'alternate_code', 'class'], 'string', 'max' => 20],
            [['profession', 'appointment', 'quick_code', 'account_holder'], 'string', 'max' => 30],
            [['fk_municipality'], 'exist', 'skipOnError' => true, 'targetClass' => Municipality::className(), 'targetAttribute' => ['fk_municipality' => 'id']],
            [['fk_third'], 'exist', 'skipOnError' => true, 'targetClass' => Thirdparties::className(), 'targetAttribute' => ['fk_third' => 'id']],
            [['dv'], 'match', 'pattern'=>'/^[\d]+$/'],
            [['code'], 'match', 'pattern'=>'/^[\d\-]+$/'],
            [['name', 'address'], 'match', 'pattern'=>'/^[\w\á-úÁ-Ú\s\ñ().#-]+$/'],
            [['account_holder'], 'match', 'pattern'=>'/^[\a-zA-Z\s\ñ\á-ú\Á-Ú]+$/'],
            [['account_number'], 'match', 'pattern'=>'/^[\d]+$/'],
            [['uploaded_photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
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
            'dv' => 'D.V.',
            'doc_type' => 'Tipo de Documento',
            'name' => 'Nombre',
            'tradename' => 'Nombre Comercial',
            'visible' => 'Visible en Selección',
            'juridical' => 'Persona Jurídica',
            'branch_office' => 'Tiene Sucursales',
            'photo' => 'Foto',
            'supplier' => 'Proveedor',
            'client' => 'Cliente',
            'employee' => 'Empleado',
            'seller' => 'Vendedor',
            'interested' => 'Interesados',
            'associate' => 'Socios',
            'treatment' => 'Tratamiento',
            'profession' => 'Profesión',
            'company' => 'Empresa',
            'appointment' => 'Cargo',
            'genre' => 'Género',
            'birthday' => 'Fecha de Nacimiento',
            'quick_code' => 'Código Rápido',
            'processing_personal_data' => 'Autoriza políticas de tratamiento de datos personales',
            'transactional_info' => 'Envío de información transaccional',
            'promotional_info' => 'Envío de información promocional',
            'fk_municipality' => 'Municipio',
            'address' => 'Dirección',
            'standard_supplier' => 'Proveedor estándar (permite relacionar información de pagos y productos)',
            'payroll_entity_supplier' => 'Proveedor entidad de nómina (active si este tercero presta servicios como entidad de nómina EPS, ARL, fondo de pensiones, caja de compensación familiar, etc..)',
            'block_payments' => 'Bloquear Pagos',
            'payment_deadline' => 'Plazo de Pagos (días)',
            'account_holder' => 'Titular de la Cuenta',
            'account_number' => 'Número de la Cuenta',
            'account_bank' => 'Banco',
            'account_type' => 'Tipo de Cuenta',
            'account_payment_method' => 'Forma de Pago',
            'alternate_code' => 'Código Alterno',
            'class' => 'Clase',
            'additional_notes' => 'Notas Adicionales',
            'fk_third' => 'Tercero Asociado',
            'uploaded_photo' => 'Foto',
        ];
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['fk_third' => 'id']);
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
     * Gets query for [[FkThird]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkThird()
    {
        return $this->hasOne(Thirdparties::className(), ['id' => 'fk_third']);
    }

    /**
     * Gets query for [[InventoryItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInventoryItems()
    {
        return $this->hasMany(Inventoryitems::className(), ['fk_third' => 'id']);
    }

    /**
     * Gets query for [[ProductsLines]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductsLines()
    {
        return $this->hasMany(Productslines::className(), ['fk_third' => 'id']);
    }

    /**
     * Gets query for [[PurchasedProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchasedProducts()
    {
        return $this->hasMany(Purchasedproducts::className(), ['fk_third' => 'id']);
    }

    /**
     * Gets query for [[TaxClassifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxClassifications()
    {
        return $this->hasMany(Taxclassification::className(), ['fk_third' => 'id']);
    }

    /**
     * Gets query for [[ThirdAttachedFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThirdAttachedFiles()
    {
        return $this->hasMany(ThirdattachedFiles::className(), ['fk_third' => 'id']);
    }

    /**
     * Gets query for [[Thirdparties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThirdparties()
    {
        return $this->hasMany(Thirdparties::className(), ['fk_third' => 'id']);
    }
}
