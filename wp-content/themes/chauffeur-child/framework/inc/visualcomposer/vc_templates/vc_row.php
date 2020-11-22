<?php

extract(shortcode_atts(array(
	'type' => '',
	'bg_image'=> '', 
	'bg_repeat' => '', 
	'bg_color'=> '',
	'top_padding' => '', 
	'bottom_padding' => '',
	'top_margin' => '', 
	'bottom_margin' => '', 
	'row_id' => '',
	'class' => ''), 
$atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$style = null;
$bg_stretch_class = null;
$set_row_id = null;
$stellar_class = null;

// Background Image
if(!empty($bg_image)) {
	if(!preg_match('/^\d+$/',$bg_image)){
		$style .= 'background: url('. $bg_image . ') fixed; ';
	} else {
		$bg_image_src = wp_get_attachment_image_src($bg_image, 'full');
		$style .= 'background: url('. $bg_image_src[0]. ') fixed; ';
	}

	//for pattern bgs
	if($bg_repeat == 'repeat'){
		$style .= 'background-repeat: '. $bg_repeat .'; ';
		$bg_stretch_class = null;
	} else if($bg_repeat == 'no-repeat'){
		$style .= 'background-repeat: '. $bg_repeat .'; ';
		$bg_stretch_class = null;
	} else if($bg_repeat == 'stretch'){
		$style .= null;
		$bg_stretch_class = 'bg-stretch';
	}
}

// Background Color
if(!empty($bg_color)) {
	$style .= 'background-color: '. $bg_color.'; ';
}

// Section ID
if(!empty($row_id)) {
	$set_row_id .= 'id="'. $row_id.'"';
}

// Padding
if($top_padding != ''){
	$style .= 'padding-top: '. $top_padding .'px; ';
}
if($bottom_padding != ''){
	$style .= 'padding-bottom: '. $bottom_padding .'px; ';
}

$style .= 'padding-left: 0px; ';
$style .= 'padding-right: 0px; ';

// Margin
if($top_margin != ''){
	$style .= 'margin-top: '. $top_margin .'px; ';
}
if($bottom_margin != ''){
	$style .= 'margin-bottom: '. $bottom_margin .'px; ';
}

// Main Class
if($type == 'standard_section'){
	$main_class = "content-wrapper content-wrapper-standard clearfix ";
} else if($type == 'full_width_section'){
	$main_class = "content-wrapper content-wrapper-full clearfix ";
} else {
	$main_class = "content-wrapper content-wrapper-standard clearfix ";
}

echo '<div '.$set_row_id.' class="wpb_row vc_row-fluid '. esc_attr($main_class) . ' '. esc_attr($class) . ' '.esc_attr($bg_stretch_class).'" style="'.$style.'">';

echo '<div class="col span_12">'.do_shortcode($content).'</div>';
echo '</div>';