<?php
include("../includes/dbconfig.php");
include("../includes/connection.php");
include("../includes/functions.php");
$get = $_GET;

if ($get['mode']=='getRecent') {
    
    //Grab the first 3 calendar entries that I have access to
    //NOTE - mysql_query is depreciated and will not work in future updates of PHP. This must be changed!
    $grabcalendar=mysql_query("SELECT * FROM cms_calendar where calendarreleased=1 and calendarend>=now() order by calendarstart asc limit 0,3");

    
    $calendarEntries = array();

    if(mysql_num_rows($grabcalendar)){
        while($calendar=mysql_fetch_assoc($grabcalendar)){

            $startdate = date('j M Y',strtotime($calendar['calendarstart']));
            $startdate = stripslashes($startdate);


            $location = stripslashes($calendar['calendarlocation']);

            $title = preg_replace("/[^a-z0-9]/i", "-", stripslashes($calendar['calendartitle']));
            $starttime = date('g:i a',strtotime($calendar['calendarstart']));

            $thiscalendar = split2(strip_tags($calendar['calendarinfo']), " ", 18);
            $textblock = trim(stripslashes($thiscalendar[0]));

            
            
            $endtime=date('g:i a',strtotime($calendar['calendarend']));

            
            $singleCalendarEntry = array(
                "startdate" => $startdate,
                "location" => $location,
                "title" => $title,
                "starttime" => $starttime,
                "textblock" => $textblock,
                "endtime" => $endtime);
            
            array_push($calendarEntries, $singleCalendarEntry);
        }
    }
    echo json_encode($calendarEntries);
    return;
}



?>