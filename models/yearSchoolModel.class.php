<?php
    require_once('connection_connect.php');
    class YearSchool{
        private $id_year;
        private $start_date;
        private $end_date;
        public function get_id_year()
        {
            return $this->id_year;
        }
        public function get_start_date()
        {
            return $this->start_date;
        }
        public function get_end_date()
        {
            return $this->end_date;
        }
        public function __construct($yearObj =  NULL)
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
                $yearSchool_list[] = new YearSchool($value);
            }
            return $yearSchool_list;
        }
        
        public static function add_yearschool($id_year, $start_date,$end_date)
        {
            $con = conDb::getInstance();
            $stmt = $con->prepare('INSERT INTO `year_school`(`id_year`, `start_date`, `end_date`) VALUES (?,?,?)');
            $check = $stmt->execute([$id_year, $start_date,$end_date]);
            return $check;
        }
        public static function delect_yearschool($id_year)
        {

            $con = conDb::getInstance();
            $stmt = $con->prepare('DELETE FROM `year_school` WHERE $id_year = ?');
            $check = $stmt->execute([$id_year]);
            return $check ;

        }
        public static function update_yearschool($id_year,$start_date,$end_date)
        {
            $con = conDb::getInstance();
            $stmt = $con->prepare('UPDATE `year_school` SET`start_date`=?,`end_date`=? WHERE `id_year`=? ');
            $check = $stmt->execute([$start_date,$end_date,$id_year]);
            return $check;


        }


    }
?>