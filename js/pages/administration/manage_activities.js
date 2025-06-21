$(function () {
	if($("#div_activities_calendar").length){
		activitiesId = $("#hdn_activities_id").val();
		var Calendar = FullCalendar.Calendar;
		var calendarEl = document.getElementById('div_activities_calendar');
		var calendar = new Calendar(calendarEl, {
			headerToolbar: {
				left  : 'prev,next today',
				center: 'title',
				right : 'dayGridMonth,timeGridWeek,timeGridDay'
			},
			themeSystem: 'bootstrap',
			//Random default events
			// events: [],
			eventSources: [{
				url: base_url + "/ajax/load_activities.php?id=" + activitiesId,
				type: 'GET',
				dataType : "JSON"
			}],
			editable  : false,
			droppable : false
		});

		calendar.render();
	}
	
	
	$("#tbl_activities_attendees").DataTable({
		"aaSorting": []
	});
	
});

