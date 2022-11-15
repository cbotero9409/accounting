<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_service".
 *
 * @property int $id
 * @property string $name
 * @property string $conf_service
 *
 * @property Services[] $services
 */
class TypeService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'conf_service'], 'required'],
            [['conf_service'], 'string'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'conf_service' => 'Conf Service',
        ];
    }

    /**
     * Gets query for [[Services]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Services::className(), ['fk_type' => 'id']);
    }
}
