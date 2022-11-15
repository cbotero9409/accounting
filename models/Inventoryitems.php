<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventory_items".
 *
 * @property int $id
 * @property int|null $fk_item
 * @property string $code
 * @property string|null $unit
 * @property string|null $price
 * @property string|null $date
 * @property string|null $last_price
 * @property string|null $last_date
 * @property int|null $fk_third
 *
 * @property Inventory $fkItem
 * @property ThirdParties $fkThird
 */
class Inventoryitems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_item', 'fk_third'], 'integer'],
            [['date', 'last_date'], 'safe'],
            [['code'], 'string', 'max' => 30],
            [['unit'], 'string', 'max' => 10],
            [['price', 'last_price'], 'string', 'max' => 20],
            [['fk_item'], 'exist', 'skipOnError' => true, 'targetClass' => Inventory::className(), 'targetAttribute' => ['fk_item' => 'id']],
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
            'fk_item' => 'Elemento',
            'code' => 'Código',
            'unit' => 'Unidad',
            'price' => 'Precio Asignado',
            'date' => 'Fecha',
            'last_price' => 'Precio Ultima Compra',
            'last_date' => 'Fecha Ultima Compra',
            'fk_third' => 'Tercero',
        ];
    }

    /**
     * Gets query for [[FkItem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkItem()
    {
        return $this->hasOne(Inventory::className(), ['id' => 'fk_item']);
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
