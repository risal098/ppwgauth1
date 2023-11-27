<?php

$servername = "localhost"; 
$usernamedb = "root";
$passworddb = ""; 
$dbname = "utsiakad";
$status="";
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

    $adminId= $_GET['adminId'];

    $sql = "SELECT * FROM akun WHERE id=$adminId";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();
    $email=$row['email'];
   // $role=$row['role'];
   

   if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
   $NIM=($_POST['NIM']);
   $TAHUN=($_POST['TahunMasuk']);
   $NAMA=$_POST['NamaLengkap'];
   $FAKULTAS=$_POST['Fakultas'];
   $STATUS=$_POST['Status'];
   $ALAMAT=$_POST['Alamat'];
   
$sql="INSERT INTO `data_dasar`( `NIM`, `NAMA`,  `ALAMAT`,   `FAKULTAS`, `TAHUNMASUK`,`STATUSUKT`)
 VALUES ($NIM,'$NAMA','$ALAMAT','$FAKULTAS',$TAHUN,'$STATUS')";
$conn->query($sql);
header("Location: /table.php?adminId=$adminId");
}catch(Exception $e){ $status="make sure to check Tahun Masuk data type (integer only)<br> and make sure database connection is no problem";}


   

    
}
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
                        <div class="commonDiv"><img src="./assets/defaultAcc.png" style="border-radius:50%"
                            height="90px" width="90px"> </div>
                            <div class="commonDiv"><p><?php echo $email?></p> </div>
                            <div class="commonDiv"><p>admin</p> </div>
                    </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="commonOption"><a href=<?php echo "table.php?adminId=$adminId"?>><img src="assets/logoTable.png" height="16px" width="16px">Table Data</a> </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="commonOption"><a><img src="assets/plus.png" height="14px" width="14px">Tambah Data</a> </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="commonOption"><a class="delete" href=<?php echo "/login.php"?>><img src="assets/logout.png" height="19px" width="19px">
                    Logout</a> </div>
                
                    
            </div>
            <div class="mainRightDiv">
                <div class="commonDiv"></div>
                <div class="block" style="min-height:45px;" name="block2"><p>SIAKAD UNJ - ADMIN</p>
                <div class="block" style="min-height:25px;" name="block2"></div>
                    <img src="./assets/logoUnj.png" alt="logo unj" height="38px" width="38px">
                </div>
                <div class="commonDiv">
                    
                    <div class="cardEdit">
                <form method="post" action="/tambah.php?adminId=<?php echo $adminId ?>">
                    
                    
                    <div class="blocks" style="min-height:25px;" name="block2"><p>EDIT DATA</p></div>
                    <div class="commonDiv"><p style="color:red"><?php echo "$status"?></p></div>
                    <div class="commonLabel"><p>NIM:</p></div>
                    <input type="text" name="NIM"  placeholder="NIM" required>
                    <div class="commonLabel"><p>Nama Lengkap:</p></div>
                    <input type="text" name="NamaLengkap"  placeholder="Nama Lengkap"  required>
                    <div class="commonLabel"><p>Fakultas:</p></div>
                    <input type="text" name="Fakultas"  placeholder="Fakultas"  required>
                    <div class="commonLabel"><p>Status:</p></div>
                    <input type="text" name="Status"  placeholder="Status"  required>
                    <div class="commonLabel"><p>Tahun Masuk:</p></div>
                    <input type="text" name="TahunMasuk"  placeholder="Tahun Masuk"  required>
                    <div class="commonLabel"><p>Alamat:</p></div>
                    <input type="text" name="Alamat"  placeholder="Alamat"  required>
               
                    <input type="submit">
                </form>
                </div>
            </div>
            </div>
        </div>
    </body>
</html>