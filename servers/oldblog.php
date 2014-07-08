<html>
  <head>
    <link rel="stylesheet" type="text/css" href="includes/css/blog.css" media="screen" />
  </head>
  <body>
    <?php
       include("includes/phpheader.php");
       include ($thisabspath."/includes/cssheader.php");
       include ($thisabspath."/includes/javaheader.php");


       
    ?>

    <script src="includes/js/blog_fns.js"> </script>


<?php if($_GET['id'] && empty($thispostid)){
$thispostid=$_GET['id'];
}

    if($thispostid){
        $blogsql="SELECT * FROM cms_blog where blogreleased=1 and blogaccess<=".$_SESSION['profile']." and blogid=".$thispostid." limit 0,1";
    }elseif($thispostrange){
        $blogsql="SELECT * FROM cms_blog where blogreleased=1 and blogaccess<=".$_SESSION['profile']." and blogmadeon<='".$thispostrange[1]."' and blogmadeon>='".$thispostrange[0]."' order by blogmadeon asc";
    }else{
        $blogsql="SELECT * FROM cms_blog where blogreleased=1 and blogaccess<=".$_SESSION['profile']." order by blogmadeon desc limit 0,10";
    }

$grabblog=mysql_query($blogsql);
if(mysql_num_rows($grabblog)){

    if($thispostid){

        $thisblog=mysql_fetch_assoc($grabblog);
        $thisblog['blogdate']=date('j M Y g:i a',strtotime($thisblog['blogmadeon']));?>
<h1>
<?php print stripslashes($thisblog['blogtitle']);?>
</h1>
<div id="blogmetadata<?php print $thisblog['blogid'];?>"
class="blogmetadata smallfont p100">
<?php print $thisblog['blogdate'];?>
    by <a href="/people/<?php print $thisblog['blogmadeby'];?>/"><?php print $thisblog['blogmadeby'];?>
    </a>
</div>
<div class="right w750" id="rightblocks">

<div id="infobox<?php print $thisblog['blogid'];?>" class="infobox">
    <div class="fullblog textblock" id="blog<?php print $thisblog['blogid'];?>">
<?php print stripslashes($thisblog['blog']);?>
    </div>
</div>
</div>
<?php }else{?>

<h1>Our Blog</h1>
<div class="right w750" id="rightblocks">
<?php while($blog=mysql_fetch_assoc($grabblog)){
        $blog['blogdate']=date('j M Y g:i a',strtotime($blog['blogmadeon']));?>
<div id="infobox<?php print $blog['blogid'];?>" class="infobox">
        <div class="box">
        <h2 id="blogheader<?php print $blog['blogid'];?>" class="blogheader">
        <a
        href="/blog/<?php $fixedtitle=preg_replace("/[^a-z0-9]/i", "-", stripslashes($blog['blogtitle']));
 echo date('Y/m/d',strtotime($blog['blogmadeon']))."/".$fixedtitle;?>/"><?php
            echo stripslashes($blog['blogtitle']);
 ?>
        </a>
        </h2>
              <div id="blogmetadata<?php print $blog['blogid'];?>"
        class="blogmetadata smallfont">
<?php print $blog['blogdate'];?>
            by <a href="/people/<?php print $blog['blogmadeby'];?>/"><?php print $blog['blogmadeby'];?>
            </a>
            </div>
            <div id="blog<?php print $blog['blogid'];?>" class="blog textblock">
<?php $thisblog=split2(strip_tags($blog['blog'])," ",180);
            print trim(stripslashes($thisblog[0]));
            if(strlen(stripslashes($thisblog[0]))<strlen(stripslashes(strip_tags($blog['blog'])))){
                print "...";
            }?>
            </div>
            </div>
</div>
<?php }?></div>
<?php }
} else{?>
<div class="right w750" id="rightblocks">
<div class="infobox">
<div class="box" id="upcomingbox">
<h2>Oops!</h2>
<p class="textblock">We're up to lots, but we don't have anything specific scheduled for this date! you can see all of our events <a href="/calendar/">here</a>.</p>
</div>
</div>
</div>
<?php }?>

<div class="left w200" id="leftblocks">
<?php $grabyears=mysql_query("SELECT distinct date_format(blogmadeon,'%Y') as theseyears FROM cms_blog where blogreleased=1 and blogaccess<=".$_SESSION['profile']." order by blogmadeon desc");
    if(mysql_num_rows($grabyears)){?>
<ul id="expList">
<?php while($year=mysql_fetch_assoc($grabyears)){?>
                                   <li><a href="/blog/<?php print $year['theseyears'];?>/"><?php print $year['theseyears'];?></a>
<?php $grabmonths=mysql_query("SELECT distinct date_format(blogmadeon,'%M') as thismonth,date_format(blogmadeon,'%m') as thesemonths FROM cms_blog where blogreleased=1 and blogaccess<=".$_SESSION['profile']." and blogmadeon like '".$year['theseyears']."%' order by blogmadeon desc");
                                   if(mysql_num_rows($grabmonths)){?>
<ul>
<?php while($month=mysql_fetch_assoc($grabmonths)){?>
                                       <li><a href="/blog/<?php print $year['theseyears']."/".$month['thesemonths'];?>/"><?php print $month['thismonth'];?></a>
<?php $grabdays=mysql_query("SELECT distinct date_format(blogmadeon,'%e') as thisday,date_format(blogmadeon,'%d') as thesedays FROM cms_blog where blogreleased=1 and blogaccess<=".$_SESSION['profile']." and blogmadeon like '".$year['theseyears']."-".$month['thesemonths']."%' order by blogmadeon desc");
                                       if(mysql_num_rows($grabmonths)){?>
<ul>
<?php while($day=mysql_fetch_assoc($grabdays)){?>
                                           <li><a href="/blog/<?php print $year['theseyears']."/".$month['thesemonths']."/".$day['thesedays'];?>/"><?php print $day['thisday'];?></a>

<?php //grab blog for each day
                                           $grabblog=mysql_query("SELECT * FROM cms_blog where blogreleased=1 and blogaccess<=".$_SESSION['profile']." and blogmadeon like '".$year['theseyears']."-".$month['thesemonths']."-".$day['thesedays']."%'  order by blogmadeon desc");
                                           if(mysql_num_rows($grabblog)){?>
<ul>
<?php while($thisblog=mysql_fetch_assoc($grabblog)){?>
<li><a
                                               href="/blog/<?php $fixedtitle=preg_replace("/[^a-z0-9]/i", "-", stripslashes($thisblog['blogtitle']));
 echo date('Y/m/d',strtotime($thisblog['blogmadeon']))."/".$fixedtitle;?>/"><?php
                                                   echo stripslashes($thisblog['blogtitle']);
 ?>
                                               </a></li>
<?php }?>
</ul><?php
      } ?>



</li>
<?php }?>
</ul><?php
      } ?>
</li>
<?php } ?>
</ul><?php
      } ?>
</li>
<?php }?>
</ul><?php
    } ?>
<div class="listControl">
    <a id="expandList">All</a>&nbsp;&#183;&nbsp;<a id="collapseList">Collapse</a>
            </div>
</div>




    <?php
       include($thisabspath."/includes/footer.php");
    ?>
  </body>
  
</html>
