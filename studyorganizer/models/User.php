<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public $password; // virtuelles Feld nur für Formulare

    public static function tableName()
    {
        return 'User';
    }

    public function rules()
    {
        return [
            [['Name', 'Email', 'password'], 'required', 'on' => 'signup'],
            [['Name', 'Email'], 'required'],
            ['Email', 'email'],
            ['Email', 'unique'],
            [['Name', 'Email'], 'string', 'max' => 100],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'UserID'   => 'ID',
            'Name'     => 'Benutzername',
            'Email'    => 'E-Mail',
            'password' => 'Passwort',
            'IsAdmin'  => 'Admin',
        ];
    }

    public function signup()
    {
        $this->scenario = 'signup';
        if (!$this->validate()) {
            return false;
        }
        $this->PasswordHash = Yii::$app->security->generatePasswordHash($this->password);
        $this->IsAdmin = 0;
        return $this->save(false);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->PasswordHash);
    }

    public function isAdmin()
    {
        return (bool) $this->IsAdmin;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['UserID' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['Name' => $username]);
    }

    public function getId()
    {
        return $this->UserID;
    }

    public function getAuthKey()
    {
        return $this->PasswordHash;
    }

    public function validateAuthKey($authKey)
    {
        return $this->PasswordHash === $authKey;
    }

    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}