<?php

namespace app\admin\controller;
use think\Controller;
use think\Db;
use dbback\Databaseback;

class Dbfile extends Base {

    public function _initialize() {
        parent::_initialize();
        $this->backup_path = '../data/backup/';
    }

    /* 数据库管理 */

    public function index() {
        $list = db()->query('SHOW TABLE STATUS');
        $this->assign('list', $list);
        return $this->fetch('export');
    }

    /**
     * 优化表
     * @param  String $tables 表名
     * @author 
     */
    public function optimize($tables = null) {
        $tables = input('tables');
        if ($tables) {
            if (is_array($tables)) {
                $tables = implode('`,`', $tables);
                $list = db()->query("OPTIMIZE TABLE `{$tables}`");
                if ($list) {
                    success('数据表优化完成');
                } else {
                   error('数据表优化出错请重试');
                }
            } else {
                $list = db()->query("OPTIMIZE TABLE `{$tables}`");
                if ($list) {
                    success("数据表'{$tables}'优化完成！");
                } else {

                    error("数据表'{$tables}'优化出错请重试");
                }
            }
        } else {

           error("请指定要优化的表");
        }
    }

    /**
     * 修复表
     * @param  String $tables 表名
     * @author 
     */
    public function repair($tables = null) {
        $tables = input('tables');
        if ($tables) {

            if (is_array($tables)) {
                $tables = implode('`,`', $tables);
                $list = db()->query("REPAIR TABLE `{$tables}`");
                if ($list) {
                    success('数据表修复完成');
                } else {
                    error('数据表修复出错请重试');
                }
            } else {
                $list = db()->query("REPAIR TABLE `{$tables}`");
                if ($list) {
                    success("数据表'{$tables}'修复完成");
                } else {
                    error("数据表'{$tables}'修复出错请重试");
                }
            }
        } else {
            error("请指定要优化的表");
        }
    }

    /**
     * 备份数据库（全部）
     */
    public function export() {

        $data = new Databaseback();
        
        $dir = $this->backup_path;

        // 创建目录
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true) or $this->error('创建文件夹失败');
        }
        $size = 2024;
        $sql = '';

        // 备份全部表
        $dbconfig=config("database");
        $dbname=$dbconfig['database'];
        if (!$tables = db()->query("show table status from " . $dbname)) {
            error('读取数据库结构失败！');
        }
        // 插入dump信息
        $sql .= $data->_base();
        // 文件名前面部分
        $filename = $dbname . date('YmdHis');
        // 查出所有表
        $tables = db()->query('SHOW TABLES');
        // 第几分卷
        $p = 1;
        // 循环所有表
        foreach ($tables as $value) {
            foreach ($value as $v) {

                // 获取表结构
                $sql .= $data->_insert_table_structure($v);
                // 单条记录
                $sql .= $data->_insert_record($v);
            }
        }
        /*
          // 如果大于分卷大小，则写入文件
          if (strlen ( $sql ) >= $size * 1024) {

          $file = $filename . "_v" . $p . ".sql";
          // 写入文件
          if (!$data->_write_file ( $sql, $file, $dir )) {

          $this->error("备份卷-" . $p . "-失败",U('index'));

          }
          // 下一个分卷
          $p ++;

          }
         */

        // sql大小不够分卷大小
        if ($sql != "") {
            $filename .= ".sql";
            if ($data->_write_file($sql, $filename, $dir)) {
                success('数据备份完成');
            } else {
                error('数据备份失败');
            }
        }
    }

    /**
     * 数据还原
     */
    function import() {
        $dir = opendir($this->backup_path);
        $i = 0;
        while (($filename = readdir($dir)) !== false) {
            if ($filename != '.' && $filename != '..') {
                $file = fopen($this->backup_path . $filename, "r");
                $list[$i]['fileurl'] = $this->backup_path . $filename;
                $list[$i]['filename'] = $filename;
                $list[$i]['fileinfo'] = fstat($file);
            }
            $i++;
        }
        if(isset($list))
            $this->assign('list', $list);
        return $this->fetch();
    }

    //删除备份
    function del() {

        $filename = input('filename');
        if (empty($filename))
            error('请选择备份文件');
        if (is_array($filename)) {
            foreach ($filename as $key => $v) {
                @unlink($this->backup_path . $v);
            }
        } else {
            @unlink($this->backup_path . $filename);
        }
        success("备份文件删除成功");
    }

    //下载
    public function download(){
        $filename=input('filename');
        if($filename){
           $this->downfile($this->backup_path . $filename);
        }
    }

    private function downfile($fileName) {  
            ob_end_clean();
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Length: ' . filesize($fileName));
            header('Content-Disposition: attachment; filename=' . basename($fileName));
            readfile($fileName);
    }

}
