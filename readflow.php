<?php
$status = $_POST['status'];

// print_r($status);

$data=$_REQUEST;
//print_r($data);

//exit;

$servername ="localhost";
$username = "tds";
$password = "tds123";
$dbname = "tds";
$table = 'device_tds';

$action = $_POST["action"];

$conn = new mysqli($servername,$username,$password,$dbname);


if($conn->connect_error){
    die("Connection Failed".$conn->connect_error);
    return;
}


if("UPDATE_FLOW" == $action){
    $device_id = $_POST['device_id'];
    $litre = $_POST['litre'];
    $tds = $_POST['tds'];
    $status = $_POST['status'];
    $sql = "INSERT INTO $table (device_id, litre, tds, status, created_on) VALUES ('$device_id','$litre','$tds','$status',current_timestamp())";
    $result = $conn->query($sql);
    $conn->close();
    return;   
}
?>
