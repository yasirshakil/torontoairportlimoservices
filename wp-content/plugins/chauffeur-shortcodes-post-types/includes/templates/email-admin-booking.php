<?php

// Email message
$admin_email_content = '';
$admin_email_content .= esc_attr($chauffeur_data['admin-booking-email-content']);

$admin_email_content .= '<br /><ul>';
$admin_email_content .= '<li><strong>' . esc_html__('Name','chauffeur') . ': </strong>' . $get_first_name . ' ' . $get_last_name . '</li>'."\r\n";
$admin_email_content .= '<li><strong>' . esc_html__('Passengers','chauffeur') . ': </strong>' . $get_num_passengers . '</li>'."\r\n";
$admin_email_content .= '<li><strong>' . esc_html__('Bags','chauffeur') . ': </strong>' . $get_num_bags . '</li>'."\r\n";
$admin_email_content .= '<li><strong>' . esc_html__('Vehicle','chauffeur') . ': </strong>' . $get_vehicle_name . '</li>'."\r\n";
$admin_email_content .= '<li><strong>' . esc_html__('Pickup Time','chauffeur') . ': </strong>' . $get_pickup_date . ' ' . esc_html__('at','chauffeur') . ' ' . $get_pickup_time . '</li>'."\r\n";

$admin_email_content .= '<li><strong>' . esc_html__('Pickup Address','chauffeur') . ': </strong>' . $get_pickup_address . '</li>'."\r\n";

$admin_email_content .= '<li><strong>' . esc_html__('Full Pickup Address','chauffeur') . ': </strong>' . $get_full_pickup_address . '</li>'."\r\n";

$admin_email_content .= '<li><strong>' . esc_html__('Pickup Instructions','chauffeur') . ': </strong>' . $get_pickup_instructions . '</li>'."\r\n";

$admin_email_content .= '<li><strong>' . esc_html__('Dropoff Address','chauffeur') . ': </strong>' . $get_dropoff_address . '</li>'."\r\n";

$admin_email_content .= '<li><strong>' . esc_html__('Full Dropoff Address','chauffeur') . ': </strong>' . $get_full_dropoff_address . '</li>'."\r\n";

$admin_email_content .= '<li><strong>' . esc_html__('Dropoff Instructions','chauffeur') . ': </strong>' . $get_dropoff_instructions . '</li>'."\r\n";

$admin_email_content .= '<li><strong>' . esc_html__('Flight Number','chauffeur') . ': </strong>' . $get_flight_number . '</li>'."\r\n";

if ( $get_trip_distance != '' ) {
	$admin_email_content .= '<li><strong>' . esc_html__('Estimated Distance','chauffeur') . ': </strong>' . $get_trip_distance . ' (' . $get_trip_time . ')</li>'."\r\n";
}

$admin_email_content .= '<li><strong>' . esc_html__('Phone Number','chauffeur') . ': </strong>' . $get_phone_num . '</li>'."\r\n";
$admin_email_content .= '<li><strong>' . esc_html__('Email','chauffeur') . ': </strong>' . $get_payment_email . '</li>'."\r\n";

if ( $get_additional_details != '' ) {
	$admin_email_content .= '<li><strong>' . esc_html__('Additional Details','chauffeur') . ': </strong>' . $get_additional_details . '</li>'."\r\n";
}

if ($get_trip_type == 'one_way') {
	$get_trip_type = esc_html__('Distance','chauffeur');
} elseif ($get_trip_type == 'hourly') {
	$get_trip_type = esc_html__('Hourly','chauffeur');
} elseif ($get_trip_type == 'flat') {
	$get_trip_type = esc_html__('Flat Rate','chauffeur');
}

$admin_email_content .= '<li><strong>' . esc_html__('Trip Type','chauffeur') . ': </strong>' . $get_trip_type . '</li>'."\r\n";

if ( $get_payment_num_hours != '' ) {
	$admin_email_content .= '<li><strong>' . esc_html__('Hours','chauffeur') . ': </strong>' . $get_payment_num_hours . '</li>'."\r\n";
}

if ( $get_return_journey != '' ) {
	$admin_email_content .= '<li><strong>' . esc_html__('Return','chauffeur') . ': </strong>' . $get_return_journey . '</li>'."\r\n";
}

$admin_email_content .= '</ul>'."\r\n";

$admin_email_content .= '<p>' . esc_html__('Payment Details','chauffeur') . ':</p>'."\r\n";
$admin_email_content .= '<ul>'."\r\n";

if( $chauffeur_data['hide-pricing'] != '1' ) {
	$admin_email_content .= '<li><strong>' . esc_html__('Amount','chauffeur') . ': </strong>' . chauffeur_get_price($amount) . '</li>'."\r\n";
}

$admin_email_content .= '</ul>'."\r\n";

// Email Subject
$admin_email_subject = esc_attr($chauffeur_data['admin-booking-email-subject']);

// Email Headers
$admin_headers = "MIME-Version: 1.0\r\n";
$admin_headers .= "Content-type: text/html; charset=UTF-8\r\n";
$admin_headers .= "From: " . esc_attr($chauffeur_data['email-sender-name']) . " <" . esc_attr($chauffeur_data['booking-email']) . ">" . "\r\n" . "Reply-To: " . esc_attr($payer_email);

?>