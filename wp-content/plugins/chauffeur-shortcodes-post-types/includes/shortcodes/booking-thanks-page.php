<?php

function booking_thanks_page_shortcode( $atts, $content = null ) {
	
	global $chauffeur_data;
	
	ob_start();

    if ( isset($_POST['item_number']) ) {
		
		$item_number = $_POST['item_number'];
		
		$get_vehicle_name = get_post_meta($item_number,'chauffeur_payment_item_name',TRUE);
		$get_pickup_address = get_post_meta($item_number,'chauffeur_payment_pickup_address',TRUE);
		$get_dropoff_address = get_post_meta($item_number,'chauffeur_payment_dropoff_address',TRUE);
		$get_pickup_date = get_post_meta($item_number,'chauffeur_payment_pickup_date',TRUE);
		$get_pickup_time = get_post_meta($item_number,'chauffeur_payment_pickup_time',TRUE);
		$get_num_passengers = get_post_meta($item_number,'chauffeur_payment_num_passengers',TRUE);
		$get_num_bags = get_post_meta($item_number,'chauffeur_payment_num_bags',TRUE);
		$get_first_name = get_post_meta($item_number,'chauffeur_payment_first_name',TRUE);
		$get_last_name = get_post_meta($item_number,'chauffeur_payment_last_name',TRUE);
		$get_phone_num = get_post_meta($item_number,'chauffeur_payment_phone_num',TRUE);
		$get_trip_distance = get_post_meta($item_number,'chauffeur_payment_trip_distance',TRUE);
		$get_trip_time = get_post_meta($item_number,'chauffeur_payment_trip_time',TRUE);
		$get_flight_number = get_post_meta($item_number,'chauffeur_payment_flight_number',TRUE);
		$get_additional_details = get_post_meta($item_number,'chauffeur_payment_additional_info',TRUE);
		$get_trip_type = get_post_meta($item_number,'chauffeur_payment_trip_type',TRUE);
		$get_payment_num_hours = get_post_meta($item_number,'chauffeur_payment_num_hours',TRUE);
		$get_payment_email = get_post_meta($item_number,'chauffeur_payment_email',TRUE);
		
		$get_full_pickup_address = get_post_meta($item_number,'chauffeur_payment_full_pickup_address',TRUE);
		$get_pickup_instructions = get_post_meta($item_number,'chauffeur_payment_pickup_instructions',TRUE);
		$get_full_dropoff_address = get_post_meta($item_number,'chauffeur_payment_full_dropoff_address',TRUE);
		$get_dropoff_instructions = get_post_meta($item_number,'chauffeur_payment_dropoff_instructions',TRUE);
		
		 ?>
		
		<!-- BEGIN .booking-step-wrapper -->
		<div class="booking-step-wrapper clearfix">

			<div class="step-wrapper clearfix">
				<div class="step-icon-wrapper">
					<div class="step-icon"><?php esc_html_e('1.','chauffeur'); ?></div>
				</div>
				<div class="step-title"><?php esc_html_e('Trip Details','chauffeur'); ?></div>
			</div>

			<div class="step-wrapper clearfix">
				<div class="step-icon-wrapper">
					<div class="step-icon"><?php esc_html_e('2.','chauffeur'); ?></div>
				</div>
				<div class="step-title"><?php esc_html_e('Select Vehicle','chauffeur'); ?></div>
			</div>

			<div class="step-wrapper clearfix">
				<div class="step-icon-wrapper">
					<div class="step-icon"><?php esc_html_e('3.','chauffeur'); ?></div>
				</div>
				<?php if( $chauffeur_data['hide-pricing'] != '1' ) { ?>
					<div class="step-title"><?php esc_html_e('Enter Payment Details','chauffeur'); ?></div>
				<?php } else { ?>
					<div class="step-title"><?php esc_html_e('Review Details','chauffeur'); ?></div>
				<?php } ?>
			</div>

			<div class="step-wrapper qns-last clearfix">
				<div class="step-icon-wrapper">
					<div class="step-icon step-icon-current"><?php esc_html_e('4.','chauffeur'); ?></div>
				</div>
				<div class="step-title"><?php esc_html_e('Confirmation','chauffeur'); ?></div>
			</div>

			<div class="step-line"></div>

		<!-- END .booking-step-wrapper -->
		</div>

		<!-- BEGIN .full-booking-wrapper -->
		<div class="full-booking-wrapper full-booking-wrapper-3 clearfix">

			<h4><?php esc_html_e('Payment Successful','chauffeur'); ?></h4>
			<div class="title-block7"></div>

			<p><?php echo esc_attr($chauffeur_data['booking-thanks-message']); ?></p>

			<hr class="space7" />

			<h4><?php esc_html_e('Trip Details','chauffeur'); ?></h4>
			<div class="title-block7"></div>

			<!-- BEGIN .clearfix -->
			<div class="clearfix">

				<!-- BEGIN .qns-one-half -->
				<div class="qns-one-half">

					<p class="clearfix"><strong><?php esc_html_e('Service:','chauffeur'); ?></strong> <span><?php echo $get_trip_type; ?></span></p>
					<p class="clearfix"><strong><?php esc_html_e('From:','chauffeur'); ?></strong> <span><?php echo $get_pickup_address; ?></span></p>
					<p class="clearfix"><strong><?php esc_html_e('To:','chauffeur'); ?></strong> <span><?php echo $get_dropoff_address; ?></span></p>
					<p class="clearfix"><strong><?php esc_html_e('Vehicle:','chauffeur'); ?></strong> <span><?php echo $get_vehicle_name; ?></span></p>

				<!-- END .qns-one-half -->
				</div>

				<!-- BEGIN .qns-one-half -->
				<div class="qns-one-half last-col">

					<p class="clearfix"><strong><?php esc_html_e('Date:','chauffeur'); ?></strong> <span><?php echo $get_pickup_date; ?></span></p>

					<?php if ($get_payment_num_hours != '') { ?>

						<p class="clearfix"><strong><?php esc_html_e('Hours','chauffeur'); ?>:</strong> <span><?php echo $get_payment_num_hours; ?></span></p>	

					<?php } else { ?>

						<p class="clearfix"><strong><?php esc_html_e('Distance','chauffeur'); ?>:</strong> <span><?php echo $get_trip_distance; ?> (<?php echo $get_trip_time; ?>)</span></p>	

					<?php } ?>

					<p class="clearfix"><strong><?php esc_html_e('Pick Up Time:','chauffeur'); ?></strong> <span><?php echo $get_pickup_time; ?></span></p>
					<p class="clearfix"><strong><?php esc_html_e('Route Estimate','chauffeur'); ?>:</strong> <span><a href="https://maps.google.com/maps?saddr=<?php echo $get_pickup_address; ?>&amp;daddr=<?php echo $get_dropoff_address; ?>&amp;ie=UTF8&amp;z=11&amp;layer=t&amp;t=m&amp;iwloc=A&amp;output=embed?iframe=true&amp;width=640&amp;height=480" data-gal="prettyPhoto[gallery]" class="view-map-button"><?php esc_html_e('View Map','chauffeur'); ?></a></span></p>

				<!-- END .qns-one-half -->
				</div>

			<!-- END .clearfix -->
			</div>

			<hr class="space2" />

			<h4><?php esc_html_e('Passengers Details','chauffeur'); ?></h4>
			<div class="title-block7"></div>

			<!-- BEGIN .clearfix -->
			<div class="clearfix">

				<!-- BEGIN .passenger-details-wrapper -->
				<div class="passenger-details-wrapper">

					<!-- BEGIN .clearfix -->
					<div class="clearfix">

						<!-- BEGIN .passenger-details-half -->
						<div class="passenger-details-half">

							<p class="clearfix"><strong><?php esc_html_e('Passengers:','chauffeur'); ?></strong> <span><?php echo $get_num_passengers; ?></span></p>
							<p class="clearfix"><strong><?php esc_html_e('Bags:','chauffeur'); ?></strong> <span><?php echo $get_num_bags; ?></span></p>

						<!-- END .passenger-details-half -->
						</div>

						<!-- BEGIN .passenger-details-half -->
						<div class="passenger-details-half last-col">

							<p class="clearfix"><strong><?php esc_html_e('Name:','chauffeur'); ?></strong> <span><?php echo $get_first_name . ' ' . $get_last_name; ?></span></p>
							<p class="clearfix"><strong><?php esc_html_e('Email:','chauffeur'); ?></strong> <span><?php echo $get_payment_email; ?></span></p>
							<p class="clearfix"><strong><?php esc_html_e('Phone:','chauffeur'); ?></strong> <span><?php echo $get_phone_num; ?></span></p>

						<!-- END .passenger-details-half -->
						</div>

					<!-- END .clearfix -->
					</div>

				<!-- END .passenger-details-wrapper -->
				</div>

				<!-- BEGIN .passenger-details-wrapper -->
				<div class="passenger-details-wrapper additional-information-wrapper last-col">

					<p class="clearfix"><strong><?php esc_html_e('Additional Information:','chauffeur'); ?></strong> <span><?php echo $get_additional_details; ?></span></p>

				<!-- END .passenger-details-wrapper -->
				</div>

			<!-- END .clearfix -->
			</div>

		<!-- END .full-booking-wrapper -->
		</div>

	<?php } else { ?>
	
		<p><?php esc_html_e('Invalid Request','chauffeur'); ?></p>
		
	<?php }
	
	return ob_get_clean();
	
}

add_shortcode( 'booking_thanks_page', 'booking_thanks_page_shortcode' );

?>