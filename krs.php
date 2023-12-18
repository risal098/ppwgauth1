<?php
if( $_GET['adminId']==null){
    echo "wrong acces method :(" ;
}
$servername = "ned.masuk.id"; 
$usernamedb = "uiulutbl_siakad";
$passworddb = "siakad@123"; 
$dbname = "uiulutbl_ppw_auth";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="mainDiv">
        <div class="mainLeftDiv">
            <div class="cardLeft">
            <div class="adminPict">
                <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="currentColor" class="fillColorProfile bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                </svg>
            </div>  
                <div class="profileText">
                    <p>
                        <?php echo $email ?>
                    </p>
                </div>
                <div class="profileText">
                    <p>admin</p>
                </div>
            </div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="commonOption"><a href=<?php echo "table.php?adminId=$adminId" ?>>
                    <button class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
              <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z"/>
            </svg> KHS</button></a> </div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="commonOption"><a href=<?php echo "krs.php?adminId=$adminId" ?>><button class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-zip-fill" viewBox="0 0 16 16">
              <path d="M8.5 9.438V8.5h-1v.938a1 1 0 0 1-.03.243l-.4 1.598.93.62.93-.62-.4-1.598a1 1 0 0 1-.03-.243"/>
              <path d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m2.5 8.5v.938l-.4 1.599a1 1 0 0 0 .416 1.074l.93.62a1 1 0 0 0 1.109 0l.93-.62a1 1 0 0 0 .415-1.074l-.4-1.599V8.5a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1zm1-5.5h-1v1h1v1h-1v1h1v1H9V6H8V5h1V4H8V3h1V2H8V1H6.5v1h1z"/>
            </svg> KRS</button></a> </div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="commonOption"><a href=<?php echo "tambah.php?adminId=$adminId" ?>><button class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
              <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
              <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
            </svg> BIODATA</button></a> </div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="commonOption"><a href=<?php echo "/login.php" ?>><button class="btn btn-danger mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z"/>
              <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
            </svg> Logout</button></a> </div>
            <div class="commonOption"><a href=<?php echo "/dashboard/table.php" ?>><button class="btn btn-warning mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
              <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
              <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
            </svg> Dashboard</button></a> </div>
        </div>
        <div class="mainRightDiv">
        <div class="headerBlock" style="min-height:45px;" name="block2">
                <p class="fs-2 fw-bolder">SIAKAD UNJ - ADMIN</p>
                <p class="fs-3 fw-bolder">Halaman KRS</p>
                <img src="./assets/logoUnj.png" alt="logo unj" height="64px" width="64px" class="headerLogo">
            </div>

                <?php
                
                    try{

                   
                      
                    $sql = "SELECT krs FROM matkulkrs WHERE id=$adminId";
                    $result = $conn->query($sql);
                    $result=$result->fetch_assoc();
                    $decjson=json_decode($result["krs"],true);

                  //   {
                        echo '<table border="1" class="table table-striped">';
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>