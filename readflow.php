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
date_default_timezone_set('Asia/Kolkata');

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
    $date=date_create(date());
    $tm = date_format($date,"Y-m-d H:i:s");
    $sql = "INSERT INTO $table (device_id, litre, tds, status, created_on) VALUES ('$device_id','$litre','$tds','$status','$tm')";
    $result = $conn->query($sql);
    $conn->close();
    return;   
}
?>
