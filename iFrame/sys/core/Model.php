<?php

namespace core;

use core\Config;
use PDO;

class Model
{
    protected $db;
    protected $table;

    function __construct($table = '')
    {
        $this->db = new PDO('mysql:host=' . Config::get('db_host') . ';dbname=' . Config::get('db_name') . ';charset=' . Config::get('db_charset'), Config::get('db_user'), Config::get('db_pwd'));
        $this->table = Config::get('db_table_prefix') . $table;    //补充完整数据表名
    }

    /*获取数据表字段*/
    public function getFields()
    {
        $sql = 'SHOW COLUMNS FROM `' . $this->table . '`';    //拼接 SQL 语句
        $pdo = $this->db->query($sql);    //执行
        $result = $pdo->fetchAll(PDO::FETCH_ASSOC);    //转换为索引数组
        $info = [];
        if ($result) {
            foreach ($result as $key => $val) {
                $val = array_change_key_case($val);
                $info[$val['field']] = [
                    'name' => $val['field'],
                    'type' => $val['type'],
                    'notnull' => (bool)('' === $val['null']),
                    'default' => $val['default'],
                    'primary' => (strtolower($val['key']) == 'pri'),
                    'auto' => (strtolower($val['extra']) == 'auto_increment'),
                ];
            }
            return $info;
        }
    }

    /*获取数据库所有表*/
    public function getTables()
    {
        $sql = 'SHOW TABLES';
        $pdo = $this->db->query($sql);
        $result = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $info = [];
        foreach ($result as $key => $val) {
            $info['key'] = current($val);
        }
        return $info;
    }

    /*释放连接*/
    public function free()
    {
        $this->db = null;
    }

    /*获得客户端真实的IP地址*/
    function getip()
    {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else
            if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
                $ip = getenv("HTTP_X_FORWARDED_FOR");
            } else
                if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
                    $ip = getenv("REMOTE_ADDR");
                } else
                    if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
                        $ip = $_SERVER['REMOTE_ADDR'];
                    } else {
                        $ip = "unknown";
                    }
        return ($ip);
    }

    /*新增数据*/
    public function save($data = [])
    {
        $keys = '';
        $values = '';
        foreach ($data as $key => $value) {
            $keys .= "$key,";
            $values .= "'" . $value . "',";
        }
        $keys = substr($keys, 0, strlen($keys) - 1);
        $values = substr($values, 0, strlen($values) - 1);
        $sql = 'INSERT INTO `' . $this->table . '` (' . $keys . ') VALUES (' . $values . ')';
        $pdo = $this->db->query($sql);
        if ($pdo) {
            return true;
        } else {
            $this->log_error('save error', $sql);
            return false;
        }
    }

    /*更新数据*/
    public function update($data = [], $wheres = [], $options = 'and')
    {
        $keys = '';
        $where = '';
        foreach ($data as $key => $value) {
            $keys .= $key . " = '" . $value . "',";
        }
        if (count($wheres) > 1) {
            foreach ($wheres as $key => $value) {
                $where .= $key . " = '" . $value . "' " . $options . " ";
            }
            $where = substr($where, 0, strlen($where) - strlen($options) - 2);
        } else {
            foreach ($wheres as $key => $value) {
                $where .= $key . " = '" . $value . "'";
            }
        }
        $keys = substr($keys, 0, strlen($keys) - 1);
        $sql = 'UPDATE ' . $this->table . ' SET ' . $keys . ' WHERE ' . $where;
        $pdo = $this->db->query($sql);
        if ($pdo) {
            return true;
        } else {
            $this->log_error('update error', $sql);
            return false;
        }
    }

    /*查找数据*/
    public function select($fields, $wheres = [], $options = 'and')
    {
        $field = '';
        if (is_string($fields)) {
            $field = $fields;
        } elseif (is_array($fields)) {
            foreach ($fields as $key => $value) {
                $field .= $value . ",";
            }
            $field = substr($field, 0, strlen($field) - 1);
        }
        $where = '';
        foreach ($wheres as $key => $value) {
            $where .= $key . ' ' . $options . " '$value',";
        }
        $where = substr($where, 0, strlen($where) - 1);
        $sql = 'SELECT ' . $field . ' FROM ' . $this->table . ' WHERE ' . $where;
        $pdo = $this->db->query($sql);
        if ($pdo) {
            $result = $pdo->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            $this->log_error('select error', $sql);
            return false;
        }
    }

    /*删除数据*/
    public function delete($wheres = [], $options = 'and')
    {
        $where = '';
        foreach ($wheres as $key => $value) {
            $where .= $key . ' ' . $options . " '$value',";
        }
        $where = substr($where, 0, strlen($where) - 1);
        $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;
        $pdo = $this->db->query($sql);
        if ($pdo) {
            return true;
        } else {
            $this->log_error('delete error', $sql);
            return false;
        }
    }

    /*错误日志记录*/
    protected function log_error($message = '', $sql = '')
    {
        $ip = $this->getip();
        $time = date("Y-m-d H:i:s");
        $message = $message . "\r\n$sql" . "\r\n客户IP:$ip" . "\r\n时间 :$time" . "\r\n\r\n";
        $server_date = date("Y-m-d");
        $filename = $server_date . "_SQL.txt";
        $file_path = RUNTIME_PATH . 'log' . DS . $filename;
        $error_content = $message;
        $file = RUNTIME_PATH . 'log'; //设置文件保存目录
        //建立文件夹
        if (!file_exists($file)) {
            if (!mkdir($file, 0777)) {
                //默认的 mode 是 0777，意味着最大可能的访问权
                die("upload files directory does not exist and creation failed");
            }
        }
        //建立txt日期文件
        if (!file_exists($file_path)) {
            //echo "建立日期文件";
            fopen($file_path, "w+");
            //首先要确定文件存在并且可写
            if (is_writable($file_path)) {
                //使用添加模式打开$filename，文件指针将会在文件的开头
                if (!$handle = fopen($file_path, 'a')) {
                    echo "Cannot open $filename";
                    exit;
                }
                //将$somecontent写入到我们打开的文件中。
                if (!fwrite($handle, $error_content)) {
                    echo "Cannot write $filename";
                    exit;
                }
                //echo "文件 $filename 写入成功";
                echo "Error logging is saved!";
                //关闭文件
                fclose($handle);
            } else {
                echo "File $filename cannot write";
            }
        } else {
            //首先要确定文件存在并且可写
            if (is_writable($file_path)) {
                //使用添加模式打开$filename，文件指针将会在文件的开头
                if (!$handle = fopen($file_path, 'a')) {
                    echo "Cannot open $filename";
                    exit;
                }
                //将$somecontent写入到我们打开的文件中。
                if (!fwrite($handle, $error_content)) {
                    echo "Cannot write $filename";
                    exit;
                }
                //echo "文件 $filename 写入成功";
                echo "——Error logging is saved!!";
                //关闭文件
                fclose($handle);
            } else {
                echo "File $filename cannot write";
            }
        }
    }
}