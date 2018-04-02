<?php
    header('Content-type: application/json');
    require('../../connection_connect.php');
    $year = $_REQUEST['year'];
    $con = ConDb::getInstance();
    $stmt = $con->prepare('SELECT member.fname,member.lname,work.person_id,work.id_year,COUNT(work.id_work) AS work_count FROM work 
    INNER JOIN member ON member.id_member = work.person_id
    WHERE work.id_year = ? 
    GROUP BY  work.person_id,work.id_year 
    ORDER BY work.id_year,work_count DESC');
    $stmt->execute([$year]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $key=>$value)
    {
        $data[] = $value;
    }
    print json_encode($data);
?>