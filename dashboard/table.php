<?php

$status="";
$servername = "localhost"; 
$usernamedb = "root";
$passworddb = ""; 
$dbname = "ppwauth2";
try{
    $conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);}
    catch(Exception $e){
        echo "Error connecting to database, pastikan format database benar (ikuti langkah file catatan): <br>";
        echo $e->getMessage();
        die("Connection failed: " . $conn->connect_error);
    }
if ($conn->connect_error) {
    echo "Error connecting to database, pastikan format database benar (ikuti langkah file catatan): ";    
    die("Connection failed: " . $conn->connect_error);
}
/*
    $adminId= $_GET['adminId'];
    $sql = "SELECT * FROM auth WHERE id=$adminId";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();
    $username=$row['username'];
    $role=$row['role'];
  */ 


?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="table.css">
    </head>
    <body>
        <div class="mainDiv">
            <div class="mainLeftDiv">
            <div class="commonDiv"></div>
                    <div class="cardLeft">
                        <div class="commonDiv"><img src="./assets/<?php echo $adminId?>.jpeg" style="border-radius:50%"
                            height="90px" width="90px"> </div>
                            
                            <div class="commonDiv"><p><?php echo $role?></p> </div>
                    </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="commonOption"><a><img src="assets/logoTable.png" height="14px" width="14px">
                    Table Data</a> </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="commonOption"><a href=<?php echo "./regfunc.php"?>><img src="assets/plus.png" height="16px" width="16px">
                    Tambah Data</a> </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="commonOption"><a class="delete" href=<?php echo "/"?>><img src="assets/logout.png" height="19px" width="19px">
                    Logout</a> </div>

            </div>
            <div class="mainRightDiv">
                <div class="commonDiv"></div>
                <div class="block" style="min-height:45px;" name="block2"><p>SIAKAD UNJ - ADMIN</p>
                <div class="block" style="min-height:25px;" name="block2"></div>
                    <img src="./assets/logoUnj.png" alt="logo unj" height="38px" width="38px">
                </div>
                <div class="commonDiv">
                <?php
                    try{

                   
                    $urutan=1;    
                    $sql = "SELECT * FROM auth";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        echo '<table border="1">';
                        echo '<tr>
                        <th >No</th>
                
                        <th>Email</th>
                        <th>Password</th>
                
                        <th >Aksi</th>
                        </tr>';


                        while ($row = $result->fetch_assoc()) {
                        //  echo $row["Foto"];
                            echo '<tr>';
                            echo '<td ><div class="commonDiv">' . $urutan . '</div></td>';
                    //        echo '<td ><div class="commonDiv">' . $row["username"] . '</div></td>';
                            echo '<td ><div class="commonDiv">' . $row["email"] . '</div></td>';
                            echo '<td ><div class="commonDiv">' . $row["password"] . '</div></td>';
              
                            echo '<td ><div class="commonDiv">
                            
                            <a class="delete" href="./delete.php?adminId='.$row["id"].'">DELETE</a>
                            </div></td>';
                            echo '</tr>';
                            $urutan+=1;
                        }

                        echo '</table>';
                    } else {
                        echo 'No data in the database.';
                    }


                    $conn->close();}
                    catch (Exception $e) {
                        echo "<p>koneksi eror,pastikan database sudah diinstal pada mysql dan pastikan credentials sudah sesuai database anda</p>",$e->getMessage(), "\n";;
                    
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>