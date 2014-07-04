/**************************************************************/
/* Downloads the blog entries                                 */
/**************************************************************/
function getBlogs(blogID, blogMin, blogMax) {
    var queryMode;
    if (arguments.length==0) {
	queryMode = "getRecent";
    }

    else if (arguments.length==1) {
	queryMode = "getPost";
    }

    var request = $.ajax({
	url: "blogServer.php",
	type: "GET",
  	data: { mode : queryMode,
		id : blogID
	      },
	    dataType: "json"
    });
	
    request.done(function( data ) {
  	populateBlog(data);
    });
    request.fail(function (data ) {
	alert("An error occured retrieving the blog post!");
    });
    
}



/**************************************************************/
/* Populates the blog with entries                            */
/**************************************************************/

function populateBlog(data) {
    var txt = "";
    for (i in data) {

	txt += "<div id='"+data[i].id+"' class='infobox'>";
	txt += "<div class = 'box'>";

	//Blog title
	txt += "<h2 id='blogheader" + data[i].id + "' class='blogheader'>";
	txt += "<a href='#' onclick='getBlogs("+data[i].id+");'>" +  data[i].title + "</a>";
	txt += "</h2>";

	//Blog date and author
	txt += "<div id='blogmetadata" + data[i].id + "' class = 'blogmetadata smallfont'>";
	txt += data[i].date;
	txt += " by <a href='#'>" + data[i].madeby + "</a>";
	txt += "</div>";

	//Blog content
	txt += "<div id='blog" + data[i].id + "' class='blog textblock'>";
	txt += data[i].blog;
	txt += "</div>";
	txt += "</div>";
	txt += "</div>";
	
	
    }
    $("#rightblocks").html(txt);
}



function populateBlogCalendar(data) {
    txt = "";
    var thisYear, thisMonth;
    
    //This will be our collapsible list
    txt += "<ul id='explist'>";
    
    //For each year create a new list entry
    for (i in data) {
	
	thisYear = data[i];

	txt += "<li><a href='#'>"+thisYear.year+"</a>";

	//We now create a new list for all of the months that have blog posts
	//in the current year.
	txt += "<ul>";
	for (k in thisYear.months) {
	    thisMonth = thisYear.months[k];
	    txt += "<li><a href='#'>" + thisMonth.month + "</a>";

	    //We now create a new list for all of the days that have blog posts
	    //in the current month.
	    txt += "<ul>";
	    for (j in thisMonth.days) {
		thisDay = thisMonth.days[j];
		txt += "<li><a href='#'>"+thisDay.day+"</a>";

		//We now create a new list for all of the posts on the current day.
		txt += "<ul>"
		for (z in thisDay.posts) {
		    thisPost = thisDay.posts[z];
		    txt += "<li><a href='#'>" + thisPost.blog + "</a></li>";
		}

		txt += "</ul>";
	    }

	    txt += "</ul>";
	}
	txt += "</ul>";
    }
    txt += "</ul>";
}

/**************************************************************/
/* Prepares the cv to be dynamically expandable/collapsible   */
/**************************************************************/
function prepareList() {
    $('#expList').find('li:has(ul)')
	.click( function(event) {
            if (this == event.target) {
		$(this).toggleClass('expanded');
		$(this).children('ul').toggle('medium');
            }
            return false;
	})
	.addClass('collapsed')
	.children('ul').hide();
    
    //Hack to add links inside the cv
    $('#expList a').unbind('click').click(function() {
	window.location.href=$(this).attr('href');
	return false;
    });
    
    //Create the button functionality
    $('#expandList')
	.unbind('click')
	.click( function() {
            $('.collapsed').addClass('expanded');
            $('.collapsed').children().show('medium');
	});
    $('#collapseList')
	.unbind('click')
	.click( function() {
            $('.collapsed').removeClass('expanded');
            $('.collapsed').children('ul').hide('medium');
	});
    
}


/**************************************************************/
/* Functions to execute on loading the document               */
/**************************************************************/
$(document).ready( function() {
    prepareList();
    $('#expList li').first().click();
    getBlogs();
});
