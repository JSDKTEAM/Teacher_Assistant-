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
        public static function getMemberByYear()
        {
            $con = conDb::getInstance();
            $stmt = $con->query('SELECT * FROM year_school
            WHERE DATE(year_school.start_date) <= DATE(CURDATE()) AND DATE(year_school.end_date) >= DATE(CURDATE())');
            $result = $stmt->fetch();
            $id_year = $result['id_year'];
            $stmt = $con->query("SELECT * FROM member 
                                 LEFT JOIN year_member ON year_member.id_member = member.id_member
                                 WHERE year_member.id_year IS NULL");
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
        public static function updateMember($id_member,$fname,$lname,$username,$type)
        {
            $con = conDb::getInstance();
            $stmt = $con->prepare('UPDATE member SET username=?,fname=?,lname=?,type=? WHERE id_code=?');
            $stmt->execute([$username,$fname,$lname,$type,$id_member]);
        }
        public static function updatePassMember($id_member,$passwd)
        {
            $con = conDb::getInstance();
            $strPassword = password_hash($passwd,PASSWORD_DEFAULT);
            $stmt = $con->prepare('UPDATE member SET passwd=? WHERE id_code=?');
            $stmt->execute([$passwd,$id_member]);
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
