<?php
/**
 * 问答管理
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.admini.Controller
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class QuestionController extends XAdminiBase
{
    /**
     * 首页
     */
    public function actionIndex() {
        parent::_acl();
        $model = new Question();
        $criteria = new CDbCriteria();
        $condition = '1';
        $realname = trim( $this->_gets->getParam( 'realname' ) );
        $question = trim( $this->_gets->getParam( 'question' ) );
        $question && $condition .= ' AND question LIKE \'%' . $question . '%\'';
        $realname && $condition .= ' AND realname LIKE \'%' . $realname . '%\'';
        $criteria->condition = $condition;
        $criteria->order = 't.id DESC';
        $count = $model->count( $criteria );
        $pages = new CPagination( $count );
        $pages->pageSize = 13;
        $pageParams = XUtils::buildCondition( $_GET, array ( 'site_name' ) );
        $pages->params = is_array( $pageParams ) ? $pageParams : array ();
        $criteria->limit = $pages->pageSize;
        $criteria->offset = $pages->currentPage * $pages->pageSize;
        $result = $model->findAll( $criteria );
        $this->render( 'index', array ( 'datalist' => $result , 'pagebar' => $pages ) );
    }
    
    /**
     * 更新留言
     *
     */
    public function actionUpdate( $id ) {
        parent::_acl( 'question_update' );
        $model = parent::_dataLoad( new Question(), $id );
        if ( isset( $_POST['Question'] ) ) {
            $model->attributes = $_POST['Question'];
            if ( $model->save() ) {
                AdminLogger::_create( array( 'catalog'=>'create', 'intro'=>'编辑留言，ID:'.$id ) );
                $this->redirect( array ( 'index' ) );
            }
        }
        $this->render( 'update', array ( 'model' => $model ) );
    }

    /**
     * 批量操作
     *
     */
    public function actionBatch() {
        if ( XUtils::method() == 'GET' ) {
            $command = trim( $_GET['command'] );
            $ids = intval( $_GET['id'] );
        } elseif ( XUtils::method() == 'POST' ) {
                $command = trim( $_POST['command'] );
                $ids = $_POST['id'];
                is_array( $ids ) && $ids = implode( ',', $ids );
            } else {
            XUtils::message( 'errorBack', '只支持POST,GET数据' );
        }
        empty( $ids ) && XUtils::message( 'error', '未选择记录' );

        switch ( $command ) {
        case 'delete':
            parent::_acl( 'question_delete' );
            AdminLogger::_create( array( 'catalog'=>'delete', 'intro'=>'删除留言反馈，ID:'.$ids ) );
            parent::_delete( new Question(), $ids, array ( 'index' ) );
            break;
        default:
            throw new CHttpException(404, '错误的操作类型:' . $command);
            break;
        }

    }

}
