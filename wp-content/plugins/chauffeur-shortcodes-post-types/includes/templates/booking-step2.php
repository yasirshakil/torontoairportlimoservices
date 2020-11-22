<?php 

if ( $_POST['form_type'] != 'flat' ) {

	$coordinates1 = get_coordinates($_POST['pickup-address']);
	$coordinates2 = get_coordinates($_POST['dropoff-address']);

	if ( !$coordinates1 || !$coordinates2 ) {	
	    $invalid_address = true;
	} else {

	    $dist = GetDrivingDistance($coordinates1['lat'], $coordinates2['lat'], $coordinates1['long'], $coordinates2['long']);
		$invalid_address = false;

	}

} else {
	$dist = false;
}

if ( $dist['distance'] == false && $_POST['form_type'] != 'flat' ) { ?>

	
		<div class="msg fail clearfix space8"><p><?php esc_html_e('Sorry, we can\'t calculate the distance between the addresses you supplied, please','chauffeur'); ?> <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><?php esc_html_e('try a different address','chauffeur'); ?></a></p></div>
		

<?php } else {
	
		
		global $post;
		global $wp_query;
		global $chauffeur_data;

		$args = array(
			'post_type' => 'fleet',
			'posts_per_page' => '9999',
			'order' => 'DESC'
		);

		$wp_query = new WP_Query( $args );
		if ($wp_query->have_posts()) : ?>

		<!-- BEGIN .clearfix -->
		<div class="clearfix">

		<!-- BEGIN .select-vehicle-wrapper -->
		<div class="select-vehicle-wrapper">

			<h4><?php esc_html_e('Select Vehicle','chauffeur'); ?></h4>
			<div class="title-block7"></div>

			<?php while($wp_query->have_posts()) :
				$wp_query->the_post(); 
				
				// Get Custom Fields
				$chauffeur_fleet_price_from = get_post_meta($post->ID, 'chauffeur_fleet_price_from', true);
				$chauffeur_fleet_price_per_mile = get_post_meta($post->ID, 'chauffeur_fleet_price_per_mile', true);
				$chauffeur_fleet_price_per_hour = get_post_meta($post->ID, 'chauffeur_fleet_price_per_hour', true);
				$chauffeur_fleet_passenger_capacity = get_post_meta($post->ID, 'chauffeur_fleet_passenger_capacity', true);
				$chauffeur_fleet_bag_capacity = get_post_meta($post->ID, 'chauffeur_fleet_bag_capacity', true);
				
				// If flat rate service selected
				if ( $_POST['form_type'] == 'flat' ) {
					
					// If return journey price x2
					if ( $_POST['return-journey'] == 'true' ) {
						$vehicle_price_calculate = get_post_meta($post->ID, 'chauffeur_'.$_POST['flat-location'], true);
						$vehicle_price = $vehicle_price_calculate * 2;
					} else {
						$vehicle_price = get_post_meta($post->ID, 'chauffeur_'.$_POST['flat-location'], true);
					}
				
				}
				
				// If hourly service selected
				elseif ( isset($_POST['num-hours']) ) {
					$vehicle_price = $_POST['num-hours'] * $chauffeur_fleet_price_per_hour;

				// Else charge by the km
				} else {

					if ( isset($dist['distance']) ) {
						$distance_value = str_replace( ',', '', $dist['distance'] );
						
						global $chauffeur_data;

						if ( $chauffeur_data['google-distance-matrix-unit'] == 'imperial' ) {
							$distance_value_complete = str_replace( 'mi', '', $distance_value );
						} else {
							$distance_value_complete = str_replace( 'km', '', $distance_value );
						}
						
						//$vehicle_price = $distance_value_complete * $chauffeur_fleet_price_per_mile;
						
						// If return journey price x2
						if ( $_POST['return-journey'] == 'true' ) {
							
							$vehicle_price = ($distance_value_complete * $chauffeur_fleet_price_per_mile) * 2;
						} else {
							$vehicle_price = $distance_value_complete * $chauffeur_fleet_price_per_mile;
						}
						
					} else {
						$distance_value = '0';
						$distance_value_complete = '0';
						$vehicle_price = '0';
					}

				}
				
				// Use minimum price
				if ( $vehicle_price < $chauffeur_fleet_price_from ) {
					$vehicle_price = $chauffeur_fleet_price_from;
				}

			?>

			<!-- BEGIN .vehicle-section -->
			<div class="vehicle-section clearfix" id="<?php the_ID(); ?>" data-price="<?php echo $vehicle_price; ?>" data-title="<?php the_title(); ?>" data-bags="<?php echo $chauffeur_fleet_bag_capacity; ?>" data-passengers="<?php echo $chauffeur_fleet_passenger_capacity; ?>">
				
				<?php if( $chauffeur_data['hide-pricing'] != '1' ) { ?>
					
					<p><?php the_title(); ?> <strong><?php echo chauffeur_get_price(number_format((float)$vehicle_price, 2, '.', '')); ?></strong></p>
					
				<?php } else { ?>
					
					<p><?php the_title(); ?></p>
					
				<?php } ?>
				
				<ul>
					<li class="vehicle-bag-limit"><?php echo $chauffeur_fleet_bag_capacity; ?></li>
					<li class="vehicle-passenger-limit"><?php echo $chauffeur_fleet_passenger_capacity; ?></li>
				</ul>
				
				<?php if( $chauffeur_data['remove-vehicle-link'] != '1' ) {
					
					if( has_post_thumbnail() ) { ?>
						<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" target="_blank">
							<?php $thumb_id = get_post_thumbnail_id($post->ID);
							$src = wp_get_attachment_image_src($thumb_id, 'chauffeur-image-style10' ); 
							$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
							echo '<img src="' . esc_url( $src[0] ) . '" alt="' . $alt . '" />'; ?>
						</a>
					<?php }
					
				} else {
					
					if( has_post_thumbnail() ) { ?>	
						<?php $thumb_id = get_post_thumbnail_id($post->ID);
						$src = wp_get_attachment_image_src($thumb_id, 'chauffeur-image-style10' ); 
						$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
						echo '<img src="' . esc_url( $src[0] ) . '" alt="' . $alt . '" />'; ?>
					<?php }
					
				} ?>
				
			<!-- END .vehicle-section -->
			</div>

			<?php endwhile; ?>

		<!-- END .select-vehicle-wrapper -->
		</div>

		<?php else : ?>
			<p><?php esc_html_e('No vehicles have been added yet','chauffeur'); ?></p>
		<?php endif;

		wp_reset_query(); ?>

			<?php 

			// Set trip type
			if ($_POST['form_type'] == 'one_way') {
				$form_type_text = esc_html__('Distance','chauffeur');
			} elseif ($_POST['form_type'] == 'hourly') {
				$form_type_text = esc_html__('Hourly','chauffeur');
			} elseif ($_POST['form_type'] == 'flat') {
				$form_type_text = esc_html__('Flat Rate','chauffeur');
			}

			?>

			<!-- BEGIN .trip-details-wrapper -->
			<div class="trip-details-wrapper clearfix">

				<h4><?php esc_html_e('Trip Details','chauffeur'); ?></h4>
				<div class="title-block7"></div>

				<!-- BEGIN .trip-details-wrapper-1 -->
				<div class="trip-details-wrapper-1">

					<p class="clearfix"><strong><?php esc_html_e('Service Type','chauffeur'); ?>:</strong> <span><?php echo $form_type_text; ?></span></p>
					
					<?php if ( $_POST['form_type'] == 'flat' ) {
						
						$pick_up_address = get_post_meta($_POST['flat-location'], 'chauffeur_flat_rate_trips_pick_up_name', true);
						$drop_off_address = get_post_meta($_POST['flat-location'], 'chauffeur_flat_rate_trips_drop_off_name', true);
						
					} else {
						
						$pick_up_address = $_POST['pickup-address'];
						$drop_off_address = $_POST['dropoff-address'];
						
					} ?>
					
					<p class="clearfix"><strong><?php esc_html_e('From','chauffeur'); ?>:</strong> <span><?php echo $pick_up_address; ?></span></p>
					<p class="clearfix"><strong><?php esc_html_e('To','chauffeur'); ?>:</strong> <span><?php echo $drop_off_address; ?></span></p>
					
					<?php if ( isset($_POST['num-hours']) ) { ?>

						<p class="clearfix"><strong><?php esc_html_e('Hours','chauffeur'); ?>:</strong> <span><?php echo $_POST['num-hours']; ?></span></p>	

					<?php } ?>
						
					<?php if ( $_POST['return-journey']) {
						
					if ( $_POST['return-journey'] == 'true' ) {
						$return_journey = esc_html__('Return','chauffeur');
					} else {
						$return_journey = esc_html__('One Way','chauffeur');
					} ?>
					
					<p class="clearfix"><strong><?php esc_html_e('Return','chauffeur'); ?>:</strong> <span><?php echo $return_journey; ?></span></p>
					
					<?php } ?>
						
					<?php if ($_POST['form_type'] == 'one_way') { ?>
					
					<?php if ( $invalid_address == true ) { ?>

					    <p class="clearfix"><strong><?php esc_html_e('Distance','chauffeur'); ?>:</strong> <span><?php esc_html_e('Invalid Address','chauffeur'); ?></span></p>

					<?php } else { ?>

					   	<p class="clearfix"><strong><?php esc_html_e('Distance','chauffeur'); ?>:</strong> <span><?php echo $dist['distance']; ?> (<?php echo $dist['time']; ?>)</span></p>

					<?php } ?>
					
					<?php } ?>

				<!-- END .trip-details-wrapper-1 -->
				</div>

				<!-- BEGIN .trip-details-wrapper-2 -->
				<div class="trip-details-wrapper-2">

					<p><strong><?php esc_html_e('Date','chauffeur'); ?>:</strong> <?php echo $_POST['pickup-date']; ?></p>
					<p><strong><?php esc_html_e('Pick Up Time','chauffeur'); ?>:</strong> <?php echo time_output_hours($_POST['time-hour'],$_POST['time-min']); ?></p>
					
					<?php if ( $_POST['form_type'] != 'flat' ) { ?>
					
					<a href="https://maps.google.com/maps?saddr=<?php echo $_POST['pickup-address']; ?>&amp;daddr=<?php echo $_POST['dropoff-address']; ?>&amp;ie=UTF8&amp;z=11&amp;layer=t&amp;t=m&amp;iwloc=A&amp;output=embed?iframe=true&amp;width=640&amp;height=480" data-gal="prettyPhoto[gallery]" class="view-map-button"><?php esc_html_e('View Map','chauffeur'); ?></a>

					<?php } ?>
					
				<!-- END .trip-details-wrapper-2 -->
				</div>

				<div class="clearboth"></div>

				<!-- BEGIN .booking-form-1 -->
				<form class="booking-form-1">

					<!-- BEGIN .clearfix -->
					<div class="clearfix">

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half">
							
							<?php if ($chauffeur_data['max-selectable-passengers']) {
								$max_selectable_passengers = $chauffeur_data['max-selectable-passengers'];
							} else {
								$max_selectable_passengers = '50';
							} ?>
							
							<label><?php esc_html_e('Number Of Passengers','chauffeur'); ?> <span>*</span></label>
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
							 	<select name="num-passengers" class="num-passengers">
									<?php foreach (range(1, $max_selectable_passengers) as $r) { ?>
										<option value="<?php echo $r; ?>"><?php echo $r; ?></option>
									<?php } ?>
								</select>
							</div>

						<!-- END .qns-one-half -->
						</div>

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half last-col">
							
							<?php if ($chauffeur_data['max-selectable-bags']) {
								$max_selectable_bags = $chauffeur_data['max-selectable-bags'];
							} else {
								$max_selectable_bags = '50';
							} ?>
							
							<label><?php esc_html_e('Number Of Bags','chauffeur'); ?> <span>*</span></label>
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
							 	<select name="num-bags" class="num-bags">
									<?php foreach (range(0, $max_selectable_bags) as $r) { ?>
										<option value="<?php echo $r; ?>"><?php echo $r; ?></option>
									<?php } ?>
								</select>
							</div>

						<!-- END .qns-one-half -->
						</div>

					<!-- END .clearfix -->
					</div>
					
					<?php if ($_POST['form_type'] == 'flat') { ?>
					
					<!-- BEGIN .clearfix -->
					<div class="clearfix">

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half">

							<label><?php esc_html_e('Full Pick Up Address','chauffeur'); ?> <span>*</span></label>
							<textarea cols="10" rows="2" class="required-form-field" name="full-pickup-address"></textarea>

						<!-- END .qns-one-half -->
						</div>

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half last-col">
							
							<label><?php esc_html_e('Full Drop Off Address','chauffeur'); ?></label>
							<textarea cols="10" rows="2" name="full-dropoff-address"></textarea>

						<!-- END .qns-one-half -->
						</div>

					<!-- END .clearfix -->
					</div>
					
					<?php } ?>
					
					<!-- BEGIN .clearfix -->
					<div class="clearfix">

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half">

							<label><?php esc_html_e('Pick Up Instructions','chauffeur'); ?></label>
							<textarea cols="10" rows="2" name="pickup-instructions"></textarea>

						<!-- END .qns-one-half -->
						</div>

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half last-col">

							<label><?php esc_html_e('Drop Off Instructions','chauffeur'); ?></label>
							<textarea cols="10" rows="2" name="dropoff-instructions"></textarea>

						<!-- END .qns-one-half -->
						</div>

					<!-- END .clearfix -->
					</div>
					
					<!-- BEGIN .clearfix -->
					<div class="clearfix">

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half">

							<label><?php esc_html_e('First Name','chauffeur'); ?> <span>*</span></label>
							<input type="text" class="required-form-field" name="first-name" value="" />

						<!-- END .qns-one-half -->
						</div>

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half last-col">

							<label><?php esc_html_e('Last Name','chauffeur'); ?> <span>*</span></label>
							<input type="text" class="required-form-field" name="last-name" value="" />

						<!-- END .qns-one-half -->
						</div>

					<!-- END .clearfix -->
					</div>

					<!-- BEGIN .clearfix -->
					<div class="clearfix">

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half">

							<label><?php esc_html_e('Email Address','chauffeur'); ?> <span>*</span></label>
							<input type="text" class="required-form-field form-email-address" name="email-address" value="" />

						<!-- END .qns-one-half -->
						</div>

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half last-col">

							<label><?php esc_html_e('Phone Number','chauffeur'); ?> <span>*</span></label>
							<input type="text" class="required-form-field form-phone-number" name="phone-number" value="" />

						<!-- END .qns-one-half -->
						</div>

					<!-- END .clearfix -->
					</div>
					
					<label><?php esc_html_e('Flight Number','chauffeur'); ?></label>
					<input type="text" class="form-flight-number" name="flight-number" value="" />
					
					<label><?php esc_html_e('Additional Information','chauffeur'); ?></label>
					<textarea cols="10" rows="14" name="additional-info"></textarea>	
					
					<input type="hidden" class="selected-vehicle-name" name="selected-vehicle-name" value="" />
					<input type="hidden" class="selected-vehicle-price" name="selected-vehicle-price" value="" />
					
					<input type="hidden" class="selected-vehicle-bags" name="selected-vehicle-bags" value="" />
					<input type="hidden" class="selected-vehicle-passengers" name="selected-vehicle-passengers" value="" />
					
					<input type="hidden" name="form_type" value="<?php echo $_POST['form_type']; ?>" />	
					<input type="hidden" name="pickup-address" value="<?php if( isset($pick_up_address) ) {echo $pick_up_address;} ?>" />
					<input type="hidden" name="dropoff-address" value="<?php if( isset($drop_off_address) ) {echo $drop_off_address;} ?>" />
					<input type="hidden" name="pickup-date" value="<?php echo $_POST['pickup-date']; ?>" />
					<input type="hidden" name="pickup-time" value="<?php echo time_output_hours($_POST['time-hour'],$_POST['time-min']); ?>" />		
					<input type="hidden" name="trip-distance" value="<?php if( isset($dist['distance']) ) {echo $dist['distance'];} ?>" />
					<input type="hidden" name="trip-time" value="<?php if( isset($dist['time']) ) {echo $dist['time'];} ?>" />
					<input type="hidden" name="currency-symbol" value="<?php echo $chauffeur_data['currency-symbol']; ?>" />
					<input type="hidden" name="num-hours" value="<?php if( isset($_POST['num-hours']) ) {echo $_POST['num-hours'];} ?>" />
					<input type="hidden" name="flat-location" value="<?php if( isset($_POST['flat-location']) ) {echo $_POST['flat-location'];} ?>" />
					
					<?php if ( $_POST['return-journey'] ) { ?>
						<input type="hidden" name="return-journey" value="<?php if( isset($_POST['return-journey']) ) {echo $_POST['return-journey'];} ?>" />
					<?php } ?>
					
					<input type="hidden" class="booking-step-2-form" name="booking-step-2-form" value="1" />
					
					<input type="hidden" name="action" value="contactform_action" />
					<?php wp_nonce_field('ajax_contactform', '_acf_nonce', true, false); ?>
					
					<?php if ( !empty($chauffeur_data["terms_conditions"]) ) { ?>
						<div class="booking-terms-wrapper clearfix">	
							<input type="checkbox" id="terms_and_conditions" name="terms_and_conditions" value="1" class="fl terms_and_conditions">
							<label for="terms_and_conditions" class="fl"><?php esc_html_e('I have read and accept the', 'chauffeur'); ?> <a href="#terms-conditions" data-gal="prettyPhoto"><?php esc_html_e('terms &amp; conditions', 'chauffeur'); ?></a>.</label>
						</div>
					<?php } ?>

					<!-- BEGIN #terms-conditions -->
					<div id="terms-conditions" class="hide">

						<!-- BEGIN .lightbox-title -->
						<div class="lightbox-title">
							<h4 class="title-style4"><?php esc_html_e('Terms &amp; Conditions', 'chauffeur'); ?><span class="title-block"></span></h4>
						<!-- END .lightbox-title -->
						</div>

						<!-- BEGIN .main-content -->
						<div class="main-content main-content-lightbox">

							<?php echo $chauffeur_data["terms_conditions"]; ?>

						<!-- END .page-content -->
						</div>

					<!-- END #terms-conditions -->
					</div>
					
					<?php if( isset($dist['distance']) ) { ?> 

						<button type="button" class="bookingbutton1">
			 				<?php esc_html_e('Confirm &amp; Pay','chauffeur'); ?> <i class="fa fa-angle-right"></i>
						</button>

					<?php } elseif ($_POST['form_type'] == 'flat') { ?>
						
						<button type="button" class="bookingbutton1">
			 				<?php esc_html_e('Confirm &amp; Pay','chauffeur'); ?> <i class="fa fa-angle-right"></i>
						</button>

					<?php } else { ?>
						
						<p><?php esc_html_e('Sorry, the addresses you provided are invalid so we cannot proceed','chauffeur'); ?></p>
						
					<?php } ?>

				<!-- END .booking-form-1 -->
				</form>

			<!-- END .trip-details-wrapper -->
			</div>

		<!-- END .clearfix -->
		</div>

<?php } ?>