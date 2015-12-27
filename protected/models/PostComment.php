<?php
/**
 * "{{post_comment}}" 数据表模型类.
 *
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Model
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */
class PostComment extends XBaseModel
{
	
	/**
	 * @return string 相关的数据库表的名称
	 */
	public function tableName()
	{
		return '{{post_comment}}';
	}

	/**
	 * @return array 对模型的属性验证规则.
	 */
	public function rules()
	{
		return array(
			array('content', 'required'),
			array('post_id, user_id, create_time', 'length', 'max'=>10),
			array('nickname', 'length', 'max'=>60),
			array('email', 'email'),
			array('email', 'length', 'max'=>50),
			array('status_is, status_answer', 'length', 'max'=>1),
			array('client_ip', 'length', 'max'=>5),
			array('answer_content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, post_id, user_id, nickname, email, content, status_is, status_answer, answer_content, client_ip, create_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array 关联规则.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
	        'post'=>array(self::BELONGS_TO, 'Post', 'post_id',  'select'=>'id,title,title_alias,title_second '),
	    );
	}

	/**
	 * @return array 自定义属性标签 (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'id',
			'post_id' => '标题id',
			'user_id' => '用户ID',
			'nickname' => '用户名',
			'email' => '邮箱',
			'content' => '评论内容',
			'status_is' => '状态',
			'status_answer' => 'Status Answer',
			'answer_content' => '回复内容',
			'client_ip' => '评论ip',
			'create_time' => '录入时间',
		);
	}


	/**
	 * 返回指定的AR类的静态模型.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PostComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
}
