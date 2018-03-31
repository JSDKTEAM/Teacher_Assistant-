<?php
    class YearMember{
       private $objMember;
       private $objYearSchool;

       public function __construct($yearMember)
       {
             $this->objMember = new Member($yearMember['id_member'],$yearMember['id_code'],$yearMember['username'],$yearMember['passwd'],$yearMember['fname'],$yearMember['lname'],$yearMember['type'],$yearMember['img_user']);
             $this->objYearSchool = new YearSchool($yearMember);
       }
       public static function getAllYearMember()
       {
            $con = conDb::getInstance();
            $stmt = $con->query('SELECT * FROM year_school
            WHERE DATE(year_school.start_date) <= DATE(CURDATE()) AND DATE(year_school.end_date) >= DATE(CURDATE())');
            $result = $stmt->fetch();
            $id_year = $result['id_year'];
            $stmt = $con->prepare('SELECT member.id_member,member.id_code,member.username,member.passwd,member.fname,member.lname,member.img_user,year_school.id_year,year_school.start_date,year_school.end_date FROM year_member 
            INNER JOIN member ON member.id_member = year_member.id_member
            INNER JOIN year_school on year_school.id_year = year_member.id_year
            WHERE year_member.id_year = ? AND member.type = ?');
            $stmt->execute([$id_year,'นิสิต']);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $key=>$value)
            {
                $year_member_list[] = new YearMember($value);
            }
            return $year_member_list;
       }
    }
?>