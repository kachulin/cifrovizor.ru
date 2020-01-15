<?php
class Login extends Model
{
    public function login()
    {
        $db = $this->db()->conn();
        $userName = mysqli_real_escape_string($db, $_POST['userName']);
        $result = $db->query("SELECT user_id, user_password, category FROM users WHERE user_login='" . $userName . "' LIMIT 1");
        $data = mysqli_fetch_assoc($result);
        if ($data['user_password'] === md5(md5($_POST['password'])))
        {
            $hash = md5($this->generateCode(10));
            $db->query("UPDATE users SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'");
            setcookie("id", $data['user_id'], time() + 60 * 60 * 24 * 30);
            setcookie("hash", $hash, time() + 60 * 60 * 24 * 30);
            header('Location: /tasks');
        }
        return false;
    }

    public function logout()
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
    }

    public function requestPost()
    {
        if ($_POST['submit'] == 'login')
        {
            return (object)$_POST;
        }
        return false;
    }

    function generateCode($length = 6)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length)
        {
            $code .= $chars[mt_rand(0, $clen)];
        }
        return $code;
    }
}