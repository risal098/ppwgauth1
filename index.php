<?php
require 'vendor/autoload.php';
if (isset($_GET['code'])) {
    // echo "masuk <br>";
    require 'vendor/autoload.php';
    $clientID = "1085395854703-4vnu3f6g7cofi23octqvdpd50s89844t.apps.googleusercontent.com";
    
    $clientSecret = "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";
       // $redirectUri = 'http://localhost:5000/register.php';
        $redirectUri = 'http://localhost:5000/index.php';
    
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
     $servername = "ned.masuk.id"; 
     $usernamedb = "uiulutbl_siakad";
     $passworddb = "siakad@123"; 
     $dbname = "uiulutbl_ppw_auth";
     $conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);
                   $result = $conn->query($sql);
                   $row=$result->fetch_assoc();
                       $adminId=$row['id'];
                       $client1->revokeToken();
                       header("Location: table.php?adminId=$adminId");}
                       catch(Exception $e){
                         echo "account not found";
                         echo "$e";
                         $client1->revokeToken();
                      //   $conn->close();
                        
                       }
   
             //    $result = $conn->query($sql);
               //  $row=$result->fetch_assoc();
   //echo "$email<br>";
  // echo "$name<br>";

 }else{
header("Location:login.php");}
?>