<?php

namespace app\models;

use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    const STATUS_DELETED = 0; //User delete
    const STATUS_ACTIVE = 10; // User active
    const STATUS_ADMIN = 1; // User admin

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        try {
            $this->password_hash = \Yii::$app->security->generatePasswordHash($password);
        } catch (Exception $e) {
        }
    }

    public function generateAuthKey()
    {
        try {
            $this->auth_key = \Yii::$app->security->generateRandomString();
        } catch (Exception $e) {
        }
    }
}
