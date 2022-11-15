<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "municipality".
 *
 * @property int $id
 * @property string $municipality
 * @property int|null $fk_department
 *
 * @property Departments $fkDepartment
 * @property Invoices[] $invoices
 * @property Services[] $services
 * @property Users[] $users
 */
class Municipality extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'municipality';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_department'], 'integer'],
            [['municipality'], 'string', 'max' => 255],
            [['fk_department'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['fk_department' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'municipality' => 'Municipality',
            'fk_department' => 'Fk Department',
        ];
    }

    /**
     * Gets query for [[FkDepartment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkDepartment()
    {
        return $this->hasOne(Departments::className(), ['id' => 'fk_department']);
    }

    /**
     * Gets query for [[Invoices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoices::className(), ['fk_municipality' => 'id']);
    }

    /**
     * Gets query for [[Services]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Services::className(), ['fk_municipality' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['fk_municipality' => 'id']);
    }
}
