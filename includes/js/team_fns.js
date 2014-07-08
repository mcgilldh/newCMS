function displayBio(memberID, fullName) {
    var request = $.ajax({
  	url: "servers/teamServer.php",
  	type: "GET",
  	data: { mode : "getBio",
		id : memberID,
		name : fullName
	      },
  	dataType: "json"
    });
    
    request.done(function( data ) {
  	populateBio(data);
    });

}

function populateBio(data) {
    txt = "<h1>" + data.name + "</h1>";
    txt += "<div class='infobox'>";
    txt += "<div class='box'>";

    txt += data.bio;

    txt += "</div>";
    txt += "</div>";

    $("#teamContent").html(txt);
}
