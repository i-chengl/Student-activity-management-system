<?php
/**
 * 模板管理
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.admini.Controller
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class TemplateController extends XAdminiBase
{
    /**
     * 首页
     */
    public function actionIndex() {
        parent::_acl();
        $templateDir =  $this->_themePath.DS.'views'.DS;
        $fileList = XUtils::getDir( $templateDir );
        foreach ( (array)$fileList as $key => $file ) 
            $files[] = array( 'fileName' => $file, 'subFileList' => XUtils::getFile( $templateDir . $file ) );
        $data['fileList'] = $files;
        $this->render( 'index', $data );
    }

    /**
     * 创建文件夹
     *
     */
    public function actionFolderCreate() {
        parent::_acl('template_folder_create',array('response'=>'json'));
        if ( isset( $_POST ) ) {
            try {
                $folderName = CHtml::encode(trim( $this->_gets->getParam('folder' )));
                $path = $this->_themePath.DS.'views'.DS.$folderName.DS;
                if(!self::_name($folderName))
                    throw new Exception( '文件夹名称不合法。只能为英文字母、数字、下划线 (或组合)' );
                elseif ( is_dir( $path ) )
                    throw new Exception( '文件夹 '.$folderName.' 已经存在' );
                @mkdir( $path );
                $var['state'] = 'success';
                $var['message'] = '创建成功';
                AdminLogger::_create(array('catalog'=>'create', 'intro'=>'创建文件夹:'.$folderName));
            } catch ( Exception $e ) {
                $var['state'] = 'error';
                $var['message'] = $e->getMessage();
            }
            exit( CJSON::encode( $var ) );
        }
    }

    /**
     * 创建文件
     *
     */
    public function actionCreateTpl() {
        parent::_acl('template_create');
         parent::_configParams(array('action'=>'allowTplOperate', 'val'=>'Y', 'message'=>'当前配置文件不允许创建或编辑模板，请在 protected/config/params.php 中配置 allowTplOperate 为 Y'));
        
        $folderName = trim( $this->_gets->getParam( 'folderName' ) );
        if (  $_POST ) {
            try {
                $fileName = CHtml::encode(trim( $this->_gets->getParam( 'fileName' ) ));
                $content = trim( $this->_gets->getParam( 'content' ) );
                if ( empty( $folderName ) )
                    throw new Exception( '必须指定文件夹' );
                elseif ( !self::_name($folderName) )
                    throw new Exception( "文件夹名称不合法。只能为英文字母、数字、下划线 (或组合)" );
                elseif ( empty( $fileName ) )
                    throw new Exception( "文件名必须填写" );
                elseif ( !self::_name($fileName))
                    throw new Exception( "文件名称不合法。只能为英文字母、数字、下划线 (或组合)" );
                elseif ( empty( $content ) )
                    throw new Exception( "文内容必须填写" );
                $newFile = $this->_themePath.DS.'views'.DS.$folderName.DS.$fileName.'.php';
                if ( is_file( $newFile ) )
                    throw new Exception( '文件 '.$fileName.' 已经存在 '. $folderName.'文件夹中' );
                $hander =  file_put_contents( $newFile, $content );
                if ( $hander ) {
                    AdminLogger::_create(array('catalog'=>'create', 'intro'=>'创建文件:'.$fileName));
                    XUtils::message( 'success', '文件 '.$fileName.' 创建成功', $this->createUrl( 'index' ) );
                }else {
                    throw new Exception( '文件创建失败' );
                }
            } catch ( Exception $e ) {
                XUtils::message( 'error', $e->getMessage() );
            }
        }
        $data['folderName'] = $folderName;
        $this->render( 'create', $data );
    }

    /**
     * 编辑
     *
     * @param $id
     */
    public function actionUpdateTpl( $filename ) {
        parent::_acl();
        parent::_configParams(array('action'=>'allowTplOperate', 'val'=>'Y', 'message'=>'不允许创建或编辑模板，请在 protected/config/params.php 中配置 allowTplOperate 为 Y'));
        $filename = CHtml::encode(trim( $this->_gets->getParam( 'filename' )));
        $content = trim( $this->_gets->getParam( 'content' ) );
        if ( isset( $_POST['content'] ) ) {
            $fileputcontent = file_put_contents(  $this->_themePath.DS.'views'.DS.XUtils::b64decode( $filename ), $content );
            if ( $fileputcontent == true ) {
                AdminLogger::_create( array( 'catalog'=>'update', 'intro'=>'编辑模板' ) );
                $this->redirect( array ( 'index' ) );
            }
        }
        $data['filename'] = XUtils::b64decode( $filename );
        $data['content'] = htmlspecialchars( file_get_contents(  $this->_themePath.DS.'views'.DS.XUtils::b64decode( $filename ) ) );
        $this->render( 'update', $data );

    }

    /**
     * 名称检测
     */
    private function _name($name){
        return preg_match( '/^[a-zA-Z0-9_-]*$/', trim( $name ) );
    }
     
    /**
     * 批量操作
     *
     */
    public function actionBatch() {
        $command = trim( $this->_gets->getParam( 'command' ) );
        switch ( $command ) {
        case 'deleteFile':
            parent::_acl('template_delete');
            $fileName = trim( $this->_gets->getParam( 'fileName' ) );
            empty( $fileName ) && XUtils::message( 'error', '未选择记录' );
            $filePath =  $this->_themePath.DS.'views'.DS.XUtils::b64decode( $fileName );
            @unlink( $filePath );
            AdminLogger::_create( array( 'catalog'=>'delete', 'intro'=>'删除模板：'.XUtils::b64decode($fileName) ) );
            $this->redirect( array( 'index' ) );
            break;
        case 'deleteFolder':
            parent::_acl('template_folder_delete');
            $folderName = trim( $this->_gets->getParam( 'folderName' ) );
            empty( $folderName ) && XUtils::message( 'error', '未选择记录' );
            $folderPath =  $this->_themePath.DS.'views'.DS.$folderName;
            if ( is_dir( $folderPath ) ) {
                $fileList = XUtils::getFile( $folderPath );
                foreach ( (array)$fileList as $row ) 
                    @unlink( $folderPath . DS. $row );
            }
            if ( rmdir( $folderPath ) ) {
                AdminLogger::_create( array( 'catalog'=>'delete', 'intro'=>'删除文件夹：'.$folderName ) );
                XUtils:: message( 'success', '目录 '.$folderName.' 删除完成', $this->createUrl( 'index' ) );
            }else {
                XUtils::message( 'errorBack', '目录删除失败，请删除此目录下所有文件再删除此目录' );
            }
            break;
        default:
            throw new CHttpException(404, '错误的操作类型:' . $command);
            break;
        }

    }

}
