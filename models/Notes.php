<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property string $note
 * @property int|null $fk_users
 * @property int|null $fk_supplier
 * @property string $date
 * @property int $public
 *
 * @property Supplier $fkSupplier
 * @property Users $fkUsers
 */
class Notes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['note'], 'required'],
            [['note'], 'string'],
            [['fk_users', 'fk_supplier', 'public'], 'integer'],
            [['date'], 'safe'],
            [['fk_users'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['fk_users' => 'id']],
            [['fk_supplier'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['fk_supplier' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'note' => 'Nota',
            'fk_users' => 'Fk Users',
            'fk_supplier' => 'Fk Supplier',
            'date' => 'Fecha',
            'public' => 'Visibilidad',
        ];
    }

    /**
     * Gets query for [[FkSupplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'fk_supplier']);
    }

    /**
     * Gets query for [[FkUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'fk_users']);
    }
}
