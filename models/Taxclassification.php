<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tax_classification".
 *
 * @property int $id
 * @property int|null $fk_economic_activity
 * @property int $tax_profile
 * @property int $pn
 * @property int $pj
 * @property int $pe
 * @property int $to1
 * @property int $ts
 * @property int $rs
 * @property int $rc
 * @property int $gc
 * @property int $av
 * @property int $ar
 * @property int $ag
 * @property int $nc
 * @property int $c1
 * @property int $c2
 * @property int $c3
 * @property int $ri
 * @property int $ee
 * @property int $ie
 * @property int $ed
 * @property int $ni
 * @property int $tax_administration
 * @property int $economic_clasification
 * @property int $declarant_class
 * @property int $iva
 * @property int $ic
 * @property int $iva_inc
 * @property int $does_not_apply
 * @property int|null $fk_company
 *
 * @property Company $fkCompany
 * @property EconomicActivity $fkEconomicActivity
 */
class Taxclassification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tax_classification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_economic_activity', 'tax_profile', 'pn', 'pj', 'pe', 'to1', 'ts', 'rs', 'rc', 'gc', 'av', 'ar', 'ag', 'nc', 'c1', 'c2', 'c3', 'ri', 'ee', 'ie', 'ed', 'ni', 'tax_administration', 'economic_clasification', 'declarant_class', 'iva', 'ic', 'iva_inc', 'does_not_apply', 'fk_company'], 'integer'],
            [['fk_economic_activity'], 'exist', 'skipOnError' => true, 'targetClass' => Economicactivity::className(), 'targetAttribute' => ['fk_economic_activity' => 'id']],
            [['fk_company'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_company' => 'id']],
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
            'fk_economic_activity' => 'Actividad Económica',
            'tax_profile' => 'Perfil Tributario',
            'pn' => 'PN - Persona natural y asimiladas',
            'pj' => 'PJ - Persona jurídica y asimiladas',
            'pe' => 'PE - Persona extranjera (sin residencia en el país)',
            'to1' => 'TO - Régimen ordinario de tributación',
            'ts' => 'TS - Régimen simple de tributación (O-47)',
            'rs' => 'RS - No responsable impuesto a las ventas',
            'rc' => 'RC - Responsable impuesto a las ventas',
            'gc' => 'GC - Gran contribuyente (O-13)',
            'av' => 'AV - Agente de retención IVA (O-23)',
            'ar' => 'AR - Auto-retenedor (no se le puede hacer retención)(O-15)',
            'ag' => 'AG - Agente retenedor (puede practicar retención)',
            'nc' => 'NC - Entidad no contribuyente (no se le debe hacer retención)',
            'c1' => 'C1 - Autoretención de renta (CREE 0.4%)',
            'c2' => 'C2 - Autoretención de renta (CREE 0.8%)',
            'c3' => 'C3 - Autoretención de renta (CREE 1.6%)',
            'ri' => 'RI - Responsable Rete-ICA',
            'ee' => 'EE - Empresa estatal',
            'ie' => 'IE - Institución de educación ',
            'ed' => 'ED - Es declarante o ingresos altos (D.R. 3110 de 2004)',
            'ni' => 'NI - No responsable de IVA',
            'tax_administration' => 'Código Administración de Impuestos',
            'economic_clasification' => 'Clasificación Económica',
            'declarant_class' => 'Clase de declarante (Régimen fiscal)',
            'iva' => 'IVA - Impuesto sobre las ventas',
            'ic' => 'IC - Impuesto nacional al consumo',
            'iva_inc' => 'IVA e INC - Impuesto sobre las ventas e Impuesto nacional al consumo',
            'does_not_apply' => 'No aplica',
            'fk_company' => 'Empresa',
            'fk_third' => 'Tercero',
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
     * Gets query for [[FkEconomicActivity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkEconomicActivity()
    {
        return $this->hasOne(Economicactivity::className(), ['id' => 'fk_economic_activity']);
    }
    
    public function getFkThird()
    {
        return $this->hasOne(Thirdparties::className(), ['id' => 'fk_third']);
    }
}
