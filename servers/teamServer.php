<?php
include("../includes/dbconfig.php");
include("../includes/connection.php");
include("../includes/functions.php");
$get = $_GET;

if ($get['mode']=="getBio") {
    $userid = $get['id'];
    $fullname = $get['name'];
    $thisuser=grabinfo('cms_users','userid',$userid,1);

    $bio = nl2br(stripslashes($thisuser['bio']));

    $response = array("name" => $fullname, "bio" => $bio);
    echo json_encode($response);
    return;
}

?>