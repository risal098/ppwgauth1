<?php

$servername = "ned.masuk.id"; 
$usernamedb = "uiulutbl_siakad";
$passworddb = "siakad@123"; 
$dbname = "uiulutbl_ppw_auth";
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

    $sql = "SELECT * FROM auth WHERE id=$adminId";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();
    $email=$row['email'];
    $password=$row['password'];
   // $role=$row['role'];
   $sqlBiodata="SELECT * FROM biodata WHERE id=$adminId";
   $resultBiodata = $conn->query($sqlBiodata);
   $rowBiodata=$resultBiodata->fetch_assoc();


   if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
        
    $upemail=($_POST["email"]);
    $uppassword=($_POST["password"]);
   $nama=($_POST["nama"]);
   $noreg=($_POST["noreg"]);
   $ttl=$_POST["ttl"];
   $email=$_POST["email"];
   $telepon=$_POST["telepon"];
   $ibu=$_POST["ibu"];
   $ayah=$_POST["ayah"];
   $alamat=$_POST["alamatLengkap"];
   $sql2="UPDATE `auth` SET  `email`='$upemail',`password`='$uppassword' WHERE id=$adminId";
   $conn->query($sql2);
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
header("Location: ./table.php?adminId=$adminId");
}catch(Exception $e){ $status="make sure to check no registrasi data type (integer only)<br> and make sure database connection is no problem $e";}


   

    
}
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="../table.css">
    </head>
    <body>
    <div class="commonDiv">
                    
    <div class="cardEdit">
                <form method="post" action="./edit.php?adminId=<?php echo $adminId ?>">
                    
                    
                    <div class="blocks" style="min-height:25px;" name="block2"><p>BIODATA</p></div>
                    <div class="commonDiv"><p style="color:red"><?php echo "$status"?></p></div>

                   
                    <div class="commonLabel"><p>Email:</p></div>
                    <input type="text" placeholder="Email"  name="email"  value="<?php echo $email ?>" required>

                    <div class="commonLabel"><p>Password:</p></div>
                    <input type="text" value="<?php echo $password ?>"  name="password"  placeholder="Password" required>

                    <div class="commonLabel"><p>Nama Lengkap:</p></div>
                    <input type="text" placeholder="Nama Lengkap"  name="nama"  value="<?php echo $rowBiodata["nama"] ?>" required>

                    <div class="commonLabel"><p>No Registrasi:</p></div>
                    <input type="text" value="<?php echo $rowBiodata["noreg"] ?>"  name="noreg"  placeholder="No Registrasi" required>

                    <div class="commonLabel"><p>tempat tanggal lahir</p></div>
                    <input type="text" value="<?php echo $rowBiodata["ttl"] ?>"  name="ttl"  placeholder="tempat tanggal lahir"  required>

                    <div class="commonLabel"><p>email Kampus</p></div>
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
    </body>
</html>