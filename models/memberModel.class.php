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
        public static function validateUsername($username)
        {
            header('Content-type: application/json');
            $con = ConDb::getInstance();
            $stmt = $con->prepare('SELECT member.username FROM member WHERE member.username = ?');
            $stmt->execute([$username]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($result)
            {
                $data = array("check"=>TRUE);
            }
            else
            {
                $data = array("check"=>TRUE);
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
            WHERE YEAR(work.created_date) = ?');
            $stmt->execute([$year]);
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
            WHERE work.person_id = ? AND YEAR(work.created_date) = ?
            GROUP BY work.person_id,YEAR(work.created_date),MONTHNAME(work.created_date)
            ORDER BY MONTH(work.created_date)');
            $stmt->execute([$person_id,$year]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $key=>$value)
            {
                $data[] = $value;
            }
            $stmt = $con->prepare('SELECT Sum(Left(work.used_time,2) * 3600 + substring(work.used_time, 4,2) * 60 + substring(work.used_time, 7,2)) /60 AS timeWork from work WHERE work.person_id = ?');
            $stmt->execute([$person_id]);
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
        public static function getMemberByYear()
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
        public static function addMemberMm($fname,$lname,$username,$passwd,$type)
        {
            $con = conDb::getInstance();
            $strPassword = password_hash($passwd,PASSWORD_DEFAULT);
            $stmt = $con->prepare('INSERT INTO member(fname,lname,username,passwd,type) VALUES(?,?,?,?,?)');
            $check = $stmt->execute([$fname,$lname,$username,$strPassword,$type]);
            return $check;
        }
        public static function addMemberSys($array_member)
        {   
            $con = conDb::getInstance();
            $stmt = $con->query('SELECT * FROM year_school
            WHERE DATE(year_school.start_date) <= DATE(CURDATE()) AND DATE(year_school.end_date) >= DATE(CURDATE())');
            $result = $stmt->fetch();
            $id_year = $result['id_year'];
            $stmt = $con->prepare('INSERT INTO year_member(id_member,id_year) VALUES(?,?)');
            foreach($array_member as $key=>$value)
            {
                $check = $stmt->execute([$value,$id_year]);
            }
            return $check;
            
        }
        public static function updateInfo($id_member,$id_code,$fname,$lname)
        {
            $con = conDb::getInstance();
            $stmt = $con->prepare('UPDATE member SET id_code = ?,fname=?,lname=? WHERE id_member = ?');
            $check = $stmt->execute([$id_code,$fname,$lname,$id_member]);
            if($check === TRUE)
            {
                $_SESSION['member']['id_code'] = $id_code;
                $_SESSION['member']['fname'] = $fname;
                $_SESSION['member']['lname'] = $lname;
            }
            return $check;
        }
        public static function updateMember($id_member,$id_code,$fname,$lname,$type)
        {
            $con = conDb::getInstance();
            $stmt = $con->prepare('UPDATE member SET id_code=?,fname=?,lname=?,type=? WHERE id_member=?');
            $stmt->execute([$id_code,$fname,$lname,$type,$id_member]);
        }
        public static function updatePassMember($id_member,$passwd)
        {
            $con = conDb::getInstance();
            $strPassword = password_hash($passwd,PASSWORD_DEFAULT);
            $stmt = $con->prepare('UPDATE member SET passwd=? WHERE id_member=?');
            $stmt->execute([$strPassword,$id_member]);
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
            file_put_contents('imagesProfile/'.$username.'.png', $data);
            $stmt = $con->prepare('UPDATE member SET img_user= ? WHERE id_member=?');
            $_SESSION['member']['img_user'] = $img_user;
            $check = $stmt->execute(['imagesProfile/'.$username.'.png',$id_member]);
        }
    }
?>
