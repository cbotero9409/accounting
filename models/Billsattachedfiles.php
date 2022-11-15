<?php

namespace app\models;

use Yii;

use yii\web\UploadedFile;

/**
 * This is the model class for table "bills_attached_files".
 *
 * @property int $id
 * @property string $file
 * @property int|null $fk_bill_of_sale
 *
 * @property BillOfSale $fkBillOfSale
 */
class Billsattachedfiles extends \yii\db\ActiveRecord
{
    public $uploaded_files;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bills_attached_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_bill_of_sale'], 'integer'],
            [['file'], 'string', 'max' => 200],
            [['fk_bill_of_sale'], 'exist', 'skipOnError' => true, 'targetClass' => Billofsale::className(), 'targetAttribute' => ['fk_bill_of_sale' => 'id']],
            [['uploaded_files'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file' => 'Archivo',
            'fk_bill_of_sale' => 'Factura de Venta',
            'uploaded_files' => 'Archivos Adjuntos',
        ];
    }

    /**
     * Gets query for [[FkBillOfSale]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkBillOfSale()
    {
        return $this->hasOne(Billofsale::className(), ['id' => 'fk_bill_of_sale']);
    }
    
    public function upload()
    {       
        if ($this->validate()) { 
            foreach ($this->uploaded_files as $file) {
                $file->saveAs('uploads/bills_of_sale/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}
