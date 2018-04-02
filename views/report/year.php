<?php
    header('Content-type: application/json');
    require('../../connection_connect.php');
    $person_id = $_REQUEST['person_id'];
    $con = ConDb::getInstance();
    $stmt = $con->prepare('SELECT DISTINCT YEAR(work.created_date) AS y FROM work
    WHERE work.person_id = ?');
    $stmt->execute([$person_id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $key=>$value)
    {
        $data[] = $value;
    }
    print json_encode($data);
?>