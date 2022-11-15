<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $business_name
 * @property int $doc_type
 * @property string $doc_number
 * @property int|null $dv
 * @property string|null $short_name
 * @property string|null $manager
 * @property string|null $color
 * @property string|null $legal_representative
 * @property string|null $representative_doc
 * @property string|null $accountant
 * @property string|null $accountant_doc
 * @property string|null $tax_auditor
 * @property string|null $auditor_doc
 * @property int $e_billing_management
 * @property int $doc_platform
 * @property int $own_email_sender
 * @property int|null $fk_municipality
 * @property string|null $address
 * @property int|null $cxc_term
 * @property int|null $cxp_term
 * @property int $interest_management
 * @property string|null $electronic_billing
 * @property string|null $start_date
 * @property string|null $end_date
 *
 * @property CompanyLabel[] $companyLabels
 * @property Contacts[] $contacts
 * @property CostCenter[] $costCenters
 * @property Municipality $fkMunicipality
 * @property Headquarters[] $headquarters
 * @property Services[] $services
 * @property TaxClassification[] $taxClassifications
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['business_name', 'doc_type', 'doc_number'], 'required'],
            [['doc_type', 'dv', 'e_billing_management', 'doc_platform', 'own_email_sender', 'fk_municipality', 'cxc_term', 'cxp_term', 'interest_management'], 'integer'],
            [['electronic_billing'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['business_name', 'address'], 'string', 'max' => 100],
            [['business_name', 'address', 'short_name'], 'match', 'pattern'=>'/^[\w\á-úÁ-Ú\s\ñ().#-]+$/'],
            [['doc_number', 'representative_doc', 'accountant_doc', 'auditor_doc'], 'string', 'max' => 15],
            [['doc_number', 'dv', 'representative_doc', 'accountant_doc', 'auditor_doc'], 'match', 'pattern'=>'/^[\d\-\.]+$/'],
            [['short_name', 'color'], 'string', 'max' => 20],
            [['manager', 'legal_representative', 'accountant', 'tax_auditor'], 'string', 'max' => 50],
            [['manager', 'legal_representative', 'accountant', 'tax_auditor'], 'match', 'pattern'=>'/^[\a-zA-Z\s\ñ\á-ú\Á-Ú]+$/'],
            [['fk_municipality'], 'exist', 'skipOnError' => true, 'targetClass' => Municipality::className(), 'targetAttribute' => ['fk_municipality' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'business_name' => 'Nombre',
            'doc_type' => 'Tipo de Documento',
            'doc_number' => 'Número de Identificación',
            'dv' => 'D.V.',
            'short_name' => 'Nombre Corto',
            'manager' => 'Gerente',
            'color' => 'Color',
            'legal_representative' => 'Representante Legal',
            'representative_doc' => 'Documento Representante',
            'accountant' => 'Contador',
            'accountant_doc' => 'Documento Contador',
            'tax_auditor' => 'Revisor Fiscal',
            'auditor_doc' => 'Documento Revisor',
            'e_billing_management' => 'Activar manejo de facturación electrónica',
            'doc_platform' => 'Activar uso de la plataforma de documentos',
            'own_email_sender' => 'Activar remitente propio para el envío de e-mails',
            'fk_municipality' => 'Municipio',
            'address' => 'Dirección',
            'cxc_term' => 'Plazo CxC (días)',
            'cxp_term' => 'Plazo CxP (días)',
            'interest_management' => 'Activar manejo de intereses en las CxC',
            'electronic_billing' => 'Datos para Facturación Electrónica',
            'start_date' => 'Fecha Inicial',
            'end_date' => 'Fecha Final',
        ];
    }

    /**
     * Gets query for [[CompanyLabels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyLabels()
    {
        return $this->hasMany(CompanyLabel::className(), ['fk_company' => 'id']);
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['fk_company' => 'id']);
    }

    /**
     * Gets query for [[CostCenters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCostCenters()
    {
        return $this->hasMany(CostCenter::className(), ['fk_company' => 'id']);
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
     * Gets query for [[Headquarters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHeadquarters()
    {
        return $this->hasMany(Headquarters::className(), ['fk_company' => 'id']);
    }

    /**
     * Gets query for [[Services]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Services::className(), ['fk_company' => 'id']);
    }

    /**
     * Gets query for [[TaxClassifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxClassifications()
    {
        return $this->hasMany(TaxClassification::className(), ['fk_company' => 'id']);
    }
}
