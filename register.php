<?php


require 'vendor/autoload.php';

// konfigurasi
$clientID = "1085395854703-4vnu3f6g7cofi23octqvdpd50s89844t.apps.googleusercontent.com";
$clientSecret = "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";
$redirectUri = 'http://localhost:5000/register.php';
$status="";
$servername = "localhost"; 
   $usernamedb = "root";
   $passworddb = ""; 
   $dbname = "utsiakad";
  //  $conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);
// 
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
function isValid() 
{
    try {

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = ['secret'   => '6LfSXx0pAAAAAEU5U10Sk51H5BlGStnBPxUACfNk',
                 'response' => $_POST['g-recaptcha-response'],
                 'remoteip' => $_SERVER['REMOTE_ADDR']];
                 
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data) 
            ]
        ];
    
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return json_decode($result)->success;
    }
    catch (Exception $e) {
        return null;
    }
}
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!isValid() ){$status= "captcha not valid";}else{
    $email=$_POST['email'];
  
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $status = "Invalid email format";
}else{
            $password=$_POST['password'];
    $conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);
    $sql = "SELECT * FROM akun WHERE email='$email' ";
    $result = $conn->query($sql);
                $row=$result->fetch_assoc();
                $isRegistered=$row['email'];
                if($isRegistered==$email){
                  $status= "already registered boiiii";
                }else{$sql = "INSERT INTO auth ( email,password) VALUES('$email','$password')";
                  $result = $conn->query($sql);
                  $sql = "INSERT INTO akun ( email) VALUES('$email') ";
                              $result = $conn->query($sql);
                              
                  $sql = "SELECT * FROM akun WHERE email='$email' ";
                              $result = $conn->query($sql);
                              $row=$result->fetch_assoc();
                              $adminId=$row['id'];
                                    header("Location: table.php?adminId=$adminId");}
                                  }}
  }
if (isset($_GET['code'])) {
   // echo "masuk <br>";
    $clients = new Google_Client();
    $clients->setClientId($clientID);
    $clients->setClientSecret($clientSecret);
    $clients->setRedirectUri($redirectUri);
    $clients->addScope("email");
  //  $clients->addScope("profile");
  $token = $clients->fetchAccessTokenWithAuthCode($_GET['code']);
  $clients->setAccessToken($token['access_token']);

  // 
  $google_oauth = new Google\Service\Oauth2($clients);


  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  try{$sql = "INSERT INTO akun ( email) VALUES('$email') ";
    $conn->query($sql);
    $sql = "SELECT * FROM akun WHERE email='$email' ";
                  $result = $conn->query($sql);
                  $row=$result->fetch_assoc();
                      $adminId=$row['id'];
                      header("Location: table.php?adminId=$adminId");}
                      catch(Exception $e){
                        echo "already registered";
                        $clients->revokeToken();
                        $client->revokeToken();
                        $sql = "SELECT * FROM akun WHERE email='$email' ";
                  $result = $conn->query($sql);
                  $row=$result->fetch_assoc();
                      $adminId=$row['id'];
                      header("Location: table.php?adminId=$adminId");
                      }
  
            //    $result = $conn->query($sql);
              //  $row=$result->fetch_assoc();
  //echo "$email<br>";
 // echo "$name<br>";

}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIAKAD Register</title>
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
          <h3 class="position-relative">Register New Account</h3>
          
          <form method="post" action="register.php">
            <div class="form-group mb-3">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>
            
            <div class="form-group mb-3">  
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="form-group mb-3">
              <label for="password">Password</label>  
              <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

            <p class="forgot-password text-right">
              <a href="login.php">Already have an account? Login</a>
            </p>
          </form>
        </div>
      </div>
      
      <div class="col-md-6 d-flex">
        <img src="assets/gedung.jpg" class="rounded gedung mt-5 mb-5">
      </div>
    </div>    
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </form>
  </body>

</html>

