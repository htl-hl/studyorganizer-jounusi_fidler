<?php

namespace app\models;

use yii\base\Model;
use yii\web\IdentityInterface;
use Yii;

class User extends Model implements IdentityInterface
{
    public $id;
    public $name;
    public $password_hash;
    public $email;

    // feste Test-User
    private static $users = [
        1 => [
            'id' => 1,
            'name' => 'admin',
            'password_hash' => 'admin',
            'email' => 'admin@test.com',
        ],
        2 => [
            'id' => 2,
            'name' => 'demo',
            'password_hash' => 'demo',
            'email' => 'demo@test.com',
        ],
    ];

    public function rules()
    {
        return [
            [['name', 'password_hash'], 'required'],
            ['email', 'email'],
        ];
    }

    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if ($user['name'] === $username) {
                return new static($user);
            }
        }

        $sessionUser = Yii::$app->session->get('signupUser');
        if ($sessionUser && $sessionUser['name'] === $username) {
            return new static([
                'id' => 3,
                'name' => $sessionUser['name'],
                'password_hash' => $sessionUser['password_hash'],
                'email' => $sessionUser['email'],
            ]);
        }

        return null;
    }

    public function validatePassword($password)
    {
        return $this->password_hash === $password;
    }

    public static function findIdentity($id)
    {
        foreach (self::$users as $user) {
            if ($user['id'] == $id) {
                return new static($user);
            }
        }
        return null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return '';
    }

    public function validateAuthKey($authKey)
    {
        return true;
    }
}