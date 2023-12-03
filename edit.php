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
try{
$id=$_GET["id"];
    $adminId=$_GET["adminId"];}
    catch(Exception $e){
echo "forbidden request, pastikan akses halaman ini dari format web terkait";
    }

    
    $sql2="SELECT * FROM data_dasar WHERE ID=$id";
    $result = $conn->query($sql2);
    $row=$result->fetch_assoc();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
   $NIM=($_POST['NIM']);
   $TAHUN=($_POST['TahunMasuk']);
   $NAMA=$_POST['NamaLengkap'];
   $FAKULTAS=$_POST['Fakultas'];
   $STATUS=$_POST['Status'];
   
   $ALAMAT=$_POST['Alamat'];
   
$sql="UPDATE `data_dasar` SET `NIM`=$NIM,`NAMA`='$NAMA',`ALAMAT`='$ALAMAT',`FAKULTAS`='$FAKULTAS',`TAHUNMASUK`=$TAHUN,`STATUSUKT`='$STATUS' WHERE `ID`=$id";
$conn->query($sql);
header("Location: /table.php?adminId=$adminId&id=$id");
}catch(Exception $e){ $status="make sure to check  Tahun Masuk data type (integer only)<br> and make sure database connection is no problem";}


   

    
}
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="edit.css">
    </head>
    <body>
    <div class="commonDiv">
                    
                    <div class="cardEdit">
                <form method="post" action="/edit.php?adminId=<?php echo $adminId ?>&id=<?php echo $id ?>">
                    
                    
                    <div class="blocks" style="min-height:25px;" name="block2"><p>EDIT DATA</p></div>
                    <div class="commonDiv"><p style="color:red"><?php echo "$status"?></p></div>
                    <div class="commonLabel"><p>NIM:</p></div>
                    <input type="text" name="NIM"  placeholder="NIM" value="<?php echo $row["NIM"] ?>" required>
                    <div class="commonLabel"><p>Nama Lengkap:</p></div>
                    <input type="text" name="NamaLengkap"  placeholder="Nama Lengkap" value="<?php echo $row["NAMA"] ?>" required>
                    <div class="commonLabel"><p>Fakultas:</p></div>
                    <input type="text" name="Fakultas"  placeholder="Fakultas" value="<?php echo $row["FAKULTAS"] ?>" required>
                    <div class="commonLabel"><p>Status:</p></div>
                    <input type="text" name="Status"  placeholder="Status" value="<?php echo $row["STATUSUKT"] ?>" required>
                    <div class="commonLabel"><p>Tahun Masuk:</p></div>
                    <input type="text" name="TahunMasuk"  placeholder="Tahun Masuk" value="<?php echo $row["TAHUNMASUK"] ?>" required>
                    <div class="commonLabel"><p>Alamat:</p></div>
                    <input type="text" name="Alamat"  placeholder="Alamat" value="<?php echo $row["ALAMAT"] ?>" required>
                    <input type="hidden" name="idMhs"  placeholder="Alamat" value="<?php echo $row["ID"] ?>" required>
                    <input type="submit">
                </form>
                </div>
            </div>
    </body>
</html>