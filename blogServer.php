<?php
include("includes/dbconfig.php");
include("includes/connection.php");
include("includes/functions.php");
$get = $_GET;


$allBlogs = array();
if ($get["mode"]=="getRecent") {
    $blogsql="SELECT * FROM cms_blog where blogreleased=1 order by blogmadeon desc limit 0,10";
}

if ($get["mode"]=="getPost") {
        $blogsql="SELECT * FROM cms_blog where blogreleased=1 and blogid=".$get["id"]." order by blogmadeon desc limit 0,1";
}


$grabblog=mysql_query($blogsql);
while($blog=mysql_fetch_assoc($grabblog)){

    if ($get["mode"]=="getRecent") {
        $thisblog = split2(strip_tags($blog['blog'])," ",180);
        $blogText = trim(stripslashes($thisblog[0]));
    
        if(strlen(stripslashes($thisblog[0]))<strlen(stripslashes(strip_tags($blog['blog'])))){
            $blogText = $blogText .  "...";
        }
    }

    else {
        $blogText = $blog['blog'];
    }
        
    $newEntry = array(
        "date" => date('j M Y g:i a',strtotime($blog['blogmadeon'])),
        "title" => $blog['blogtitle'],
        "madeby" => $blog['blogmadeby'],
        "id" => $blog['blogid'],
        "blog" => $blogText
    );
    
    array_push($allBlogs, $newEntry);
    }
echo json_encode($allBlogs);

?>