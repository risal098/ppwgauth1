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



     $servername = "ned.masuk.id"; 
     $usernamedb = "uiulutbl_siakad";
     $passworddb = "siakad@123"; 
     $dbname = "uiulutbl_ppw_auth";
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
 data-client_id="1085395854703-4vnu3f6g7cofi23octqvdpd50s89844t.apps.googleusercontent.com"
                    data-context="signin"
                    data-ux_mode="popup"
                    data-callback="handleCredentialResponse"
                    data-auto_prompt="false"
*/
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="login-form">
            <img src="assets/logoUnj.png" class="logo w-25 position-relative translate-middle translate-middle-x pb-2 start-50">
            <h3 class="position-relative">Login to SIAKAD</h3>
            <p class="text-danger"> <?php echo $status; ?> </p>
            <form method="post" action="login.php">
              <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="username">
              </div>
              <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="form-group captcha mb-3">
                <p>what is <?php echo $num1; ?> + <?php echo $num2; ?>? </p>
                <input type="text" class="form-control" name="angka">
                <input type="hidden" name="num1" value="<?php echo $num1; ?>">
                <input type="hidden" name="num2" value="<?php echo $num2; ?>">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="<?=$clients1->createAuthUrl()?>" class="btn btn-default" id="bCheckIn" value="action01">
        <img src="assets/gugel.png" width="35" height="35"/>
        <span class="hidden-xs hidden-sm">Sign in with Google Account</span>
    </a>
              
              <p class="forgot-password text-right">
                <a href="#">Forgot password?</a>
              </p>
              <p class="forgot-password text-right">
                <a href="register.php">Register</a>
              </p>
            </form>
          </div>
        </div>
        <div class="col-md-6 d-flex">
          <img src="assets/gedung.jpg" class="rounded gedung mt-5 mb-5">
        </div>
      </div>    
    </div>
    <script src="https://accounts.google.com/gsi/client" async></script>
    <script src="bootstrap-autocomplete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </body>
</html>