<?php

/*
  Plugin Name: Chauffeur Shortcodes & Post Types
  Plugin URI: http://quitenicestuff.com
  Description: A Simple Shortcodes and Post Type Plugin
  Version: 1.3.2
  Author: Quite Nice Stuff
  Author URI: http://quitenicestuff.com
*/



/* ----------------------------------------------------------------------------

   Register Session

---------------------------------------------------------------------------- */
function register_session(){
	if( !session_id())
		session_start();
}

add_action('init','register_session');



/* ----------------------------------------------------------------------------

   Load Language Files

---------------------------------------------------------------------------- */
function chauffeur_init() {
	load_plugin_textdomain( 'chauffeur', false, dirname(plugin_basename( __FILE__ ))  . '/languages/' ); 
}
add_action('init', 'chauffeur_init');



/* ----------------------------------------------------------------------------

   Load Files

---------------------------------------------------------------------------- */
if ( ! defined( 'chauffeur_BASE_FILE' ) )
    define( 'chauffeur_BASE_FILE', __FILE__ );

if ( ! defined( 'chauffeur_BASE_DIR' ) )
    define( 'chauffeur_BASE_DIR', dirname( chauffeur_BASE_FILE ) );

if ( ! defined( 'chauffeur_PLUGIN_URL' ) )
    define( 'chauffeur_PLUGIN_URL', plugin_dir_url( __FILE__ ) );



/* ----------------------------------------------------------------------------

   Plugin Activation

---------------------------------------------------------------------------- */
function chauffeur_shortcodes_activation() {}
register_activation_hook(__FILE__, 'chauffeur_shortcodes_activation');

function chauffeur_shortcodes_deactivation() {}
register_deactivation_hook(__FILE__, 'chauffeur_shortcodes_deactivation');



/* ----------------------------------------------------------------------------

   Load JS

---------------------------------------------------------------------------- */
add_action('wp_enqueue_scripts', 'chauffeur_shortcodes_scripts');
function chauffeur_shortcodes_scripts() {
	
    global $post;
	global $chauffeur_data;
	
	
	
	/* +Flat Rate +Hourly +Distance */
	if ( $chauffeur_data['disable-flat-rate'] == 0 && $chauffeur_data['disable-hourly'] == 0 && $chauffeur_data['disable-distance'] == 0 ) {
		$disable_booking_options_js = "var chauffeur_active_tab = 'distance';";
	}



	/* +Flat Rate +Hourly -Distance */
	if ( $chauffeur_data['disable-flat-rate'] == 0 && $chauffeur_data['disable-hourly'] == 0 && $chauffeur_data['disable-distance'] == 1 ) {
		$disable_booking_options_js = "jQuery(document).ready(function($) { 
			$( '#booking-tabs' ).tabs({ active: 1 });
			$( '#booking-tabs-2' ).tabs({ active: 1 });
		});
		var chauffeur_active_tab = 'hourly';";
	}



	/* +Distance -Hourly +Flat Rate */
	if ( $chauffeur_data['disable-flat-rate'] == 0 && $chauffeur_data['disable-hourly'] == 1 && $chauffeur_data['disable-distance'] == 0  ) {
		$disable_booking_options_js = "jQuery(document).ready(function($) { 
			$( '#booking-tabs' ).tabs({ active: 3 });
			$( '#booking-tabs-2' ).tabs({ active: 3 });
		});
		var chauffeur_active_tab = 'distance';";
	}



	/* +Distance +Hourly -Flat Rate */
	if ( $chauffeur_data['disable-flat-rate'] == 1 && $chauffeur_data['disable-hourly'] == 0 && $chauffeur_data['disable-distance'] == 0  ) {
		$disable_booking_options_js = "jQuery(document).ready(function($) { 
			$( '#booking-tabs' ).tabs({ active: 3 });
			$( '#booking-tabs-2' ).tabs({ active: 3 });
		});
		var chauffeur_active_tab = 'distance';";
	}



	/* +Distance -Hourly -Flat Rate */
	if ( $chauffeur_data['disable-flat-rate'] == 1 && $chauffeur_data['disable-hourly'] == 1 && $chauffeur_data['disable-distance'] == 0  ) {
		$disable_booking_options_js = "jQuery(document).ready(function($) { 
			$( '#booking-tabs' ).tabs({ active: 3 });
			$( '#booking-tabs-2' ).tabs({ active: 3 });
		});
		var chauffeur_active_tab = 'distance';";
	}



	/* +Hourly -Distance -Flat Rate */
	if ( $chauffeur_data['disable-flat-rate'] == 1 && $chauffeur_data['disable-hourly'] == 0 && $chauffeur_data['disable-distance'] == 1  ) {
		$disable_booking_options_js = "jQuery(document).ready(function($) { 
			$( '#booking-tabs' ).tabs({ active: 1 });
			$( '#booking-tabs-2' ).tabs({ active: 1 });
		});
		var chauffeur_active_tab = 'hourly';

		jQuery(document).ready(function($) {
			setTimeout(function(){
				$('#booking-tabs a[href=\"#tab-hourly\"]').trigger('click');
			});
		});

		jQuery(document).ready(function($) {
			setTimeout(function(){
				$('#booking-tabs-2 a[href=\"#tab-hourly\"]').trigger('click');
			});
		});";
	}



	/* +Flat Rate -Hourly -Distance */
	if ( $chauffeur_data['disable-flat-rate'] == 0 && $chauffeur_data['disable-hourly'] == 1 && $chauffeur_data['disable-distance'] == 1  ) {
		$disable_booking_options_js = "jQuery(document).ready(function($) { 
			$( '#booking-tabs' ).tabs({ active: 2 });
			$( '#booking-tabs-2' ).tabs({ active: 2 });
		});
		var chauffeur_active_tab = 'flat_rate';

		jQuery(document).ready(function($) {
			setTimeout(function(){
				$('#booking-tabs a[href=\"#tab-flat\"]').trigger('click');
			});
		});

		jQuery(document).ready(function($) {
			setTimeout(function(){
				$('#booking-tabs-2 a[href=\"#tab-flat\"]').trigger('click');
			});
		});";
	}
	
	if (empty($disable_booking_options_js)) {
		$disable_booking_options_js = '';
	}
	
	$GoogleMapApiKey = $chauffeur_data['google-map-api-key'];
	
	wp_enqueue_script('jquery');
	
	if ( !empty($chauffeur_data['google-map-api-key']) ) {
		//wp_register_script('googleMap', 'http://maps.google.com/maps/api/js?key='.$GoogleMapApiKey);
		//wp_enqueue_script('googleMap');
	}
	
	if ( !empty($chauffeur_data['datepicker-format']) ) {
		$chauffeur_datepicker_format = $chauffeur_data['datepicker-format'];
	} else {
		$chauffeur_datepicker_format = "dd/mm/yy";
	}
	
	if ( !empty($chauffeur_data['google-map-api-key']) ) {
		
		if ( !empty($chauffeur_data['google-api-language']) ) {
			wp_register_script('googlesearch', 'https://maps.googleapis.com/maps/api/js?key=' . $GoogleMapApiKey . '&libraries=places&mode=driving&language='.$chauffeur_data['google-api-language']);
			wp_enqueue_script('googlesearch');
		} else {
			wp_register_script('googlesearch', 'https://maps.googleapis.com/maps/api/js?key=' . $GoogleMapApiKey . '&libraries=places&mode=driving');
			wp_enqueue_script('googlesearch');
		}
		
	}
	
	if ( $chauffeur_data['hours-before-booking-minimum'] == '60' ) {
		$hours_before_booking_minimum = '1';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '120' ) {
		$hours_before_booking_minimum = '2';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '180' ) {
		$hours_before_booking_minimum = '3';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '240' ) {
		$hours_before_booking_minimum = '4';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '300' ) {
		$hours_before_booking_minimum = '5';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '360' ) {
		$hours_before_booking_minimum = '6';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '420' ) {
		$hours_before_booking_minimum = '7';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '480' ) {
		$hours_before_booking_minimum = '8';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '540' ) {
		$hours_before_booking_minimum = '9';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '600' ) {
		$hours_before_booking_minimum = '10';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '660' ) {
		$hours_before_booking_minimum = '11';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '720' ) {
		$hours_before_booking_minimum = '12';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '780' ) {
		$hours_before_booking_minimum = '13';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '840' ) {
		$hours_before_booking_minimum = '14';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '900' ) {
		$hours_before_booking_minimum = '15';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '960' ) {
		$hours_before_booking_minimum = '16';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '1020' ) {
		$hours_before_booking_minimum = '17';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '1080' ) {
		$hours_before_booking_minimum = '18';
	}	elseif ( $chauffeur_data['hours-before-booking-minimum'] == '1140' ) {
		$hours_before_booking_minimum = '19';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '1200' ) {
		$hours_before_booking_minimum = '20';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '1260' ) {
 		$hours_before_booking_minimum = '21';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '1320' ) {
		$hours_before_booking_minimum = '22';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '1380' ) {
		$hours_before_booking_minimum = '23';
	} elseif ( $chauffeur_data['hours-before-booking-minimum'] == '1440' ) {
		$hours_before_booking_minimum = '24';
	}
	
	if ( $chauffeur_data['terms_conditions'] ) {
		$terms_and_conditions = 'true';
	} else {
		$terms_and_conditions = 'false';
	}
	
	wp_register_script('chauffeur-custom', plugins_url('assets/js/scripts.js', __FILE__));
	wp_enqueue_script('chauffeur-custom');
	
	wp_add_inline_script( 'chauffeur-custom', "
	
	var AJAX_URL = '" . AJAX_URL . "';
	var chauffeur_pickup_dropoff_error = '" . esc_html__('Please enter a pick up and drop off location','chauffeur') . "';
	var chauffeur_valid_email = '" . esc_html__('Please enter a valid email address','chauffeur') . "';
	var chauffeur_valid_phone = '" . esc_html__('Please enter a valid phone number (numbers only and no spaces)','chauffeur') . "';
	var chauffeur_valid_bags = '" . esc_html__('Number of bags selected exceeds vehicle limit','chauffeur') . "';
	var chauffeur_valid_passengers = '" . esc_html__('Number of passengers selected exceeds vehicle limit','chauffeur') . "';
	var chauffeur_select_vehicle = '" . esc_html__('Please select a vehicle','chauffeur') . "';
	var chauffeur_complete_required = '" . esc_html__('Please complete all the required form fields marked with a *','chauffeur') . "';
	var chauffeur_autocomplete = '" . esc_html__('Please select your addresses using the Google autocomplete suggestion','chauffeur') . "';
	var chauffeur_terms = '" . esc_html__('You must accept the terms and conditions before placing your booking', 'chauffeur') . "';
	var chauffeur_terms_set = '" . $terms_and_conditions . "';
	
	var ch_minimum_hourly_alert = '" . esc_html__('The minimum hourly booking is','chauffeur') . " " . $chauffeur_data['hourly-minimum'] . " " . esc_html__('hours','chauffeur') . "';
	
	var chauffeur_min_time_before_booking_error = '" . esc_html__('Sorry we do not accept same day online bookings less than','chauffeur') . " " . $hours_before_booking_minimum . " " . esc_html__('hour(s) in advance of the pick up time','chauffeur') . "';
	
	var LOADING_IMAGE = '" . chauffeur_PLUGIN_URL . "assets/images/loading.gif';
	var chauffeur_datepicker_format = '" . $chauffeur_datepicker_format . "';
	
	" . $disable_booking_options_js );
	
	if ($chauffeur_data['google-limit-country'] == '') {
		wp_add_inline_script( 'chauffeur-custom', "var Google_AutoComplete_Country = 'ALL_COUNTRIES';");		
	} else {	
		wp_add_inline_script( 'chauffeur-custom', "var Google_AutoComplete_Country = '" . $chauffeur_data['google-limit-country'] . "';");
	}
	
	if ($chauffeur_data['hours-before-booking-minimum'] == '') {
		wp_add_inline_script( 'chauffeur-custom', "var hours_before_booking_minimum = '2000';");		
	} else {	
		wp_add_inline_script( 'chauffeur-custom', "var hours_before_booking_minimum = '" . $chauffeur_data['hours-before-booking-minimum'] . "';");
	}
	
	if ($chauffeur_data['hourly-minimum'] == '') {
		wp_add_inline_script( 'chauffeur-custom', "var hourly_minimum = '1';");		
	} else {	
		wp_add_inline_script( 'chauffeur-custom', "var hourly_minimum = '" . $chauffeur_data['hourly-minimum'] . "';");
	}
	
	wp_register_script('fontawesomemarkers', plugins_url('assets/js/fontawesome-markers.min.js', __FILE__));
	wp_enqueue_script('fontawesomemarkers');
	
	wp_enqueue_script( array( 'jquery-ui-core', 'jquery-ui-tabs', 'jquery-effects-core' ) );

}



/* ----------------------------------------------------------------------------

   WPML

---------------------------------------------------------------------------- */
global $sitepress;
if ( !empty($sitepress) ){
	define('AJAX_URL', admin_url('admin-ajax.php?lang=' . $sitepress->get_current_language()));
} else {
	define('AJAX_URL', admin_url('admin-ajax.php'));
}



/* ----------------------------------------------------------------------------

   Load CSS

---------------------------------------------------------------------------- */
add_action('wp_enqueue_scripts', 'chauffeur_shortcodes_styles');
function chauffeur_shortcodes_styles() {

	wp_register_style('style', plugins_url('assets/css/style.css', __FILE__));
    wp_enqueue_style('style');

}



/* ----------------------------------------------------------------------------

   Load Shortcodes

---------------------------------------------------------------------------- */
include 'includes/shortcodes/booking-image-background.php';
include 'includes/shortcodes/booking-full-width.php';
include 'includes/shortcodes/booking-page.php';
include 'includes/shortcodes/booking-thanks-page.php';
include 'includes/shortcodes/fleet-carousel.php';
include 'includes/shortcodes/fleet-page.php';
include 'includes/shortcodes/testimonials-carousel.php';
include 'includes/shortcodes/testimonials-page.php';
include 'includes/shortcodes/call-to-action-small.php';
include 'includes/shortcodes/call-to-action-large.php';
include 'includes/shortcodes/icon-text.php';
include 'includes/shortcodes/video-text.php';
include 'includes/shortcodes/video-thumbnail.php';
include 'includes/shortcodes/news-carousel.php';
include 'includes/shortcodes/gallery.php';
include 'includes/shortcodes/title.php';
include 'includes/shortcodes/news-page.php';
include 'includes/shortcodes/link-blocks.php';
include 'includes/shortcodes/socialmedia.php';
include 'includes/shortcodes/googlemap.php';
include 'includes/shortcodes/contactdetails.php';
include 'includes/shortcodes/button.php';
include 'includes/shortcodes/message.php';
include 'includes/shortcodes/service-rates-page.php';
include 'includes/shortcodes/booking-debug.php';



/* ----------------------------------------------------------------------------

   Load Post Types

---------------------------------------------------------------------------- */
include 'includes/post-types/testimonials.php';
include 'includes/post-types/fleet.php';
include 'includes/post-types/rates.php';
include 'includes/post-types/payments.php';
include 'includes/post-types/flat-rate-trips.php';



/* ----------------------------------------------------------------------------

   Load Template Chooser

---------------------------------------------------------------------------- */
add_filter( 'template_include', 'chauffeur_spt_template_chooser');
function chauffeur_spt_template_chooser( $template ) {
 
    if ( is_search() ) {
		
		return $template;
		
	} else {
		
		$post_id = get_the_ID();

		if ( get_post_type( $post_id ) == 'fleet' ) {
			return chauffeur_spt_get_template_hierarchy( 'single-fleet' );
		} elseif ( get_post_type( $post_id ) == 'testimonial' ) {
			return chauffeur_spt_get_template_hierarchy( 'single-testimonials' );
		} elseif ( get_post_type( $post_id ) == 'rates' ) {
			return chauffeur_spt_get_template_hierarchy( 'single-rates' );
		} elseif ( get_post_type( $post_id ) == 'payment' ) {
			return chauffeur_spt_get_template_hierarchy( 'single-payment' );
		} elseif ( get_post_type( $post_id ) == 'flat_rate_trips' ) {
			return chauffeur_spt_get_template_hierarchy( 'single-flat-rate-trips' );
		} else {
			return $template;
		}
		
	}

}



/* ----------------------------------------------------------------------------

   Select Template

---------------------------------------------------------------------------- */
add_filter( 'template_include', 'chauffeur_spt_template_chooser' );
function chauffeur_spt_get_template_hierarchy( $template ) {
 
	if ( is_search() ) {
		
		$file = chauffeur_BASE_DIR . '/includes/templates/' . $template;
		return apply_filters( 'chauffeur_template_' . $template, $file );
	
	} else {

    	$template_slug = rtrim( $template, '.php' );
	    $template = $template_slug . '.php';

	    if ( $theme_file = locate_template( array( 'includes/templates/' . $template ) ) ) {
	        $file = $theme_file;
	    }
	    else {
	        $file = chauffeur_BASE_DIR . '/includes/templates/' . $template;
	    }

	    return apply_filters( 'chauffeur_template_' . $template, $file );
	
	}

}



/* ----------------------------------------------------------------------------

   Select Taxonomy Template

---------------------------------------------------------------------------- */
add_filter('template_include', 'qns_taxonomy_template');
function qns_taxonomy_template( $template ){

	if( is_tax('yacht_charter-type')){
  		$template = chauffeur_BASE_DIR .'/includes/templates/taxonomy-yacht-categories.php';
 	}  

	if( is_tax('yacht_sales-type')){
  		$template = chauffeur_BASE_DIR .'/includes/templates/taxonomy-yacht-categories.php';
 	}
  	
	return $template;

}



/* ----------------------------------------------------------------------------

   AJAX Booking Form

---------------------------------------------------------------------------- */
function contactform_add_script() {
	wp_localize_script( 'contactform-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_enqueue_scripts', 'contactform_add_script');



/* ----------------------------------------------------------------------------

   AJAX Booking Form Callback

---------------------------------------------------------------------------- */
function ajax_contactform_action_callback() {
	
	// Booking Form Step 2 
	if($_POST['form_type'] == 'one_way') {
		
		$booking_step_wrapper = booking_steps('2');
		$booking_form_content = booking_step_2("one_way");
	
	// Booking Form Step 2 
	} elseif($_POST['form_type'] == 'hourly') {
		
		$booking_step_wrapper = booking_steps('2');
		$booking_form_content = booking_step_2("hourly");
		
	} elseif($_POST['form_type'] == 'flat') {

		$booking_step_wrapper = booking_steps('2');
		$booking_form_content = booking_step_2("hourly");

	}
	
	// Booking Form Step 3
	if( isset($_POST['selected-vehicle-name']) ) {
		
		$booking_step_wrapper = booking_steps('3');
		$booking_form_content = booking_step_3();
		
	}
	
	$resp = array('booking_step_wrapper' => $booking_step_wrapper, 'booking_form_content' => $booking_form_content);
	header( "Content-Type: application/json" );
	echo json_encode($resp);
	die();
	
}
add_action( 'wp_ajax_contactform_action', 'ajax_contactform_action_callback' );
add_action( 'wp_ajax_nopriv_contactform_action', 'ajax_contactform_action_callback' );



/* ----------------------------------------------------------------------------

   Load Booking Form Steps Template

---------------------------------------------------------------------------- */
function booking_steps($step) {
	
	ob_start();
	include 'includes/templates/booking-steps.php';
	return ob_get_clean();
	
}



/* ----------------------------------------------------------------------------

   Load Booking Form Step 2 Template

---------------------------------------------------------------------------- */
function booking_step_2($type) {
	
	ob_start();
	include 'includes/templates/booking-step2.php';
	return ob_get_clean();
	
}



/* ----------------------------------------------------------------------------

   Load Booking Form Step 3 Template

---------------------------------------------------------------------------- */
function booking_step_3() {
	
	ob_start();
	include 'includes/templates/booking-step3.php';
	return ob_get_clean();
	
}



/* ----------------------------------------------------------------------------

   Get Google Map Coordinates

---------------------------------------------------------------------------- */
function get_coordinates($address_string) {
	
	global $chauffeur_data;
	
	$address = urlencode($address_string);
	$url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&key=" . $chauffeur_data['google-map-api-key'];
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);
	$response_a = json_decode($response);
	$status = $response_a->status;
	
	if ( $status == 'ZERO_RESULTS' ) {
		return FALSE;
	} else {
		$return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
		return $return;
	}

}



/* ----------------------------------------------------------------------------

   Get Google Map Coordinates (DEBUG)

---------------------------------------------------------------------------- */
function get_coordinates_debug($address_string) {
	
	global $chauffeur_data;
	
	$address = urlencode($address_string);
	$url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&key=" . $chauffeur_data['google-map-api-key'];
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);
	$response_a = json_decode($response);
	$status = $response_a->status;
	
	return $response;

}



/* ----------------------------------------------------------------------------

   Get Google Map Driving Distance

---------------------------------------------------------------------------- */
function GetDrivingDistance($lat1, $lat2, $long1, $long2) {
   
	global $chauffeur_data;

	if ( $chauffeur_data['google-distance-matrix-unit'] == 'imperial' ) {
		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" . $lat1 . "," . $long1 . "&destinations=" . $lat2 . "," . $long2 . "&key=" . $chauffeur_data['google-map-api-key'];
	} else {
		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $lat1 . "," . $long1 . "&destinations=" . $lat2 . "," . $long2 . "&key=" . $chauffeur_data['google-map-api-key'];
	}
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);
	$response_a = json_decode($response, true);
	
	if ( isset($response_a['rows'][0]['elements'][0]['distance']['text']) ) {
		$dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
	} else {
		$dist = false;
	}
	
	if ( isset($response_a['rows'][0]['elements'][0]['duration']['text']) ) {
		$time = $response_a['rows'][0]['elements'][0]['duration']['text'];
	} else {
		$time = false;
	}
	
	return array('distance' => $dist, 'time' => $time);

}



/* ----------------------------------------------------------------------------

   Get Google Map Driving Distance (Debug)

---------------------------------------------------------------------------- */
function GetDrivingDistance_debug($lat1, $lat2, $long1, $long2) {
   
	global $chauffeur_data;

	if ( $chauffeur_data['google-distance-matrix-unit'] == 'imperial' ) {
		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" . $lat1 . "," . $long1 . "&destinations=" . $lat2 . "," . $long2 . "&key=" . $chauffeur_data['google-map-api-key'];
	} else {
		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $lat1 . "," . $long1 . "&destinations=" . $lat2 . "," . $long2 . "&key=" . $chauffeur_data['google-map-api-key'];
	}
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);
	$response_a = json_decode($response, true);
	
	if ( isset($response_a['rows'][0]['elements'][0]['distance']['text']) ) {
		$dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
	} else {
		$dist = false;
	}
	
	if ( isset($response_a['rows'][0]['elements'][0]['duration']['text']) ) {
		$time = $response_a['rows'][0]['elements'][0]['duration']['text'];
	} else {
		$time = false;
	}
	
	return $response;

}



/* ----------------------------------------------------------------------------

   Payment Form

---------------------------------------------------------------------------- */
function payment_form( $data) {
	
	global $chauffeur_data;
	
	if ($chauffeur_data['paypal-sandbox'] == 'true') {
		define('SSL_P_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
		define('SSL_SAND_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
	} else {
		define('SSL_P_URL', 'https://www.paypal.com/cgi-bin/webscr');
		define('SSL_SAND_URL', 'https://www.paypal.com/cgi-bin/webscr');
	}
	
	$action = '';
	// Is this a test transaction? 
	$action = ($data['paypal_mode']) ? SSL_SAND_URL : SSL_URL;

	$form = '';
	$form .= '<form name="frm_payment_method" action="' . $action . '" method="post">';
	$form .= '<input type="hidden" name="business" value="' . $data['merchant_email'] . '" />';
	// Instant Payment Notification & Return Page Details /
	$form .= '<input type="hidden" name="notify_url" value="' . $data['notify_url'] . '" />';
	$form .= '<input type="hidden" name="cancel_return" value="' . $data['cancel_url'] . '" />';
	$form .= '<input type="hidden" name="return" value="' . $data['thanks_page'] . '" />';
	$form .= '<input type="hidden" name="rm" value="2" />';
	// Configures Basic Checkout Fields -->
	$form .= '<input type="hidden" name="lc" value="" />';
	$form .= '<input type="hidden" name="no_shipping" value="1" />';
	$form .= '<input type="hidden" name="no_note" value="1" />';
	// <input type="hidden" name="custom" value="localhost" />-->
	$form .= '<input type="hidden" name="currency_code" value="' . $data['currency_code'] . '" />';
	$form .= '<input type="hidden" name="page_style" value="paypal" />';
	$form .= '<input type="hidden" name="charset" value="utf-8" />';
	$form .= '<input type="hidden" name="item_name" value="' . $data['product_name'] . '" />';
	$form .= '<input type="hidden" name="item_number" value="' . $data['item_number'] . '" />';
	$form .= '<input type="hidden" value="_xclick" name="cmd"/>';
	$form .= '<input type="hidden" name="amount" value="' . $data['amount'] . '" />';
			
	$form .= '</form>';
	$form .= '<script>';
	$form .= 'setTimeout("document.frm_payment_method.submit()", 0);';
	$form .= '</script>';
	return $form;
	
}



/* ----------------------------------------------------------------------------

   PayPal IPN

---------------------------------------------------------------------------- */
class PayPal_IPN{
	
	function payment_ipn($im_debut_ipn) {
		
		global $chauffeur_data;
		
		if ($chauffeur_data['paypal-sandbox'] == 'true') {
			define('SSL_P_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
			define('SSL_SAND_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
		} else {
			define('SSL_P_URL', 'https://www.paypal.com/cgi-bin/webscr');
			define('SSL_SAND_URL', 'https://www.paypal.com/cgi-bin/webscr');
		}
		
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		if (!preg_match('/paypal\.com$/', $hostname)) {
			
			$ipn_status = 'Validation post isn\'t from PayPal';
			if ($im_debut_ipn == true) {
				// mail test
			}
			return false;
		
		}
		
		// parse the paypal URL
		$paypal_url = ($_REQUEST['test_ipn'] == 1) ? SSL_SAND_URL : SSL_P_URL;
		$url_parsed = parse_url($paypal_url);
		
		$post_string = '';
		foreach ($_REQUEST as $field => $value) {
			$post_string .= $field . '=' . urlencode(stripslashes($value)) . '&';
		}
		$post_string.="cmd=_notify-validate"; // append ipn command
		// get the correct paypal url to post request to
		$paypal_mode_status = $im_debut_ipn; //get_option('im_sabdbox_mode');
		if ($chauffeur_data['paypal-sandbox'] == 'true')
			$fp = fsockopen('ssl://www.sandbox.paypal.com', "443", $err_num, $err_str, 60);
		else
			$fp = fsockopen('ssl://www.paypal.com', "443", $err_num, $err_str, 60);
		
		$ipn_response = '';
		
		if (!$fp) {
			// could not open the connection.  If loggin is on, the error message
			// will be in the log.
			$ipn_status = "fsockopen error no. $err_num: $err_str";
			if ($im_debut_ipn == true) {
				echo 'fsockopen fail';
			}
			return false;
		} else {
			// Post the data back to paypal
			fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n");
			fputs($fp, "Host: $url_parsed[host]\r\n");
			fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
			fputs($fp, "Content-length: " . strlen($post_string) . "\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
			fputs($fp, $post_string . "\r\n\r\n");

			// loop through the response from the server and append to variable
			while (!feof($fp)) {
				$ipn_response .= fgets($fp, 1024);
			}
			fclose($fp); // close connection
		}
		
		// Invalid IPN transaction.  Check the $ipn_status and log for details.
		if (!preg_match("/VERIFIED/s", $ipn_response)) {
			$ipn_status = 'IPN Validation Failed';
			if ($im_debut_ipn == true) {
				echo 'Validation fail';
				print_r($_REQUEST);
			}
			return false;
		} else {
			$ipn_status = "IPN VERIFIED";
			if ($im_debut_ipn == true) {
				echo 'SUCCESS';
			}
			return true;
		}
		
	}
	
	function ipn_response($request) {
		
		$im_debut_ipn=true;
		if ($this->payment_ipn($im_debut_ipn)) {
			
			// if paypal sends a response code back let's handle it        
			if ($im_debut_ipn == true) {
				$sub = 'PayPal IPN Debug Email Main';
				$msg = print_r($request, true);
				$aname = 'infotuts';
				//mail send
			}
			
			// process the membership since paypal gave us a valid +
			$this->insert_data($request);
		}
	}
	
	function issetCheck($post,$key) {
		
		if(isset($post[$key])){
			$return=$post[$key];
		} else {
			$return='';
		}
		return $return;
	
	}
	
	function insert_data($request) {
		
		global $chauffeur_data;
		
		$post=$request;
		$item_name=$this->issetCheck($post,'item_name');
		$item_number=$this->issetCheck($post,'item_number');
		$amount=$this->issetCheck($post,'mc_gross');
		$currency=$this->issetCheck($post,'mc_currency');
		$payer_email=$this->issetCheck($post,'payer_email');
		$first_name=$this->issetCheck($post,'first_name');
		$last_name=$this->issetCheck($post,'last_name');
		$country=$this->issetCheck($post,'residence_country');
		$txn_id=$this->issetCheck($post,'txn_id');
		$txn_type=$this->issetCheck($post,'txn_type');
		$payment_status=$this->issetCheck($post,'payment_status');
		$payment_type=$this->issetCheck($post,'payment_type');
		$payer_id=$this->issetCheck($post,'payer_id');
		$create_date=date('Y-m-d H:i:s');
		$payment_date=date('Y-m-d H:i:s');
		
		/*$payment_details = esc_html__('Amount Paid','chauffeur') . ': ' . $amount . ' (' . $currency . ')
' . esc_html__('Email','chauffeur') . ': ' . $payer_email . '
' . esc_html__('Name','chauffeur') . ': ' . $first_name . ' ' . $last_name . '
' . esc_html__('Country','chauffeur') . ': ' . $country . '
' . esc_html__('Payment Status','chauffeur') . ': ' . $payment_status . '
' . esc_html__('Payment ID','chauffeur') . ': ' . $payer_id . '
' . esc_html__('Payment Date','chauffeur') . ': ' . $payment_date;*/
		
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
		
		$get_return_journey = get_post_meta($item_number,'chauffeur_payment_return_journey',TRUE);
		
		// Send customer email
		include ( chauffeur_BASE_DIR . "/includes/templates/email-customer-booking.php");
		wp_mail($get_payment_email,$customer_email_subject,$customer_email_content,$customer_headers);
		
		// Send admin email
		include ( chauffeur_BASE_DIR . "/includes/templates/email-admin-booking.php");
		wp_mail($chauffeur_data['booking-email'],$admin_email_subject,$admin_email_content,$admin_headers);
		
		// Update booking data
		update_post_meta($item_number, 'chauffeur_payment_status', esc_html__('Paid','chauffeur') );
		//update_post_meta($item_number, 'chauffeur_payment_details', $payment_details );
		update_post_meta($item_number, 'chauffeur_payment_method', esc_html__('PayPal','chauffeur') );
	
	}

}



/* ----------------------------------------------------------------------------

   Cash Payment Complete

---------------------------------------------------------------------------- */

function cash_payment_complete($booking_id) {
	
	global $chauffeur_data;
	
	ob_start();

    if ( isset($booking_id) ) {
		
		$item_number = $booking_id;
		
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

		<!-- BEGIN .full-booking-wrapper -->
		<div class="full-booking-wrapper full-booking-wrapper-3 clearfix">

			<h4><?php esc_html_e('Booking Successful','chauffeur'); ?></h4>
			<div class="title-block7"></div>

			<p><?php echo esc_attr($chauffeur_data['booking-thanks-message']); ?></p>

			<hr class="space7" />

			<h4><?php esc_html_e('Trip Details','chauffeur'); ?></h4>
			<div class="title-block7"></div>

			<!-- BEGIN .clearfix -->
			<div class="clearfix">

				<!-- BEGIN .qns-one-half -->
				<div class="qns-one-half">
					
					<?php if ($get_trip_type == 'one_way') {
						$form_type_text = esc_html__('Distance','chauffeur');
					} elseif ($get_trip_type == 'hourly') {
						$form_type_text = esc_html__('Hourly','chauffeur');
					} elseif ($get_trip_type == 'flat') {
						$form_type_text = esc_html__('Flat Rate','chauffeur');
					} ?>
					
					<p class="clearfix"><strong><?php esc_html_e('Service:','chauffeur'); ?></strong> <span><?php echo $form_type_text; ?></span></p>
					
					<?php if ( $get_trip_type == 'flat' ) {

						$pick_up_address = get_post_meta($_POST['flat-location'], 'chauffeur_flat_rate_trips_pick_up_name', true);
						$drop_off_address = get_post_meta($_POST['flat-location'], 'chauffeur_flat_rate_trips_drop_off_name', true);

					} else {

						$pick_up_address = $_POST['pickup-address'];
						$drop_off_address = $_POST['dropoff-address'];

					} ?>

					<p class="clearfix"><strong><?php esc_html_e('From','chauffeur'); ?>:</strong> <span><?php echo $pick_up_address; if( $_POST['full-pickup-address'] ) { echo '(' . $_POST['full-pickup-address'] . ')'; } ?></span></p>
					<p class="clearfix"><strong><?php esc_html_e('To','chauffeur'); ?>:</strong> <span><?php echo $drop_off_address; if( $_POST['full-dropoff-address'] ) { echo '(' . $_POST['full-dropoff-address'] . ')'; } ?></span></p>
					
					<p class="clearfix"><strong><?php esc_html_e('Vehicle:','chauffeur'); ?></strong> <span><?php echo $get_vehicle_name; ?></span></p>
					
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

					<p class="clearfix"><strong><?php esc_html_e('Date:','chauffeur'); ?></strong> <span><?php echo $get_pickup_date; ?></span></p>

					<?php if ($_POST['num-hours'] != '') { ?>

						<p class="clearfix"><strong><?php esc_html_e('Hours','chauffeur'); ?>:</strong> <span><?php echo $_POST['num-hours']; ?></span></p>	

					<?php } elseif ( $get_trip_type != 'flat' ) { ?>

						<p class="clearfix"><strong><?php esc_html_e('Distance','chauffeur'); ?>:</strong> <span><?php echo $_POST['trip-distance']; ?> (<?php echo $_POST['trip-time']; ?>)</span></p>	

					<?php } ?>

					<p class="clearfix"><strong><?php esc_html_e('Pick Up Time:','chauffeur'); ?></strong> <span><?php echo $get_pickup_time; ?></span></p>
					
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
					
					<?php if ( $get_trip_type != 'flat' ) { ?>
					
					<p class="clearfix"><strong><?php esc_html_e('Route Estimate','chauffeur'); ?>:</strong> <span><a href="https://maps.google.com/maps?saddr=<?php echo $get_pickup_address; ?>&amp;daddr=<?php echo $get_dropoff_address; ?>&amp;ie=UTF8&amp;z=11&amp;layer=t&amp;t=m&amp;iwloc=A&amp;output=embed?iframe=true&amp;width=640&amp;height=480" data-gal="prettyPhoto[gallery]" class="view-map-button"><?php esc_html_e('View Map','chauffeur'); ?></a></span></p>

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



/* ----------------------------------------------------------------------------

   Time Input

---------------------------------------------------------------------------- */

function time_input_hours() {
	
	global $chauffeur_data;
	$output = '';
	
	if ($chauffeur_data['time-format'] == '12hr') {
		
		$output .= '<option value="01">' . esc_html__( '1am', 'chauffeur' ) . '</option>
		<option value="02">' . esc_html__( '2am', 'chauffeur' ) . '</option>
		<option value="03">' . esc_html__( '3am', 'chauffeur' ) . '</option>
		<option value="04">' . esc_html__( '4am', 'chauffeur' ) . '</option>
		<option value="05">' . esc_html__( '5am', 'chauffeur' ) . '</option>
		<option value="06">' . esc_html__( '6am', 'chauffeur' ) . '</option>
		<option value="07">' . esc_html__( '7am', 'chauffeur' ) . '</option>
		<option value="08">' . esc_html__( '8am', 'chauffeur' ) . '</option>
		<option value="09">' . esc_html__( '9am', 'chauffeur' ) . '</option>
		<option value="10">' . esc_html__( '10am', 'chauffeur' ) . '</option>
		<option value="11">' . esc_html__( '11am', 'chauffeur' ) . '</option>
		<option value="12">' . esc_html__( '12pm', 'chauffeur' ) . '</option>
		<option value="13">' . esc_html__( '1pm', 'chauffeur' ) . '</option>
		<option value="14">' . esc_html__( '2pm', 'chauffeur' ) . '</option>
		<option value="15">' . esc_html__( '3pm', 'chauffeur' ) . '</option>
		<option value="16">' . esc_html__( '4pm', 'chauffeur' ) . '</option>
		<option value="17">' . esc_html__( '5pm', 'chauffeur' ) . '</option>
		<option value="18">' . esc_html__( '6pm', 'chauffeur' ) . '</option>
		<option value="19">' . esc_html__( '7pm', 'chauffeur' ) . '</option>
		<option value="20">' . esc_html__( '8pm', 'chauffeur' ) . '</option>
		<option value="21">' . esc_html__( '9pm', 'chauffeur' ) . '</option>
		<option value="22">' . esc_html__( '10pm', 'chauffeur' ) . '</option>
		<option value="23">' . esc_html__( '11pm', 'chauffeur' ) . '</option>
		<option value="00">' . esc_html__( '12am', 'chauffeur' ) . '</option>';
		
	} else {
		
		$output .= '<option value="01">' . esc_html__( '01', 'chauffeur' ) . '</option>
		<option value="02">' . esc_html__( '02', 'chauffeur' ) . '</option>
		<option value="03">' . esc_html__( '03', 'chauffeur' ) . '</option>
		<option value="04">' . esc_html__( '04', 'chauffeur' ) . '</option>
		<option value="05">' . esc_html__( '05', 'chauffeur' ) . '</option>
		<option value="06">' . esc_html__( '06', 'chauffeur' ) . '</option>
		<option value="07">' . esc_html__( '07', 'chauffeur' ) . '</option>
		<option value="08">' . esc_html__( '08', 'chauffeur' ) . '</option>
		<option value="09">' . esc_html__( '09', 'chauffeur' ) . '</option>
		<option value="10">' . esc_html__( '10', 'chauffeur' ) . '</option>
		<option value="11">' . esc_html__( '11', 'chauffeur' ) . '</option>
		<option value="12">' . esc_html__( '12', 'chauffeur' ) . '</option>
		<option value="13">' . esc_html__( '13', 'chauffeur' ) . '</option>
		<option value="14">' . esc_html__( '14', 'chauffeur' ) . '</option>
		<option value="15">' . esc_html__( '15', 'chauffeur' ) . '</option>
		<option value="16">' . esc_html__( '16', 'chauffeur' ) . '</option>
		<option value="17">' . esc_html__( '17', 'chauffeur' ) . '</option>
		<option value="18">' . esc_html__( '18', 'chauffeur' ) . '</option>
		<option value="19">' . esc_html__( '19', 'chauffeur' ) . '</option>
		<option value="20">' . esc_html__( '20', 'chauffeur' ) . '</option>
		<option value="21">' . esc_html__( '21', 'chauffeur' ) . '</option>
		<option value="22">' . esc_html__( '22', 'chauffeur' ) . '</option>
		<option value="23">' . esc_html__( '23', 'chauffeur' ) . '</option>
		<option value="00">' . esc_html__( '00', 'chauffeur' ) . '</option>';
		
	}
	
	return $output;
	
}



/* ----------------------------------------------------------------------------

   Time Output

---------------------------------------------------------------------------- */

function time_output_hours($hour,$min) {
	
	global $chauffeur_data;
	$output = '';
	
	if ($chauffeur_data['time-format'] == '12hr') {
		
		if($hour == '01') {
			$hour_output = '1';
			$unit = 'am';
		} elseif ($hour == '02') {
			$hour_output = '2';
			$unit = 'am';
		} elseif ($hour == '03') {
			$hour_output = '3';
			$unit = 'am';
		} elseif ($hour == '04') {
			$hour_output = '4';
			$unit = 'am';
		} elseif ($hour == '05') {
			$hour_output = '5';
			$unit = 'am';
		} elseif ($hour == '06') {
			$hour_output = '6';
			$unit = 'am';
		} elseif ($hour == '07') {
			$hour_output = '7';
			$unit = 'am';
		} elseif ($hour == '08') {
			$hour_output = '8';
			$unit = 'am';
		} elseif ($hour == '09') {
			$hour_output = '9';
			$unit = 'am';
		} elseif ($hour == '10') {
			$hour_output = '10';
			$unit = 'am';
		} elseif ($hour == '11') {
			$hour_output = '11';
			$unit = 'am';
		} elseif ($hour == '12') {
			$hour_output = '12';
			$unit = 'pm';
		} elseif ($hour == '13') {
			$hour_output = '1';
			$unit = 'pm';
		} elseif ($hour == '14') {
			$hour_output = '2';
			$unit = 'pm';
		} elseif ($hour == '15') {
			$hour_output = '3';
			$unit = 'pm';
		} elseif ($hour == '16') {
			$hour_output = '4';
			$unit = 'pm';
		} elseif ($hour == '17') {
			$hour_output = '5';
			$unit = 'pm';
		} elseif ($hour == '18') {
			$hour_output = '6';
			$unit = 'pm';
		} elseif ($hour == '19') {
			$hour_output = '7';
			$unit = 'pm';
		} elseif ($hour == '20') {
			$hour_output = '8';
			$unit = 'pm';
		} elseif ($hour == '21') {
			$hour_output = '9';
			$unit = 'pm';
		} elseif ($hour == '22') {
			$hour_output = '10';
			$unit = 'pm';
		} elseif ($hour == '23') {
			$hour_output = '11';
			$unit = 'pm';
		} elseif ($hour == '00') {
			$hour_output = '12';
			$unit = 'am';
		}
		
		$output = $hour_output . ':' . $min . $unit;
		
	} else {
		
		$output = $hour . ':' . $min;
		
	}
	
	return $output;
	
}



/* ----------------------------------------------------------------------------

   Time Output

---------------------------------------------------------------------------- */

function chauffeur_get_price($price) {

	global $chauffeur_data;
	
	if ($chauffeur_data['currency-symbol-position'] == 'before') {
		return $chauffeur_data['currency-symbol'] . $price;
	} else {
		return $price . $chauffeur_data['currency-symbol'];
	}
	
}



/* ----------------------------------------------------------------------------

   Stripe Payment

---------------------------------------------------------------------------- */
function chauffeur_stripe_payment($data) {
	
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

	if(isset($data['stripeToken']))
	{
		$amount_cents = str_replace(".","",$data["selected-vehicle-price"]);  // Chargeble amount
		$invoiceid = $data["booking_id"];                      // Invoice ID
		$description = "Invoice #" . $invoiceid . " - " . $invoiceid;

		try {
			
			global $chauffeur_data;

			$charge = Stripe_Charge::create(array(		 
				  "amount" => $amount_cents,
				  "currency" => $chauffeur_data['stripe-currency'],
				  "source" => $data['stripeToken'],
				  "description" => $description,
				  "receipt_email" => $data["email-address"])	  
			);

			if ($charge->card->address_zip_check == "fail") {
				throw new Exception("zip_check_invalid");
			} else if ($charge->card->address_line1_check == "fail") {
				throw new Exception("address_check_invalid");
			} else if ($charge->card->cvc_check == "fail") {
				throw new Exception("cvc_check_invalid");
			}
			// Payment has succeeded, no exceptions were thrown or otherwise caught				

			$result = "success";

		} catch(Stripe_CardError $e) {			

		$error = $e->getMessage();
			$result = "declined";

		} catch (Stripe_InvalidRequestError $e) {
			$result = "declined";		  
		} catch (Stripe_AuthenticationError $e) {
			$result = "declined";
		} catch (Stripe_ApiConnectionError $e) {
			$result = "declined";
		} catch (Stripe_Error $e) {
			$result = "declined";
		} catch (Exception $e) {

			if ($e->getMessage() == "zip_check_invalid") {
				$result = "declined";
			} else if ($e->getMessage() == "address_check_invalid") {
				$result = "declined";
			} else if ($e->getMessage() == "cvc_check_invalid") {
				$result = "declined";
			} else {
				$result = "declined";
			}		  
		}
		
		$data_array = array();
		$data_array["booking_id"] = $data["booking_id"];
		$data_array["payment_status"] = $result;
		
		// If payment is successful add details in database
		if ( $result == 'success' ) {
			
			$item_number = $data_array["booking_id"];
			$amount = $data["selected-vehicle-price"];
			
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
			$get_return_journey = get_post_meta($item_number,'chauffeur_payment_return_journey',TRUE);

			// Send customer email
			include ( chauffeur_BASE_DIR . "/includes/templates/email-customer-booking.php");
			wp_mail($get_payment_email,$customer_email_subject,$customer_email_content,$customer_headers);

			// Send admin email
			include ( chauffeur_BASE_DIR . "/includes/templates/email-admin-booking.php");
			wp_mail($chauffeur_data['booking-email'],$admin_email_subject,$admin_email_content,$admin_headers);
			
			// Update booking data
			update_post_meta($data_array["booking_id"], 'chauffeur_payment_status', esc_html__('Paid','chauffeur') );
			update_post_meta($data_array["booking_id"], 'chauffeur_payment_method', esc_html__('Stripe','chauffeur') );
	
		}
		
		return $data_array;
		
	}
	
}