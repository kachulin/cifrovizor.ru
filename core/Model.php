<?php
class Model
{
    public function db()
    {
        return (new Mysql);
    }

    public function checkAuth()
    {
        if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
        {
            $query = $this->db()->conn()->query("SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
            $userData = mysqli_fetch_assoc($query);

            if(($userData['user_hash'] !== $_COOKIE['hash']) or ($userData['user_id'] !== $_COOKIE['id']))
            {
                setcookie("id", "", time() - 3600*24*30*12, "/");
                setcookie("hash", "", time() - 3600*24*30*12, "/");
            }
            else
            {
                return true;
            }
        }
        return false;
    }
}