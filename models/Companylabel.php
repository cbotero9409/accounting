<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company_label".
 *
 * @property int $id
 * @property string $main_title
 * @property int $mt_size
 * @property string $mt_color
 * @property string|null $subtitle
 * @property int|null $subt_size
 * @property string|null $subt_color
 * @property string|null $detail
 * @property int|null $detail_size
 * @property string|null $detail_color
 * @property string|null $footer
 * @property int|null $footer_size
 * @property string|null $footer_color
 * @property string|null $logo
 * @property int $header_type
 * @property int|null $fk_company
 *
 * @property Company $fkCompany
 */
class Companylabel extends \yii\db\ActiveRecord
{
    public $logo_file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_label';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mt_size', 'subt_size', 'detail_size', 'footer_size', 'header_type', 'fk_company'], 'integer'],
            [['main_title', 'subtitle', 'detail', 'footer'], 'string', 'max' => 200],
            [['mt_color', 'subt_color', 'detail_color', 'footer_color'], 'string', 'max' => 20],
            [['logo'], 'string', 'max' => 100],
            [['fk_company'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_company' => 'id']],
            [['logo_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_title' => 'Título Principal',
            'mt_size' => 'Tamaño Título Principal',
            'mt_color' => 'Color Título Principal',
            'subtitle' => 'Subtítulo',
            'subt_size' => 'Tamaño Subtítulo',
            'subt_color' => 'Color Subtítulo',
            'detail' => 'Detalle',
            'detail_size' => 'Tamaño Detalle',
            'detail_color' => 'Color Detalle',
            'footer' => 'Pie de Página',
            'footer_size' => 'Tamaño Pie de Página',
            'footer_color' => 'Color Pie de Página',
            'logo' => 'Logo',
            'header_type' => 'Tipo de Encabezado para Reportes',
            'fk_company' => 'Empresa',
            'logo_file' => 'Logo',
        ];
    }

    /**
     * Gets query for [[FkCompany]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'fk_company']);
    }
}
