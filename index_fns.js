function getCalendarInfo() {
    var request = $.ajax({
  	url: "script.php",
  	type: "POST",
  	data: { mode : "getRecent" },
  	dataType: "json"
    });
    
    request.done(function( data ) {
  	populateCalendar(data);
    });
}

function populateCalendar(data) {
    var txt = "";
    var startTime, startDate, endTime, endDate;
    for (i in data) {
	startTime = data[i].startTime;
	startDate = data[i].startDate;
	endTime = data[i].endTime;
	endDate = data[i].endDate;
	
	//Print the date of the event
	txt += "<h4>" + startDate;
	if (startTime!='12:00 am') txt+=startTime;
	txt += "</h4>";

	//Location
	txt += "<h5>" + data[i].location; + "</h5>";
	txt += "<h5 class='calendarheader'> <a href='/calendar/'>";
	txt += data[i].title + "</a></h5>";

	//Textblock
	txt += "<p class='calendar textblock'>" + data[i].textBlock + "</p>";

	
    }
    $("#upcominginner").html(txt);
}
