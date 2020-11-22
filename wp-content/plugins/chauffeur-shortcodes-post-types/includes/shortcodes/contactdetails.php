<?php

function contact_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
			'address' => '',
			'phone' => '',
			'email' => ''
		), $atts ) );
	
	$output = '<ul class="contact-details-list">';
	
	if( isset($atts['address']) ) {
		$output .= '<li class="cdw-address clearfix">' . $atts['address'] . '</li>';
	}
	
	if( isset($atts['phone']) ) {
		$output .= '<li class="cdw-phone clearfix"><a href="tel:' . $atts['phone'] . '">' . $atts['phone'] . '</a></li>';
	}
	
	if( isset($atts['email']) ) {
		$output .= '<li class="cdw-email clearfix">' . $atts['email'] . '</li>';
	}
	
	$output .= '</ul>';
	
	return $output;

}

add_shortcode( 'contactdetails', 'contact_shortcode' );

?>