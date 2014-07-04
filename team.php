<html>
  <head>
  </head>

  <body>
    <?php
       include("includes/phpheader.php");
       include ($thisabspath."/includes/cssheader.php");
       include ($thisabspath."/includes/javaheader.php");       
    ?>
    <script src="includes/js/team_fns.js"> </script>

    <!-- If we are being linked to this page from the main menu, we must automatically display the requested bio -->
    <!-- The following script adds a javascript command to display the bio once the page has been fully loaded -->
    <?php
       if (isset($_GET["id"]) && isset($_GET["name"])) {
         print "<script> 
		$(document).ready(function () {
		  displayBio('".$_GET["id"]."', '".$_GET["name"]."');
		});
		</script>";
       }
    ?>


    <div id="teamContent">
      <h1>Our Team</h1>
      <div class="box">
	<h4><a href="#" onclick="displayBio('mcgill', 'McGill University');">McGill University</a></h4>
	<ul class="list">
	  <li><a href="#" onclick="displayBio('cbradley', 'Catherine Bradley');">Catherine Bradley</a>: Co-Founder of the Virtual Textile Project<br>McGill Project Co-Director</li>
	  <li><a href="#" onclick="displayBio('ssinclair', 'Stefan Sinclair');">Stefan Sinclair</a><br>Collaborator</li>
	  <li><a href="#" onclick="displayBio('mmilner', 'Matthew Milner');">Matthew Milner</a><br>Web Design</li>
	  <li><a href="#" onclick="displayBio('pdavoust', 'Peter Davoust');">Peter Davoust</a><br>Developer</li>
	  <li><a href="#" onclick="displayBio('jeidelman', 'Jonathan Eidelman');">Jonathan Eidelman</a><br>Developer</li>
	</ul>
	<h4><a href="#" onclick="displayBio('mcgill', 'McGill University');">Dragon and Phoenix Software Inc.</a></h4>
	<ul class="list">
	  <li><a href="#" onclick="displayBio('klind', 'Kat Lind');">Kat Lind</a>: Co-Founder of the Virtual Textile Project<br>
	    Dragon and Phoenix Project Co-Director</li>
	</ul>
      </div>
    </div>


    <?php
       include($thisabspath."/includes/footer.php");
    ?>
  </body>
</html>
