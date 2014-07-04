<html>
  <head>

  </head>
  <body>
    <?php
       include("includes/phpheader.php");
       include ($thisabspath."/includes/cssheader.php");
       include ($thisabspath."/includes/javaheader.php");
       
    ?>
    <script src="includes/js/index_fns.js"> </script>       
    
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
	
      </div>
    </div>
    
    
    <?php
       include($thisabspath."/includes/footer.php");
    ?>
  </body>
  
</html>
