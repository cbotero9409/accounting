<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $id
 * @property string $department
 *
 * @property Municipality[] $municipalities
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department' => 'Department',
        ];
    }

    /**
     * Gets query for [[Municipalities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipalities()
    {
        return $this->hasMany(Municipality::className(), ['fk_department' => 'id']);
    }
}
