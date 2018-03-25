<?php
    require_once('connection_connect.php');
    class Indentify{
        
        public static function login($username,$passwd)
        {
            $con = conDb::getInstance();
            $stmt = $con->prepare('SELECT * FROM member WHERE username = ?');
            $check = $stmt->execute([$username]);
            if($check == TRUE)
            {
                $result = $stmt->fetch();
                $password_hash = $result['passwd'];
                $check_password = password_verify($passwd,$password_hash);
                if($check_password === TRUE)
                {
                    return $result;
                }
                else
                {
                    return false;
                }
            } 
            else
            {
                return false;
            }
        }
    }
?>