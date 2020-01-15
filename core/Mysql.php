<?php
class Mysql
{
    public function conn()
    {
        define('DB_HOSTNAME', 'localhost');
        define('DB_USERNAME', 'u5020191_default');
        define('DB_PASSWORD', 'shifr8565');
        define('DB_DATABASE', 'u5020191_default');
        $db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $db -> set_charset("utf8");
        return $db;
    }

    public function selectAll($table, $sort = 'ASC')
    {
        $db = $this->conn();
        $result = $db->query("SELECT * FROM `$table` WHERE 1 ORDER BY `id` $sort");
        while ($row = mysqli_fetch_assoc($result))
        {
            $rows[] = (object)$row;
        }
        return $rows;
    }

    public function selectById($table, $id)
    {
        $db = $this->conn();
        $result = $db->query("SELECT * FROM $table WHERE `id` = '". (int)$id . "'");
        $row = mysqli_fetch_row($result);
        return $row;
    }

}