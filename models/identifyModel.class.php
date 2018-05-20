<?php
    require_once('connection_connect.php');
    class Indentify{
        
        public static function login($username,$passwd)
        {
            $con = conDb::getInstance();
            $stmt = $con->prepare('SELECT * FROM member WHERE username = ?');
            $check = $stmt->execute([$username]);
            $result = $stmt->fetch();
            $id_member = $result['id_member'];
            $type = $result['type'];
            if($check == TRUE)
            {
                
                $user = $result;
                $password_hash = $result['passwd'];
                $check_password = password_verify($passwd,$password_hash);
                //print_r($result);
                if($check_password === TRUE)
                {
                    if($type == "นิสิต")
                    {
                        $stmt = $con->query('SELECT * FROM year_school
                        WHERE DATE(year_school.start_date) <= DATE(CURDATE()) AND DATE(year_school.end_date) >= DATE(CURDATE())');
                        $result = $stmt->fetch();
                        $id_year = $result['id_year'];
                        $stmt = $con->query("SELECT * FROM year_member
                        INNER JOIN year_school ON year_member.id_year = year_school.id_year 
                        INNER JOIN member ON member.id_member = year_member.id_member
                        WHERE year_member.id_year = $id_year AND year_member.id_member = $id_member");
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if($result)
                        {
                            return $user;
                        }
                        else
                        {
                            return 1;
                        }
                    }
                    else
                    {
                        return $user;
                    }
                }
                else
                {
                    return 2;
                }
            } 
            else
            {
                return 3;
            }
        }
    }
?>