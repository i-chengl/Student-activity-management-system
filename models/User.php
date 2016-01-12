<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $usr_id
 * @property string $usr_name
 * @property string $usr_passwd
 * @property integer $usr_state
 * @property string $usr_depart
 * @property string $usr_class
 *
 * @property Activity[] $activities
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usr_id', 'usr_name', 'usr_passwd', 'usr_state'], 'required'],
            [['usr_id', 'usr_state'], 'integer'],
            [['usr_name'], 'string', 'max' => 10],
            [['usr_passwd', 'usr_class'], 'string', 'max' => 20],
            [['usr_depart'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usr_id' => '学号/工号',
            'usr_name' => '用户名',
            'usr_passwd' => '密码',
            'usr_state' => '身份：1-teacher 0-student',
            'usr_depart' => '所属院系(教师可为NULL)',
            'usr_class' => '所属班级(教师为NULL)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['act_id_submit' => 'usr_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\UserQuery(get_called_class());
    }
    
    
    
    
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
    	return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    	foreach (self::$users as $user) {
    		if ($user['accessToken'] === $token) {
    			return new static($user);
    		}
    	}
    
    	return null;
    }
    
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
    	foreach (self::$users as $user) {
    		if (strcasecmp($user['username'], $username) === 0) {
    			return new static($user);
    		}
    	}
    
    	return null;
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
    	return $this->id;
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
    	return $this->authKey;
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
    	return $this->authKey === $authKey;
    }
    
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
    	return $this->password === $password;
    }
    
}
