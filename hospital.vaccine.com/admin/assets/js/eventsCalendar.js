events = { upcomingEvents: function(){
        $calendar = $('#myEvents');

        today = new Date();
        y = today.getFullYear();
        m = today.getMonth();
        d = today.getDate();

        $calendar.fullCalendar({
            viewRender: function(view, element) {
                // We make sure that we activate the perfect scrollbar when the view isn't on Month
                if (view.name != 'month'){
                    $(element).find('.fc-scroller').perfectScrollbar();
                }
            },
            header: {
				left: 'title',
				center: 'month,agendaWeek,agendaDay',
				right: 'prev,next,today'
			},
			defaultDate: today,
			selectable: true,
			selectHelper: true,
            views: {
                month: { // name of view
                    titleFormat: 'MMMM YYYY'
                    // other view-specific options here
                },
                week: {
                    titleFormat: " MMMM D YYYY"
                },
                day: {
                    titleFormat: 'D MMM, YYYY'
                }
            },

			select: function(start, end) {

                // on select we show the Sweet Alert modal with an input
				swal({
                 
    				title: "add event",
    				html: '<div class="form-group">' +
                            '<input class="form-control" placeholder="Event Title" id="input-field">' +
                        '</div>',
    				showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function(result) {

                    var eventData;
                    event_title = $('#input-field').val();
                    var values="event_title="+event_title+"&date="+moment(start).format()+
                    "&end="+moment(end).format();



                    var url="http://insurance.mutengeneresort.com/admin/phpdata/events/add-event.php?"+values;

                            $.ajax({
            url:url,
            type:"POST",
            dataType:"json",
            success: function(response){

                var newData = response.success;
                if(newData==1){
                     swal("Event status",response.message,"success");
                   //  swal(moment(end).format());
                    if (event_title) {
                        eventData = {
                            title: event_title,
                            start: start,
                            end: end
                        };
                        $calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
                    }

                    $calendar.fullCalendar('unselect');

                }else{
                    swal("User status",response.message,"warning");

                }
            }

        });

                   
    				
                });
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events


            // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
          //  eventsSources:[ {
          //  	url: 'http://localhost/www.agent.com/admin/phpdata/events/all-events.php',
          //  	type: 'GET',
          //  	data:{},
         	// error: function(){
         	// 	alert("no data found");
         	// }
          
          //  }]
          events: "http://insurance.mutengeneresort.com/admin/phpdata/events/all-events.php",
       eventClick: function(event){
            if(event.title){
                swal({
                    title: 'Name:'+event.username,
                    html: '<div class="form-group label-floating">' +
                          '<b>Agenda:</b>'+event.title+'<br>'+
                           '<b>Date:</b>'+event.selected_date+'<br>'+
                         
                        '</div>',
                });
            }
        }
		});
    },

	showNotification: function(from, align){
        type = ['','info','success','warning','danger','rose','primary'];

        color = Math.floor((Math.random() * 6) + 1);

    	$.notify({
        	icon: "notifications",
        	message: "Welcome to <b>Material Dashboard</b> - a beautiful freebie for every web developer."

        },{
            type: type[color],
            timer: 3000,
            placement: {
                from: from,
                align: align
            }
        });
	},

    appointments: function(){
        $calendar = $('#myAppointments');

        today = new Date();
        y = today.getFullYear();
        m = today.getMonth();
        d = today.getDate();

        $calendar.fullCalendar({
            viewRender: function(view, element) {
                // We make sure that we activate the perfect scrollbar when the view isn't on Month
                if (view.name != 'month'){
                    $(element).find('.fc-scroller').perfectScrollbar();
                }
            },
            header: {
                left: 'title',
                center: 'month,agendaWeek,agendaDay',
                right: 'prev,next,today'
            },
            defaultDate: today,
            selectable: true,
            selectHelper: true,
            views: {
                month: { // name of view
                    titleFormat: 'MMMM YYYY'
                    // other view-specific options here
                },
                week: {
                    titleFormat: " MMMM D YYYY"
                },
                day: {
                    titleFormat: 'D MMM, YYYY'
                }
            },

            select: function(start, end) {


             swal({
                 
                    title: "Add Appointment",
                    html: '<div class="form-group">' +
                            '<input class="form-control" placeholder="Name of Client" id="input-field-name">' +

                        '</div>'+
                        '<div class="form-group">' +
                            '<input class="form-control" placeholder="appointment Agenda" id="input-field-agenda">' +
                            
                        '</div>'+
                        '<div class="form-group">' +
                            '<input class="form-control" type="number" placeholder="Phone Number" id="input-field-phone">' +
                            
                        '</div>'+
                         '<div class="form-group">' +
                            '<select class="form-control" id="select-ref">'+
                               '<option value="1">Existing Clients</option>'+
                                '<option value="2">Referals</option>'+
                                '<option value="3">Centers of influence</option>'+
                                '<option value="4">Cold Canvasing</option>'+
                                '<option value="5">Worksites</option>'+
                                '<option value="6">Nesting</option>'+
                                '<option value="7">Media</option>'+
                                '<option value="8">Affinity Groups</option>'+
                                '<option value="9">Group presentation</option>'+
                          '</select>' +                       
                        '</div>'
                         ,
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function(result) {

                    var eventData;
                    name = $('#input-field-name').val();
                    agenda = $('#input-field-agenda').val();
                    phone = $('#input-field-phone').val();
                    refrence = $('#select-ref').val();
                    var values="name="+name+"&date="+moment(start).format()+
                    "&end="+moment(end).format();
                    var value_2="&agenda="+agenda+"&phone="+phone+"&refrence="+refrence;



                    var url="http://insurance.mutengeneresort.com/admin/phpdata/appointments/add-appointment.php?"+values+value_2;

                            $.ajax({
            url:url,
            type:"POST",
            dataType:"json",
            success: function(response){


                var newData = response.success;
                if(newData==1){
                     swal("Appointment status",response.message,"success");
                   //  swal(moment(end).format());
                    if (name) {
                        eventData = {
                            title: name,
                            start: start,
                            end: end
                        };
                        $calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
                    }

                    $calendar.fullCalendar('unselect');

                }else{
                    swal("Appointment status",response.message,"warning");

                }
            }

        });

                   
                    
                 });
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events


            // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
          //  eventsSources:[ {
          //    url: 'http://localhost/www.agent.com/admin/phpdata/events/all-events.php',
          //    type: 'GET',
          //    data:{},
            // error: function(){
            //  alert("no data found");
            // }
          
          //  }]
          events: "http://insurance.mutengeneresort.com/admin/phpdata/appointments/all-appointments.php",
        
        eventClick: function(event){
            if(event.title){
                swal({
                    title: event.title,
                    html: '<div class="form-group label-floating">' +
                          '<b>Agenda:</b>'+event.agenda+'<br>'+
                          '<b>Phone:</b>'+event.phone+'<br>'+
                          '<b>Referal:</b>'+event.referral+'<br>'+
                        '</div>',
                });
            }
        }
        });
    }

}