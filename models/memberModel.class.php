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
        public function __construct($id_member,$id_code,$username,$passwd,$fname,$lname,$type)
        {
            $this->id_member = $id_member;
            $this->id_code = $id_code;
            $this->username = $username;
            $this->passwd = $passwd;
            $this->fname = $fname;
            $this->lname = $lname;
            $this->type = $type;
        }
        public static function getAllMember()
        {
            $con = conDb::getInstance();
            $stmt = $con->query('SELECT * FROM member');
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $key=>$value)
            {
                $member_list[] = new Member($value['id_member'],$value['id_code'],$value['username'],$value['passwd'],$value['fname'],$value['lname'],$value['type']);
            }
            //$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Member');
            //$result = $stmt->fetchAll();
            return $member_list;
        }
        public static function addMember()
        {
            $con = conDb::getInstance();
            $stmt = $con->prepare('INSERT INTO member()');
        }
    }
?>
