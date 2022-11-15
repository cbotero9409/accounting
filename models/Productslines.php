<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products_lines".
 *
 * @property int $id
 * @property string $line
 * @property int|null $fk_third
 *
 * @property ThirdParties $fkThird
 */
class Productslines extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products_lines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['line'], 'required'],
            [['fk_third'], 'integer'],
            [['line'], 'string', 'max' => 100],
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
            'line' => 'Línea',
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
