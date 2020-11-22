<?php global $chauffeur_data; ?>

<!-- BEGIN .full-booking-wrapper -->
<div class="full-booking-wrapper full-booking-wrapper-3 clearfix">

	<h4><?php esc_html_e('Trip Details','chauffeur'); ?></h4>
	<div class="title-block7"></div>

	<!-- BEGIN .clearfix -->
	<div class="clearfix">

		<!-- BEGIN .qns-one-half -->
		<div class="qns-one-half">
			
			<?php if ($_POST['form_type'] == 'one_way') {
				$form_type_text = esc_html__('Distance','chauffeur');
			} elseif ($_POST['form_type'] == 'hourly') {
				$form_type_text = esc_html__('Hourly','chauffeur');
			} elseif ($_POST['form_type'] == 'flat') {
					$form_type_text = esc_html__('Flat Rate','chauffeur');
			} ?>
					
			<p class="clearfix"><strong><?php esc_html_e('Service','chauffeur'); ?>:</strong> <span><?php echo $form_type_text; ?></span></p>
			
			<?php if ( $_POST['form_type'] == 'flat' ) {
				
				$pick_up_address = get_post_meta($_POST['flat-location'], 'chauffeur_flat_rate_trips_pick_up_name', true);
				$drop_off_address = get_post_meta($_POST['flat-location'], 'chauffeur_flat_rate_trips_drop_off_name', true);
				
			} else {
				
				$pick_up_address = $_POST['pickup-address'];
				$drop_off_address = $_POST['dropoff-address'];
				
			} ?>
			
			<p class="clearfix"><strong><?php esc_html_e('From','chauffeur'); ?>:</strong> <span><?php echo $pick_up_address; if( $_POST['full-pickup-address'] ) { echo '(' . $_POST['full-pickup-address'] . ')'; } ?></span></p>
			<p class="clearfix"><strong><?php esc_html_e('To','chauffeur'); ?>:</strong> <span><?php echo $drop_off_address; if( $_POST['full-dropoff-address'] ) { echo '(' . $_POST['full-dropoff-address'] . ')'; } ?></span></p>
			
			<p class="clearfix"><strong><?php esc_html_e('Vehicle','chauffeur'); ?>:</strong> <span><?php echo $_POST["selected-vehicle-name"]; ?></span></p>
			
			<?php if ( $_POST['return-journey']) {
				
				if ( $_POST['return-journey'] == 'true' ) {
					$return_journey = esc_html__('Return','chauffeur');
				} else {
					$return_journey = esc_html__('One Way','chauffeur');
				}
			
				echo '<p class="clearfix"><strong>' . esc_html__('Return','chauffeur') . ':</strong> <span>' .  $return_journey . '</span></p>';
			
			} ?>
			
			<?php if ( $_POST['flight-number'] ) { ?>
			
				<p class="clearfix"><strong><?php esc_html_e('Flight Number','chauffeur'); ?>:</strong> <span><?php echo $_POST["flight-number"]; ?></span></p>
			
			<?php } ?>
		
		<!-- END .qns-one-half -->
		</div>

		<!-- BEGIN .qns-one-half -->
		<div class="qns-one-half last-col">

			<p class="clearfix"><strong><?php esc_html_e('Date','chauffeur'); ?>:</strong> <span><?php echo $_POST["pickup-date"]; ?></span></p>
			
			<?php if ($_POST['num-hours'] != '') { ?>
				
				<p class="clearfix"><strong><?php esc_html_e('Hours','chauffeur'); ?>:</strong> <span><?php echo $_POST['num-hours']; ?></span></p>	
				
			<?php } elseif ( $_POST['form_type'] != 'flat' ) { ?>
				
				<p class="clearfix"><strong><?php esc_html_e('Distance','chauffeur'); ?>:</strong> <span><?php echo $_POST['trip-distance']; ?> (<?php echo $_POST['trip-time']; ?>)</span></p>	
			
			<?php } ?>
			
			<p class="clearfix"><strong><?php esc_html_e('Pick Up Time','chauffeur'); ?>:</strong> <span><?php echo $_POST["pickup-time"]; ?></span></p>
			
			<?php if ( $_POST['pickup-instructions'] ) { ?>
			
				<p class="clearfix"><strong><?php esc_html_e('Pick Up Instructions','chauffeur'); ?>:</strong> <span><?php echo $_POST["pickup-instructions"]; ?></span></p>
			
			<?php } ?>
			
			<?php if ( $_POST['dropoff-instructions'] ) { ?>
			
				<p class="clearfix"><strong><?php esc_html_e('Drop Off Instructions','chauffeur'); ?>:</strong> <span><?php echo $_POST["dropoff-instructions"]; ?></span></p>
			
			<?php } ?>
			
			<?php if ( $_POST['full-pickup-address'] ) { ?>
			
				<p class="clearfix"><strong><?php esc_html_e('Full Pick Up Address','chauffeur'); ?>:</strong> <span><?php echo $_POST["full-pickup-address"]; ?></span></p>
			
			<?php } ?>
			
			<?php if ( $_POST['full-dropoff-address'] ) { ?>
			
				<p class="clearfix"><strong><?php esc_html_e('Full Drop Off Address','chauffeur'); ?>:</strong> <span><?php echo $_POST["full-dropoff-address"]; ?></span></p>
			
			<?php } ?>
			
			<?php if ( $_POST['form_type'] != 'flat' ) { ?>
			
			<p class="clearfix"><strong><?php esc_html_e('Route Estimate','chauffeur'); ?>:</strong> <span><a href="https://maps.google.com/maps?saddr=<?php echo $_POST['pickup-address']; ?>&amp;daddr=<?php echo $_POST['dropoff-address']; ?>&amp;ie=UTF8&amp;z=11&amp;layer=t&amp;t=m&amp;iwloc=A&amp;output=embed?iframe=true&amp;width=640&amp;height=480" data-gal="prettyPhoto[gallery]" class="view-map-button"><?php esc_html_e('View Map','chauffeur'); ?></a></span></p>
			
			<?php } ?>

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

					<p class="clearfix"><strong><?php esc_html_e('Passengers','chauffeur'); ?>:</strong> <span><?php echo $_POST["num-passengers"]; ?></span></p>
					<p class="clearfix"><strong><?php esc_html_e('Bags','chauffeur'); ?>:</strong> <span><?php echo $_POST["num-bags"]; ?></span></p>

				<!-- END .passenger-details-half -->
				</div>

				<!-- BEGIN .passenger-details-half -->
				<div class="passenger-details-half last-col">

					<p class="clearfix"><strong><?php esc_html_e('Name','chauffeur'); ?>:</strong> <span><?php echo $_POST["first-name"]; ?> <?php echo $_POST["last-name"]; ?></span></p>
					<p class="clearfix"><strong><?php esc_html_e('Email','chauffeur'); ?>:</strong> <span><?php echo $_POST["email-address"]; ?></span></p>
					<p class="clearfix"><strong><?php esc_html_e('Phone','chauffeur'); ?>:</strong> <span><?php echo $_POST["phone-number"]; ?></span></p>

				<!-- END .passenger-details-half -->
				</div>

			<!-- END .clearfix -->
			</div>

		<!-- END .passenger-details-wrapper -->
		</div>

		<!-- BEGIN .passenger-details-wrapper -->
		<div class="passenger-details-wrapper additional-information-wrapper last-col">

			<p class="clearfix"><strong><?php esc_html_e('Additional Information','chauffeur'); ?>:</strong> <span><?php echo $_POST["additional-info"]; ?> </span></p>

		<!-- END .passenger-details-wrapper -->
		</div>

	<!-- END .clearfix -->
	</div>

	<form class="total-price-display clearfix" method="post" action="#">
		
		<?php
		
		$flat_rate_surcharge = $chauffeur_data['surcharge-enable-flat-rate'];
		$distance_surcharge = $chauffeur_data['surcharge-enable-distance'];
		$hourly_surcharge = $chauffeur_data['surcharge-enable-hourly'];
		
		// Check if surcharge is enabled for form type
		if ( $_POST['form_type'] == 'flat' && $flat_rate_surcharge == 1 || $_POST['form_type'] == 'hourly' && $hourly_surcharge == 1 || $_POST['form_type'] == 'one_way' && $distance_surcharge == 1 ) {
			$use_surcharge = true;
		} else {
			$use_surcharge = false;
		}
		
		// If surcharge is enabled for form type add it to total
		if ( $use_surcharge == 1 ) {
			
			if( $chauffeur_data['booking-surcharge'] == 'percentage' ) {
				$total_booking_price = $chauffeur_data['surcharge-percentage'] * $_POST["selected-vehicle-price"] / 100 + $_POST["selected-vehicle-price"];
			} elseif ( $chauffeur_data['booking-surcharge'] == 'flat-rate' ) {
				$total_booking_price = $_POST["selected-vehicle-price"] + $chauffeur_data['surcharge-flat-rate'];
			} else {
				$total_booking_price = $_POST["selected-vehicle-price"];
			}
		
		// Else do not add surcharge to total
		} else {
			
			$total_booking_price = $_POST["selected-vehicle-price"];
			
		} ?>
		
		<input type="hidden" name="num-passengers" value="<?php echo $_POST['num-passengers']; ?>" />
		<input type="hidden" name="num-bags" value="<?php echo $_POST['num-bags']; ?>" />
		<input type="hidden" name="first-name" value="<?php echo $_POST['first-name']; ?>" />
		<input type="hidden" name="last-name" value="<?php echo $_POST['last-name']; ?>" />
		<input type="hidden" name="email-address" value="<?php echo $_POST['email-address']; ?>" />
		<input type="hidden" name="phone-number" value="<?php echo $_POST['phone-number']; ?>" />
		<input type="hidden" name="flight-number" value="<?php echo $_POST['flight-number']; ?>" />
		<input type="hidden" name="additional-info" value="<?php echo $_POST['additional-info']; ?>" />
		<input type="hidden" name="selected-vehicle-name" value="<?php echo $_POST['selected-vehicle-name']; ?>" />
		<input type="hidden" name="selected-vehicle-price" value="<?php echo number_format((float)$total_booking_price, 2, '.', ''); ?>" />
		<input type="hidden" name="form-type" value="<?php echo $_POST['form_type']; ?>" />
		<input type="hidden" name="pickup-address" value="<?php echo $_POST['pickup-address']; ?>" />
		<input type="hidden" name="dropoff-address" value="<?php echo $_POST['dropoff-address']; ?>" />
		<input type="hidden" name="pickup-date" value="<?php echo $_POST['pickup-date']; ?>" />
		<input type="hidden" name="pickup-time" value="<?php echo $_POST['pickup-time']; ?>" />
		<input type="hidden" name="trip-distance" value="<?php echo $_POST['trip-distance']; ?>" />
		<input type="hidden" name="trip-time" value="<?php echo $_POST['trip-time']; ?>" />
		<input type="hidden" name="num-hours" value="<?php echo $_POST['num-hours']; ?>" />
		<input type="hidden" name="flat-location" value="<?php if( isset($_POST['flat-location']) ) {echo $_POST['flat-location'];} ?>" />
		
		<input type="hidden" name="full-pickup-address" value="<?php echo $_POST['full-pickup-address']; ?>" />
		<input type="hidden" name="pickup-instructions" value="<?php echo $_POST['pickup-instructions']; ?>" />
		<input type="hidden" name="full-dropoff-address" value="<?php echo $_POST['full-dropoff-address']; ?>" />
		<input type="hidden" name="dropoff-instructions" value="<?php echo $_POST['dropoff-instructions']; ?>" />
		
		<?php if ( $_POST['return-journey'] ) { ?>
			<input type="hidden" name="return-journey" value="<?php if( isset($_POST['return-journey']) ) {echo $_POST['return-journey'];} ?>" />
		<?php } ?>
		
		<?php if( $chauffeur_data['hide-pricing'] != '1' ) { ?>
		
		<div class="total-price-inner clearfix">
			<p><?php esc_html_e('Total Price','chauffeur'); ?>: <strong><?php echo chauffeur_get_price(number_format((float)$total_booking_price, 2, '.', '')); ?></strong>
				
				<?php if ( $use_surcharge == 1 ) { ?>
				
					<?php if( $chauffeur_data['booking-surcharge'] == 'percentage' ) { ?>

						<span>(<?php esc_html_e( 'Includes Surcharge of','chauffeur' ); ?> <?php echo $chauffeur_data['surcharge-percentage']; ?>%)</span>

					<?php } elseif ( $chauffeur_data['booking-surcharge'] == 'flat-rate' ) { ?>

						<span>(<?php esc_html_e( 'Includes Surcharge of','chauffeur' ); ?> <?php echo chauffeur_get_price($chauffeur_data['surcharge-flat-rate']); ?>)</span>

					<?php } ?>
				
				<?php } ?>
				
			</p>
		</div>
		
		<?php } ?>
		
		<div class="payment-options-section clearfix">
			
			<?php if( $chauffeur_data['hide-pricing'] != '1' ) { ?>
			
			<?php if( $chauffeur_data['enable-paypal'] == '1' ) {
				
				$paypal_check = '1';
				$stripe_check = '0';
				$cash_check = '0';
				
			} elseif ( $chauffeur_data['enable-paypal'] == '0' && $chauffeur_data['enable-stripe'] == '1' ) {
				
				$paypal_check = '0';
				$stripe_check = '1';
				$cash_check = '0';
				
			} else {
				
				$paypal_check = '0';
				$stripe_check = '0';
				$cash_check = '1';
				
			} ?>
			
			<?php if( $chauffeur_data['enable-paypal'] == '1' ) { ?>
				<div class="radio-wrapper clearfix"><input type="radio" name="payment-method" value="paypal" <?php if( $paypal_check == '1' ) { echo 'checked="checked"'; } ?> /><label><?php esc_html_e('Pay with PayPal','chauffeur'); ?></label><img src="<?php echo plugins_url('../../assets/images/paypal.png', __FILE__); ?>"></div>
			<?php } ?>
			
			<?php if( $chauffeur_data['enable-stripe'] == '1' ) { ?>
				<div class="radio-wrapper clearfix"><input type="radio" name="payment-method" value="stripe" <?php if( $stripe_check == '1' ) { echo 'checked="checked"'; } ?> /><label><?php esc_html_e('Pay with Credit Card','chauffeur'); ?></label><img src="<?php echo plugins_url('../../assets/images/stripe.png', __FILE__); ?>"></div>
			<?php } ?>
			
			<?php if( $chauffeur_data['enable-cash'] == '1' ) { ?>
				<div class="radio-wrapper clearfix"><input type="radio" name="payment-method" value="cash" <?php if( $cash_check == '1' ) { echo 'checked="checked"'; } ?> /><label><?php esc_html_e('Pay with Cash','chauffeur'); ?></label></div>
			<?php } ?>
			
			<?php // If all payment gateways are disabled 
			if( $chauffeur_data['enable-paypal'] != '1' && $chauffeur_data['enable-stripe'] != '1' && $chauffeur_data['enable-cash'] != '1' ) { ?>	
				<input type="hidden" name="payment-method" value="cash" />
			<?php } ?>
			
			<button name="pay_now" id="pay_now" class="payment-button" type="submit">
				<?php esc_html_e('Proceed To Payment','chauffeur'); ?>
			</button>
			
			<?php } else { ?>
				
				<input type="hidden" name="payment-method" value="cash" />

				<button name="pay_now" id="pay_now" class="payment-button" type="submit">
					<?php esc_html_e('Proceed To Book','chauffeur'); ?>
				</button>
				
			<?php } ?>
		
		</div>
		
	</form>

<!-- END .full-booking-wrapper -->
</div>