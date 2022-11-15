<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventory".
 *
 * @property int $id
 * @property string $item
 *
 * @property InventoryItems[] $inventoryItems
 */
class Inventory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item'], 'required'],
            [['item'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item' => 'Item',
        ];
    }

    /**
     * Gets query for [[InventoryItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInventoryItems()
    {
        return $this->hasMany(Inventoryitems::className(), ['fk_item' => 'id']);
    }
}
