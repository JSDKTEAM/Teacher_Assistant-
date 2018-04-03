<?php
    header('Content-type: application/json');
    require('../../connection_connect.php');
    $year = $_REQUEST['year'];
    $con = ConDb::getInstance();
    $stmt = $con->prepare('SELECT DISTINCT member.id_member,member.fname,member.lname FROM work 
    INNER JOIN member ON member.id_member = work.person_id
    WHERE YEAR(work.created_date) = ?');
    $stmt->execute([$year]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $key=>$value)
    {
        $data[] = $value;
    }
    print json_encode($data);
?>