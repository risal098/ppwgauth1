<?php

$status="";
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    </head>
    <body>
        <div class="mainDiv">
            <div class="mainLeftDiv">
                    <div class="cardLeft">
                        <div class="adminGear">
                            <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="currentColor" class="fillColorProfile bi bi-person-fill-gear" viewBox="0 0 16 16">
                            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                            </svg>
                        </div>        
                        <div class="profileText"><p>Admin Dashboard</p> </div>
                    </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="commonOption"><a href=<?php echo "./table.php"?>><button class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                      <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 2h-4v3h4zm0 4h-4v3h4zm0 4h-4v3h3a1 1 0 0 0 1-1zm-5 3v-3H6v3zm-5 0v-3H1v2a1 1 0 0 0 1 1zm-4-4h4V8H1zm0-4h4V4H1zm5-3v3h4V4zm4 4H6v3h4z"/>
                    </svg> Table Data</button></a> </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="commonOption"><a href=<?php echo "./regfunc.php"?>><button class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg> Tambah Data</button></a> </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="commonOption"><a href=<?php echo "/login.php" ?>><button class="btn btn-danger mb-2 m-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z"/>
                      <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                    </svg> Logout</button></a> </div>

            </div>
            <div class="mainRightDiv">
            <div class="headerBlock" style="min-height:45px;" name="block2">
                <p class="fs-2 fw-bolder">SIAKAD UNJ - ADMIN</p>
                <p class="fs-3 fw-bolder">Halaman Dashboard</p>
                <img src="../assets/logoUnj.png" alt="logo unj" height="64px" width="64px" class="headerLogo">
            </div>
                <div class="commonDiv">
                <?php
                    try{

                   
                    $urutan=1;    
                    $sql = "SELECT * FROM auth";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        echo '<table border="1" class="table table-striped">';
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
                            <a class="edit" href="./edit.php?adminId='.$row["id"].'">EDIT</a>
                            
                            <div  style="min-width:65px;" name="block2">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    </body>
</html>