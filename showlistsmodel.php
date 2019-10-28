
<?php
include("config.php"); // incude �����������������¡��ҹ
$mysqli = connect();

    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = $mysqli->query("SELECT DISTINCT Model FROM orderjob WHERE Model LIKE '".$searchTerm."%' ORDER BY Model ASC LIMIT 10");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['Model'];
    }
    
    //return json data
    echo json_encode($data);;

?>