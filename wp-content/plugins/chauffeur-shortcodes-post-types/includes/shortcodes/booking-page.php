<?php

function booking_page_shortcode( $atts, $content = null ) {
	
	// Stripe library
	require chauffeur_BASE_DIR .'/includes/stripe/Stripe.php';
	
	$stripe_result = chauffeur_stripe_payment($_POST);
	
	global $chauffeur_data;
	
	// PayPal IPN
	$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    if (preg_match('/paypal\.com$/', $hostname)) {	
		$obj = New PayPal_IPN();
		$obj->ipn_response($_REQUEST);		
    }

	$output = '';
	
	// If the booking page referral is from an external form automatically go to booking step 2
	if ( isset($_POST['external_form'] ) ) {
		
		if($_POST['form_type'] == 'one_way') {
			
			$output .= '<div class="booking-step-wrapper clearfix">' . booking_steps('2') . '</div>';
			$output .= '<div class="booking-form-content clearfix">' . booking_step_2("one_way") . '</div>';

		// Booking Form Step 2 
		} elseif($_POST['form_type'] == 'hourly') {

			$output .= '<div class="booking-step-wrapper clearfix">' . booking_steps('2') . '</div>';
			$output .= '<div class="booking-form-content clearfix">' . booking_step_2("hourly") . '</div>';

		} elseif($_POST['form_type'] == 'flat') {

			$output .= '<div class="booking-step-wrapper clearfix">' . booking_steps('2') . '</div>';
			$output .= '<div class="booking-form-content clearfix">' . booking_step_2("flat") . '</div>';

			}
	
	// Else just load booking step 1 as normal
	} else {
		
		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

		$output .= '<!-- BEGIN .booking-step-wrapper -->
		<div class="booking-step-wrapper clearfix">';

			if ( !empty($stripe_result) ) {
				$output .= booking_steps('4');
			} elseif(isset($_POST['pay_now']) && isset($_POST['payment-method'])) {
				
				if ( $_POST['payment-method'] == 'paypal' ) {
					$output .= booking_steps('3');
				} elseif ( $_POST['payment-method'] == 'stripe' ) {
					$output .= booking_steps('3');
				} else {
					$output .= booking_steps('4');
				}
			
			} else {
				$output .= booking_steps('1');
			}
			
		$output .= '<!-- END .booking-step-wrapper -->
		</div>';
		
		if ( !empty($stripe_result) ) {
			
			global $chauffeur_data;
			
			if ( $stripe_result["payment_status"] == 'success' ) {
				
				$get_vehicle_name = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_item_name',TRUE);
				$get_pickup_address = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_pickup_address',TRUE);
				$get_dropoff_address = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_dropoff_address',TRUE);
				$get_pickup_date = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_pickup_date',TRUE);
				$get_pickup_time = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_pickup_time',TRUE);
				$get_num_passengers = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_num_passengers',TRUE);
				$get_num_bags = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_num_bags',TRUE);
				$get_first_name = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_first_name',TRUE);
				$get_last_name = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_last_name',TRUE);
				$get_phone_num = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_phone_num',TRUE);
				$get_trip_distance = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_trip_distance',TRUE);
				$get_flight_number = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_flight_number',TRUE);
				$get_trip_time = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_trip_time',TRUE);
				$get_additional_details = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_additional_info',TRUE);
				$get_trip_type = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_trip_type',TRUE);
				$get_payment_num_hours = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_num_hours',TRUE);
				$get_payment_email = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_email',TRUE);
				
				$get_full_pickup_address = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_full_pickup_address',TRUE);
				$get_pickup_instructions = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_pickup_instructions',TRUE);
				$get_full_dropoff_address = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_full_dropoff_address',TRUE);
				$get_dropoff_instructions = get_post_meta($stripe_result["booking_id"],'chauffeur_payment_dropoff_instructions',TRUE);
				
				$output .= '<!-- BEGIN .full-booking-wrapper -->
				<div class="full-booking-wrapper full-booking-wrapper-3 clearfix">

					<h4>' . esc_html__('Payment Successful','chauffeur') . '</h4>
					<div class="title-block7"></div>

					<p>' . esc_attr($chauffeur_data['booking-thanks-message']) . '</p>

					<hr class="space7" />

					<h4>' . esc_html__('Trip Details','chauffeur') . '</h4>
					<div class="title-block7"></div>

					<!-- BEGIN .clearfix -->
					<div class="clearfix">

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half">

							<p class="clearfix"><strong>' . esc_html__('Service:','chauffeur') . '</strong> <span>' . $get_trip_type . '</span></p>
							<p class="clearfix"><strong>' . esc_html__('From:','chauffeur') . '</strong> <span>' . $get_pickup_address . '</span></p>
							<p class="clearfix"><strong>' . esc_html__('To:','chauffeur') . '</strong> <span>' . $get_dropoff_address . '</span></p>
							<p class="clearfix"><strong>' . esc_html__('Vehicle:','chauffeur') . '</strong> <span>' . $get_vehicle_name . '</span></p>

						<!-- END .qns-one-half -->
						</div>

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half last-col">

							<p class="clearfix"><strong>' . esc_html__('Date:','chauffeur') . '</strong> <span>' . $get_pickup_date . '</span></p>';

							if ($get_payment_num_hours != '') {

								$output .= '<p class="clearfix"><strong>' . esc_html__('Hours','chauffeur') . ':</strong> <span>' . $get_payment_num_hours . '</span></p>';

							} else {

								$output .= '<p class="clearfix"><strong>' . esc_html__('Distance','chauffeur') . ':</strong> <span>' . $get_trip_distance . ' (' . $get_trip_time . ')</span></p>';	

							}

							$output .= '<p class="clearfix"><strong>' . esc_html__('Pick Up Time:','chauffeur') . '</strong> <span>' . $get_pickup_time . '</span></p>
							<p class="clearfix"><strong>' . esc_html__('Route Estimate','chauffeur') . ':</strong> <span><a href="https://maps.google.com/maps?saddr=' . $get_pickup_address . '&amp; daddr=' . $get_dropoff_address . '&amp;ie=UTF8&amp;z=11&amp;layer=t&amp;t=m&amp;iwloc=A&amp;output=embed?iframe=true&amp;width=640&amp;height=480" data-gal="prettyPhoto[gallery]" class="view-map-button">' .  esc_html__('View Map','chauffeur') . '</a></span></p>

						<!-- END .qns-one-half -->
						</div>

					<!-- END .clearfix -->
					</div>

					<hr class="space2" />

					<h4>' . esc_html__('Passengers Details','chauffeur') . '</h4>
					<div class="title-block7"></div>

					<!-- BEGIN .clearfix -->
					<div class="clearfix">

						<!-- BEGIN .passenger-details-wrapper -->
						<div class="passenger-details-wrapper">

							<!-- BEGIN .clearfix -->
							<div class="clearfix">

								<!-- BEGIN .passenger-details-half -->
								<div class="passenger-details-half">

									<p class="clearfix"><strong>' . esc_html__('Passengers:','chauffeur') . '</strong> <span>' . $get_num_passengers . '</span></p>
									<p class="clearfix"><strong>' . esc_html__('Bags:','chauffeur') . '</strong> <span>' . $get_num_bags . '</span></p>

								<!-- END .passenger-details-half -->
								</div>

								<!-- BEGIN .passenger-details-half -->
								<div class="passenger-details-half last-col">

									<p class="clearfix"><strong>' . esc_html__('Name:','chauffeur') . '</strong> <span>' . $get_first_name . ' ' . $get_last_name . '</span></p>
									<p class="clearfix"><strong>' . esc_html__('Email:','chauffeur') . '</strong> <span>' . $get_payment_email . '</span></p>
									<p class="clearfix"><strong>' . esc_html__('Phone:','chauffeur') . '</strong> <span>' . $get_phone_num . '</span></p>

								<!-- END .passenger-details-half -->
								</div>

							<!-- END .clearfix -->
							</div>

						<!-- END .passenger-details-wrapper -->
						</div>

						<!-- BEGIN .passenger-details-wrapper -->
						<div class="passenger-details-wrapper additional-information-wrapper last-col">

							<p class="clearfix"><strong>' . esc_html__('Additional Information:','chauffeur') . '</strong> <span>' . $get_additional_details . '</span></p>

						<!-- END .passenger-details-wrapper -->
						</div>

					<!-- END .clearfix -->
					</div>

				<!-- END .full-booking-wrapper -->
				</div>';
				 
			} else {
				
				$output .= '<!-- BEGIN .full-booking-wrapper -->
				<div class="full-booking-wrapper full-booking-wrapper-3 clearfix">

					<h4>' . esc_html__('Payment Failed','chauffeur') . '</h4>
					<div class="title-block7"></div>

					<p>' . esc_html__('Unfortunately we were not able to process your payment, please contact us at hello@test.com for assistance.','chauffeur') . '</p>

				<!-- END .full-booking-wrapper -->
				</div>';
				
			}
			
		// Load Payment
		} elseif(isset($_POST['pay_now']) && isset($_POST['payment-method'])) {
			
			// Get form data
			$num_passengers = $_POST['num-passengers'];
			$num_bags = $_POST['num-bags'];
			$first_name = $_POST['first-name'];
			$last_name = $_POST['last-name'];
			$email_address = $_POST['email-address'];
			$phone_number = $_POST['phone-number'];
			$additional_info = $_POST['additional-info'];
			$flight_number = $_POST['flight-number'];			
			$selected_vehicle_name = $_POST['selected-vehicle-name'];
			$selected_vehicle_price = $_POST['selected-vehicle-price'];
			$form_type = $_POST['form-type'];
			$pickup_address = $_POST['pickup-address'];
			$dropoff_address = $_POST['dropoff-address'];
			$pickup_date = $_POST['pickup-date'];
			$pickup_time = $_POST['pickup-time'];
			$trip_distance = $_POST['trip-distance'];
			$trip_time = $_POST['trip-time'];
			$num_hours = $_POST['num-hours'];
			
			$full_pickup_address = $_POST['full-pickup-address'];
			$pickup_instructions = $_POST['pickup-instructions'];
			$full_dropoff_address = $_POST['full-dropoff-address'];
			$dropoff_instructions = $_POST['dropoff-instructions'];
			
			if ($_POST['return-journey']) {
				
				if ( $_POST['return-journey'] == 'true' ) {
					$return_journey = esc_html__('Return','chauffeur');
				} else {
					$return_journey = esc_html__('One Way','chauffeur');
				}
				
			} else {
				
				$return_journey = '';
			
			}
			
			// Booking query
			$add_booking_query = array(
				'post_title'    => $first_name . ' ' . $last_name . ' (' . $pickup_date . ' ' . esc_html__( 'at', 'chauffeur' ) . ' ' . $pickup_time . ')',
				'post_status'   => 'publish',
				'post_type'	    => 'payment'
			);

			// Insert booking
			$booking_id = wp_insert_post( $add_booking_query );
			
			// Insert custom fields
			update_post_meta($booking_id, 'chauffeur_payment_status', esc_html__( 'Unpaid', 'chauffeur' ) );
			//update_post_meta($booking_id, 'chauffeur_payment_details', esc_html__( 'N/A', 'chauffeur' ) );
			update_post_meta($booking_id, 'chauffeur_payment_num_passengers', $num_passengers );
			update_post_meta($booking_id, 'chauffeur_payment_num_bags', $num_bags );
			update_post_meta($booking_id, 'chauffeur_payment_first_name', $first_name );
			update_post_meta($booking_id, 'chauffeur_payment_last_name', $last_name );
			update_post_meta($booking_id, 'chauffeur_payment_email', $email_address );
			update_post_meta($booking_id, 'chauffeur_payment_phone_num', $phone_number );
			update_post_meta($booking_id, 'chauffeur_payment_flight_number', $flight_number );
			update_post_meta($booking_id, 'chauffeur_payment_additional_info', $additional_info );
			update_post_meta($booking_id, 'chauffeur_payment_pickup_address', $pickup_address );
			update_post_meta($booking_id, 'chauffeur_payment_dropoff_address', $dropoff_address );
			update_post_meta($booking_id, 'chauffeur_payment_pickup_date', $pickup_date );
			update_post_meta($booking_id, 'chauffeur_payment_pickup_time', $pickup_time );
			update_post_meta($booking_id, 'chauffeur_payment_trip_distance', $trip_distance );
			update_post_meta($booking_id, 'chauffeur_payment_trip_time', $trip_time );
			update_post_meta($booking_id, 'chauffeur_payment_item_name', $selected_vehicle_name );
			update_post_meta($booking_id, 'chauffeur_payment_trip_type', $form_type );
			update_post_meta($booking_id, 'chauffeur_payment_return_journey', $return_journey );
			update_post_meta($booking_id, 'chauffeur_payment_num_hours', $num_hours );
			update_post_meta($booking_id, 'chauffeur_payment_amount', $selected_vehicle_price );
			
			update_post_meta($booking_id, 'chauffeur_payment_full_pickup_address', $full_pickup_address );
			update_post_meta($booking_id, 'chauffeur_payment_pickup_instructions', $pickup_instructions );
			update_post_meta($booking_id, 'chauffeur_payment_full_dropoff_address', $full_dropoff_address );
			update_post_meta($booking_id, 'chauffeur_payment_dropoff_instructions', $dropoff_instructions );
			
			// Load PayPal
			if ( $_POST['payment-method'] == 'paypal' ) {
				
				$data = array(
					'merchant_email'=> esc_attr($chauffeur_data['paypal-address']),
					'product_name'=> get_bloginfo('name'),
					'item_number'=> $booking_id,
					'amount'=> $selected_vehicle_price,
					'currency_code'=> esc_attr($chauffeur_data['paypal-currency']),
					'thanks_page'=> esc_attr($chauffeur_data['thanks-page-url']),
					'notify_url'=> esc_url($chauffeur_data['booking-page-url']),
					'cancel_url'=> "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
					'paypal_mode'=> true
				);

				$output .= '<div class="paypal-loader">' . esc_html__( 'PayPal is loading, please wait...', 'chauffeur' ) . '</div>';
				
				$output .= payment_form($data);
			
			// Load Stripe
			} elseif ($_POST['payment-method'] == 'stripe') {

				global $chauffeur_data;
				
				$params = array(
					"testmode"   => $chauffeur_data['stripe-testmode'],
					"private_live_key" => $chauffeur_data['stripe-live-secret-key'],
					"public_live_key"  => $chauffeur_data['stripe-live-publishable-key'],
					"private_test_key" => $chauffeur_data['stripe-test-secret-key'],
					"public_test_key"  => $chauffeur_data['stripe-test-publishable-key']
				);
				
				if ($params['testmode'] == "on") {
					Stripe::setApiKey($params['private_test_key']);
					$pubkey = $params['public_test_key'];
				} else {
					Stripe::setApiKey($params['private_live_key']);
					$pubkey = $params['public_live_key'];
				}
				
				$output .= '<div class="full-booking-wrapper full-booking-wrapper-3 clearfix">

				<h4>' . esc_html__( 'Enter Payment Information', 'chauffeur' ) . '</h4>
				<div class="title-block7"></div>

				<p class="stripe-review-payment">' . esc_html__( 'Please review the details before entering payment information.', 'chauffeur' ) . '</p>

				<p class="stripe-trip-details">' . $pickup_address . ' > ' . $dropoff_address . ' (' . chauffeur_get_price($selected_vehicle_price) . ')</p>

				<form action="" method="POST" id="payment-form">

					<span class="payment-errors"></span>

					<label>' . esc_html__( 'Card Holder Name', 'chauffeur' ) . '</label>
					<input size="20" data-stripe="name" type="text" />

					<label>' . esc_html__( 'Card Number', 'chauffeur' ) . '</label>
					<input type="text" size="20" data-stripe="number" />

					<div class="clearfix">
					
						<div class="qns-one-half">
							<label>' . esc_html__( 'Expiration (MM)', 'chauffeur' ) . '</label>
							<input type="text" size="2" data-stripe="exp_month" />
						</div>
						
						<div class="qns-one-half last-col">
							<label>' . esc_html__( 'Expiration (YY)', 'chauffeur' ) . '</label>
							<input type="text" size="2" data-stripe="exp_year" />
						</div>
						
					</div>

					<label>' . esc_html__( 'CVC', 'chauffeur' ) . '</label>
					<input type="text" size="4" data-stripe="cvc" />

					<input type="hidden" name="pay_now" value="true" />
					<input type="hidden" name="payment-method" value="stripe" />

					<input type="hidden" name="num-passengers" value="' . $_POST['num-passengers'] . '" />
					<input type="hidden" name="num-bags" value="' . $_POST['num-bags'] . '" />
					<input type="hidden" name="first-name" value="' . $_POST['first-name'] . '" />
					<input type="hidden" name="last-name" value="' . $_POST['last-name'] . '" />
					<input type="hidden" name="email-address" value="' . $_POST['email-address'] . '" />
					<input type="hidden" name="phone-number" value="' . $_POST['phone-number'] . '" />
					<input type="hidden" name="flight-number" value="' . $_POST['flight-number'] . '" />
					<input type="hidden" name="additional-info" value="' . $_POST['additional-info'] . '" />
					<input type="hidden" name="selected-vehicle-name" value="' . $_POST['selected-vehicle-name'] . '" />
					<input type="hidden" name="selected-vehicle-price" value="' . $_POST['selected-vehicle-price'] . '" />
					<input type="hidden" name="form-type" value="' . $_POST['form-type'] . '" />
					<input type="hidden" name="pickup-address" value="' . $_POST['pickup-address'] . '" />
					<input type="hidden" name="dropoff-address" value="' . $_POST['dropoff-address'] . '" />
					<input type="hidden" name="pickup-date" value="' . $_POST['pickup-date'] . '" />
					<input type="hidden" name="pickup-time" value="' . $_POST['pickup-time'] . '" />
					<input type="hidden" name="trip-distance" value="' . $_POST['trip-distance'] . '" />
					<input type="hidden" name="trip-time" value="' . $_POST['trip-time'] . '" />
					<input type="hidden" name="num-hours" value="' . $_POST['num-hours'] . '" />

					<input type="hidden" name="full-pickup-address" value="' . $_POST['full-pickup-address'] . '" />
					<input type="hidden" name="pickup-instructions" value="' . $_POST['pickup-instructions'] . '" />
					<input type="hidden" name="full-dropoff-address" value="' . $_POST['full-dropoff-address'] . '" />
					<input type="hidden" name="dropoff-instructions" value="' . $_POST['dropoff-instructions'] . '" />
					
					<input type="hidden" name="booking_id" value="' . $booking_id . '" />

					<button type="submit">
					' . esc_html__( 'Confirm & Pay', 'chauffeur' ) . '
					<i class="fa fa-angle-right"></i>
					</button>

				</form>
				</div>

				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
				<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
				<!-- TO DO : Place below JS code in js file and include that JS file -->
				<script type="text/javascript">
					Stripe.setPublishableKey("' . $pubkey . '");

					$(function() {
					  var $form = $(\'#payment-form\');
					  $form.submit(function(event) {
						// Disable the submit button to prevent repeated clicks:
						$form.find(\'.submit\').prop(\'disabled\', true);

						// Request a token from Stripe:
						Stripe.card.createToken($form, stripeResponseHandler);

						// Prevent the form from being submitted:
						return false;
					  });
					});

					function stripeResponseHandler(status, response) {
					  // Grab the form:
					  var $form = $(\'#payment-form\');

					  if (response.error) { // Problem!

						// Show the errors on the form:
						$form.find(\'.payment-errors\').css( "display", "block" );
						$form.find(\'.payment-errors\').text(response.error.message);
						$form.find(\'.submit\').prop(\'disabled\', false); // Re-enable submission

					  } else { // Token was created!

						// Get the token ID:
						var token = response.id;

						// Insert the token ID into the form so it gets submitted to the server:
						$form.append($(\'<input type="hidden" name="stripeToken">\').val(token));

						// Submit the form:
						$form.get(0).submit();
					  }
					};
				</script>';
				
			// Load cash
			} elseif ($_POST['payment-method'] == 'cash') {
				
				$get_vehicle_name = get_post_meta($booking_id,'chauffeur_payment_item_name',TRUE);
				$get_pickup_address = get_post_meta($booking_id,'chauffeur_payment_pickup_address',TRUE);
				$get_dropoff_address = get_post_meta($booking_id,'chauffeur_payment_dropoff_address',TRUE);
				$get_pickup_date = get_post_meta($booking_id,'chauffeur_payment_pickup_date',TRUE);
				$get_pickup_time = get_post_meta($booking_id,'chauffeur_payment_pickup_time',TRUE);
				$get_num_passengers = get_post_meta($booking_id,'chauffeur_payment_num_passengers',TRUE);
				$get_num_bags = get_post_meta($booking_id,'chauffeur_payment_num_bags',TRUE);
				$get_first_name = get_post_meta($booking_id,'chauffeur_payment_first_name',TRUE);
				$get_last_name = get_post_meta($booking_id,'chauffeur_payment_last_name',TRUE);
				$get_phone_num = get_post_meta($booking_id,'chauffeur_payment_phone_num',TRUE);
				$get_trip_distance = get_post_meta($booking_id,'chauffeur_payment_trip_distance',TRUE);
				$get_trip_time = get_post_meta($booking_id,'chauffeur_payment_trip_time',TRUE);
				$get_flight_number = get_post_meta($booking_id,'chauffeur_payment_flight_number',TRUE);
				$get_additional_details = get_post_meta($booking_id,'chauffeur_payment_additional_info',TRUE);
				$get_trip_type = get_post_meta($booking_id,'chauffeur_payment_trip_type',TRUE);
				$get_payment_num_hours = get_post_meta($booking_id,'chauffeur_payment_num_hours',TRUE);
				$get_payment_email = get_post_meta($booking_id,'chauffeur_payment_email',TRUE);
				
				$get_full_pickup_address = get_post_meta($booking_id,'chauffeur_payment_full_pickup_address',TRUE);
				$get_pickup_instructions = get_post_meta($booking_id,'chauffeur_payment_pickup_instructions',TRUE);
				$get_full_dropoff_address = get_post_meta($booking_id,'chauffeur_payment_full_dropoff_address',TRUE);
				$get_dropoff_instructions = get_post_meta($booking_id,'chauffeur_payment_dropoff_instructions',TRUE);
				$get_return_journey = get_post_meta($booking_id,'chauffeur_payment_return_journey',TRUE);
				
				$amount = $selected_vehicle_price;
				
				$output .= cash_payment_complete($booking_id);
				update_post_meta($booking_id, 'chauffeur_payment_method', esc_html__('Cash','chauffeur') );
				
				// Send customer email
				include ( chauffeur_BASE_DIR . "/includes/templates/email-customer-booking.php");
				wp_mail($get_payment_email,$customer_email_subject,$customer_email_content,$customer_headers);

				// Send admin email
				include ( chauffeur_BASE_DIR . "/includes/templates/email-admin-booking.php");
				wp_mail($chauffeur_data['booking-email'],$admin_email_subject,$admin_email_content,$admin_headers);
				
			}

		} else {
		
		$output .= '<!-- BEGIN .clearfix -->
		<div class="booking-form-content clearfix">

			<!-- BEGIN .widget-booking-form-wrapper -->
			<div class="widget-booking-form-wrapper booking-step-1-form">

				<!-- BEGIN #booking-tabs -->
				<div id="booking-tabs">

					<ul class="nav clearfix">
						<li><a id="tab1" href="#tab-one-way">' . esc_html__( 'Distance', 'chauffeur' ) . '</a></li>
						<li><a id="tab2" href="#tab-hourly">' . esc_html__( 'Hourly', 'chauffeur' ) . '</a></li>
						<li><a id="tab3" href="#tab-flat">' . esc_html__( 'Flat Rate', 'chauffeur' ) . '</a></li>
					</ul>

					<!-- BEGIN #tab-one-way -->
					<div id="tab-one-way">

						<!-- BEGIN .booking-form-1 -->
						<form class="booking-form-1 one-way-transfer-form">

							<input type="text" name="pickup-address" id="pickup-address1" class="pickup-address" placeholder="' . esc_html__( 'Pick Up Address', 'chauffeur' ) . '" />
							<input type="text" name="dropoff-address" id="dropoff-address1" class="dropoff-address" placeholder="' . esc_html__( 'Drop Off Address', 'chauffeur' ) . '" />
							
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
							 	<select name="return-journey">
									<option value="false">' . esc_html__( 'One Way', 'chauffeur' ) . '</option>
									<option value="true">' . esc_html__( 'Return', 'chauffeur' ) . '</option>
								</select>
							</div>
							
							<input type="text" name="pickup-date" class="datepicker pickup-date1" value="" placeholder="' . esc_html__( 'Pick Up Date', 'chauffeur' ) . '" />
							
							
							<div class="booking-form-time">
								<label>' . esc_html__( 'Pick Up Time', 'chauffeur' ) . '</label>
							</div>

							<div class="booking-form-hour">
								<div class="select-wrapper">
									<i class="fa fa-angle-down"></i>
								 	<select name="time-hour" class="time-hour1">';
									$output .= time_input_hours();	
									$output .= '</select>
								</div>
							</div>

							<div class="booking-form-min">
								<div class="select-wrapper">
									<i class="fa fa-angle-down"></i>
								 	<select name="time-min" class="time-min1">
										<option value="00">' . esc_html__( '00', 'chauffeur' ) . '</option>
										<option value="05">' . esc_html__( '05', 'chauffeur' ) . '</option>
										<option value="10">' . esc_html__( '10', 'chauffeur' ) . '</option>
										<option value="15">' . esc_html__( '15', 'chauffeur' ) . '</option>
										<option value="20">' . esc_html__( '20', 'chauffeur' ) . '</option>
										<option value="25">' . esc_html__( '25', 'chauffeur' ) . '</option>
										<option value="30">' . esc_html__( '30', 'chauffeur' ) . '</option>
										<option value="35">' . esc_html__( '35', 'chauffeur' ) . '</option>
										<option value="40">' . esc_html__( '40', 'chauffeur' ) . '</option>
										<option value="45">' . esc_html__( '45', 'chauffeur' ) . '</option>
										<option value="50">' . esc_html__( '50', 'chauffeur' ) . '</option>
										<option value="55">' . esc_html__( '55', 'chauffeur' ) . '</option>
									</select>
								</div>
							</div>

							<input type="hidden" name="form_type" value="one_way" />
							<input type="hidden" name="first_booking_step" class="first_booking_step" value="1" />

							<input type="hidden" name="action" value="contactform_action" />
							'.wp_nonce_field('ajax_contactform', '_acf_nonce1', true, false).'

							<button type="button" class="bookingbutton1">
				 				<span>' . esc_html__( 'Reserve Now', 'chauffeur' ) . '</span>
							</button>

						<!-- END .booking-form-1 -->
						</form>

					<!-- END #tab-one-way -->
					</div>

					<!-- BEGIN #tab-hourly -->
					<div id="tab-hourly">

						<!-- BEGIN .booking-form-1 -->
						<form class="booking-form-1 hourly-service-form">

							<input type="text" name="pickup-address" id="pickup-address2" class="pickup-address" placeholder="' . esc_html__( 'Pick Up Address', 'chauffeur' ) . '" />

							<div class="one-third">
								<label>' . esc_html__( 'Trip Duration', 'chauffeur' ) . '</label>
							</div>

							<div class="two-thirds last-col">
								<div class="select-wrapper">
									<i class="fa fa-angle-down"></i>
								 	<select name="num-hours" class="ch-num-hours">';
									
									if ($chauffeur_data['hourly-maximum']) {
										$hourly_maximum = $chauffeur_data['hourly-maximum'];
									} else {
										$hourly_maximum = '48';
									}
									
									foreach (range(1, $hourly_maximum) as $r) {
										$output .= '<option value="' . $r . '">' . $r . ' ' . esc_html__( 'Hour(s)', 'chauffeur') . '</option>';
									}
								
									$output .= '</select>
								</div>
							</div>

							<input type="text" name="dropoff-address" id="dropoff-address2" class="dropoff-address" placeholder="' . esc_html__( 'Drop Off Address', 'chauffeur' ) . '" />
							<input type="text" name="pickup-date" class="datepicker pickup-date2" value="" placeholder="' . esc_html__( 'Pick Up Date', 'chauffeur' ) . '" />

							<div class="booking-form-time">
								<label>' . esc_html__( 'Pick Up Time', 'chauffeur' ) . '</label>
							</div>

							<div class="booking-form-hour">
								<div class="select-wrapper">
									<i class="fa fa-angle-down"></i>
								 	<select name="time-hour" class="time-hour2">';
									$output .= time_input_hours();	
									$output .= '</select>
								</div>
							</div>

							<div class="booking-form-min">
								<div class="select-wrapper">
									<i class="fa fa-angle-down"></i>
								 	<select name="time-min" class="time-min2">
										<option value="00">' . esc_html__( '00', 'chauffeur' ) . '</option>
										<option value="05">' . esc_html__( '05', 'chauffeur' ) . '</option>
										<option value="10">' . esc_html__( '10', 'chauffeur' ) . '</option>
										<option value="15">' . esc_html__( '15', 'chauffeur' ) . '</option>
										<option value="20">' . esc_html__( '20', 'chauffeur' ) . '</option>
										<option value="25">' . esc_html__( '25', 'chauffeur' ) . '</option>
										<option value="30">' . esc_html__( '30', 'chauffeur' ) . '</option>
										<option value="35">' . esc_html__( '35', 'chauffeur' ) . '</option>
										<option value="40">' . esc_html__( '40', 'chauffeur' ) . '</option>
										<option value="45">' . esc_html__( '45', 'chauffeur' ) . '</option>
										<option value="50">' . esc_html__( '50', 'chauffeur' ) . '</option>
										<option value="55">' . esc_html__( '55', 'chauffeur' ) . '</option>
									</select>
								</div>
							</div>

							<input type="hidden" name="form_type" value="hourly" />
							<input type="hidden" name="first_booking_step" class="first_booking_step" value="1" />

							<input type="hidden" name="action" value="contactform_action" />
							'.wp_nonce_field('ajax_contactform', '_acf_nonce2', true, false).'

							<button type="button" class="bookingbutton1">
				 				<span>' . esc_html__( 'Reserve Now', 'chauffeur' ) . '</span>
							</button>

						<!-- END .booking-form-1 -->
						</form>

					<!-- END #tab-hourly -->
					</div>
					
					<!-- BEGIN #tab-flat -->
					<div id="tab-flat">

						<!-- BEGIN .booking-form-1 -->
						<form action="' . esc_url($chauffeur_data['booking-page-url']) . '" class="booking-form-1" method="post">

							<div class="booking-form-full">
								<div class="select-wrapper">
									<i class="fa fa-angle-down"></i>
								 	<select name="flat-location">';
										
										global $post;
										global $wp_query;
										
										$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

										$args = array(
										'post_type' => 'flat_rate_trips',
										'posts_per_page' => '9999',
										'paged' => $paged,
										'order' => 'ASC',
										'orderby' => 'title'
										);

										$wp_query = new WP_Query( $args );
										if ($wp_query->have_posts()) :

											while($wp_query->have_posts()) :

												$wp_query->the_post();
												
												$chauffeur_flat_rate_trips_pick_up_name = get_post_meta($post->ID, 'chauffeur_flat_rate_trips_pick_up_name', true);
												$chauffeur_flat_rate_trips_drop_off_name = get_post_meta($post->ID, 'chauffeur_flat_rate_trips_drop_off_name', true);
												
												$output .= '<option value="' . get_the_ID() . '">';
												$output .= $chauffeur_flat_rate_trips_pick_up_name . ' > ' . $chauffeur_flat_rate_trips_drop_off_name;
												$output .= '</option>';

											endwhile;

										endif;
										wp_reset_query();
										
									$output .='</select>
								</div>
							</div>
							
							<div class="booking-form-full">
								<div class="select-wrapper">
									<i class="fa fa-angle-down"></i>
								 	<select name="return-journey">
										<option value="false">' . esc_html__( 'One Way', 'chauffeur' ) . '</option>
										<option value="true">' . esc_html__( 'Return', 'chauffeur' ) . '</option>
									</select>
								</div>
							</div>
							
							<input type="text" name="pickup-date" class="datepicker pickup-date3" value="" placeholder="' . esc_html__('Pick Up Date','chauffeur') . '" />

							<div class="booking-form-time">
								<label>' . esc_html__('Pick Up Time','chauffeur') . '</label>
							</div>

							<div class="booking-form-hour">
								<div class="select-wrapper">
									<i class="fa fa-angle-down"></i>
								 	<select name="time-hour" class="time-hour3">';
									$output .= time_input_hours();	
									$output .= '</select>
								</div>
							</div>

							<div class="booking-form-min">
								<div class="select-wrapper">
									<i class="fa fa-angle-down"></i>
								 	<select name="time-min" class="time-min3">
										<option value="00">' . esc_html__( '00', 'chauffeur' ) . '</option>
										<option value="05">' . esc_html__( '05', 'chauffeur' ) . '</option>
										<option value="10">' . esc_html__( '10', 'chauffeur' ) . '</option>
										<option value="15">' . esc_html__( '15', 'chauffeur' ) . '</option>
										<option value="20">' . esc_html__( '20', 'chauffeur' ) . '</option>
										<option value="25">' . esc_html__( '25', 'chauffeur' ) . '</option>
										<option value="30">' . esc_html__( '30', 'chauffeur' ) . '</option>
										<option value="35">' . esc_html__( '35', 'chauffeur' ) . '</option>
										<option value="40">' . esc_html__( '40', 'chauffeur' ) . '</option>
										<option value="45">' . esc_html__( '45', 'chauffeur' ) . '</option>
										<option value="50">' . esc_html__( '50', 'chauffeur' ) . '</option>
										<option value="55">' . esc_html__( '55', 'chauffeur' ) . '</option>
									</select>
								</div>
							</div>
							
							<input type="hidden" name="form_type" value="flat" />
							<input type="hidden" name="first_booking_step" class="first_booking_step" value="1" />
							
							<input type="hidden" name="action" value="contactform_action" />
							'.wp_nonce_field('ajax_contactform', '_acf_nonce2', true, false).'

							<button type="button" class="bookingbutton1">
				 				<span>' . esc_html__( 'Reserve Now', 'chauffeur' ) . '</span>
							</button>

						<!-- END .booking-form-1 -->
						</form>

					<!-- END #tab-flat -->
					</div>
					
				<!-- END #booking-tabs -->
				</div>

			<!-- END .widget-booking-form-wrapper -->
			</div>

			<div class="booking-step-intro">' . $content . '</div>

		<!-- END .clearfix -->
		</div>';
	
	}
	
}
	
return $output;	
	
}

add_shortcode( 'booking_page', 'booking_page_shortcode' );

?>