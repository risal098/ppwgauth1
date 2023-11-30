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
   $conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);
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
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <p><?php echo $status;?></p>
  <form method="post" action="/register.php">

<input type="text"  placeholder="email"  name="email"  required><br><br>
 <input type="password"  placeholder="password"  name="password" required><br><br>
 <div class="g-recaptcha" data-sitekey="6LfSXx0pAAAAAFr_w8bwEpXjt5cXaztTxu1rnwZG"></div>
 <input type="submit" value="Submits" > 
  
</form>
<a href="<?=$client->createAuthUrl()?>">
                <button >
                    Sign in with Google Account
                  </button>
                </a>
  </body>

</html>

