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
$table = 'PSOC6';

$action = $_POST["action"];

$conn = new mysqli($servername,$username,$password,$dbname);


if($conn->connect_error){
    die("Connection Failed".$conn->connect_error);
    return;
}


if("GET_ALL" == $action){
    $ID = $_POST['DEVICE_ID'];
    $db_data = array();
    $sql = "SELECT * FROM $table WHERE DEVICE_ID IN ($ID)";
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

if("ADD_DEVICE" == $action){
    $DEVICE_ID = $_POST['DEVICE_ID'];
    $CONTROL = $_POST['CONTROL'];
    echo $DEVICE_ID;

    $sql = "SELECT DEVICE_ID FROM $table WHERE DEVICE_ID='$DEVICE_ID'";
    $result = $conn->query($sql);
    
    if($result==false)
    {
        echo "new record";
        $DATE_D = "0000-00-00";
        $TIME_D = "00:00:00";
        $sql = "INSERT INTO $table (DEVICE_ID, CONTROL, DATE_D, TIME_D, CUR_TIME) VALUES ('$DEVICE_ID','$CONTROL','$DATE_D','$TIME_D',current_timestamp())";
    }
    else
    {
        mysqli_free_result($result);
        echo "existing record";
        echo $CONTROL;
        echo $DEVICE_ID;
        $sql = "UPDATE $table SET CONTROL = '$CONTROL', CUR_TIME = current_timestamp() WHERE DEVICE_ID='$DEVICE_ID'";    
    }
    $result = $conn->query($sql);
    if($result==false)
    {
        echo "ABC";
    }
    else
    {
        echo "QWE";
    }
    $conn->close();
    return;       
}
?>
