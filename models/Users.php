<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $document
 * @property string $birthday
 * @property string $phone
 * @property string $address
 * @property int|null $fk_municipality
 * @property string $gender
 * @property string $occupation
 * @property string $user_type
 * @property string $email
 * @property string $password
 * @property string|null $photo
 * @property string $last_date
 *
 * @property Municipality $fkMunicipality
 * @property Notes[] $notes
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    public $imageFile;
    public $old_password;
    public $new_password;
    public $repeat_password;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'document', 'birthday', 'phone', 'address', 'gender', 'occupation', 'user_type', 'email'], 'required'],
            [['password'], 'required', 'on' => 'create'],
            [['birthday', 'last_date'], 'safe'],
            [['fk_municipality'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['name'], 'match', 'pattern'=>'/^[\a-zA-Z\s\ñ\á-ú\Á-Ú]+$/'],
            [['document'], 'string', 'max' => 11],
            [['document'], 'match', 'pattern'=>'/^[\d]+$/'],
            [['phone', 'user_type'], 'string', 'max' => 20],
            [['phone'], 'match', 'pattern'=>'/^[\d\#+-]+$/'],
            [['address'], 'string', 'max' => 100],
            [['address'], 'match', 'pattern'=>'/^[\w\s\ñ().#-]+$/'],
            [['gender'], 'string', 'max' => 10],
            [['occupation'], 'string', 'max' => 15],
            [['occupation'], 'match', 'pattern'=>'/^[\a-zA-Z\s\ñ\á-ú\Á-Ú]+$/'],
            [['email', 'photo'], 'string', 'max' => 50],
            [['email'], 'match', 'pattern'=>'/^[\d\a-z\ñ\@_.]+$/'],
            [['email'], 'unique', 'message' => 'Correo electrónico ya existe!'],
            [['password'], 'string', 'max' => 256],
            [['fk_municipality'], 'exist', 'skipOnError' => true, 'targetClass' => Municipality::className(), 'targetAttribute' => ['fk_municipality' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['old_password, new_password, repeat_password'], 'required', 'on' => 'changePwd'],
            [['old_password'], 'findPasswords', 'on' => 'changePwd'],
            [['repeat_password'], 'compare', 'compareAttribute' => 'new_password', 'on' => 'changePwd']
        ];
    }
    
    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'document' => 'Documento de Identidad',
            'birthday' => 'Fecha de Nacimiento',
            'phone' => 'Teléfono',
            'address' => 'Dirección',
            'fk_municipality' => 'Municipio',
            'gender' => 'Género',
            'occupation' => 'Ocupación',
            'user_type' => 'Tipo de Usuario',
            'email' => 'Correo Electrónico',
            'password' => 'Contraseña',
            'imageFile' => 'Foto',
            'photo' => 'Foto',
            'last_date' => 'Ultimo acceso',
            'old_password' => 'Contraseña actual',
            'new_password' => 'Nueva contraseña',
            'repeat_password' => 'Confirmar contraseña',
        ];
    }

    /**
     * Gets query for [[FkMunicipality]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkMunicipality() {
        return $this->hasOne(Municipality::className(), ['id' => 'fk_municipality']);
    }

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes() {
        return $this->hasMany(Notes::className(), ['fk_users' => 'id']);
    }

    public function getAuthKey() {
//        return $this->authKey;
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey) {
//        return $this->authKey === $authKey;
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new \yii\base\NotSupportedException;
    }

    public static function findByEmail($email) {
        return self::findOne(['email' => $email]);
    }

    public function validatePassword($password) {
        return password_verify($password, $this->password);
    }

    public function findPasswords($attribute, $id) {
        $user = self::find()->select('password')->where(['id' => $id])->one();
        
//        $user = User::model()->findByPk(Yii::app()->user->id);
        if (!password_verify($this->old_password, $user->password))
            $this->addError($attribute, 'Old password is incorrect.');
    }

}
