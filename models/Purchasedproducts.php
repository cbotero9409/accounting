<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchased_products".
 *
 * @property int $id
 * @property string $code
 * @property string|null $product
 * @property string|null $unit
 * @property string|null $date
 * @property string|null $doc_number
 * @property string|null $price
 * @property string|null $movement_type
 * @property int|null $fk_third
 *
 * @property ThirdParties $fkThird
 */
class Purchasedproducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchased_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['date'], 'safe'],
            [['fk_third'], 'integer'],
            [['code', 'unit', 'doc_number', 'price', 'movement_type'], 'string', 'max' => 20],
            [['product'], 'string', 'max' => 30],
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
            'code' => 'Código',
            'product' => 'Producto',
            'unit' => 'Unidad',
            'date' => 'Fecha',
            'doc_number' => 'Número de Documento',
            'price' => 'Precio',
            'movement_type' => 'Tipo de Movimiento',
            'fk_third' => 'Tercero',
        ];
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
}
