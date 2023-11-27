<?php


require 'vendor/autoload.php';
$clientID = "1085395854703-4vnu3f6g7cofi23octqvdpd50s89844t.apps.googleusercontent.com";

$clientSecret = "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";
   
    $redirectUri = 'http://localhost:5000/index.php';
 $redirectUri = 'http://localhost:5000/register.php';
     $clients1 = new Google_Client();
     $clients1->setClientId($clientID);
     $clients1->setClientSecret($clientSecret);
     $clients1->setRedirectUri($redirectUri);
     $clients1->addScope("email");
     $clients1->addScope("profile");



   $servername = "localhost"; 
   $usernamedb = "root";
   $passworddb = ""; 
   $dbname = "utsiakad";
   $status="";
   $num1=rand(0,11);
   $num2=rand(0,11);
   if($_SERVER["REQUEST_METHOD"] == "GET"){
    $status="";
   }
   if (isset($_GET['code'])) {
    // echo "masuk <br>";
 
     $client1 = new Google_Client();
     $client1->setClientId($clientID);
     $client1->setClientSecret($clientSecret);
     $client1->setRedirectUri($redirectUri);
     $client1->addScope("email");
   //  $client1->addScope("profile");
   $token = $client1->fetchAccessTokenWithAuthCode($_GET['code']);
   $client1->setAccessToken($token['access_token']);
 
   // 
   $google_oauth = new Google\Service\Oauth2($client1);
 
 
   $google_account_info = $google_oauth->userinfo->get();
   $email =  $google_account_info->email;
   $name =  $google_account_info->name;
   try{
     $sql = "SELECT * FROM akun WHERE email='$email' ";
     $conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);
                   $result = $conn->query($sql);
                   $row=$result->fetch_assoc();
                       $adminId=$row['id'];
                       header("Location: table.php?adminId=$adminId");}
                       catch(Exception $e){
                         echo "account not found";
                         $client->revokeToken();
                      //   $conn->close();
                        
                       }
   
             //    $result = $conn->query($sql);
               //  $row=$result->fetch_assoc();
   //echo "$email<br>";
  // echo "$name<br>";

 }

   if($_SERVER["REQUEST_METHOD"] == "POST"){   
        if($_POST["num1"]+$_POST["num2"]!=(int)$_POST["angka"]){
            $status="invalid calculation";
            
        }else{
            //login logic
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
            $username=$_POST['username'];
            $password=$_POST['password'];
        // echo $username ,$password;
            try{
                $sql = "SELECT * FROM auth WHERE email='$username' AND password='$password'";
                $result = $conn->query($sql);
                $row=$result->fetch_assoc();
              
                    
                if($row["email"]==$username && $row["password"]==$password){
                    $status="success";
                    $sql = "SELECT * FROM akun WHERE email='$username' ";
                $result = $conn->query($sql);
                $row=$result->fetch_assoc();
                    $adminId=$row['id'];
                    header("Location: table.php?adminId=$adminId");
                }
                else{
                    
                    $status="invalid credentials!";
                }
           }catch (Exception $e){print($e);$status="invalid credentials";}
           $conn->close(); 
        }
   }
/*
   
*/

//$sql = "SELECT * FROM table1";
//$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="mainDiv">
            <div class="mainLeftDiv">
                <div class="block"style="min-height:30px;" name="block1"></div>
                <div class="commonDiv">
                    <img src="./assets/logoUnj.png" alt="logoUnj" height="70 px">
                </div>
                <div class="commonDiv">
                    <p style="font-size:18px;color:#7DA950;font-family: Arial;font-weight: normal;">SIAKAD </p>
                    <div style="min-width:7px"> </div>
                    <p style="font-size:18px;color:#BFAC00;font-family: Arial;font-weight: normal;">UNJ</p>
                </div>
                
                <div id="loginCard" class="loginCard">
                    <div class="block" style="min-height:25px;" name="block2"></div>
                    <div class="commonDiv">
                        <p style="font-size:28px;color:white;font-family: Arial;font-weight: normal;">LOGIN</p>
                    </div>
                    <div class="commonDiv">
                        <p style="color:#FF6161"><?php echo $status;?></p>
                    </div>
                    <div class="block" style="min-height:20px;" name="block2"></div>
                    <div class="commonDiv">
                        <form method="post" action="/login.php">
                            
                            <input type="text"  placeholder="email"  name="username"  required><br><br>
                            <input type="password"  placeholder="password"  name="password" required><br><br>
                            <div style="padding:15 px 15px;background-color:#5B64BD;min-height:30px;display:flex">
                                <div class="block" style="min-width:20px;background-color:#5B64BD;" name="block2"></div>
                                <p style="color:white"><?php echo " hitung $num1 + $num2 ?"?></p>
                            </div>
                            <input type="text" placeholder="jawaban" name="angka">
                            <input type="hidden" name="num1" value="<?php echo $num1; ?>">
                            <input type="hidden" name="num2" value="<?php echo $num2; ?>">
                            <div class="block" style="min-height:20px;" name="block2"></div>
                            <div class="commonDiv" style="justify-content:right">
                                <input type="submit" value="Submit" >    
                            </div>
                            <div class="block" style="min-height:20px;" name="block2"></div>
                            
                        </form>
                        
                        <a href="<?=$clients1->createAuthUrl()?>">
                <button >
                    Sign in with Google Account
                  </button>
                </a>
                    </div>
                    <div style="background-color:#5B64BD;min-height:40px">
                    <div class="block" style="min-height:10px;" name="block2"></div>
                    <a style="padding-left:14px;color:white">< Ubah Password</a></div>
                    
                </div>

            </div>
            <div class="mainRightDiv">
                <img src="./assets/gedung.jpg" alt="gedung UNJ" height="450px" width="900px">
            </div>
        </div>
    </body>

</html>