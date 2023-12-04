<?php

$servername = "localhost"; 
$usernamedb = "root";
$passworddb = ""; 
$dbname ="ppwauth2";
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
   $sqlBiodata="SELECT * FROM biodata WHERE id=$adminId";
   $resultBiodata = $conn->query($sqlBiodata);
   $rowBiodata=$resultBiodata->fetch_assoc();


   if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
        
   $nama=($_POST["nama"]);
   $noreg=($_POST["noreg"]);
   $ttl=$_POST["ttl"];
   $email=$_POST["email"];
   $telepon=$_POST["telepon"];
   $ibu=$_POST["ibu"];
   $ayah=$_POST["ayah"];
   $alamat=$_POST["alamatLengkap"];
   
$sql="UPDATE `biodata` SET 
`nama`='$nama'
,`noreg`=$noreg
,`ttl`='$ttl'
,`email`='$email'
,`telepon`='$telepon'
,`ibu`='$ibu'
,`ayah`='$ayah'
,`alamatlengkap`='$alamat' 
WHERE id=$adminId";
$conn->query($sql);
header("Location: /tambah.php?adminId=$adminId");
}catch(Exception $e){ $status="make sure to check no registrasi data type (integer only)<br> and make sure database connection is no problem";}


   

    
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
                    <div class="commonOption"><a href=<?php echo "table.php?adminId=$adminId"?>><img src="assets/logoTable.png" height="16px" width="16px">KHS</a> </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
            <div class="commonOption"><a href=<?php echo "krs.php?adminId=$adminId" ?>><img src="assets/plus.png"
                        height="16px" width="16px">
                    KRS </a> </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="commonOption"><a><img src="assets/plus.png" height="14px" width="14px">BIODATA</a> </div>
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
                    
                    
                    <div class="blocks" style="min-height:25px;" name="block2"><p>BIODATA</p></div>
                    <div class="commonDiv"><p style="color:red"><?php echo "$status"?></p></div>

                   
                    
                    <div class="commonLabel"><p>Nama Lengkap:</p></div>
                    <input type="text" placeholder="Nama Lengkap"  name="nama"  value="<?php echo $rowBiodata["nama"] ?>" required>

                    <div class="commonLabel"><p>No Registrasi:</p></div>
                    <input type="text" value="<?php echo $rowBiodata["noreg"] ?>"  name="noreg"  placeholder="No Registrasi"  required>

                    <div class="commonLabel"><p>tempat tanggal lahir</p></div>
                    <input type="text" value="<?php echo $rowBiodata["ttl"] ?>"  name="ttl"  placeholder="tempat tanggal lahir"  required>

                    <div class="commonLabel"><p>email</p></div>
                    <input type="text" value="<?php echo $rowBiodata["email"] ?>"  name="email"  placeholder="email"   required>

                    <div class="commonLabel"><p>telepon</p></div>
                    <input type="text" value="<?php echo $rowBiodata["telepon"] ?>"  name="telepon"  placeholder="telepon"  required>

                    <div class="commonLabel"><p>ibu</p></div>
                    <input type="text" value="<?php echo $rowBiodata["ibu"] ?>"  name="ibu"  placeholder="ibu"  required>

                    <div class="commonLabel"><p>ayah</p></div>
                    <input type="text" value="<?php echo $rowBiodata["ayah"] ?>"  name="ayah" placeholder="ayah"   required>

                    <div class="commonLabel"><p>alamat Lengkap</p></div>
                    <input type="text" value="<?php echo $rowBiodata["alamatlengkap"] ?>"  name="alamatLengkap" placeholder="alamat Lengkap"  required>
                    <input type="submit">
                </form>
                </div>
            </div>
            </div>
        </div>
    </body>
</html>