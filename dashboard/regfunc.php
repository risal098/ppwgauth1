<?php
$status="";
$servername = "localhost"; 
$usernamedb = "root";
$passworddb = ""; 
$dbname = "ppwauth2";
$conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);

$khs=[
  "2021"=>
  [
  ["Kalkulus Diferensial",12001,rand(67,98)],
  ["Perancangan Program",12002,rand(67,98)],
  ["Pemrograman Dasar",12003,rand(67,98)],
  ["Statistika Dasar",12004,rand(67,98)],
  ["Komputasi Dasar",12005,rand(67,98)],
  ["Matematika 2",12006,rand(67,98)],
  ["Etika Profesi",12007,rand(67,98)],
  ]
  ,
"2022"=>
  [
  ["Kalkulus Integral",13001,rand(67,98)],
  ["Perancangan Software",13002,rand(67,98)],
  ["Pemrograman Objek",13003,rand(67,98)],
  ["Aljabar Linear",13004,rand(67,98)],
  ["Data Raya",13005,rand(67,98)],
  ["Kecerdasan buatan",13006,rand(67,98)],
  ["Etika Profesi",13007,rand(67,98)],
  ["Komputer Masyarakat",13008,rand(67,98)],]
  ];
$krs=[
    
  ["Kalkulus Integral 2",14001],
  ["Maha Data",14002],
  ["Automata",14003],
  ["Penelitian Ilmiah",14004],
  ["Metode Numerik",14005],
  ["Manajemen Proyek",14006]
];

if($_SERVER["REQUEST_METHOD"] == "POST"){


$email=$_POST['email'];
$password=$_POST['password'];
    $conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);
    $sql = "SELECT * FROM akun WHERE email='$email' ";
    $result = $conn->query($sql);
                $row=$result->fetch_assoc();
                $isRegistered=$row['email'];
                if($isRegistered==$email){
                  $status= "already registered boiiii";
                }else{
                  $sql = "INSERT INTO akun ( email) VALUES('$email') ";
                  $result = $conn->query($sql);
                  
      $sql = "SELECT * FROM akun WHERE email='$email' ";
                  $result = $conn->query($sql);
                  $row=$result->fetch_assoc();
                  $adminId=$row['id'];
                  
                  $sql = "INSERT INTO auth (id, email,password) VALUES($adminId,'$email','$password')";
                  $result = $conn->query($sql);
                  
                              $sql =  "INSERT INTO `biodata`(`id`) VALUES ($adminId)";
                              $result = $conn->query($sql);
                              $tokhs=json_encode($khs);
                              $sql =  "INSERT INTO `matkulkhs`(`id`,`matkulkhs`) VALUES ($adminId,'$tokhs')";
                              $result = $conn->query($sql);
                              $tokrs=json_encode($krs);
                              $sql =  "INSERT INTO `matkulkrs`(`id`,`krs`) VALUES ($adminId,'$tokrs')";
                              $result = $conn->query($sql);
                              header("Location: ./table.php?");
}
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
                        <div class="commonDiv"><img src="./assets/<?php echo $adminId?>.jpeg" style="border-radius:50%"
                            height="90px" width="90px"> </div>
                            
                            <div class="commonDiv"><p><?php echo $role?></p> </div>
                    </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="commonOption"><a href=<?php echo "table.php?adminId=$adminId"?>><img src="assets/logoTable.png" height="16px" width="16px">Table Data</a> </div>
                    <div class="block" style="min-height:25px;background-color:white;" name="block2"></div>
                    <div class="commonOption"><a><img src="assets/plus.png" height="14px" width="14px">Tambah Data</a> </div>
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
                    
                    <div class="cardEdit">
                <form method="post" action="regfunc.php">
                    
                    
                    <div class="blocks" style="min-height:25px;" name="block2"><p>TAMBAH AKUN MAHASISWA</p></div>
                    <div class="commonDiv"><p style="color:red"><?php echo "$status"?></p></div>
               
                    <div class="commonLabel"><p>Email:</p></div>
                    <input type="text" name="email"  placeholder="Email"  required>
                    <div class="commonLabel"><p>Password</p></div>
                    <input type="text" name="password"  placeholder="Password"  required>
           
               
                    <input type="submit">
                </form>
                </div>
            </div>
            </div>
        </div>
    </body>
</html>