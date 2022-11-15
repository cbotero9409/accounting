<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "third_attached_files".
 *
 * @property int $id
 * @property string $file
 * @property int|null $fk_third
 *
 * @property ThirdParties $fkThird
 */
class Thirdattachedfiles extends \yii\db\ActiveRecord
{
    public $uploaded_files;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'third_attached_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file'], 'required'],
            [['fk_third'], 'integer'],
            [['file'], 'string', 'max' => 200],
            [['fk_third'], 'exist', 'skipOnError' => true, 'targetClass' => Thirdparties::className(), 'targetAttribute' => ['fk_third' => 'id']],
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
            'fk_third' => 'Tercero',
            'uploaded_files' => 'Archivos Adjuntos',
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
