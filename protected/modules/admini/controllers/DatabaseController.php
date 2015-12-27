<?php
/**
 * 数据库管理
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.admini.Controller
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class DatabaseController extends XAdminiBase
{

    private $_db;
    private $_bakupPath;
    public function init ()
    {
        parent::init();
        $this->_db = Yii::app()->db;
        $this->_bakupPath = WWWPATH.'/data/dbbak/';
    
    }

    /**
     * 首页
     */
    public function actionIndex ()
    {
        parent::_acl();
        $dataList = $this->_db->createCommand("SHOW TABLE STATUS LIKE '" . Yii::app()->db->tablePrefix . "%'")->queryAll();
        foreach ($dataList as $row) {
            $dataSize += $row['Data_length'];
        }
        $this->render('index', array ('dataSize' => $dataSize , 'dataList' => $dataList ));
    
    }

    /**
     * 执行查询
     */
    public function actionQuery ()
    {
        parent::_acl();
        parent::_configParams(array('action'=>'allowExecuteSql', 'val'=>'Y', 'message'=>'不允许执行SQL，请在 protected/config/params.php 中配置 allowExecuteSql 为 Y'));
        $this->render('query', array ());
    
    }

    /**
     * 执行相关命令
     */
    public function actionDoQuery ()
    {
        parent::_acl('database_query', array('response'=>'text'));
        if (XUtils::method() == 'POST') {
            $command = $this->_gets->getParam('command');
            $table = $this->_gets->getParam('table');
            empty($table) && exit('表必须选择');
            $tb = implode(',', $table);
            switch ($command) {
                case 'optimzeTable':
                    self::_execute("OPTIMIZE TABLE {$tb}");
                    break;
                case 'checkTable':
                    self::_execute("CHECK TABLE {$tb}");
                    break;
                case 'analyzeTable':
                    self::_execute("ANALYZE TABLE {$tb}");
                    break;
                case 'repairTable':
                    self::_execute("REPAIR TABLE {$tb}");
                    break;
                case 'showTable':
                    $table = explode(',', $tb);
                    foreach ((array) $table as $tb) 
                        self::_execute("SHOW COLUMNS FROM {$tb}");
                    break;
                default:
                    
                    break;
            }
        }
    }

    /**
     * 执行sql
     */
    public function actionExecute ()
    {
        if (XUtils::method() == 'POST') {
            parent::_acl('database_query', array('response'=>'text'));
            parent::_configParams(array('action'=>'allowExecuteSql', 'val'=>'Y', 'message'=>'不允许执行SQL，请在 protected/config/params.php 中配置 allowExecuteSql 为 Y', 'response'=>'text'));
            $sql = $this->_gets->getParam('command');
            $sqls = self::_sqlSplit($sql);
            foreach ($sqls as $execute)
                self::_execute($execute);
        }
    }

    /**
     * 导出
     */
    public function actionExport ()
    {
        parent::_acl();
        $this->render('export');
    }

    /**
     * 导出数据
     */
    public function actionDoExport ()
    {
        parent::_acl('database_export');
        $dosubmit = $this->_gets->getParam('dosubmit');
        if ($dosubmit) {
            $tables = $this->_db->schema->tableNames;
            $sqlcharset = $_POST['sqlcharset'] ? $_POST['sqlcharset'] : $_GET['sqlcharset'];
            $sqlcompat = $_POST['sqlcompat'] ? $_POST['sqlcompat'] : $_GET['sqlcompat'];
            $sizelimit = $_POST['sizelimit'] ? $_POST['sizelimit'] : $_GET['sizelimit'];
            $fileid = $_POST['fileid'] ? $_POST['fileid'] : trim($_GET['fileid']);
            $random = $_POST['random'] ? $_POST['random'] : trim($_GET['random']);
            $tableid = $_POST['tableid'] ? $_POST['tableid'] : trim($_GET['tableid']);
            $startfrom = $_POST['startfrom'] ? $_POST['startfrom'] : trim($_GET['startfrom']);
            $tabletype = $_POST['tabletype'] ? $_POST['tabletype'] : trim($_GET['tabletype']);
            self::exportDatabase($tables, $sqlcompat, $sqlcharset, $sizelimit, $fileid, $random, $tableid, $startfrom, $tabletype);
        }
    }

    /**
     * 数据备份
     * @param  $tables
     * @param  $sqlcompat
     * @param  $sqlcharset
     * @param  $sizelimit
     * @param  $fileid
     * @param  $random
     * @param  $tableid
     * @param  $startfrom
     * @param  $tabletype
     */
    private function exportDatabase ($tables, $sqlcompat, $sqlcharset, $sizelimit, $fileid, $random, $tableid, $startfrom, $tabletype)
    {
        $dumpcharset = $sqlcharset ? $sqlcharset : 'UTF8';
        
        $fileid = ($fileid != '') ? $fileid : 1;
        if ($fileid == 1 && $tables)
            $random = mt_rand(1000, 9999);
        
        if ($this->_db->serverVersion > '4.1') {
            if ($sqlcharset) {
                $this->_db->createCommand("SET NAMES '" . $sqlcharset . "';\n\n")->execute();
            }
            if ($sqlcompat == 'MYSQL40') {
                $this->_db->createCommand("SET SQL_MODE='MYSQL40'")->execute();
            } elseif ($sqlcompat == 'MYSQL41') {
                $this->_db->createCommand("SET SQL_MODE=''")->execute();
            }
        }
        
        $tabledump = '';
        
        $tableid = ($tableid != '') ? $tableid - 1 : 0;
        $startfrom = ($startfrom != '') ? intval($startfrom) : 0;
        
        for ($i = $tableid; $i < count($tables) && strlen($tabledump) + 500 < $sizelimit * 1000; $i ++) {
            global $startrow;
            $offset = 100;
            if (! $startfrom) {
                
                $tabledump .= "DROP TABLE IF EXISTS `$tables[$i]`;\n";
                $createtable = $this->_db->createCommand("SHOW CREATE TABLE `$tables[$i]` ")->queryAll(false);
                $tabledump .= $createtable[0][1] . ";\n\n";
                
                if ($sqlcompat == 'MYSQL41' && $this->_db->serverVersion < '4.1') {
                    $tabledump = preg_replace("/TYPE\=([a-zA-Z0-9]+)/", "ENGINE=\\1 DEFAULT CHARSET=" . $dumpcharset, $tabledump);
                }
                if ($this->_db->serverVersion > '4.1' && $sqlcharset) {
                    $tabledump = preg_replace("/(DEFAULT)*\s*CHARSET=[a-zA-Z0-9]+/", "DEFAULT CHARSET=" . $sqlcharset, $tabledump);
                }
                /* if($tables[$i]==DB_PRE.'session') {
                    $tabledump = str_replace("CREATE TABLE `".DB_PRE."session`", "CREATE TABLE IF NOT EXISTS `".DB_PRE."session`", $tabledump);
                } */
            }
            
            $numrows = $offset;
            while (strlen($tabledump) < $sizelimit * 1000 && $numrows == $offset) {
                $sql = "SELECT * FROM `$tables[$i]` LIMIT $startfrom, $offset";
                
                $exe = $this->_db->createCommand($sql);
                
                $q = $exe->queryAll();
                $numrows = count($q);
                $keys = array_keys((array) $q[0]);
                $numfields = count($keys);
                //$fields_name = $this->db->get_fields($tables[$i]);
                //$rows = $this->db->query($sql);
                $r = array ();
                $rows = $exe->query();
                //while (($row = $rows->read()) !== false) {
                foreach ((array) $q as $row) {
                    $r[] = $row;
                    $comma = "";
                    $tabledump .= "INSERT INTO `$tables[$i]` VALUES(";
                    //for ($j = 0; $j < $numfields; $j ++) {
                    foreach ($keys as $k) {
                        $tabledump .= $comma . "'" . mysql_escape_string($row[$k]) . "'";
                        $comma = ",";
                    }
                    $tabledump .= ");\n";
                }
                $startfrom += $offset;
            }
            $tabledump .= "\n";
            $startrow = $startfrom;
            $startfrom = 0;
        }
        
        if (trim($tabledump)) {
            $tabledump = "# bagecms database backup\n# version:".$this->_bagecms."\n# time:" . date('Y-m-d H:i:s') . "\n# type:cms\n# www.bagecms.com\n# --------------------------------------------------------\n\n\n" . $tabledump;
            $tableid = $i;
            $filename = $tabletype . '_' . date('Ymd') . '_' . $random . '_' . $fileid . '.sql';
            $altid = $fileid;
            $fileid ++;
            
            $bakfile = $this->_bakupPath . $filename;
            
            file_put_contents($bakfile, $tabledump);
            
            XUtils::message('success', "备份文件 $filename 写入成功!", $this->createUrl('database/doExport', array ('sizelimit' => $sizelimit , 'tableid' => $tableid , 'fileid' => $fileid , 'random' => $random , 'startfrom' => $startrow , 'dosubmit' => 1 , 'sqlcompat' => $sqlcompat , 'sqlcharset' => $sqlcharset , 'tabletype' => $tabletype )), 1);
        
        } else {
            @file_put_contents($this->_bakupPath . 'index.html', '');
            $this->redirect($this->createUrl('database/export'));
        }
    }

    /**
     * 导入数据
     */
    public function actionImport ()
    {
        parent::_acl('database_import');
        if ($this->_gets->getParam('dosubmit')) {
            $pre = trim($this->_gets->getParam('pre'));
            $fileid = $this->_gets->getParam('fileid');
            self::_import($pre, $fileid);
        } else {
            
            $sqlfiles = glob($this->_bakupPath . '*.sql');
            if (is_array($sqlfiles)) {
                asort($sqlfiles);
                $prepre = '';
                $info = $infos = $other = $others = array ();
                foreach ($sqlfiles as $id => $sqlfile) {
                    if (preg_match("/(bagecms_[0-9]{8}_[0-9a-z]{4}_)([0-9]+)\.sql/i", basename($sqlfile), $num)) {
                        $info['filename'] = basename($sqlfile);
                        $info['filesize'] = round(filesize($sqlfile) / (1024 * 1024), 2);
                        $info['maketime'] = date('Y-m-d H:i:s', filemtime($sqlfile));
                        $info['pre'] = $num[1];
                        $info['number'] = $num[2];
                        if (! $id)
                            $prebgcolor = '#CFEFFF';
                        if ($info['pre'] == $prepre) {
                            $info['bgcolor'] = $prebgcolor;
                        } else {
                            $info['bgcolor'] = $prebgcolor == '#F2F9FD' ? '' : '#F2F9FD';
                        }
                        $prebgcolor = $info['bgcolor'];
                        $prepre = $info['pre'];
                        $infos[] = $info;
                    } else {
                        $other['filename'] = basename($sqlfile);
                        $other['filesize'] = round(filesize($sqlfile) / (1024 * 1024), 2);
                        $other['maketime'] = date('Y-m-d H:i:s', filemtime($sqlfile));
                        $others[] = $other;
                    }
                }
            }
            $show_validator = true;
            
            $this->render('import', array ('infos' => $infos , 'otherData' => $others ));
        }
    }

    /**
     * 数据恢复
     * @param  $filename
     * @param  $fileid
     */
    private function _import ($filename, $fileid)
    {
        if ($filename && CFileHelper::getExtension($filename) == 'sql') {
            $filepath = $this->_bakupPath . $filename;
            if (! file_exists($filepath))
                XUtils::message('error', '文件不存在');
            $sql = file_get_contents($filepath);
            self::_sqlExecute($sql);
            //showmessage("$filename " . L('data_have_load_to_database'));
            XUtils::message('success', $filename . '中的数据成功导入');
        } else {
            $fileid = $fileid ? $fileid : 1;
            $pre = $filename;
            $filename = $filename . $fileid . '.sql';
            $filepath = $this->_bakupPath . $filename;
            if (file_exists($filepath)) {
                $sql = file_get_contents($filepath);
                $this->_sqlExecute($sql);
                $fileid ++;
                //showmessage(L('bakup_data_file') . " $filename " . L('load_success'), "?m=admin&c=database&a=import&pdoname=" . $this->pdo_name . "&pre=" . $pre . "&fileid=" . $fileid . "&dosubmit=1");
                XUtils::message('success', '数据文件' . $filename . ' 导入成功', $this->createUrl('database/import', array ('pre' => $pre , 'fileid' => $fileid , 'dosubmit' => '1' )), 1);
            } else {
                XUtils::message('success', '数据成功导入', $this->createUrl('database/import'), 3);
            }
        }
    }

    /**
     * 执行SQL
     * @param  $sql
     */
    private function _sqlExecute ($sql)
    {
        $sqls = self::_sqlSplit($sql);
        if (is_array($sqls)) {
            foreach ($sqls as $sql) {
                if (trim($sql) != '') {
                    $this->_db->createCommand($sql)->execute();
                }
            }
        } else {
            $this->_db->createCommand($sql)->execute();
        }
        return true;
    }

    /**
     * 拆分sql
     * @param  $sql
     */
    private function _sqlSplit ($sql)
    {
        if ($this->_db->serverVersion > '4.1' && $this->_db->charset) {
            $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=" . $this->_db->charset, $sql);
        }
        if ($this->_db->tablePrefix != "os_")
            $sql = str_replace("`os_", '`' . $this->_db->tablePrefix, $sql);
        $sql = str_replace("\r", "\n", $sql);
        $ret = array ();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query) {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $query;
            }
            $num ++;
        }
        return ($ret);
    }

    /**
     * 执行sql
     */
    private function _execute ($command = '')
    {
        $exeSql = empty($command) ? trim($this->_gets->getParam('command')) : $command;
        $formatExeSql = XUtils::splitsql($exeSql);
        foreach ($formatExeSql as $sql) {
            if (empty($sql))
                continue;
             try {
                 $resultData = self::_executeCommand($sql);
                if (false !== $resultData['result']) {
                    if ($resultData['type'] == 'query') {
                        if (empty($resultData['result']))
                            echo '执行完成';
                        $fields = array_keys($resultData['result'][0]);
                        echo $this->render('query_result', array ('fields' => $fields , 'dataList' => $resultData['result'] , 'command' => $command ), true);
                    } else {
                        echo "<div style='color:red;padding:10px 0'>执行完成: {$sql}</div>";
                    }
                } else {
                    echo "执行失败";
                }
             } catch (Exception $e) {
                echo "<div style='color:red;padding:10px 0'>执行失败: {$sql}</div>";
            }   
        }
    }

    /**
     * 查询分析器
     * @param  $sql
     */
    private function _executeCommand ($sql = '')
    {
        if (MAGIC_QUOTES_GPC) {
            $sql = stripslashes($sql);
        }
        if (empty($sql))
            exit('SQL不能为空');
        
        $queryType = 'INSERT|UPDATE|DELETE|REPLACE|CREATE|DROP|LOAD DATA|SELECT .* INTO|COPY|ALTER|GRANT|TRUNCATE|REVOKE|LOCK|UNLOCK';
        if (preg_match('/^\s*"?(' . $queryType . ')\s+/i', $sql)) {
            $data['result'] = $this->_db->createCommand($sql)->execute();
            $data['type'] = 'execute';
        } else {
            $data['result'] = $this->_db->createCommand($sql)->queryAll();
            $data['type'] = 'query';
        }
        
        return $data;
    }

    /**
     * 批处理
     */
    public function actionOperate ()
    {
        $command = trim($this->_gets->getParam('command'));
        
        switch ($command) {
            case 'deleteFile':
                parent::_acl('database_delete');
                $filenames = $this->_gets->getParam('sqlfile');
                
                if ($filenames) {
                    if (is_array($filenames)) {
                        foreach ($filenames as $filename) {
                            if (CFileHelper::getExtension($filename) == 'sql') {
                                @unlink($this->_bakupPath . $filename);
                            }
                        }
                        
                        XUtils::message('success', '删除完成', $this->createUrl('database/import'));
                    } else {
                        if (CFileHelper::getExtension($filenames) == 'sql') {
                            @unlink($this->_bakupPath . $filename);
                            XUtils::message('success', '删除完成', $this->createUrl('database/import'));
                        }
                    }
                } else {
                    XUtils::message('error', '请选择要删除的文件', $this->createUrl('database/import'));
                }
                
                break;
            case 'downloadFile':
                parent::_acl('database_download');
                $sqlfile = $this->_gets->getParam('sqlfile');
                XHttp::download($this->_bakupPath . $sqlfile, '', '', 3600);
                break;
            default:
                throw new CHttpException(404, '未找到操作' );
                break;
        }
    
    }

}

?>