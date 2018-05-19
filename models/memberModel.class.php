<?php
    require_once('connection_connect.php');
    class Member{
        private $id_member;
        private $id_code;
        private $username;
        private $passwd;
        private $fname;
        private $lname;
        private $type;
        private $img_user;
        public function get_id_member()
        {
            return $this->id_member;
        }
        public function get_id_code()
        {
            return $this->id_code;
        }
        public function get_username()
        {
            return $this->username;
        }
        public function get_passwd()
        {
            return $this->passwd;
        }
        public function get_fname()
        {
            return $this->fname;
        }
        public function get_lname()
        {
            return $this->lname;
        }
        public function get_type()
        {
            return $this->type;
        }
        public function get_img_user()
        {
            return $this->img_user;
        }
        public function __construct($id_member,$id_code,$username,$passwd,$fname,$lname,$type,$img_user=NULL)
        {
            $this->id_member = $id_member;
            $this->id_code = $id_code;
            $this->username = $username;
            $this->passwd = $passwd;
            $this->fname = $fname;
            $this->lname = $lname;
            $this->type = $type;
            $this->img_user = $img_user;
        }
        public static function validateCode($id_code)
        {
            header('Content-type: application/json');
            $con = ConDb::getInstance();
            $stmt = $con->prepare('SELECT member.id_code FROM member WHERE member.id_code = ?');
            $stmt->execute([$id_code]);
            if($stmt->rowCount() > 0)
            {
                
                $data = array("check"=>TRUE);
            }
            else
            {
                $data = array("check"=>FALSE);
            }
            ob_end_clean();
            print json_encode($data);
        }
        public static function validateUsername($username)
        {
            header('Content-type: application/json');
            $con = ConDb::getInstance();
            $stmt = $con->prepare('SELECT member.username FROM member WHERE member.username = ?');
            $stmt->execute([$username]);
            if($stmt->rowCount() > 0)
            {
                $data = array("check"=>TRUE,"username"=>$username,"count"=>$stmt->rowCount());
            }
            else
            {
                $data = array("check"=>FALSE,"username"=>$username,"count"=>$stmt->rowCount());
            }
            ob_end_clean();
            print json_encode($data);
        }
        public static function validatePassword($passwd,$id_member)
        {
            header('Content-type: application/json');
            $con = ConDb::getInstance();
            $strPassword = password_hash($passwd,PASSWORD_DEFAULT);
            $stmt = $con->prepare('SELECT member.passwd FROM member WHERE member.id_member = ?');
            $stmt->execute([$id_member]);
            $result = $stmt->fetch();
            $password_hash = $result['passwd'];
            $check_password = password_verify($passwd,$password_hash);
            if($check_password)
            {
                $data = array("check"=>TRUE);
            }
            else
            {
                $data = array("check"=>FALSE);
            }
            ob_end_clean();
            print json_encode($data);
        }
        public static function getMemberByYearReport($year)
        {
            header('Content-type: application/json');
            $con = ConDb::getInstance();
            $stmt = $con->prepare('SELECT DISTINCT member.id_member,member.fname,member.lname FROM work 
            INNER JOIN member ON member.id_member = work.person_id
            WHERE YEAR(work.created_date) = ? AND work.status = ?');
            $stmt->execute([$year,'finish']);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $key=>$value)
            {
                $data[] = $value;
            }
            ob_end_clean();
            print json_encode($data);
            //return $data;
        }
        public static function reportMonth($person_id,$year)
        {
            header('Content-type: application/json');
            $con = ConDb::getInstance();
            $stmt = $con->prepare('SELECT work.person_id,YEAR(work.created_date) as y,MONTHNAME(work.created_date) AS m,COUNT(work.id_work) AS work_count  FROM work 
            WHERE work.person_id = ? AND YEAR(work.created_date) = ? AND work.status = ?
            GROUP BY work.person_id,YEAR(work.created_date),MONTHNAME(work.created_date)
            ORDER BY MONTH(work.created_date)');
            $stmt->execute([$person_id,$year,'finish']);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $key=>$value)
            {
                $data[] = $value;
            }
            $stmt = $con->prepare('SELECT Sum(Left(work.used_time,2) * 3600 + substring(work.used_time, 4,2) * 60 + substring(work.used_time, 7,2)) /60 AS timeWork from work WHERE work.person_id = ? AND YEAR(work.created_date) = ? AND work.status = ?');
            $stmt->execute([$person_id,$year,'finish']);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $key=>$value)
            {
                $data[] = $value;
            }
            $stmt = $con->prepare('SELECT COUNT(work.id_work) AS sum_work FROM work WHERE YEAR(work.created_date) = ? GROUP BY YEAR(work.created_date)');
            $stmt->execute([$year]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $key=>$value)
            {
                $data[] = $value;
            }
            ob_end_clean();
            print json_encode($data);
        }
        public static function reportYear($year)
        {
            header('Content-type: application/json');
            $con = ConDb::getInstance();
            $stmt = $con->prepare('SELECT member.fname,member.lname,work.person_id,work.id_year,COUNT(work.id_work) AS work_count FROM work 
            INNER JOIN member ON member.id_member = work.person_id
            WHERE work.id_year = ? 
            GROUP BY  work.person_id,work.id_year 
            ORDER BY work.id_year,work_count DESC');
            $stmt->execute([$year]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $key=>$value)
            {
                $data[] = $value;
            }
            ob_end_clean();
            print json_encode($data);
        }
        public static function getAllMember()
        {
            $con = conDb::getInstance();
            $stmt = $con->query('SELECT * FROM member');
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($result)
            {
                foreach($result as $key=>$value)
                {
                    $member_list[] = new Member($value['id_member'],$value['id_code'],$value['username'],$value['passwd'],$value['fname'],$value['lname'],$value['type'],$value['img_user']);
                }
                //$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Member');
                //$result = $stmt->fetchAll();
                return $member_list;
            }
            else
            {
                return FALSE;
            }
        }
        public static function getAllStaff()
        {
            $con = conDb::getInstance();
            $stmt = $con->query("SELECT * FROM member WHERE member.type != 'นิสิต'");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($result)
            {
                foreach($result as $key=>$value)
                {
                    $member_list[] = new Member($value['id_member'],$value['id_code'],$value['username'],$value['passwd'],$value['fname'],$value['lname'],$value['type'],$value['img_user']);
                }
                //$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Member');
                //$result = $stmt->fetchAll();
                return $member_list;
            }
            else
            {
                return FALSE;
            }
        }
        public static function getMemberInSym()
        {
            $con = conDb::getInstance();
            $stmt = $con->query("SELECT * FROM member
            WHERE member.id_member IN (SELECT DISTINCT member.id_member FROM member 
            INNER JOIN year_member ON year_member.id_member = member.id_member) AND member.type = 'นิสิต'");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($result)
            {
                foreach($result as $key=>$value)
                {
                    $member_list[] = new Member($value['id_member'],$value['id_code'],$value['username'],$value['passwd'],$value['fname'],$value['lname'],$value['type'],$value['img_user']);
                }
            }
            else
            {
                return FALSE;
            }
            return $member_list;
        }

        /*public static function getMemberByYear()
        {
            $con = conDb::getInstance();
            $stmt = $con->query('SELECT * FROM year_school
            WHERE DATE(year_school.start_date) <= DATE(CURDATE()) AND DATE(year_school.end_date) >= DATE(CURDATE())');
            $result = $stmt->fetch();
            $id_year = $result['id_year'];
            $stmt = $con->query("SELECT * FROM member
                                 WHERE member.id_member NOT IN(SELECT DISTINCT  member.id_member FROM member 
                                 INNER JOIN year_member ON year_member.id_member = member.id_member
                                 WHERE year_member.id_year = $id_year) AND member.type = 'นิสิต'");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($result)
            {
                foreach($result as $key=>$value)
                {
                    $member_list[] = new Member($value['id_member'],$value['id_code'],$value['username'],$value['passwd'],$value['fname'],$value['lname'],$value['type'],$value['img_user']);
                }
            }
            else
            {
                return FALSE;
            }
            return $member_list;
        }*/
        public static function getMemberNotInSys($id_year)
        {
            header('Content-type: application/json');
            $con = conDb::getInstance();
            $stmt = $con->query("SELECT * FROM member
                                 WHERE member.id_member NOT IN(SELECT DISTINCT  member.id_member FROM member 
                                 INNER JOIN year_member ON year_member.id_member = member.id_member
                                 WHERE year_member.id_year = $id_year) AND member.type = 'นิสิต'");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($result)
            {
                foreach($result as $key=>$value)
                {
                    $data[] = $value;
                }
            }
            ob_end_clean();
            print json_encode($data);
        }
        public static function getAllMemberByYear()
        {
            $con = conDb::getInstance();
            $stmt = $con->query('SELECT * FROM year_school
            WHERE DATE(year_school.start_date) <= DATE(CURDATE()) AND DATE(year_school.end_date) >= DATE(CURDATE())');
            $result = $stmt->fetch();
            $id_year = $result['id_year'];
            $stmt = $con->query("SELECT member.id_member,member.id_code,member.username,member.passwd,member.fname,member.lname,member.img_user,member.type FROM member 
            INNER JOIN year_member ON year_member.id_member = member.id_member
            WHERE year_member.id_year = $id_year");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($result)
            {
                foreach($result as $key=>$value)
                {
                    $member_list[] = new Member($value['id_member'],$value['id_code'],$value['username'],$value['passwd'],$value['fname'],$value['lname'],$value['type'],$value['img_user']);
                }
            }
            else
            {
                return FALSE;
            }
            return $member_list;
        }
        public static function getMember($id_member)
        {
            $con = conDb::getInstance();
            $stmt = $con->prepare('SELECT * FROM member WHERE id_member = ?');
            $stmt->execute([$id_member]);
            $result = $stmt->fetch();
            if($result)
            {
                return new Member($result['id_member'],$result['id_code'],$result['username'],$result['passwd'],$result['fname'],$result['lname'],$result['type'],$result['img_user']);
            }
            else
            {
                return FALSE;
            }
        }
        public static function addMemberRegister($id_code,$fname,$lname,$username,$passwd)
        {
            $con = conDb::getInstance();
            $strPassword = password_hash($passwd,PASSWORD_DEFAULT);
            $stmt = $con->prepare('INSERT INTO member(id_code,fname,lname,username,passwd,type) VALUES(?,?,?,?,?,?)');
            $check = $stmt->execute([$id_code,$fname,$lname,$username,$strPassword,'นิสิต']);
            return $check;
        }
        public static function addMemberMm($id_code=NULL,$fname,$lname,$username,$passwd,$type)
        {
            $con = conDb::getInstance();
            if($type == 'นิสิต')
            {
                $sql = "INSERT INTO member(id_code,fname,lname,username,passwd,type) VALUES(?,?,?,?,?,?)";
            }
            else
            {
                $sql = "INSERT INTO member(fname,lname,username,passwd,type) VALUES(?,?,?,?,?)";
            }
            $strPassword = password_hash($passwd,PASSWORD_DEFAULT);
            $stmt = $con->prepare($sql);
            if($type == 'นิสิต')
            {
                $check = $stmt->execute([$id_code,$fname,$lname,$username,$strPassword,$type]);
            }
            else
            {
                $check = $stmt->execute([$fname,$lname,$username,$strPassword,$type]);
            }
            return $check;
        }
        public static function addMemberSys($array_member,$id_year)
        {   
            $con = conDb::getInstance();
            $stmt = $con->prepare('INSERT INTO year_member(id_member,id_year) VALUES(?,?)');
            foreach($array_member as $key=>$value)
            {
                $check = $stmt->execute([$value,$id_year]);
                echo $id_year;
            }
            return $check;
            
        }
        public static function updateInfo($id_member,$id_code,$fname,$lname,$id_code_new)
        {
            $con = conDb::getInstance();
            if(isset($id_code_new))
            {
               $sql = 'UPDATE member SET id_code = ? WHERE id_member = ?';
            }
            else
            {
                $sql = 'UPDATE member SET id_code = ?,fname = ?,lname = ? WHERE id_member = ?';
            }
            $stmt = $con->prepare($sql);
            if(isset($id_code_new))
            {
                $check = $stmt->execute([$id_code_new,$id_member]);
                $_SESSION['member']['id_code'] = $id_code_new;
            }
            else
            {
                $check = $stmt->execute([$id_code,$fname,$lname,$id_member]);
                $_SESSION['member']['id_code'] = $id_code;
            }
            if($check === TRUE)
            {
                $_SESSION['member']['fname'] = $fname;
                $_SESSION['member']['lname'] = $lname;
            }
            return $check;
        }
        public static function updateMember($id_member,$id_code,$fname,$lname,$type)
        {
            $con = conDb::getInstance();
            if(isset($fname) && isset($lname))
            {
                $sql = 'UPDATE member SET fname=?,lname=? WHERE id_member=?';
            }
            else if(isset($type))
            {
                $sql = 'UPDATE member SET id_code=?,type=? WHERE id_member=?';
            }
            else if(isset($id_code))
            {
                $sql = 'UPDATE member SET id_code=? WHERE id_member=?';
            }
            $stmt = $con->prepare($sql);
            if(isset($fname) && isset($lname))
            {
                $check = $stmt->execute([$fname,$lname,$id_member]);
                $_SESSION['member']['fname'] = $fname;
                $_SESSION['member']['lname'] = $lname;
            }
            else if(isset($type))
            {
                if($type == "นิสิต")
                {
                    $check = $stmt->execute([$id_code,$type,$id_member]);
                }
                else
                {
                    $check = $stmt->execute([NULL,$type,$id_member]);
                }
                $_SESSION['member']['type'] = $type;
            }
            else if(isset($id_code))
            {
                $check = $stmt->execute([$id_code,$id_member]);
                $_SESSION['member']['id_code'] = $id_code;
            }
            return $check;
        }
        public static function updatePassMember($id_member,$passwd)
        {
            $con = conDb::getInstance();
            $strPassword = password_hash($passwd,PASSWORD_DEFAULT);
            $stmt = $con->prepare('UPDATE member SET passwd=? WHERE id_member=?');
            $check = $stmt->execute([$strPassword,$id_member]);
            return $check;
        }
        public static function upload_image($data_img,$id_member,$username)
        {      
            $con = conDb::getInstance();
            $stmt = $con->prepare('SELECT img_user FROM member WHERE id_member = ?');
            $stmt->execute([$id_member]);
            $result = $stmt->fetch();
            $img_user = $result['img_user'];
            if($img_user != 'imagesProfile/image-Profile.png')
            {
                unlink($img_user);
            }
            $data = $data_img;
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            clearstatcache();
            file_put_contents('imagesProfile/'.$username.'.png', $data);
            $stmt = $con->prepare('UPDATE member SET img_user= ? WHERE id_member=?');
            $_SESSION['member']['img_user'] = 'imagesProfile/'.$username.'.png';
            $check = $stmt->execute(['imagesProfile/'.$username.'.png',$id_member]);
        }
        public static function deleteUser($id_member)
        {   
            $con = conDb::getInstance();
            /*$check_value = true;
            $check = false;
            $stmt = $con->prepare('SELECT * FROM member 
            INNER JOIN work on work.patron_id = member.id_member WHERE member.id_member = ?');
            $stmt->execute([$id_member]);
            if($stmt->rowCount() > 0)
            {
                $check_value = false;
                $stmt = $con->prepare('SELECT * FROM member 
                INNER JOIN work on work.person_id = member.id_member
                WHERE member.id_member = ?');
                $stmt->execute([$id_member]);
                if($stmt->rowCount() > 0)
                {
                    $check_value = false;
                }
            }
            else
            {
                $stmt = $con->prepare('SELECT * FROM member 
                INNER JOIN work on work.person_id = member.id_member 
                WHERE member.id_member = ?');
                $stmt->execute([$id_member]);
                if($stmt->rowCount() > 0)
                {
                    $check_value = false;
                }
            }*/
            /*if($check_value)
            {*/
                $stmt = $con->prepare('DELETE FROM member WHERE member.id_member = ?');
                $check = $stmt->execute([$id_member]);
            //}
            return $check;
            
        }
    }
?>
