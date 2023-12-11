<?php

$servername = "ned.masuk.id"; 
$usernamedb = "uiulutbl_siakad";
$passworddb = "siakad@123"; 
$dbname = "uiulutbl_ppw_auth";


try{
    $conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);}
    catch(Exception $e){
        echo "Error connecting to database, pastikan format database benar (ikuti langkah file catatan): <br>";
        echo $e->getMessage();
        die("Connection failed: " . $conn->connect_error);
    }

   
if ($conn->connect_error) {
    
    die("Connection failed: " . $conn->connect_error);
}
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id=$_GET['adminId'];
  //  $id=$_GET['id'];
    $sql2="DELETE FROM akun WHERE id=$id";
    $result = $conn->query($sql2);
    $sql2="DELETE FROM auth WHERE id=$id";
    $result = $conn->query($sql2);
    $sql2="DELETE FROM biodata WHERE id=$id";
    $result = $conn->query($sql2);
    $sql2="DELETE FROM matkulkhs WHERE id=$id";
    $result = $conn->query($sql2);
    $sql2="DELETE FROM matkulkrs WHERE id=$id";
    $result = $conn->query($sql2);
    header("Location: ./table.php?");
}

?>