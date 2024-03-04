<?php

namespace backend\components;

use Yii;
use common\helpers\Myfunctions;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\models\User;

/**
 * This is the model class for table "admin_user".
 *
 * @property int $id
 * @property int $role 1-admin, 2-editor
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string|null $note
 * @property int $login_counter
 * @property string $last_login_on
 * @property int $status
 * @property int $created_by
 * @property string $created_on
 * @property int $modify_by
 * @property string|null $modify_on
 * @property int $deleted
 */
class AdminUser extends MActiveRecord implements IdentityInterface
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role', 'login_counter', 'status', 'created_by', 'modify_by', 'deleted'], 'integer'],
            [['username', 'password', 'first_name', 'email'], 'required'],
            [['note'], 'string'],
            [['last_login_on', 'created_on', 'modify_on'], 'safe'],
            [['username'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 255],
            [['first_name', 'last_name', 'email'], 'string', 'max' => 50],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'username' => 'Username',
            'password' => 'Password',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'note' => 'Note',
            'login_counter' => 'Login Counter',
            'last_login_on' => 'Last Login On',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'modify_by' => 'Modify By',
            'modify_on' => 'Modify On',
            'deleted' => 'Deleted',
        ];
    }

    /**
     *@return AdminUser full name
     */
    public function getUserFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     * miller: auth key is null by default
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return Yii::$app->security->validatePassword($password, $this->password);
        //Myfunctions::echoArray($password);
        $pass = md5($password);
        //return Yii::$app->security->validatePassword($password, $this->password);
        return Yii::$app->security->compareString($this->password, $pass);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        //$this->password = Yii::$app->security->generatePasswordHash($password);
        $this->password = md5($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
