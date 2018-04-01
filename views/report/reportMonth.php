<?php
    header('Content-type: application/json');
    require('../../connection_connect.php');
    $person_id = $_REQUEST['person_id'];
    $year = $_REQUEST['year'];
    $con = ConDb::getInstance();
    $stmt = $con->prepare('SELECT work.person_id,YEAR(work.created_date) as y,MONTHNAME(work.created_date) AS m,COUNT(work.id_work) AS work_count  FROM work 
    WHERE work.person_id = ? AND YEAR(work.created_date) = ?
    GROUP BY work.person_id,YEAR(work.created_date),MONTHNAME(work.created_date)
    ORDER BY m');
    $stmt->execute([$person_id,$year]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $key=>$value)
    {
        $data[] = $value;
    }
    print json_encode($data);
?>