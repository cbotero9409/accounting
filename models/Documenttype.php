<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document_type".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $mask
 * @property int $numbering_type
 *
 * @property Invoices[] $invoices
 */
class Documenttype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'mask', 'numbering_type'], 'required'],
            [['numbering_type'], 'integer'],
            [['code', 'mask'], 'string', 'max' => 20],
            [['mask'], 'match', 'pattern'=>'/^[A-Z\s\-]+[@#&]+$/', 'message' => 'Máscara debe iniciar en mayúscula y terminar en caracter especial (@#&)'],
            [['name'], 'string', 'max' => 50],
            [['name'], 'match', 'pattern'=>'/^[\a-zA-Z\s\ñ\á-ú\Á-Ú]+$/'],
            [['code'], 'unique', 'message' => 'Código ya existe!', 'on' => 'create'],
            [['code'], 'match', 'pattern'=>'/^[\d]+$/'],
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
            'mask' => 'Máscara',
            'numbering_type' => 'Tipo de Numeración',
        ];
    }

    /**
     * Gets query for [[Invoices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoices::className(), ['fk_doc_type' => 'id']);
    }
}
