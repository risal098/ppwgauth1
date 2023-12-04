<?php

$servername = "localhost";
$usernamedb = "root";
$passworddb = "";
$dbname = "ppwauth2";
try {
    $conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);
} catch (Exception $e) {
    echo "Error connecting to database, pastikan format database benar (ikuti langkah file catatan): <br>";
    echo $e->getMessage();
    die("Connection failed: " . $conn->connect_error);
}
if ($conn->connect_error) {
    echo "Error connecting to database, pastikan format database benar (ikuti langkah file catatan): ";
    die("Connection failed: " . $conn->connect_error);
}

$adminId = $_GET['adminId'];
$sql = "SELECT * FROM akun WHERE id=$adminId";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$email = $row['email'];
//$role=$row['role'];



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
                <div class="commonDiv"><img src="./assets/defaultAcc.png" style="border-radius:50%" height="90px"
                        width="90px"> </div>
                <div class="commonDiv">
                    <p>
                        <?php echo $email ?>
                    </p>
                </div>
                <div class="commonDiv">
                    <p>admin</p>
                </div>
            </div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="commonOption"><a><img src="assets/logoTable.png" height="14px" width="14px">
                    KHS</a> </div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="commonOption"><a href=<?php echo "krs.php?adminId=$adminId" ?>><img src="assets/plus.png"
                        height="16px" width="16px">
                    KRS </a> </div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="commonOption"><a href=<?php echo "tambah.php?adminId=$adminId" ?>><img src="assets/plus.png"
                        height="16px" width="16px">
                    BIODATA </a> </div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="commonOption"><a class="delete" href=<?php echo "/login.php" ?>><img src="assets/logout.png"
                        height="19px" width="19px">
                    Logout</a> </div>

        </div>
        <div class="mainRightDiv">
            <div class="commonDiv"></div>
            <div class="block" style="min-height:45px;" name="block2">
                <p>SIAKAD UNJ - ADMIN</p>
                <div class="block" style="min-height:25px;" name="block2"></div>
                <img src="./assets/logoUnj.png" alt="logo unj" height="38px" width="38px">
            </div>
           
         
            <!-- hias bang-->
          
            <?php
                
                try{
                    $sql = "SELECT matkulkhs FROM matkulkhs WHERE id=$adminId";
                $result = $conn->query($sql);
                $result=$result->fetch_assoc();
                $decjson=json_decode($result["matkulkhs"],true);
                echo "<div class='commonDiv'>";
                foreach($decjson as $key => $_value) {
                    echo "<a href='table.php?adminId=$adminId&tahunkhs=$key'><button  class='btn btn-primary'>$key</button>";

                    echo "</a>";
                  echo '  <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>';
                  }
               echo "</div>";
                  if($_GET['tahunkhs']!=null){
                
                    echo " <div class='commonDiv'>";
              //   {
                    echo '<table border="1">';
                    echo '<tr>
                    <th >No</th>
                    <th>Nama Matkul</th>
                    <th>Kode Matkul</th>
                    <th>Nilai Matkul</th>
                    </tr>';

                    $urutan=1; 
                    foreach($decjson as $key => $_value)
                    
                     {
                        if($key==$_GET['tahunkhs']){
                        while ($urutan<=count($_value)){
                        echo '<tr>';
                        echo '<td ><div class="commonDiv">' . $urutan . '</div></td>';
                        echo '<td ><div class="commonDiv">' . $_value[$urutan-1][0] . '</div></td>';
                        echo '<td ><div class="commonDiv">' . $_value[$urutan-1][1] . '</div></td>';
                        echo '<td ><div class="commonDiv">' . $_value[$urutan-1][2] . '</div></td>';
                   
                        
                        echo '</tr>';
                        $urutan+=1;}}
                    }

                    echo '</table>';
                    echo "</div>";
              //  } else {
                //    echo 'No data in the database.';
             //   }

              }else{
                echo " <div class='commonDiv'>";
                echo '<div>';
                echo " <div class='commonDiv'>";
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="170" height="170" fill="red" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
              </svg>';
              echo "</div>";
                echo "<p>pilih tahun khs untuk melihat data khs!</p>";
                echo "</div>";
                echo "</div>";
              }
                $conn->close();}
                catch (Exception $e) {
                    echo "<p>koneksi eror,pastikan database sudah diinstal pada mysql dan pastikan credentials sudah sesuai database anda</p>",$e->getMessage(), "\n";;
                
                }
            
            ?>
            
        </div>
    </div>
</body>

</html>