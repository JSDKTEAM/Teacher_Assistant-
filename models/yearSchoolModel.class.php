<?php
    require_once('connection_connect.php');
    class YearSchool{
        private $id_year;
        private $start_date;
        private $end_date;
        public function construct($yearObj =  NULL)
        {
            $this->id_year = $yearObj['id_year'];
            $this->start_date = $yearObj['start_date'];
            $this->end_date = $yearObj['end_date'];
        }
        public static function getAllYearSchool()
        {
            $con = conDb::getInstance();
            $stmt = $con->query('SELECT * FROM year_school');
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $key=>$value)
            {
                $yearSchool_list = new YearSchool($value);
            }
            return $yearSchool_list;
        }
    }
?>