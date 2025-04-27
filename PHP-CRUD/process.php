<?php

session_start();

$mysqli = new mysqli('localhost', 'root', 'Andrei12345', 'db_pms')or die(mysqli_error($mysql));

$id = 0;
$update = false;
$name = '';
$address = '';


if (isset($_POST['save'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    
    $mysqli->query("INSERT INTO tbl_patient(name,address) VALUES('$name','$address')")or die($mysqli->error);
    
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
     
    header("location: index.php");
}

else if (isset ($_GET['delete'])){
    $patient_id = $_GET['delete'];
    $mysqli->query("DELETE FROM tbl_patient WHERE patient_id=$patient_id") or die($mysqli->error());
     
    $_SESSION['message']= "Record has been deleted!";
    $_SESSION['msg_type']= "danger";

}

if (isset ($_GET['edit'])){
    $patient_id= $_GET['edit'];
    $update= true;
    $result = $mysqli->query("SELECT * FROM tbl_patient WHERE patient_id=$patient_id")or die($mysqli->error);
    if($result->num_rows == 1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $address = $row['address'];
    }
}

if (isset($_POST['update'])){
    $patient_id = $_POST['patient_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];

    $mysqli->query("UPDATE tbl_patient SET name='$name', address='$address' WHERE patient_id=$patient_id")or die($mysqli->error);
    
    $_SESSION['message']= "Record has been updated!";
    $_SESSION['msg_type']="warning";
   
    header("location: index.php");

}