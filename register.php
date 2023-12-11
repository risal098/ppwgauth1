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
$dbname = "ppwauth2";
$conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);
// 
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
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
                              ////////////////registration
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
                      $sql =  "INSERT INTO `biodata`(`id`) VALUES ($adminId)";
                              $result = $conn->query($sql);
                              $tokhs=json_encode($khs);
                              $sql =  "INSERT INTO `matkulkhs`(`id`,`matkulkhs`) VALUES ($adminId,'$tokhs')";
                              
                              $result = $conn->query($sql);
                              $tokrs=json_encode($krs);
                              $sql =  "INSERT INTO `matkulkrs`(`id`,`krs`) VALUES ($adminId,'$tokrs')";
                              $result = $conn->query($sql);
                              print $tokrs;
                              print($tokhs);
                              //////////////////////////registraionb
                      header("Location: table.php?adminId=$adminId");}
                      catch(Exception $e){
                      //  echo "already registered";
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
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
          <p style="color:red"><?php echo "$status";?></p>
          <form method="post" action="register.php">
      
            
            <div class="form-group mb-3">  
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="form-group mb-3">
              <label for="password">Password</label>  
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="g-recaptcha" data-sitekey="6LfSXx0pAAAAAFr_w8bwEpXjt5cXaztTxu1rnwZG"></div>
            <button type="submit" class="btn btn-primary">Submit</button>
            
            

            <p class="forgot-password text-right">
              <a href="login.php">Already have an account? Login</a>
            </p>
          </form>
          <a href="<?=$client->createAuthUrl()?>" class="btn btn-default" id="bCheckIn" value="action01">
        <img src="assets/gugel.png" width="35" height="35"/>
        <span class="hidden-xs hidden-sm">Sign Up with Google Account</span>
    </a>
        </div>
      </div>
      
      <div class="col-md-6 d-flex">
        <img src="assets/gedung.jpg" class="rounded gedung mt-5 mb-5">
      </div>
    </div>    
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://accounts.google.com/gsi/client" async></script>
    <script src="bootstrap-autocomplete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </form>
  </body>

</html>

