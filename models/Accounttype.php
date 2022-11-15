<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_type".
 *
 * @property int $id
 * @property string $type
 *
 * @property ChartAccounts[] $chartAccounts
 */
class Accounttype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 20],
            [['type'], 'match', 'pattern'=>'/^[\a-zA-Z\s\ñ\á-ú\Á-Ú]+$/'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Tipo',
        ];
    }

    /**
     * Gets query for [[ChartAccounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChartaccounts()
    {
        return $this->hasMany(Chartaccounts::className(), ['fk_account_type' => 'id']);
    }
}
