<?php
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
        $this->objPatron = new Member($work['id_patron'],'-',$work['userPatron'],$work['passwdPatron'],$work['fnamePatron'],$work['lnamePatron'],$work['typePatron']);
        $this->objPerson = new Member($work['id_person'],'-',$work['userPerson'],$work['passwdPerson'],$work['fnamePerson'],$work['lnamePerson'],$work['typePerson']);
        $this->used_time = $work['used_time'];
        $this->summary = $work['summary'];
        $this->objYearSchool = new YearSchool($work);
    }
    public static function getAllWork()
    {
        $con = conDb::getInstance();
        $stmt = $con->query('SELECT work.id_work,work.title,work.time_start,work.time_stop,work.detail,work.status,work.created_date,work.due_date,work.used_time,work.summary,patron.id_member AS id_patron,patron.username AS userPatron,
        patron.passwd AS passwdPatron , patron.fname AS fnamePatron , patron.lname  AS lnamePatron , patron.type AS typePatron , person.id_member AS id_person , person.id_code,person.username AS userPerson , person.passwd AS passwdPerson , person.fname AS fnamePerson , person.lname AS lnamePerson , person.type AS typePerson,
        year_school.id_year,year_school.start_date,year_school.end_date FROM work
        INNER JOIN member as patron ON patron.id_member = work.patron_id
        INNER JOIN member as person ON person.id_member = work.person_id
        INNER JOIN year_school ON year_school.id_year = work.id_year');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $key=>$value)
        {
            $work_list[] = new Work($value);
        }
        return $work_list;
    }
 }
?>