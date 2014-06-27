<html>

	<body>
		<?php
			include("includes/phpheader.php");
			include ($thisabspath."/includes/cssheader.php");
			include ($thisabspath."/includes/javaheader.php");
	
		?>


		<div id="frontimages"><img id="headerimage" src="frame/images/headers/random.php">
		</div>


		<div id="rightblocks" class="right w700">
			<div id="infobox1" class="infobox"><div class="box intro">
				<p>The Virtual Textile Project is a joint initiative between Dragon and Phoenix Software and McGill University, 
				headed by Catherine Bradley (McGill) and Kat Lind (Dragon and Phoenix). It's setting out to digitize
				historical textiles from a number of leading museums and collections to make them available to 
				wider audiences, for conservation, and to preserve these important fabrics for generations to come.</p>
				<!-- <br><br> -->
				<p>The Virtual Textile Project database is in the final phase of deployment. Soon, this site will 
				provide open access to images of antique and vintage textiles. 
				Our first round of images comes from the American Textile History Museum. </p>
				Please check back soon!
				<br><br>
				Catherine Bradley, Co-Founder
			</div>
		</div>

		</div>

		<div id="leftblocks" class="left w250">
			<div id="upcomingbox" class="box">
				<h3><a href="/calendar/">Upcoming</a></h3>
				<div id="upcominginner"> </div>
				<!--<?php $grabcalendar=mysql_query("SELECT * FROM cms_calendar where calendarreleased=1 and calendaraccess<=".$_SESSION['profile']." and calendarend>=now() order by calendarstart asc limit 0,3");
				if(mysql_num_rows($grabcalendar)){
				while($calendar=mysql_fetch_assoc($grabcalendar)){
				$startdate=date('j M Y',strtotime($calendar['calendarstart']));
				$enddate=date('j M Y',strtotime($calendar['calendarend']));
				$starttime=date('g:i a',strtotime($calendar['calendarstart']));
				$endtime=date('g:i a',strtotime($calendar['calendarend']));
			?>
				<h4><?php print stripslashes($startdate);
						if($calendar['calendarshowtime']==1){
						if($starttime!='12:00 am'){
						print " ".$starttime;
						}
						
						}
					?>
			</h4>
				<h5><?php print stripslashes($calendar['calendarlocation']);?></h5>
				<h5 id="calendarheader<?php print $calendar['calendarid'];?>" class="calendarheader">
					<a href="/calendar/
						<?php 
							$fixedcalendartitle=preg_replace("/[^a-z0-9]/i", "-", stripslashes($calendar['calendartitle']));
							echo date('Y/m/d',strtotime($calendar['calendarstart']))."/".$fixedcalendartitle;
					?>/"><?php echo stripslashes($calendar['calendartitle']);?>
				</a>
			</h5>
				<p id="calendar<?php print $calendar['calendarid'];?>" class="calendar textblock">
					<?php 
						$thiscalendar=split2(strip_tags($calendar['calendarinfo'])," ",18);
					print trim(stripslashes($thiscalendar[0]));
					if(strlen(stripslashes($thiscalendar[0]))
						<strlen(stripslashes(strip_tags($calendar['calendarinfo'])))){
							print "...";
					}?></p>
				 <?php }
				}?> -->
			</div>
		</div>


		<?php
			include($thisabspath."/includes/footer.php");
		?>
	</body>

</html>
	
