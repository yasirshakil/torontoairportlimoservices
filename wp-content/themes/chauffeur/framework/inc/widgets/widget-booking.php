<?php

// Widget Class
class chauffeur_booking_widget extends WP_Widget {


/* ------------------------------------------------
	Widget Setup
------------------------------------------------ */

	function chauffeur_booking_widget() {
		
		parent::__construct(false, $name = esc_html__('Chauffeur Booking','chauffeur'), array(
			'description' => esc_html__('Display Chauffeur Booking Form','chauffeur')
		));
	
	}


/* ------------------------------------------------
	Display Widget
------------------------------------------------ */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		
		global $chauffeur_allowed_html_array;
		global $chauffeur_data;
		
		 ?>
		
		<!-- BEGIN .widget-booking-form-wrapper -->
		<div class="widget-booking-form-wrapper">

			<!-- BEGIN #booking-tabs -->
			<div id="booking-tabs">

				<ul class="nav clearfix">
					<li><a id="tab1" href="#tab-one-way"><?php esc_html_e( 'Distance', 'chauffeur' ); ?></a></li>
					<li><a id="tab2" href="#tab-hourly"><?php esc_html_e( 'Hourly', 'chauffeur' ); ?></a></li>
					<li><a id="tab3" href="#tab-flat"><?php esc_html_e( 'Flat Rate', 'chauffeur' ); ?></a></li>
				</ul>

				<!-- BEGIN #tab-one-way -->
				<div id="tab-one-way">

					<!-- BEGIN .booking-form-1 -->	
					<form id="formOneWay" action="<?php echo esc_url($chauffeur_data['booking-page-url']); ?>" class="booking-form-1" method="post">

						<input type="text" name="pickup-address" id="pickup-address1" class="pickup-address" value="" placeholder="<?php esc_html_e('Pick Up Address', 'chauffeur'); ?>" />
						<input type="text" name="dropoff-address" id="dropoff-address1" class="dropoff-address" value="" placeholder="<?php esc_html_e('Drop Off Address', 'chauffeur'); ?>" />
						
						<div class="select-wrapper">
							<i class="fa fa-angle-down"></i>
						 	<select name="return-journey">
								<option value="false"><?php esc_html_e( 'One Way', 'chauffeur' ); ?></option>
								<option value="true"><?php esc_html_e( 'Return', 'chauffeur' ); ?></option>
							</select>
						</div>
						
						<input type="text" name="pickup-date" class="datepicker pickup-date1" value="" placeholder="<?php esc_html_e('Pick Up Date', 'chauffeur'); ?>" />

						<div class="booking-form-time">
							<label><?php esc_html_e('Pick Up Time', 'chauffeur'); ?></label>
						</div>

						<div class="booking-form-hour">
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
							 	<select name="time-hour" class="time-hour1">
									<?php echo time_input_hours();	?>
								</select>
							</div>
						</div>

						<div class="booking-form-min">
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
							 	<select name="time-min" class="time-min1">
									<option value="00"><?php esc_html_e('00', 'chauffeur'); ?></option>
									<option value="05"><?php esc_html_e('05', 'chauffeur'); ?></option>
									<option value="10"><?php esc_html_e('10', 'chauffeur'); ?></option>
									<option value="15"><?php esc_html_e('15', 'chauffeur'); ?></option>
									<option value="20"><?php esc_html_e('20', 'chauffeur'); ?></option>
									<option value="25"><?php esc_html_e('25', 'chauffeur'); ?></option>
									<option value="30"><?php esc_html_e('30', 'chauffeur'); ?></option>
									<option value="35"><?php esc_html_e('35', 'chauffeur'); ?></option>
									<option value="40"><?php esc_html_e('40', 'chauffeur'); ?></option>
									<option value="45"><?php esc_html_e('45', 'chauffeur'); ?></option>
									<option value="50"><?php esc_html_e('50', 'chauffeur'); ?></option>
									<option value="55"><?php esc_html_e('55', 'chauffeur'); ?></option>
								</select>
							</div>
						</div>
						
						<input type="hidden" name="form_type" value="one_way" />
						<input type="hidden" name="external_form" value="true" />
						
						<button type="button" class="bookingbutton2">
			 				<span><?php esc_html_e('Reserve Now', 'chauffeur'); ?></span>
						</button>

					<!-- END .booking-form-1 -->
					</form>

				<!-- END #tab-one-way -->
				</div>

				<!-- BEGIN #tab-hourly -->
				<div id="tab-hourly">

					<!-- BEGIN .booking-form-1 -->
					<form id="formHourly" action="<?php echo esc_url($chauffeur_data['booking-page-url']); ?>" class="booking-form-1" method="post">

						<input type="text" name="pickup-address" id="pickup-address2" class="pickup-address" value="" placeholder="<?php esc_html_e('Pick Up Address', 'chauffeur'); ?>" />

						<div class="one-third">
							<label><?php esc_html_e('Trip Duration', 'chauffeur'); ?></label>
						</div>

						<div class="two-thirds last-col">
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
							 	<select name="num-hours" class="ch-num-hours">
									<option value="1hr"><?php esc_html_e('1 Hour', 'chauffeur'); ?></option>
									<option value="2hr"><?php esc_html_e('2 Hours', 'chauffeur'); ?></option>
									<option value="3hr"><?php esc_html_e('3 Hours', 'chauffeur'); ?></option>
									<option value="4hr"><?php esc_html_e('4 Hours', 'chauffeur'); ?></option>
									<option value="5hr"><?php esc_html_e('5 Hours', 'chauffeur'); ?></option>
									<option value="6hr"><?php esc_html_e('6 Hours', 'chauffeur'); ?></option>
									<option value="7hr"><?php esc_html_e('7 Hours', 'chauffeur'); ?></option>
									<option value="8hr"><?php esc_html_e('8 Hours', 'chauffeur'); ?></option>
									<option value="9hr"><?php esc_html_e('9 Hours', 'chauffeur'); ?></option>
									<option value="10hr"><?php esc_html_e('10 Hours', 'chauffeur'); ?></option>
									<option value="11hr"><?php esc_html_e('11 Hours', 'chauffeur'); ?></option>
									<option value="12hr"><?php esc_html_e('12 Hours', 'chauffeur'); ?></option>
									<option value="13hr"><?php esc_html_e('13 Hours', 'chauffeur'); ?></option>
									<option value="14hr"><?php esc_html_e('14 Hours', 'chauffeur'); ?></option>
									<option value="15hr"><?php esc_html_e('15 Hours', 'chauffeur'); ?></option>
									<option value="16hr"><?php esc_html_e('16 Hours', 'chauffeur'); ?></option>
									<option value="17hr"><?php esc_html_e('17 Hours', 'chauffeur'); ?></option>
									<option value="18hr"><?php esc_html_e('18 Hours', 'chauffeur'); ?></option>
									<option value="19hr"><?php esc_html_e('19 Hours', 'chauffeur'); ?></option>
									<option value="20hr"><?php esc_html_e('20 Hours', 'chauffeur'); ?></option>
									<option value="21hr"><?php esc_html_e('21 Hours', 'chauffeur'); ?></option>
									<option value="22hr"><?php esc_html_e('22 Hours', 'chauffeur'); ?></option>
									<option value="23hr"><?php esc_html_e('23 Hours', 'chauffeur'); ?></option>
									<option value="24hr"><?php esc_html_e('24 Hours', 'chauffeur'); ?></option>
									<option value="25hr"><?php esc_html_e('25 Hours', 'chauffeur'); ?></option>
									<option value="26hr"><?php esc_html_e('26 Hours', 'chauffeur'); ?></option>
									<option value="27hr"><?php esc_html_e('27 Hours', 'chauffeur'); ?></option>
									<option value="28hr"><?php esc_html_e('28 Hours', 'chauffeur'); ?></option>
									<option value="29hr"><?php esc_html_e('29 Hours', 'chauffeur'); ?></option>
									<option value="30hr"><?php esc_html_e('30 Hours', 'chauffeur'); ?></option>
									<option value="31hr"><?php esc_html_e('31 Hours', 'chauffeur'); ?></option>
									<option value="32hr"><?php esc_html_e('32 Hours', 'chauffeur'); ?></option>
									<option value="33hr"><?php esc_html_e('33 Hours', 'chauffeur'); ?></option>
									<option value="34hr"><?php esc_html_e('34 Hours', 'chauffeur'); ?></option>
									<option value="35hr"><?php esc_html_e('35 Hours', 'chauffeur'); ?></option>
									<option value="36hr"><?php esc_html_e('36 Hours', 'chauffeur'); ?></option>
									<option value="37hr"><?php esc_html_e('37 Hours', 'chauffeur'); ?></option>
									<option value="38hr"><?php esc_html_e('38 Hours', 'chauffeur'); ?></option>
									<option value="39hr"><?php esc_html_e('39 Hours', 'chauffeur'); ?></option>
									<option value="40hr"><?php esc_html_e('40 Hours', 'chauffeur'); ?></option>
									<option value="41hr"><?php esc_html_e('41 Hours', 'chauffeur'); ?></option>
									<option value="42hr"><?php esc_html_e('42 Hours', 'chauffeur'); ?></option>
									<option value="43hr"><?php esc_html_e('43 Hours', 'chauffeur'); ?></option>
									<option value="44hr"><?php esc_html_e('44 Hours', 'chauffeur'); ?></option>
									<option value="45hr"><?php esc_html_e('45 Hours', 'chauffeur'); ?></option>
									<option value="46hr"><?php esc_html_e('46 Hours', 'chauffeur'); ?></option>
									<option value="47hr"><?php esc_html_e('47 Hours', 'chauffeur'); ?></option>
									<option value="48hr"><?php esc_html_e('48 Hours', 'chauffeur'); ?></option>
								</select>
							</div>
						</div>

						<input type="text" name="dropoff-address" value="" id="dropoff-address2" class="dropoff-address" placeholder="<?php esc_html_e('Drop Off Address', 'chauffeur'); ?>" />
						<input type="text" name="pickup-date" class="datepicker pickup-date2" value="" placeholder="<?php esc_html_e('Pick Up Date', 'chauffeur'); ?>" />

						<div class="booking-form-time">
							<label><?php esc_html_e('Pick Up Time', 'chauffeur'); ?></label>
						</div>

						<div class="booking-form-hour">
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
							 	<select name="time-hour" class="time-hour2">
									<?php echo time_input_hours();	?>
								</select>
							</div>
						</div>

						<div class="booking-form-min">
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
							 	<select name="time-min" class="time-min2">
									<option value="00"><?php esc_html_e('00', 'chauffeur'); ?></option>
									<option value="05"><?php esc_html_e('05', 'chauffeur'); ?></option>
									<option value="10"><?php esc_html_e('10', 'chauffeur'); ?></option>
									<option value="15"><?php esc_html_e('15', 'chauffeur'); ?></option>
									<option value="20"><?php esc_html_e('20', 'chauffeur'); ?></option>
									<option value="25"><?php esc_html_e('25', 'chauffeur'); ?></option>
									<option value="30"><?php esc_html_e('30', 'chauffeur'); ?></option>
									<option value="35"><?php esc_html_e('35', 'chauffeur'); ?></option>
									<option value="40"><?php esc_html_e('40', 'chauffeur'); ?></option>
									<option value="45"><?php esc_html_e('45', 'chauffeur'); ?></option>
									<option value="50"><?php esc_html_e('50', 'chauffeur'); ?></option>
									<option value="55"><?php esc_html_e('55', 'chauffeur'); ?></option>
								</select>
							</div>
						</div>
						
						<input type="hidden" name="form_type" value="hourly" />
						<input type="hidden" name="external_form" value="true" />
						
						<button type="button" class="bookingbutton2">
			 				<span><?php esc_html_e('Reserve Now', 'chauffeur'); ?></span>
						</button>

					<!-- END .booking-form-1 -->
					</form>

				<!-- END #tab-hourly -->
				</div>
				
				<!-- BEGIN #tab-flat -->
				<div id="tab-flat">

					<!-- BEGIN .booking-form-1 -->
					<form id="formFlat" action="<?php echo esc_url($chauffeur_data['booking-page-url']); ?>" class="booking-form-1" method="post">
						
						<div class="booking-form-full">
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
							 	<select name="flat-location">
									
									<?php global $post;
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
											
											echo '<option value="' . get_the_ID() . '">';
											echo $chauffeur_flat_rate_trips_pick_up_name . ' > ' . $chauffeur_flat_rate_trips_drop_off_name;
											echo '</option>';

										endwhile;

									endif;
									wp_reset_query(); ?>
									
								</select>
							</div>
						</div>
						
						<div class="booking-form-full">
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
							 	<select name="return-journey">
									<option value="false"><?php esc_html_e( 'One Way', 'chauffeur' ); ?></option>
									<option value="true"><?php esc_html_e( 'Return', 'chauffeur' ); ?></option>
								</select>
							</div>
						</div>
						
						<input type="text" name="pickup-date" class="datepicker pickup-date3" value="" placeholder="<?php esc_html_e('Pick Up Date','chauffeur'); ?>" />

						<div class="booking-form-time">
							<label><?php esc_html_e('Pick Up Time','chauffeur'); ?></label>
						</div>

						<div class="booking-form-hour">
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
							 	<select name="time-hour" class="time-hour3">
									<?php echo time_input_hours();	?>
								</select>
							</div>
						</div>

						<div class="booking-form-min">
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
							 	<select name="time-min" class="time-min3">
									<option value="00"><?php esc_html_e('00', 'chauffeur'); ?></option>
									<option value="05"><?php esc_html_e('05', 'chauffeur'); ?></option>
									<option value="10"><?php esc_html_e('10', 'chauffeur'); ?></option>
									<option value="15"><?php esc_html_e('15', 'chauffeur'); ?></option>
									<option value="20"><?php esc_html_e('20', 'chauffeur'); ?></option>
									<option value="25"><?php esc_html_e('25', 'chauffeur'); ?></option>
									<option value="30"><?php esc_html_e('30', 'chauffeur'); ?></option>
									<option value="35"><?php esc_html_e('35', 'chauffeur'); ?></option>
									<option value="40"><?php esc_html_e('40', 'chauffeur'); ?></option>
									<option value="45"><?php esc_html_e('45', 'chauffeur'); ?></option>
									<option value="50"><?php esc_html_e('50', 'chauffeur'); ?></option>
									<option value="55"><?php esc_html_e('55', 'chauffeur'); ?></option>
								</select>
							</div>
						</div>
						
						<input type="hidden" name="form_type" value="flat" />
						<input type="hidden" name="external_form" value="true" />
						
						<button type="button" class="bookingbutton2">
			 				<span><?php esc_html_e('Reserve Now', 'chauffeur'); ?></span>
						</button>

					<!-- END .booking-form-1 -->
					</form>

				<!-- END #tab-flat -->
				</div>
				
			<!-- END #booking-tabs -->
			</div>

		<!-- END .widget-booking-form-wrapper -->
		</div>
		
		<?php
		
	}	
	
	
/* ------------------------------------------------
	Update Widget
------------------------------------------------ */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}
	
	
/* ------------------------------------------------
	Widget Input Form
------------------------------------------------ */

	function form( $instance ) {
		$defaults = array(
		'title' => 'Chauffeur Booking',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'chauffeur'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'chauffeur_booking_widget' );

// Register Widget
function chauffeur_booking_widget() {
	register_widget( 'chauffeur_booking_widget' );
}