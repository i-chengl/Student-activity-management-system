<?php
/**
 * 系统配置
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.admini.Controller
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class ConfigController extends XAdminiBase
{

    /**
     * 取配置数据
     *
     */
    public function loadData ()
    {
        $model = Config::model()->findAll();
        foreach ($model as $key => $row) {
            $config[$row['variable']] = $row['value'];
        }
        return $config;
    
    }

    /**
     * 更新数据
     *
     */
    private function _updateData ($data, $scope = 'base')
    {
        if (XUtils::method() == 'POST') {
            foreach ((array) $data as $key => $row){
                $config = Config::model()->find('scope=:scope AND variable=:variable',array('scope'=>$scope, 'variable'=>$key));
                if($config){
                    Config::model()->updateAll(array('value'=>$row),'scope=:scope AND variable=:variable',array('scope'=>$scope, 'variable'=>$key));
                }else{
                    $config = new Config();
                    $config->scope = $scope;
                    $config->variable = $key;
                    $config->value = $row;
                    $config->save();
                }
            }
            XXcache::refresh('_config', 3600);
            AdminLogger::_create(array ('catalog' => 'update' , 'intro' => '更新系统配置，模块：' . $this->action->id )); 
            XUtils::message('success', '更新完成', $this->createUrl($this->action->id));
        }
    
    }

    /**
     * 基本配置首页
     *
     */
    public function actionIndex ()
    {
        parent::_acl(); 
        self::_updateData($_POST['Config']);
        $this->render('index', array ('config' => self::loadData() ));
    
    }

    /**
     * seo设置
     *
     */
    public function actionSeo ()
    {
        parent::_acl(); 
        self::_updateData($_POST['Config']);
        $this->render('seo', array ('config' => self::loadData() ));
    }


    /**
     * 更新备忘
     *
     */
    public function actionUpdateNotebook ()
    {
        $notebook = $this->_gets->getParam('notebook');
        $model = Admin::model()->findByPk($this->_admini['userId']);
        $model->notebook = trim($notebook);
        if ($model->save()) {
            exit('更新完成');
        } else {
            exit('更新失败');
        }
    }

    /**
     * 自定义字段
     */
    public function actionCustom ()
    {
        parent::_acl(); 
       
        if (XUtils::method() == 'POST') {
            foreach ((array) $_POST['attr'] as $key => $row) {
                $val = is_array( $row['val'] ) ? implode( ',', $row['val'] ) : $row['val'];
                $var = $row["name"];
                $config = Config::model()->find('scope=:scope AND variable=:variable',array('scope'=>'custom', 'variable'=>$var));
                if($config){
                    Config::model()->updateAll(array('value'=>$val),'scope=:scope AND variable=:variable',array('scope'=>'custom', 'variable'=>$var));
                }else{
                    $config = new Config();
                    $config->scope = 'custom';
                    $config->variable = $var;
                    $config->value = $val;
                    $config->save();
                }
            }
            XXcache::refresh('_config', 3600);
            AdminLogger::_create(array ('catalog' => 'update' , 'intro' => '更新系统配置，模块：' . $this->action->id )); 
            XUtils::message('success', '更新完成', $this->createUrl($this->action->id));
        }

        $attrModel = Attr::lists(0, 'config');
        $this->render('custom', array ('attrData' => self::loadData() , 'attrModel' => $attrModel));
    }
    
    /**
     * 附件设置
     */
    public function actionUpload(){
        parent::_acl(); 
        self::_updateData($_POST['Config'], 'base');
        $this->render('upload', array ('config' => self::loadData() ));
    }


}