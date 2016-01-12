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
	
// 	public $enableSession = true;
	
// 	public $enableAutoLogin = true;
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
            'usr_depart' => '院系',
            'usr_class' => '班级/系',
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
     * 使用session来维持登录状态的时候会用到这个方法。
     */
    public static function findIdentity($id)
    {
    	return static::findOne($id);
    }
    
    /**
     * @inheritdoc
     * 根据指定的存取令牌查找 认证模型类的实例，
     * 该方法用于 通过单个加密令牌认证用户的时候（比如无状态的RESTful应用）。
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    	//为空
//     	 return static::findOne(['access_token' => $token]);
    }
    
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
//     	return static::findOne($username);
		$user = User::find()
			->where(['usr_name' => $username])
			->asArray()
			->one();
		if($user)
			return new static($user);
		return null;
    }
    
    /**
     * @inheritdoc
     * 获取该认证实例表示的用户的ID。
     */
    public function getId()
    {
    	return $this->usr_id;
    }
    
    /**
     * @inheritdoc
     * 获取基于 cookie 登录时使用的认证密钥。
     *  认证密钥储存在 cookie 里并且将来会与服务端的版本进行比较以确保 cookie的有效性。
     */
    public function getAuthKey()
    {
//     	return $this->authKey;
    }
    
    /**
     * @inheritdoc
     * 是基于 cookie 登录密钥的 验证的逻辑的实现。
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
    	return $this->usr_passwd === $password;
    }
    
}
