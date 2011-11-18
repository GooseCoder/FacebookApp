<?php
require "src/facebook.php";

$appUrl = 'https://apps.facebook.com/dr_filosoraptor/';

// Get an instance of the Facebook class distributed as the PHP SDK by facebook:
$facebook = new Facebook(array(
  'appId'  => '139930296109749',
  'secret' => 'eaf9971f6e8ff4eec4b1d61bc874843f',
));

$session = $facebook->getUser();

if ($user){
    $loginUrl = $facebook->getLoginUrl(array('scope'=>'email,publish_stream','redirect_url'=>$appUrl));
    echo "<script> top.location.href='$loginUrl' </script>";
} else {
    try {       
        $userProfile = $facebook->api('/me');
        echo "<pre>";
        print_r($userProfile);
        echo "</pre>";
    } catch (FacebookApiException $exc) {
        $loginUrl = $facebook->getLoginUrl(array('scope'=>'email,publish_stream','redirect_url'=>$appUrl));
        echo "<script> top.location.href='$loginUrl' </script>";
        echo ($exc);
        $user=null;
    }
}
?>