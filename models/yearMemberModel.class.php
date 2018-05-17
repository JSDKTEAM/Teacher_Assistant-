<?php
    class YearMember{
       private $objMember;
       private $objYearSchool;

       public function __construct($yearMember)
       {
             $this->objMember = new Member($yearMember['id_member'],$yearMember['id_code'],$yearMember['username'],$yearMember['passwd'],$yearMember['fname'],$yearMember['lname'],$yearMember['type'],$yearMember['img_user']);
             $this->objYearSchool = new YearSchool($yearMember);
       }
       public function get_objMember()
       {
           return $this->objMember;
       }
       public function get_objYearSchool()
       {
           return $this->objYearSchool;
       }
       public static function getAllYearMember()
       {
            $con = conDb::getInstance();
            $stmt = $con->query('SELECT * FROM year_school
            WHERE DATE(year_school.start_date) <= DATE(CURDATE()) AND DATE(year_school.end_date) >= DATE(CURDATE())');
            $result = $stmt->fetch();
            $id_year = $result['id_year'];
            $stmt = $con->prepare('SELECT member.id_member,member.id_code,member.username,member.passwd,member.fname,member.lname,member.img_user,year_school.id_year,year_school.start_date,year_school.end_date,member.type FROM year_member 
            INNER JOIN member ON member.id_member = year_member.id_member
            INNER JOIN year_school on year_school.id_year = year_member.id_year
            WHERE year_member.id_year = ? AND member.type = ?');
            $stmt->execute([$id_year,'นิสิต']);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($result)
            {
                foreach($result as $key=>$value)
                {
                    $year_member_list[] = new YearMember($value);
                }
            }
            else{
                return false;
            }
            return $year_member_list;
       }
       public static function getMemberByYearSch($id_year)
       {
           $con = conDb::getInstance();
           $stmt = $con->query("SELECT * FROM year_member
           INNER JOIN year_school ON year_member.id_year = year_school.id_year 
           INNER JOIN member ON member.id_member = year_member.id_member
           WHERE year_member.id_year = $id_year");
           $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
           if($result)
           {
               foreach($result as $key=>$value)
               {
                   $member_list[] = new YearMember($value);
               }
           }
           else
           {
               return FALSE;
           }
           return $member_list;
       }
       public static function deleteStd($id_member,$id_year)
       {
           $con = conDb::getInstance();
           $stmt = $con->prepare('DELETE FROM year_member WHERE id_member = ? AND id_year = ?');
           $check = $stmt->execute([$id_member,$id_year]);
           return $check;
       }
    }
?>