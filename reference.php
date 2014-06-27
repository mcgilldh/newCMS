
<?php $grabcalendar=mysql_query("SELECT * FROM cms_calendar where calendarreleased=1 and calendaraccess<=".$_SESSION['profile']." and calendarend>=now() order by calendarstart asc limit 0,3");
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
				}?> 
