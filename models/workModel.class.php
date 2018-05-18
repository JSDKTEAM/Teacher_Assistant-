<?php
//select Sum(Left(work.used_time,2) * 3600 + substring(work.used_time, 4,2) * 60 + substring(work.used_time, 7,2)) /60 from work
 require_once('connection_connect.php');
 class Work{
    private $id_work;
    private $title;
    private $time_start;
    private $time_stop;
    private $detail;
    private $status;
    private $created_date;
    private $due_date;
    private $objPatron;
    private $objPerson;
    private $used_time;
    private $summary;
    private $objYearSchool;
    public function get_id_work()
    {
        return $this->id_work;
    }
    public function get_title()
    {
        return $this->title;
    }
    public function get_time_start()
    {
        return $this->time_start;
    }
    public function get_time_stop()
    {
        return $this->time_stop;
    }
    public function get_detail()
    {
        return $this->detail;
    }
    public function get_status()
    {
        return $this->status;
    }
    public function get_created_date()
    {
        return $this->created_date;
    }
    public function get_due_date()
    {
        return $this->due_date;
    }
    public function get_objPatron()
    {
        return $this->objPatron;
    }
    public function get_objPerson()
    {
        return $this->objPerson;
    }
    public function get_used_time()
    {
        return $this->used_time;
    }
    public function get_summary()
    {
        return $this->summary;
    }
    public function get_objYearSchool()
    {
        return $this->objYearSchool;
    }
    public function __construct($work)
    {
        $this->id_work = $work['id_work'];
        $this->title = $work['title'];
        $this->time_start = $work['time_start'];
        $this->time_stop = $work['time_stop'];
        $this->detail = $work['detail'];
        $this->status = $work['status'];
        $this->created_date = $work['created_date'];
        $this->due_date = $work['due_date'];
        $this->objPatron = new Member($work['id_patron'],'-',$work['userPatron'],$work['passwdPatron'],$work['fnamePatron'],$work['lnamePatron'],$work['typePatron'],$work['patron_img']);
        $this->objPerson = new Member($work['id_person'],$work['id_code'],$work['userPerson'],$work['passwdPerson'],$work['fnamePerson'],$work['lnamePerson'],$work['typePerson'],$work['person_img']);
        $this->used_time = $work['used_time'];
        $this->summary = $work['summary'];
        $this->objYearSchool = new YearSchool($work);
    }
    public function DateTimeThai($strDate)
    {
        if(isset($strDate))
        {
            $strYear = date("Y",strtotime($strDate))+543;
            $strMonth= date("n",strtotime($strDate));
            $strDay= date("j",strtotime($strDate));
            $strHour= date("H",strtotime($strDate));
            $strMinute= date("i",strtotime($strDate));
            $strSeconds= date("s",strtotime($strDate));
            $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
            $strMonthThai=$strMonthCut[$strMonth];
            return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
        }
        else
        {
            return '';
        }
    }
    public function DateThai($strDate)
	{
        if(isset($strDate))
        {
            $strYear = date("Y",strtotime($strDate))+543;
            $strMonth= date("n",strtotime($strDate));
            $strDay= date("j",strtotime($strDate));
            $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
            $strMonthThai=$strMonthCut[$strMonth];
            return "$strDay $strMonthThai $strYear";
        }
        else
        {
            return '';
        }
	}
    public static function getAllWork()
    {
        $con = conDb::getInstance();
        $stmt = $con->query('SELECT * FROM year_school
        WHERE DATE(year_school.start_date) <= DATE(CURDATE()) AND DATE(year_school.end_date) >= DATE(CURDATE())');
        $result = $stmt->fetch();
        $id_year = $result['id_year'];
        $stmt = $con->query("SELECT work.id_work,work.title,DATE(work.time_start) AS time_start,DATE(work.time_stop) AS time_stop,work.detail,work.status,work.created_date,DATE(work.due_date) AS due_date ,work.used_time,work.summary,patron.id_member AS id_patron,patron.username AS userPatron,
        patron.passwd AS passwdPatron , patron.fname AS fnamePatron , patron.lname  AS lnamePatron , patron.type AS typePatron,patron.img_user AS patron_img , person.id_member AS id_person , person.id_code,person.username AS userPerson , person.passwd AS passwdPerson , person.fname AS fnamePerson , person.lname AS lnamePerson , person.type AS typePerson
        ,person.img_user AS person_img,year_school.id_year,year_school.start_date,year_school.end_date FROM work
        INNER JOIN member as patron ON patron.id_member = work.patron_id
        LEFT JOIN member as person ON person.id_member = work.person_id
        INNER JOIN year_school ON year_school.id_year = work.id_year
        WHERE work.id_year = $id_year ORDER BY work.created_date DESC" );
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result)
        {
            foreach($result as $key=>$value)
            {
                $work_list[] = new Work($value);
            }
            return $work_list;
        }
        else
        {
            return false;
        }
        
    }
    public static function searchWork($id_year)
    {
        $con = conDb::getInstance();
        $stmt = $con->query("SELECT work.id_work,work.title,DATE(work.time_start) AS time_start,DATE(work.time_stop) AS time_stop,work.detail,work.status,work.created_date,work.due_date,work.used_time,work.summary,patron.id_member AS id_patron,patron.username AS userPatron,
        patron.passwd AS passwdPatron , patron.fname AS fnamePatron , patron.lname  AS lnamePatron , patron.type AS typePatron,patron.img_user AS patron_img , person.id_member AS id_person , person.id_code,person.username AS userPerson , person.passwd AS passwdPerson , person.fname AS fnamePerson , person.lname AS lnamePerson , person.type AS typePerson
        ,person.img_user AS person_img,year_school.id_year,year_school.start_date,year_school.end_date FROM work
        INNER JOIN member as patron ON patron.id_member = work.patron_id
        LEFT JOIN member as person ON person.id_member = work.person_id
        INNER JOIN year_school ON year_school.id_year = work.id_year
        WHERE work.id_year = $id_year ORDER BY work.created_date DESC" );
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result)
        {
            foreach($result as $key=>$value)
            {
                $work_list[] = new Work($value);
            }
            return $work_list;
        }
        else
        {
            return false;
        }
    }
    public static function getWork($id_work)
    {
        $con = conDb::getInstance();
        $stmt = $con->query("SELECT work.id_work,work.title,DATE(work.time_start) AS time_start,DATE(work.time_stop) AS time_stop,work.detail,work.status,work.created_date,DATE(work.due_date) AS due_date,work.used_time,work.summary,patron.id_member AS id_patron,patron.username AS userPatron,
        patron.passwd AS passwdPatron , patron.fname AS fnamePatron , patron.lname  AS lnamePatron , patron.type AS typePatron,patron.img_user AS patron_img , person.id_member AS id_person , person.id_code,person.username AS userPerson , person.passwd AS passwdPerson , person.fname AS fnamePerson , person.lname AS lnamePerson , person.type AS typePerson,
        person.img_user AS person_img,year_school.id_year,year_school.start_date,year_school.end_date FROM work
        INNER JOIN member as patron ON patron.id_member = work.patron_id
        LEFT JOIN member as person ON person.id_member = work.person_id
        INNER JOIN year_school ON year_school.id_year = work.id_year
        WHERE work.id_work = $id_work ORDER BY work.created_date DESC");
        $result = $stmt->fetch();
        if($result)
        {
            return new Work($result);
        }
        else
        {
            return false;
        }
    }
    public static function getAllWorkByMember($id_member,$type)
    {
        $con = conDb::getInstance();
        if($type == 'นิสิต')
        {
            $stmt = $con->prepare('SELECT work.id_work,work.title,DATE(work.time_start) AS time_start,DATE(work.time_stop) AS time_stop,work.detail,work.status,work.created_date,work.due_date,work.used_time,work.summary,patron.id_member AS id_patron,patron.username AS userPatron,
            patron.passwd AS passwdPatron , patron.fname AS fnamePatron , patron.lname  AS lnamePatron , patron.type AS typePatron,patron.img_user AS patron_img , person.id_member AS id_person , person.id_code,person.username AS userPerson , person.passwd AS passwdPerson , person.fname AS fnamePerson , person.lname AS lnamePerson , person.type AS typePerson
            ,person.img_user AS person_img,year_school.id_year,year_school.start_date,year_school.end_date FROM work
            INNER JOIN member as patron ON patron.id_member = work.patron_id
            LEFT JOIN member as person ON person.id_member = work.person_id
            INNER JOIN year_school ON year_school.id_year = work.id_year WHERE  person.id_member = ? ORDER BY work.created_date DESC');
        }
        else
        {
            $stmt = $con->prepare('SELECT work.id_work,work.title,DATE(work.time_start) AS time_start,DATE(work.time_stop) AS time_stop,work.detail,work.status,work.created_date,work.due_date,work.used_time,work.summary,patron.id_member AS id_patron,patron.username AS userPatron,
            patron.passwd AS passwdPatron , patron.fname AS fnamePatron , patron.lname  AS lnamePatron , patron.type AS typePatron,patron.img_user AS patron_img , person.id_member AS id_person , person.id_code,person.username AS userPerson , person.passwd AS passwdPerson , person.fname AS fnamePerson , person.lname AS lnamePerson , person.type AS typePerson
            ,person.img_user AS person_img,year_school.id_year,year_school.start_date,year_school.end_date FROM work
            INNER JOIN member as patron ON patron.id_member = work.patron_id
            LEFT JOIN member as person ON person.id_member = work.person_id
            INNER JOIN year_school ON year_school.id_year = work.id_year WHERE  patron.id_member  = ? ORDER BY work.created_date DESC');
        }     
        $stmt->execute([$id_member]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result)
        {
            foreach($result as $key=>$value)
            {
                $work_list[] = new Work($value);
            }
            return $work_list;
        }
        else
        {
            return false;
        }
    }
    public static function updateStatusWork($person_id,$id_work,$status)
    {
        $con = conDb::getInstance();
        $stmt = $con->prepare('UPDATE work SET person_id = ?,status = ? WHERE id_work = ?');
        $check = $stmt->execute([$person_id,$status,$id_work]);
        return $check;
    }
    public static function finishWork($id_work,$due_date,$HH,$mm,$summary)
    {
        $con = conDb::getInstance();
        $stmt = $con->prepare('UPDATE work SET due_date = CURDATE() , used_time = ? , summary = ? , status = ? WHERE id_work = ?');
        $check = $stmt->execute(["$HH:$mm:0",$summary,'finish',$id_work]);
        return $check;
    }
    public static function addWork($patron_id,$title,$detail,$time_start,$time_stop)
    {
        $con = conDb::getInstance();
        $stmt = $con->query('SELECT * FROM year_school
        WHERE DATE(year_school.start_date) <= DATE(CURDATE()) AND DATE(year_school.end_date) >= DATE(CURDATE())');
        $result = $stmt->fetch();
        $id_year = $result['id_year'];
        echo $time_start;
        $stmt = $con->prepare('INSERT INTO work(patron_id,title,detail,time_start,time_stop,id_year,status) VALUES(?,?,?,?,?,?,?)');
        $check = $stmt->execute([$patron_id,$title,$detail,$time_start,$time_stop,$id_year,'waiting']);
        return $check;
    }
    public static function editPatronWork($id_work,$id_patron)
    {
        $con = conDb::getInstance();
        $stmt = $con->prepare('UPDATE work SET patron_id = ? WHERE id_work = ?');
        $check = $stmt->execute([$id_patron,$id_work]);
        return $check;
    }
    public static function editPersonWork($id_work,$id_person)
    {
        $con = conDb::getInstance();
        $stmt = $con->prepare('UPDATE work SET  person_id = ? WHERE id_work = ?');
        $check = $stmt->execute([$id_person,$id_work]);
        return $check;
    }
    public static function editWork($id_work,$title,$time_start,$time_stop,$detail)
    {
        $con = conDb::getInstance();
        $stmt = $con->prepare('UPDATE work SET  title = ? , time_start = ? , time_stop = ? , detail = ? WHERE id_work = ?');
        $check = $stmt->execute([$title,$time_start,$time_stop,$detail,$id_work]);
        return $check;
    }
    public static function deleteWork($id_work)
    {
        $con = conDb::getInstance();
        $stmt = $con->prepare('DELETE FROM work WHERE id_work = ?');
        $check = $stmt->execute([$id_work]);
        return $check;
    }
    public static function getYearWork()
    {
        $con = conDb::getInstance();
        $stmt = $con->query('SELECT DISTINCT YEAR(work.created_date) year FROM work ');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }
    public static function countStatus($id_member,$type)
    {
        $waiting = 0;
        $booked = 0;
        $finish = 0;
        $con = ConDb::getInstance();
        if($type == 'นิสิต')
        {
            $sql = 'SELECT work.status , COUNT(work.status) AS count_st FROM work WHERE work.person_id = ? GROUP BY work.status';
        }
        else 
        {
            $sql = 'SELECT work.status , COUNT(work.status) AS count_st FROM work WHERE work.patron_id = ? GROUP BY work.status'; 
        }
        $stmt = $con->prepare($sql);
        $stmt->execute([$id_member]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result)
        {
            foreach($result as $key=>$value)
            {
                if($value['status'] == 'waiting')
                {
                    $waiting = $value['count_st'];
                }
                else if($value['status'] == '$booked')
                {
                    $booked = $value['count_st'];
                }
                else if($value['status'] == 'finish')
                {
                    $finish = $value['count_st'];
                }
            }
        }
        return array('waiting'=>$waiting,'booked'=>$booked,'finish'=>$finish);
        
    }
 }
?>