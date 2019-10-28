<?php
include("config.php"); // incude �����������������¡��ҹ
$mysqli = connect();

    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = $mysqli->query("SELECT DISTINCT Company FROM orderjob WHERE Company LIKE '".$searchTerm."%' ORDER BY Company ASC LIMIT 10");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['Company'];
    }
    
    //return json data
    echo json_encode($data);;


?>
