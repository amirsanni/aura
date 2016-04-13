/* Global JavaScript File for working with JQuery library */

// execute when the HTML file's (document object model: DOM) has loaded

/* AUTOSUGGEST SEARCH */
// triggered by input field onKeyUp
function autosuggest(str){
	// if there's no text to search, hide the list div
	if (str.length == 0) {
		$('#autosuggest_list').fadeOut(500);
	} else {
		// first show the loading animation
		$('#class_activity').addClass('loading');
		
		// Ajax request to CodeIgniter controller "ajax" method "autosuggest"
		// post the str paramter value
		$.post('/index.php/ajax/autosuggest',
			{ 'str':str },
			function(result) {
				// if there is a result, fill the list div, fade it in 
				// then remove the loading animation
				if(result) {
					$('#autosuggest_list').html(result);
					$('#autosuggest_list').fadeIn(500);
					$('#class_activity').removeClass('loading');
			}
		});
	}
}

/* AUTOSUGGEST SET ACTIVITY */
// triggered by an onClick from any of the li's in the autosuggest list
// set the class_acitity field, wait and fade the autosuggest list
// then display the activity details
function set_activity(activity_name, master_activity_id) {
	$('#class_activity').val(activity_name);
	setTimeout("$('#autosuggest_list').fadeOut(500);", 250);
	display_activity_details(master_activity_id);
}

/* AUTOSUGGEST DISPLAY ACTIVITY DETAILS */
// called by set_activity()
// get the HTML to display and display it
function display_activity_details(master_activity_id) {
	
	// Ajax request to CodeIgniter controller "ajax" method "get_activity_html"
	// post the master_class_activity parameter values
	$.post('/index.php/ajax/get_activity_html',
		{ 'master_activity_id':master_activity_id },
		// when the Web server responds to the request
		// replace the innerHTML of the select_activity element
		function(result) { 
			$('#select_activity').html(result);

			// because the add datepicker is not loaded with the DOM
			// manually add it after the date input field is written
			$(".date-picker").datepicker();
		}
	);
}
