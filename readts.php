<?php
$status = $_POST['status'];


// print_r($status);

//$data=$_REQUEST;
//print_r($data);

//exit;

$servername ="localhost";
$username = "tds";
$password = "tds123";
$dbname = "tds";
$table = "device_deadline";
date_default_timezone_set('Asia/Kolkata');


$action = $_POST["action"];

$conn = new mysqli($servername,$username,$password,$dbname);


if($conn->connect_error){
    die("Connection Failed".$conn->connect_error);
    return;
}


if("GET_ALL" == $action){
    $ID = $_POST['DEVICE_ID'];
    $db_data = array();
    $sql = "SELECT * FROM $table WHERE device_id IN ($ID)";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $db_data[] = $row;
        }
        echo json_encode($db_data);
    }else{
        echo "error";
    }
    $conn->close();
    return;
}

if("GET_TIME" == $action){
    $tm = getdate();
    $db_tm[] = $tm;
    echo json_encode($db_tm);
    $conn->close();
    return;
}

if("UPDATE_CTRL" == $action)
{
    $DEVICE_ID = $_POST['DEVICE_ID'];
    $CONTROL = $_POST['CONTROL'];
    $sql = "UPDATE $table SET device_status='$CONTROL' WHERE device_id='$DEVICE_ID'";
    $result = $conn->query($sql);
    $conn->close();
    return;
}
?>
