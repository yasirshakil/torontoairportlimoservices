jQuery(document).ready(function($) {
	
	"use strict";
	
	function chauffeur_email_validation(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}
	
	function check_booking_time(booking_h,booking_m,booking_date) {
		
		// Get current date and time and format it
		var d = new Date();
		var curr_date = d.getDate();
		var curr_month = d.getMonth() + 1;
		var curr_year = d.getFullYear();
		var curr_hour = d.getHours();
		var curr_min = d.getMinutes();
		var curr_date_full = curr_year + "/" + curr_month + "/" + curr_date + " " + curr_hour + ":" + curr_min;

		// Detect date format and format current date and time accordingly
		if ( chauffeur_datepicker_format == 'yy/mm/dd') {
			var data = booking_date;
			var arr = data.split('/');
			var booking_date_full = arr[0] + "/" + arr[1] + "/" + arr[2] + " " + booking_h + ":" + booking_m;
		}

		if ( chauffeur_datepicker_format == 'dd/mm/yy') {
			var data = booking_date;
			var arr = data.split('/');
			var booking_date_full = arr[2] + "/" + arr[1] + "/" + arr[0] + " " + booking_h + ":" + booking_m;
		}

		if ( chauffeur_datepicker_format == 'mm/dd/yy') {
			var data = booking_date;
			var arr = data.split('/');
			var booking_date_full = arr[2] + "/" + arr[0] + "/" + arr[1] + " " + booking_h + ":" + booking_m;
		}
		
		// Convert strings to dates
		var startTime = new Date(curr_date_full); 
		var endTime = new Date(booking_date_full);
		
		// Calculate time difference
		var difference = endTime.getTime() - startTime.getTime();
		var resultInMinutes = Math.round(difference / 60000);
		
		// Check if enough time notice given
		if ( resultInMinutes <= hours_before_booking_minimum ) {
			// Time notice given, can book
			return true;
		} else {
			// Not enough time notice, cannot book
			return false;
		}
		
	}
	
	// Datepicker
	$(".datepicker").datepicker({
		minDate: 0,
		dateFormat: chauffeur_datepicker_format
	});
	
	// Set Datepicker value as todays date
	var todaysDate = $.datepicker.formatDate(chauffeur_datepicker_format, new Date());
	$(".datepicker").val(todaysDate);
	
	// Hide booking form until JS loads
	$(".header-booking-form-wrapper, .body-booking-form-wrapper, .widget-booking-form-wrapper").fadeIn().css("display","block");
	
	// Disable datepicker user input
	$('.datepicker').keydown(function(e) {
	   e.preventDefault();
	   return false;
	});
	
	// Load tabs
	$( "#booking-tabs, #booking-tabs-2" ).tabs();
	
	// Add selected vehicle data in hidden fields
	$(".select-vehicle-wrapper").on('click', '.vehicle-section', function () {
	
		$('.vehicle-section').removeClass("selected-vehicle");
		$(this).toggleClass("selected-vehicle");	
		$('.selected-vehicle-price').val( $(this).attr('data-price') );
		$('.selected-vehicle-name').val( $(this).attr('data-title') );
		
		$('.selected-vehicle-bags').val( $(this).attr('data-bags') );
		$('.selected-vehicle-passengers').val( $(this).attr('data-passengers') );
		
	});
	
	// Remove any content on first page load
	$("#pickup-address1").val("");
	$("#dropoff-address1").val("");
	$("#pickup-address2").val("");
	$("#dropoff-address2").val("");
	
	$(document).on('click','#tab1', function(e) {
		chauffeur_active_tab = 'distance';
	});
	
	$(document).on('click','#tab2', function(e) {
		chauffeur_active_tab = 'hourly';
	});
	
	$(document).on('click','#tab3', function(e) {
		chauffeur_active_tab = 'flat_rate';
	});
	
	var pickup_1 = false;
	var dropoff_1 = false;
	
	var pickup_2 = false;
	var dropoff_2 = false;
	
	function initialize_autosuggest(form_tab) {
		
		if ( Google_AutoComplete_Country != 'ALL_COUNTRIES' ) {
			var options = {
			  componentRestrictions: {country: Google_AutoComplete_Country}
			 };
		} else {
			var options = '';
		}
		
		if(form_tab == 'distance') {
			
			// Pick up address
			var pickup_input1 = document.getElementById('pickup-address1');
			var pickup_autocomplete1 = new google.maps.places.Autocomplete(pickup_input1,options);

			google.maps.event.addListener(pickup_autocomplete1, 'place_changed', function() {
				var pickup_place1 = pickup_autocomplete1.getPlace();
				if (typeof pickup_place1.adr_address==='undefined') {
					pickup_1 = false;
			  	} else {
					pickup_1 = true;
				}
			});

			// Drop off address
			var dropoff_input1 = document.getElementById('dropoff-address1');
			var dropoff_autocomplete1 = new google.maps.places.Autocomplete(dropoff_input1,options);

			google.maps.event.addListener(dropoff_autocomplete1, 'place_changed', function() {
				var dropoff_place1 = dropoff_autocomplete1.getPlace();
				if (typeof dropoff_place1.adr_address==='undefined') {
					dropoff_1 = false;
			  	} else {
					dropoff_1 = true;
				}
			});
			
		}
		
		if(form_tab == 'hourly') {
			
			// Pick up address
			var pickup_input2 = document.getElementById('pickup-address2');
			var pickup_autocomplete2 = new google.maps.places.Autocomplete(pickup_input2,options);

			google.maps.event.addListener(pickup_autocomplete2, 'place_changed', function() {
				var pickup_place2 = pickup_autocomplete2.getPlace();
				if (typeof pickup_place2.adr_address==='undefined') {
					pickup_2 = false;
			  	} else {
					pickup_2 = true;
				}
			});

			// Drop off address
			var dropoff_input2 = document.getElementById('dropoff-address2');
			var dropoff_autocomplete2 = new google.maps.places.Autocomplete(dropoff_input2,options);

			google.maps.event.addListener(dropoff_autocomplete2, 'place_changed', function() {
				var dropoff_place2 = dropoff_autocomplete2.getPlace();
				if (typeof dropoff_place2.adr_address==='undefined') {
					dropoff_2 = false;
			  	} else {
					dropoff_2 = true;
				}
			});
			
		}
		
	}
	
	if (typeof google != 'undefined') {
		google.maps.event.addDomListener(window, 'load', initialize_autosuggest('distance'));
		google.maps.event.addDomListener(window, 'load', initialize_autosuggest('hourly'));
	}
	
	$(document).on("click",'.bookingbutton2, .bookingbutton1', function(e) {
		
		var chauffeur_form_submit = new Array();
		
		// Booking step 1 button
		if( $(".first_booking_step").val() == '1' || $(this).attr("class") == 'bookingbutton2' ) {
			
			// Validate distance tab form if selected
			if (chauffeur_active_tab == 'distance') {

				// Google autocomplete validation
				if ( pickup_1 == false && dropoff_1 == false ) {
					// Do not submit
					alert(chauffeur_autocomplete);
					chauffeur_form_submit.push(false);
				} else {
					if ( pickup_1 == dropoff_1 ) {
						// Submit
						chauffeur_form_submit.push(true);
					} else {
						// Do not submit
						alert(chauffeur_autocomplete);
						chauffeur_form_submit.push(false);
					}
				}

				// Pick up and drop off address empty validation
				if ( $("#pickup-address1").val() == '' || $("#dropoff-address1").val() == '' ) {
					// Do not submit
					alert(chauffeur_pickup_dropoff_error);
					chauffeur_form_submit.push(false);
				} else {
					// Submit
					chauffeur_form_submit.push(true);
				}

				// Minimum notice time validation
				if ( check_booking_time($(".time-hour1").val(),$(".time-min1").val(),$(".pickup-date1").val()) == true ) {
					// Do not submit
					alert(chauffeur_min_time_before_booking_error);
					chauffeur_form_submit.push(false);
				} else {
					// Submit
					chauffeur_form_submit.push(true);
				}

			}

			// Validate hourly tab form if selected
			if (chauffeur_active_tab == 'hourly') {

				// Google autocomplete validation
				if ( pickup_2 == false && dropoff_2 == false ) {
					// Do not submit
					alert(chauffeur_autocomplete);
					chauffeur_form_submit.push(false);
				} else {
					if ( pickup_2 == dropoff_2 ) {
						// Submit
						chauffeur_form_submit.push(true);
					} else {
						// Do not submit
						alert(chauffeur_autocomplete);
						chauffeur_form_submit.push(false);
					}
				}

				// Pick up and drop off address empty validation
				if ( $("#pickup-address2").val() == '' || $("#dropoff-address2").val() == '' ) {
					// Do not submit
					alert(chauffeur_pickup_dropoff_error);
					chauffeur_form_submit.push(false);
				} else {
					// Submit
					chauffeur_form_submit.push(true);
				}

				// Minimum notice time validation
				if ( check_booking_time($(".time-hour2").val(),$(".time-min2").val(),$(".pickup-date2").val()) == true ) {
					// Do not submit
					alert(chauffeur_min_time_before_booking_error);
					chauffeur_form_submit.push(false);
				} else {
					// Submit
					chauffeur_form_submit.push(true);
				}

				// Validate hourly
			    if ( parseInt($('.ch-num-hours').val()) < parseInt(hourly_minimum) ) {
					// Do not submit        
			        alert(ch_minimum_hourly_alert);
			        chauffeur_form_submit.push(false);
			    } else {
					// Submit
					chauffeur_form_submit.push(true);
				}

			}

			// Validate flat rate tab form if selected
			if (chauffeur_active_tab == 'flat_rate') {

				// Minimum notice time validation
				if ( check_booking_time($(".time-hour3").val(),$(".time-min3").val(),$(".pickup-date3").val()) == true ) {
					// Do not submit
					alert(chauffeur_min_time_before_booking_error);
					chauffeur_form_submit.push(false);
				} else {
					// Submit
					chauffeur_form_submit.push(true);
				}

			}
			
			// Submit	
			if ( $.inArray(false, chauffeur_form_submit) == -1 ) {

				if (chauffeur_active_tab == 'distance') {
					$("#formOneWay").trigger('submit');
				}

				if (chauffeur_active_tab == 'hourly') {
					$("#formHourly").trigger('submit');
				}

				if (chauffeur_active_tab == 'flat_rate') {
					$("#formFlat").trigger('submit');
				}

			}

		}
		
		// AJAX booking process
		if( $(this).attr("class") == 'bookingbutton1' ) {
			
			if ( $(".booking-step-2-form").val() == '1' ) {
				
				// Validate vehicle selection
				if ( $(".selected-vehicle-name").val() == '') {
					// Do not submit    
			        alert(chauffeur_select_vehicle);
			        return false;
			    }
				
				// Validate form fields
				var ch_validation_error = false;
				
				$('.required-form-field').each(function() {
					if ($.trim($(this).val()) == '') {
						ch_validation_error = true;
					}
				});
				
				if ( ch_validation_error == true ) {
					// Do not submit   
			        alert(chauffeur_complete_required);
			        chauffeur_form_submit.push(false);
				} else {
					// Submit
			        chauffeur_form_submit.push(true);
				}
				
				// Email validation
				if ( chauffeur_email_validation( $(".form-email-address").val() ) == false ) {
					// Do not submit   
			        alert(chauffeur_valid_email);
			        chauffeur_form_submit.push(false);
				} else {
					// Submit
			        chauffeur_form_submit.push(true);
				}
				
				// Phone number validation
				if( $.isNumeric($(".form-phone-number").val()) ) {
				    // Submit
			        chauffeur_form_submit.push(true);
				} else {
					// Do not submit   
			        alert(chauffeur_valid_phone);
			        chauffeur_form_submit.push(false);
				}
				
				// Max bags validation
				if ( Number($(".num-bags").val()) > Number($(".selected-vehicle-bags").val()) ) {
					// Do not submit   
			        alert(chauffeur_valid_bags);
			        chauffeur_form_submit.push(false);
				} else {
					// Submit
			        chauffeur_form_submit.push(true);
				}
				
				// Max passengers validation
				if ( Number($(".num-passengers").val()) > Number($(".selected-vehicle-passengers").val()) ) {
					// Do not submit   
			        alert(chauffeur_valid_passengers);
			        chauffeur_form_submit.push(false);
				} else {
					// Submit
			        chauffeur_form_submit.push(true);
				}
				
				if( chauffeur_terms_set == 'true' ) {
				
					if( $('.terms_and_conditions').is(':checked') == false ) {
				        alert(chauffeur_terms);
				        return false;
			        }
				
				}
				
			}
			
			// Submit
			if ( $.inArray(false, chauffeur_form_submit) !== -1 ) {

				// Do not submit
				
			} else {
				
				// Submit
				
				// Add form data into array
				var $form1 = $(this).closest('.booking-form-1');
				var formData1 = $form1.serializeArray();
				formData1.push({
				    name: this.name,
				    value: this.value
				});

				// Post form via AJAX
				$.ajax({
					type: 'POST',
					url: AJAX_URL,
					data: formData1,
					dataType: 'json',
					success: function(response) {
						
						// Fade divs and add loading image between booking steps
						$('.widget-booking-form-wrapper, .booking-step-intro, .full-booking-wrapper-3, .select-vehicle-wrapper, .trip-details-wrapper').css('opacity','1');
						
						// AJAX success response
						if (response.status == 'success') {
							$('.booking-form-1')[0].reset();
						}

						// Display outside in divs
						$('.booking-step-wrapper').html(response.booking_step_wrapper);
						$('.booking-form-content').html(response.booking_form_content);

						// Load prettyPhoto in response
						$("a[data-gal^='prettyPhoto']").prettyPhoto();  

						// Scroll to top for each booking step
						$('html,body').animate({
						   scrollTop: $(".booking-step-wrapper").offset().top
						});

						// Add selected vehicle data in hidden fields
						$(".select-vehicle-wrapper").on('click', '.vehicle-section', function () {

							$('.vehicle-section').removeClass("selected-vehicle");
							$(this).toggleClass("selected-vehicle");	
							$('.selected-vehicle-price').val( $(this).attr('data-price') );
							$('.selected-vehicle-name').val( $(this).attr('data-title') );
							
							$('.selected-vehicle-bags').val( $(this).attr('data-bags') );
							$('.selected-vehicle-passengers').val( $(this).attr('data-passengers') );
							
						});

					}

				});
				
				// Fade divs and add loading image between booking steps
				$('.widget-booking-form-wrapper, .booking-step-intro, .full-booking-wrapper-3, .select-vehicle-wrapper, .trip-details-wrapper').css('opacity','0.3');
				
			}
			
		}
	
	});

});