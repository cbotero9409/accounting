<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_list".
 *
 * @property int $id
 * @property string|null $cod_cc
 * @property string|null $name
 * @property string|null $short_name
 * @property string|null $type
 * @property string|null $manager
 * @property string|null $image
 * @property int|null $fk_headquarter
 *
 * @property Headquarters $fkHeadquarter
 */
class Categorylist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_headquarter'], 'integer'],
            [['cod_cc', 'short_name'], 'string', 'max' => 20],
            [['name', 'type', 'manager'], 'string', 'max' => 30],
            [['image'], 'string', 'max' => 100],
            [['fk_headquarter'], 'exist', 'skipOnError' => true, 'targetClass' => Headquarters::className(), 'targetAttribute' => ['fk_headquarter' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cod_cc' => 'Cód. CC',
            'name' => 'Nombre',
            'short_name' => 'Nombre Corto',
            'type' => 'Tipo',
            'manager' => 'Responsable',
            'image' => 'Imagen',
            'fk_headquarter' => 'Sede',
        ];
    }

    /**
     * Gets query for [[FkHeadquarter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkHeadquarter()
    {
        return $this->hasOne(Headquarters::className(), ['id' => 'fk_headquarter']);
    }
}
