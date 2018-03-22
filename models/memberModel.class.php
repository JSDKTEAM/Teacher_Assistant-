<?php
    class Member{
        private $id_member;
        private $id_code;
        private $username;
        private $passwd;
        private $f_name;
        private $l_name;
        private $status_user;
        public function get_id_member()
        {
            return $id_member;
        }
        public function get_id_code()
        {
            return $id_code;
        }
        public function __construct($id_member,$id_code,$username,$passwd,$f_name,$l_name,$status_user)
        {
            $this->id_member = $id_member;
            $this->id_code = $id_code;
            $this->username = $username;
            $this->passwd $passwd;
            $this->f_name =$f_name;
            $this->l_name = $l_name;
            $this->$status_user = $status_user;
        }
        
    }
?>