$(document).ready(function () {
    getCalendarInfo();
});
		  

function getCalendarInfo() {
    var request = $.ajax({
  	url: "server.php",
  	type: "GET",
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
	startTime = data[i].starttime;
	startDate = data[i].startdate;
	endTime = data[i].endtime;
	endDate = data[i].enddate;
	
	//Print the date of the event
	txt += "<h4>" + startDate;
	if (startTime!='12:00 am') txt+=startTime;
	txt += "</h4>";

	//Location
	txt += "<h5>" + data[i].location; + "</h5>";
	txt += "<h5 class='calendarheader'> <a href='/calendar/'>";
	txt += data[i].title + "</a></h5>";

	//Textblock - main description of event
	txt += "<p class='calendar textblock'>" + data[i].textblock + "</p>";

	
    }
    //This forms the HTML of our "updates" section
    $("#upcominginner").html(txt);
}
