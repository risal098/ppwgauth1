<?php
if( $_GET['adminId']==null){
    echo "wrong acces method :(" ;
}
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
            <div class="commonOption"><a href=<?php echo "table.php?adminId=$adminId" ?>><img src="assets/logoTable.png" height="14px" width="14px">
                    Table Data</a> </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="commonOption"><a><img src="assets/logoTable.png" height="14px" width="14px">
                    KRS</a> </div>
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
            <div class="commonDiv">

                <?php
                
                    try{

                   
                      
                    $sql = "SELECT krs FROM matkulkrs WHERE id=$adminId";
                    $result = $conn->query($sql);
                    $result=$result->fetch_assoc();
                    $decjson=json_decode($result["krs"],true);

                  //   {
                        echo '<table border="1">';
                        echo '<tr>
                        <th >No</th>
                        <th>Nama Matkul</th>
                        <th>Kode Matkul</th>
                     
                        </tr>';

                        $urutan=1; 
                        while ($urutan<=count($decjson)) {
                        //  echo $row["Foto"];
                            echo '<tr>';
                            echo '<td ><div class="commonDiv">' . $urutan . '</div></td>';
                            echo '<td ><div class="commonDiv">' . $decjson[$urutan-1][0] . '</div></td>';
                            echo '<td ><div class="commonDiv">' . $decjson[$urutan-1][1] . '</div></td>';
                       
                            
                            echo '</tr>';
                            $urutan+=1;
                        }

                        echo '</table>';
                  //  } else {
                    //    echo 'No data in the database.';
                 //   }


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