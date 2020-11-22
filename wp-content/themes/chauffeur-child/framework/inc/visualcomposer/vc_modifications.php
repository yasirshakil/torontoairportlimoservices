<?php

/* ----------------------------------------------------------------------------

   Visual Composer Modifications

---------------------------------------------------------------------------- */

// Disable Frontend Editor
function vc_remove_frontend_links() {
    vc_disable_frontend();
}
add_action( 'vc_after_init', 'vc_remove_frontend_links' );

// Remove VC Items
/*vc_remove_element("vc_pie");
//vc_remove_element("vc_row");
//vc_remove_element("vc_column_text");
vc_remove_element("vc_icon");
vc_remove_element("vc_separator");
vc_remove_element("vc_text_separator");
vc_remove_element("vc_message");
vc_remove_element("vc_facebook");
vc_remove_element("vc_tweetmeme");
vc_remove_element("vc_googleplus");
vc_remove_element("vc_pinterest");
//vc_remove_element("vc_toggle");
vc_remove_element("vc_single_image");
vc_remove_element("vc_gallery");
vc_remove_element("vc_images_carousel");
//vc_remove_element("vc_tta_tabs");
vc_remove_element("vc_tta_tour");
//vc_remove_element("vc_tta_accordion");
vc_remove_element("vc_tta_pageable");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_widget_sidebar");
vc_remove_element("vc_video");
vc_remove_element("vc_gmaps");
//vc_remove_element("vc_raw_html");
//vc_remove_element("vc_raw_js");
vc_remove_element("vc_flickr");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_round_chart");
vc_remove_element("vc_line_chart");
vc_remove_element("vc_empty_space");
vc_remove_element("vc_custom_heading");
vc_remove_element("vc_btn");
vc_remove_element("vc_cta");
vc_remove_element("vc_basic_grid");
vc_remove_element("vc_masonry_grid");
vc_remove_element("vc_masonry_media_grid");
vc_remove_element("vc_media_grid");
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_text");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_rss");*/

// Remove VC Depreciated Items
vc_remove_element("vc_tabs");
vc_remove_element("vc_tour");
vc_remove_element("vc_accordion");
vc_remove_element("vc_button");
vc_remove_element("vc_button2");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");

// Remove VC Templates
add_filter( 'vc_load_default_templates', 'template_modify_array' );
function template_modify_array($data) {
    return array();
}

// Remove Automatic Updates
if(function_exists('vc_set_as_theme')) vc_set_as_theme(true);



/* ----------------------------------------------------------------------------

   Map Theme Shortcodes To VC

---------------------------------------------------------------------------- */

// Booking Form With Image Background
function chauffeur_booking_image_background_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Booking Form With Image Background", 'chauffeur' ),
		"description"			=> esc_html__( "Add a booking form with an image background", 'chauffeur' ),
		"base"					=> "booking_image_background",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Background Image", 'chauffeur' ),
				"param_name"	=> "background_img_url",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_booking_image_background_vc' );



// Booking Form Full Width
function chauffeur_booking_full_width_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Booking Form Full Width", 'chauffeur' ),
		"description"			=> esc_html__( "Add a booking form which spans the width of the page", 'chauffeur' ),
		"base"					=> "booking_full_width",
		'category'				=> "Content",
		"icon"					=> ""
	) );
}
add_action( 'vc_before_init', 'chauffeur_booking_full_width_vc' );



// Our Fleet Carousel
function our_fleet_carousel_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Our Fleet Carousel", 'chauffeur' ),
		"description"			=> esc_html__( "Display vehicles in a carousel", 'chauffeur' ),
		"base"					=> "our_fleet_carousel",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Section Title", 'chauffeur' ),
				"param_name"	=> "section_title",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Section Intro", 'chauffeur' ),
				"param_name"	=> "section_intro",
				"value"			=> "",
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Posts per page", 'chauffeur' ),
				"param_name"	=> "posts_per_page",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5',
					'6' 	=> '6',
					'7' 	=> '7',
					'8' 	=> '8',
					'9' 	=> '9',
					'10' 	=> '10',
					'11' 	=> '11',
					'12' 	=> '12',
					'13' 	=> '13',
					'14' 	=> '14',
					'15' 	=> '15',
					'16' 	=> '16',
					'17' 	=> '17',
					'18' 	=> '18',
					'19' 	=> '19',
					'20' 	=> '20',
					'21' 	=> '21',
					'22' 	=> '22',
					'23' 	=> '23',
					'24' 	=> '24',
					'25' 	=> '25',
					'26' 	=> '26',
					'27' 	=> '27',
					'28' 	=> '28',
					'29' 	=> '29',
					'30' 	=> '30',
					'31' 	=> '31',
					'32' 	=> '32',
					'33' 	=> '33',
					'34' 	=> '34',
					'35' 	=> '35',
					'36' 	=> '36',
					'37' 	=> '37',
					'38' 	=> '38',
					'39' 	=> '39',
					'40' 	=> '40',
					'41' 	=> '41',
					'42' 	=> '42',
					'43' 	=> '43',
					'44' 	=> '44',
					'45' 	=> '45',
					'46' 	=> '46',
					'47' 	=> '47',
					'48' 	=> '48',
					'49' 	=> '49',
					'50' 	=> '50',
					'51' 	=> '51',
					'52' 	=> '52',
					'53' 	=> '53',
					'54' 	=> '54',
					'55' 	=> '55',
					'56' 	=> '56',
					'57' 	=> '57',
					'58' 	=> '58',
					'59' 	=> '59',
					'60' 	=> '60',
					'61' 	=> '61',
					'62' 	=> '62',
					'63' 	=> '63',
					'64' 	=> '64',
					'65' 	=> '65',
					'66' 	=> '66',
					'67' 	=> '67',
					'68' 	=> '68',
					'69' 	=> '69',
					'70' 	=> '70',
					'71' 	=> '71',
					'72' 	=> '72',
					'73' 	=> '73',
					'74' 	=> '74',
					'75' 	=> '75',
					'76' 	=> '76',
					'77' 	=> '77',
					'78' 	=> '78',
					'79' 	=> '79',
					'80' 	=> '80',
					'81' 	=> '81',
					'82' 	=> '82',
					'83' 	=> '83',
					'84' 	=> '84',
					'85' 	=> '85',
					'86' 	=> '86',
					'87' 	=> '87',
					'88' 	=> '88',
					'89' 	=> '89',
					'90' 	=> '90',
					'91' 	=> '91',
					'92' 	=> '92',
					'93' 	=> '93',
					'94' 	=> '94',
					'95' 	=> '95',
					'96' 	=> '96',
					'97' 	=> '97',
					'98' 	=> '98',
					'99' 	=> '99',
					'100' 	=> '100',
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'chauffeur' ),
				"param_name"	=> "order",
				"value"			=> array(
					'Newest First' 	=> 'newest',
					'Oldest First' 	=> 'oldest',
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Our Fleet Category Slug (Leave blank to display all)", 'chauffeur' ),
				"param_name"	=> "fleet_type",
				"value"			=> "",
			)
		)
	) );
}
add_action( 'vc_before_init', 'our_fleet_carousel_vc' );



// Testimonials Carousel
function chauffeur_testimonials_carousel_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Testimonials Carousel", 'chauffeur' ),
		"description"			=> esc_html__( "Display testimonials in a carousel", 'chauffeur' ),
		"base"					=> "testimonials_carousel",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Section Title", 'chauffeur' ),
				"param_name"	=> "section_title",
				"value"			=> "",
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Style", 'chauffeur' ),
				"param_name"	=> "style",
				"value"			=> array(
					'Light Background' 	=> '1',
					'Dark Background' 	=> '2'
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Posts per page", 'chauffeur' ),
				"param_name"	=> "posts_per_page",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5',
					'6' 	=> '6',
					'7' 	=> '7',
					'8' 	=> '8',
					'9' 	=> '9',
					'10' 	=> '10',
					'11' 	=> '11',
					'12' 	=> '12',
					'13' 	=> '13',
					'14' 	=> '14',
					'15' 	=> '15',
					'16' 	=> '16',
					'17' 	=> '17',
					'18' 	=> '18',
					'19' 	=> '19',
					'20' 	=> '20',
					'21' 	=> '21',
					'22' 	=> '22',
					'23' 	=> '23',
					'24' 	=> '24',
					'25' 	=> '25',
					'26' 	=> '26',
					'27' 	=> '27',
					'28' 	=> '28',
					'29' 	=> '29',
					'30' 	=> '30',
					'31' 	=> '31',
					'32' 	=> '32',
					'33' 	=> '33',
					'34' 	=> '34',
					'35' 	=> '35',
					'36' 	=> '36',
					'37' 	=> '37',
					'38' 	=> '38',
					'39' 	=> '39',
					'40' 	=> '40',
					'41' 	=> '41',
					'42' 	=> '42',
					'43' 	=> '43',
					'44' 	=> '44',
					'45' 	=> '45',
					'46' 	=> '46',
					'47' 	=> '47',
					'48' 	=> '48',
					'49' 	=> '49',
					'50' 	=> '50',
					'51' 	=> '51',
					'52' 	=> '52',
					'53' 	=> '53',
					'54' 	=> '54',
					'55' 	=> '55',
					'56' 	=> '56',
					'57' 	=> '57',
					'58' 	=> '58',
					'59' 	=> '59',
					'60' 	=> '60',
					'61' 	=> '61',
					'62' 	=> '62',
					'63' 	=> '63',
					'64' 	=> '64',
					'65' 	=> '65',
					'66' 	=> '66',
					'67' 	=> '67',
					'68' 	=> '68',
					'69' 	=> '69',
					'70' 	=> '70',
					'71' 	=> '71',
					'72' 	=> '72',
					'73' 	=> '73',
					'74' 	=> '74',
					'75' 	=> '75',
					'76' 	=> '76',
					'77' 	=> '77',
					'78' 	=> '78',
					'79' 	=> '79',
					'80' 	=> '80',
					'81' 	=> '81',
					'82' 	=> '82',
					'83' 	=> '83',
					'84' 	=> '84',
					'85' 	=> '85',
					'86' 	=> '86',
					'87' 	=> '87',
					'88' 	=> '88',
					'89' 	=> '89',
					'90' 	=> '90',
					'91' 	=> '91',
					'92' 	=> '92',
					'93' 	=> '93',
					'94' 	=> '94',
					'95' 	=> '95',
					'96' 	=> '96',
					'97' 	=> '97',
					'98' 	=> '98',
					'99' 	=> '99',
					'100' 	=> '100',
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'chauffeur' ),
				"param_name"	=> "order",
				"value"			=> array(
					'Newest First' 	=> 'newest',
					'Oldest First' 	=> 'oldest',
				),
			),
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Background Image URL", 'chauffeur' ),
				"param_name"	=> "background_image_url",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_testimonials_carousel_vc' );



// Testimonials Page
function chauffeur_testimonials_page_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Testimonials Page", 'chauffeur' ),
		"description"			=> esc_html__( "Display the testimonials page content", 'chauffeur' ),
		"base"					=> "testimonials_page",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Posts per page", 'chauffeur' ),
				"param_name"	=> "posts_per_page",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5',
					'6' 	=> '6',
					'7' 	=> '7',
					'8' 	=> '8',
					'9' 	=> '9',
					'10' 	=> '10',
					'11' 	=> '11',
					'12' 	=> '12',
					'13' 	=> '13',
					'14' 	=> '14',
					'15' 	=> '15',
					'16' 	=> '16',
					'17' 	=> '17',
					'18' 	=> '18',
					'19' 	=> '19',
					'20' 	=> '20',
					'21' 	=> '21',
					'22' 	=> '22',
					'23' 	=> '23',
					'24' 	=> '24',
					'25' 	=> '25',
					'26' 	=> '26',
					'27' 	=> '27',
					'28' 	=> '28',
					'29' 	=> '29',
					'30' 	=> '30',
					'31' 	=> '31',
					'32' 	=> '32',
					'33' 	=> '33',
					'34' 	=> '34',
					'35' 	=> '35',
					'36' 	=> '36',
					'37' 	=> '37',
					'38' 	=> '38',
					'39' 	=> '39',
					'40' 	=> '40',
					'41' 	=> '41',
					'42' 	=> '42',
					'43' 	=> '43',
					'44' 	=> '44',
					'45' 	=> '45',
					'46' 	=> '46',
					'47' 	=> '47',
					'48' 	=> '48',
					'49' 	=> '49',
					'50' 	=> '50',
					'51' 	=> '51',
					'52' 	=> '52',
					'53' 	=> '53',
					'54' 	=> '54',
					'55' 	=> '55',
					'56' 	=> '56',
					'57' 	=> '57',
					'58' 	=> '58',
					'59' 	=> '59',
					'60' 	=> '60',
					'61' 	=> '61',
					'62' 	=> '62',
					'63' 	=> '63',
					'64' 	=> '64',
					'65' 	=> '65',
					'66' 	=> '66',
					'67' 	=> '67',
					'68' 	=> '68',
					'69' 	=> '69',
					'70' 	=> '70',
					'71' 	=> '71',
					'72' 	=> '72',
					'73' 	=> '73',
					'74' 	=> '74',
					'75' 	=> '75',
					'76' 	=> '76',
					'77' 	=> '77',
					'78' 	=> '78',
					'79' 	=> '79',
					'80' 	=> '80',
					'81' 	=> '81',
					'82' 	=> '82',
					'83' 	=> '83',
					'84' 	=> '84',
					'85' 	=> '85',
					'86' 	=> '86',
					'87' 	=> '87',
					'88' 	=> '88',
					'89' 	=> '89',
					'90' 	=> '90',
					'91' 	=> '91',
					'92' 	=> '92',
					'93' 	=> '93',
					'94' 	=> '94',
					'95' 	=> '95',
					'96' 	=> '96',
					'97' 	=> '97',
					'98' 	=> '98',
					'99' 	=> '99',
					'100' 	=> '100',
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'chauffeur' ),
				"param_name"	=> "order",
				"value"			=> array(
					'Newest First' 	=> 'newest',
					'Oldest First' 	=> 'oldest',
				),
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_testimonials_page_vc' );



// Call To Action Small
function chauffeur_call_to_action_small_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Call To Action Small", 'chauffeur' ),
		"description"			=> esc_html__( "Display call to action", 'chauffeur' ),
		"base"					=> "call_to_action_small",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Section Text", 'chauffeur' ),
				"param_name"	=> "section_text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button Text", 'chauffeur' ),
				"param_name"	=> "button_text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button URL", 'chauffeur' ),
				"param_name"	=> "button_url",
				"value"			=> "",
			),
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Background Image", 'chauffeur' ),
				"param_name"	=> "section_background_image_url",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_call_to_action_small_vc' );



// Call To Action Large
function chauffeur_call_to_action_large_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Call To Action Large", 'chauffeur' ),
		"description"			=> esc_html__( "Display call to action", 'chauffeur' ),
		"base"					=> "call_to_action_large",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Section Title", 'chauffeur' ),
				"param_name"	=> "section_title",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Section Text", 'chauffeur' ),
				"param_name"	=> "section_text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button Text", 'chauffeur' ),
				"param_name"	=> "button_text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button URL", 'chauffeur' ),
				"param_name"	=> "button_url",
				"value"			=> "",
			),
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Background Image", 'chauffeur' ),
				"param_name"	=> "section_background_image_url",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_call_to_action_large_vc' );



// Icon Text
function chauffeur_icon_text_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Icon Text", 'chauffeur' ),
		"description"			=> esc_html__( "Add Icons With Text", 'chauffeur' ),
		"base"					=> "icon_text",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon 1", 'chauffeur' ),
				"param_name"	=> "icon_icon_1",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon Title 1", 'chauffeur' ),
				"param_name"	=> "icon_title_1",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon Content 1", 'chauffeur' ),
				"param_name"	=> "icon_content_1",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon 2", 'chauffeur' ),
				"param_name"	=> "icon_icon_2",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon Title 2", 'chauffeur' ),
				"param_name"	=> "icon_title_2",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon Content 2", 'chauffeur' ),
				"param_name"	=> "icon_content_2",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon 3", 'chauffeur' ),
				"param_name"	=> "icon_icon_3",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon Title 3", 'chauffeur' ),
				"param_name"	=> "icon_title_3",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon Content 3", 'chauffeur' ),
				"param_name"	=> "icon_content_3",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon 4", 'chauffeur' ),
				"param_name"	=> "icon_icon_4",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon Title 4", 'chauffeur' ),
				"param_name"	=> "icon_title_4",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon Content 4", 'chauffeur' ),
				"param_name"	=> "icon_content_4",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_icon_text_vc' );



// Video Text
function chauffeur_video_text_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Video Text", 'chauffeur' ),
		"description"			=> esc_html__( "Add a video with description text", 'chauffeur' ),
		"base"					=> "video_text",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Section Title", 'chauffeur' ),
				"param_name"	=> "section_title",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea_html",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Text Content", 'chauffeur' ),
				"param_name"	=> "content",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button Text", 'chauffeur' ),
				"param_name"	=> "button_text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button URL", 'chauffeur' ),
				"param_name"	=> "button_url",
				"value"			=> "",
			),
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Video Thumbnail", 'chauffeur' ),
				"param_name"	=> "video_thumbnail_url",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Video URL", 'chauffeur' ),
				"param_name"	=> "video_url",
				"value"			=> "",
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Background", 'chauffeur' ),
				"param_name"	=> "background",
				"value"			=> array(
					'Light' 	=> 'light',
					'Dark' 		=> 'dark',
				),
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_video_text_vc' );



// Video Thumbnail
function chauffeur_videothumbnail_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Video Thumbnail", 'chauffeur' ),
		"description"			=> esc_html__( "Add thumbnail image with a link to a video which opens in a lightbox", 'chauffeur' ),
		"base"					=> "videothumbnail",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Video URL", 'chauffeur' ),
				"param_name"	=> "video_url",
				"value"			=> "",
				),	
			array(
				"type"			=> "attach_image",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Video Thumbnail", 'chauffeur' ),
				"param_name"	=> "video_thumbnail_url",
				"value"			=> "",
				),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_videothumbnail_vc' );



// News Page
function chauffeur_news_carousel_vc() {
	vc_map( array(
		"name"					=> esc_html__( "News Carousel", 'chauffeur' ),
		"description"			=> esc_html__( "Display latest news in a carousel", 'chauffeur' ),
		"base"					=> "news_carousel",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Section Title", 'chauffeur' ),
				"param_name"	=> "section_title",
				"value"			=> "Latest News",
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Number Of Posts To Display", 'chauffeur' ),
				"param_name"	=> "posts_per_page",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5',
					'6' 	=> '6',
					'7' 	=> '7',
					'8' 	=> '8',
					'9' 	=> '9',
					'10' 	=> '10',
					'11' 	=> '11',
					'12' 	=> '12',
					'13' 	=> '13',
					'14' 	=> '14',
					'15' 	=> '15',
					'16' 	=> '16',
					'17' 	=> '17',
					'18' 	=> '18',
					'19' 	=> '19',
					'20' 	=> '20',
					'21' 	=> '21',
					'22' 	=> '22',
					'23' 	=> '23',
					'24' 	=> '24',
					'25' 	=> '25',
					'26' 	=> '26',
					'27' 	=> '27',
					'28' 	=> '28',
					'29' 	=> '29',
					'30' 	=> '30',
					'31' 	=> '31',
					'32' 	=> '32',
					'33' 	=> '33',
					'34' 	=> '34',
					'35' 	=> '35',
					'36' 	=> '36',
					'37' 	=> '37',
					'38' 	=> '38',
					'39' 	=> '39',
					'40' 	=> '40',
					'41' 	=> '41',
					'42' 	=> '42',
					'43' 	=> '43',
					'44' 	=> '44',
					'45' 	=> '45',
					'46' 	=> '46',
					'47' 	=> '47',
					'48' 	=> '48',
					'49' 	=> '49',
					'50' 	=> '50',
					'51' 	=> '51',
					'52' 	=> '52',
					'53' 	=> '53',
					'54' 	=> '54',
					'55' 	=> '55',
					'56' 	=> '56',
					'57' 	=> '57',
					'58' 	=> '58',
					'59' 	=> '59',
					'60' 	=> '60',
					'61' 	=> '61',
					'62' 	=> '62',
					'63' 	=> '63',
					'64' 	=> '64',
					'65' 	=> '65',
					'66' 	=> '66',
					'67' 	=> '67',
					'68' 	=> '68',
					'69' 	=> '69',
					'70' 	=> '70',
					'71' 	=> '71',
					'72' 	=> '72',
					'73' 	=> '73',
					'74' 	=> '74',
					'75' 	=> '75',
					'76' 	=> '76',
					'77' 	=> '77',
					'78' 	=> '78',
					'79' 	=> '79',
					'80' 	=> '80',
					'81' 	=> '81',
					'82' 	=> '82',
					'83' 	=> '83',
					'84' 	=> '84',
					'85' 	=> '85',
					'86' 	=> '86',
					'87' 	=> '87',
					'88' 	=> '88',
					'89' 	=> '89',
					'90' 	=> '90',
					'91' 	=> '91',
					'92' 	=> '92',
					'93' 	=> '93',
					'94' 	=> '94',
					'95' 	=> '95',
					'96' 	=> '96',
					'97' 	=> '97',
					'98' 	=> '98',
					'99' 	=> '99',
					'100' 	=> '100',
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'chauffeur' ),
				"param_name"	=> "order",
				"value"			=> array(
					'Newest First' 	=> 'newest',
					'Oldest First' 	=> 'oldest',
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Category ID (Leave empty to display all categories)", 'chauffeur' ),
				"param_name"	=> "category",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_news_carousel_vc' );



// News Page
function chauffeur_news_page_vc() {
	vc_map( array(
		"name"					=> esc_html__( "News Page", 'chauffeur' ),
		"description"			=> esc_html__( "Display the news page content", 'chauffeur' ),
		"base"					=> "news_page",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Columns", 'chauffeur' ),
				"param_name"	=> "columns",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5',
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Posts per page", 'chauffeur' ),
				"param_name"	=> "posts_per_page",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5',
					'6' 	=> '6',
					'7' 	=> '7',
					'8' 	=> '8',
					'9' 	=> '9',
					'10' 	=> '10',
					'11' 	=> '11',
					'12' 	=> '12',
					'13' 	=> '13',
					'14' 	=> '14',
					'15' 	=> '15',
					'16' 	=> '16',
					'17' 	=> '17',
					'18' 	=> '18',
					'19' 	=> '19',
					'20' 	=> '20',
					'21' 	=> '21',
					'22' 	=> '22',
					'23' 	=> '23',
					'24' 	=> '24',
					'25' 	=> '25',
					'26' 	=> '26',
					'27' 	=> '27',
					'28' 	=> '28',
					'29' 	=> '29',
					'30' 	=> '30',
					'31' 	=> '31',
					'32' 	=> '32',
					'33' 	=> '33',
					'34' 	=> '34',
					'35' 	=> '35',
					'36' 	=> '36',
					'37' 	=> '37',
					'38' 	=> '38',
					'39' 	=> '39',
					'40' 	=> '40',
					'41' 	=> '41',
					'42' 	=> '42',
					'43' 	=> '43',
					'44' 	=> '44',
					'45' 	=> '45',
					'46' 	=> '46',
					'47' 	=> '47',
					'48' 	=> '48',
					'49' 	=> '49',
					'50' 	=> '50',
					'51' 	=> '51',
					'52' 	=> '52',
					'53' 	=> '53',
					'54' 	=> '54',
					'55' 	=> '55',
					'56' 	=> '56',
					'57' 	=> '57',
					'58' 	=> '58',
					'59' 	=> '59',
					'60' 	=> '60',
					'61' 	=> '61',
					'62' 	=> '62',
					'63' 	=> '63',
					'64' 	=> '64',
					'65' 	=> '65',
					'66' 	=> '66',
					'67' 	=> '67',
					'68' 	=> '68',
					'69' 	=> '69',
					'70' 	=> '70',
					'71' 	=> '71',
					'72' 	=> '72',
					'73' 	=> '73',
					'74' 	=> '74',
					'75' 	=> '75',
					'76' 	=> '76',
					'77' 	=> '77',
					'78' 	=> '78',
					'79' 	=> '79',
					'80' 	=> '80',
					'81' 	=> '81',
					'82' 	=> '82',
					'83' 	=> '83',
					'84' 	=> '84',
					'85' 	=> '85',
					'86' 	=> '86',
					'87' 	=> '87',
					'88' 	=> '88',
					'89' 	=> '89',
					'90' 	=> '90',
					'91' 	=> '91',
					'92' 	=> '92',
					'93' 	=> '93',
					'94' 	=> '94',
					'95' 	=> '95',
					'96' 	=> '96',
					'97' 	=> '97',
					'98' 	=> '98',
					'99' 	=> '99',
					'100' 	=> '100',
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'chauffeur' ),
				"param_name"	=> "order",
				"value"			=> array(
					'Newest First' 	=> 'newest',
					'Oldest First' 	=> 'oldest',
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Category ID (Leave empty to display all categories)", 'chauffeur' ),
				"param_name"	=> "category",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_news_page_vc' );



// Title
function chauffeur_title_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Title", 'chauffeur' ),
		"description"			=> esc_html__( "Add Title", 'chauffeur' ),
		"base"					=> "title",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Type", 'chauffeur' ),
				"param_name"	=> "type",
				"value"			=> array(
					'Normal Size Center Aligned Title' 	=> 'title1',
					'Normal Size Left Aligned Title' 	=> 'title2',
					'h1' 	=> 'h1',
					'h2' 	=> 'h2',
					'h3' 	=> 'h3',
					'h4' 	=> 'h4',
					'h5' 	=> 'h5',
					'h6' 	=> 'h6',
				),
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Text", 'chauffeur' ),
				"param_name"	=> "content",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_title_vc' );



// Link Blocks
function chauffeur_link_blocks_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Link Blocks", 'chauffeur' ),
		"description"			=> esc_html__( "Add Link Blocks", 'chauffeur' ),
		"base"					=> "link_blocks",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Columns", 'chauffeur' ),
				"param_name"	=> "columns",
				"value"			=> array(
					'2' 	=> '2',
					'3' 	=> '3'
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Link Block Text 1", 'chauffeur' ),
				"param_name"	=> "link_block_text_1",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Link Block URL 1", 'chauffeur' ),
				"param_name"	=> "link_block_url_1",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Link Block Text 2", 'chauffeur' ),
				"param_name"	=> "link_block_text_2",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Link Block URL 2", 'chauffeur' ),
				"param_name"	=> "link_block_url_2",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Link Block Text 3", 'chauffeur' ),
				"param_name"	=> "link_block_text_3",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Link Block URL 3", 'chauffeur' ),
				"param_name"	=> "link_block_url_3",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_link_blocks_vc' );



// Contact Details
function chauffeur_contactdetails_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Contact Details", 'chauffeur' ),
		"description"			=> esc_html__( "Display contact details in icon list", 'chauffeur' ),
		"base"					=> "contactdetails",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Address", 'chauffeur' ),
				"param_name"	=> "address",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Phone", 'chauffeur' ),
				"param_name"	=> "phone",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Email", 'chauffeur' ),
				"param_name"	=> "email",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_contactdetails_vc' );



// Social Media
function chauffeur_socialmedia_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Social Media", 'chauffeur' ),
		"description"			=> esc_html__( "Display social media icon links", 'chauffeur' ),
		"base"					=> "socialmedia",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Facebook", 'chauffeur' ),
				"param_name"	=> "facebook",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Flickr", 'chauffeur' ),
				"param_name"	=> "flickr",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Google Plus", 'chauffeur' ),
				"param_name"	=> "googleplus",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Instagram", 'chauffeur' ),
				"param_name"	=> "instagram",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Pinterest", 'chauffeur' ),
				"param_name"	=> "pinterest",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Skype", 'chauffeur' ),
				"param_name"	=> "skype",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Soundcloud", 'chauffeur' ),
				"param_name"	=> "soundcloud",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Tumblr", 'chauffeur' ),
				"param_name"	=> "tumblr",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Twitter", 'chauffeur' ),
				"param_name"	=> "twitter",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Vimeo", 'chauffeur' ),
				"param_name"	=> "vimeo",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Vine", 'chauffeur' ),
				"param_name"	=> "vine",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Yelp", 'chauffeur' ),
				"param_name"	=> "yelp",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Youtube", 'chauffeur' ),
				"param_name"	=> "youtube",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_socialmedia_vc' );



// Google Map
function chauffeur_googlemap_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Google Map", 'chauffeur' ),
		"description"			=> esc_html__( "Display Google Map", 'chauffeur' ),
		"base"					=> "googlemap",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Map ID", 'chauffeur' ),
				"param_name"	=> "map_id",
				"value"			=> "1",
				),
		
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Width", 'chauffeur' ),
				"param_name"	=> "width",
				"value"			=> "100%",
				),
			
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Height", 'chauffeur' ),
				"param_name"	=> "height",
				"value"			=> "550px",
				),
		
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Map Type", 'chauffeur' ),
				"param_name"	=> "maptype",
				"value"			=> "road",
				),
			
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Zoom", 'chauffeur' ),
				"param_name"	=> "zoom",
				"value"			=> "14",
				),
			
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Latitude", 'chauffeur' ),
				"param_name"	=> "latitude",
				"value"			=> "40.703316",
				),
			
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Longitude", 'chauffeur' ),
				"param_name"	=> "longitude",
				"value"			=> "-73.988145",
				),
			
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Marker Content", 'chauffeur' ),
				"param_name"	=> "marker_content",
				"value"			=> "Chauffeur Car Rental",
				),
			
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Map Color", 'chauffeur' ),
				"param_name"	=> "map_color",
				"value"			=> "#cc4452",
				),
				array(
					"type"			=> "textfield",
					"admin_label"	=> false,
					"class"			=> "",
					"heading"		=> esc_html__( "Marker Color", 'chauffeur' ),
					"param_name"	=> "marker_color",
					"value"			=> "#cc4452",
					),
			),	
	) );
}
add_action( 'vc_before_init', 'chauffeur_googlemap_vc' );



// Button
function chauffeur_button_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Button", 'chauffeur' ),
		"description"			=> esc_html__( "Display a button", 'chauffeur' ),
		"base"					=> "button",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Button Text", 'chauffeur' ),
				"param_name"	=> "content",
				"value"			=> "",
				),
		
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Link URL", 'chauffeur' ),
				"param_name"	=> "link_url",
				"value"			=> "",
				),
			
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Button Style", 'chauffeur' ),
				"param_name"	=> "type",
				"value"			=> array(
					'Style 1' 	=> 'button1',
					'Style 2' 	=> 'button2',
					'Style 3' 	=> 'button3',
					'Style 4' 	=> 'button4',
					'Style 5' 	=> 'button5',
					'Style 6' 	=> 'button6',
					'Style 7' 	=> 'button7',
				),
			),
			
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Rounded Corners", 'chauffeur' ),
				"param_name"	=> "rounded",
				"value"			=> array(
					'Yes' 	=> 'true',
					'No' 	=> 'false',
				),
			),
				
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Center align", 'chauffeur' ),
				"param_name"	=> "center",
				"value"			=> array(
					'Yes' 	=> 'true',
					'No' 	=> 'false',
				),
			),
			
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Link Target", 'chauffeur' ),
				"param_name"	=> "target",
				"value"			=> array(
					'Open in a new window/tab' 	=> 'true',
					'Do not open in a new window/tab' 	=> 'false',
				),
			),
			
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Background Color", 'chauffeur' ),
				"param_name"	=> "background_color",
				"value"			=> "",
				),
				
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Text Color", 'chauffeur' ),
				"param_name"	=> "text_color",
				"value"			=> "",
				),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_button_vc' );



// Alert Message
function chauffeur_alert_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Alert Message", 'chauffeur' ),
		"description"			=> esc_html__( "Add Alert Message Boxes", 'chauffeur' ),
		"base"					=> "msg",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Type", 'chauffeur' ),
				"param_name"	=> "type",
				"value"			=> array(
					'Default Message' 	=> 'default',
					'Notice Message' 	=> 'notice',
					'Success Message' 	=> 'success',
					'Fail Message' 		=> 'fail',
				),
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Text", 'chauffeur' ),
				"param_name"	=> "content",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_alert_vc' );



// Fleet Page
function chauffeur_fleet_page_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Our Fleet Page", 'chauffeur' ),
		"description"			=> esc_html__( "Display the fleet/vehicles page content", 'chauffeur' ),
		"base"					=> "fleet_page",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Posts per page", 'chauffeur' ),
				"param_name"	=> "posts_per_page",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5',
					'6' 	=> '6',
					'7' 	=> '7',
					'8' 	=> '8',
					'9' 	=> '9',
					'10' 	=> '10',
					'11' 	=> '11',
					'12' 	=> '12',
					'13' 	=> '13',
					'14' 	=> '14',
					'15' 	=> '15',
					'16' 	=> '16',
					'17' 	=> '17',
					'18' 	=> '18',
					'19' 	=> '19',
					'20' 	=> '20',
					'21' 	=> '21',
					'22' 	=> '22',
					'23' 	=> '23',
					'24' 	=> '24',
					'25' 	=> '25',
					'26' 	=> '26',
					'27' 	=> '27',
					'28' 	=> '28',
					'29' 	=> '29',
					'30' 	=> '30',
					'31' 	=> '31',
					'32' 	=> '32',
					'33' 	=> '33',
					'34' 	=> '34',
					'35' 	=> '35',
					'36' 	=> '36',
					'37' 	=> '37',
					'38' 	=> '38',
					'39' 	=> '39',
					'40' 	=> '40',
					'41' 	=> '41',
					'42' 	=> '42',
					'43' 	=> '43',
					'44' 	=> '44',
					'45' 	=> '45',
					'46' 	=> '46',
					'47' 	=> '47',
					'48' 	=> '48',
					'49' 	=> '49',
					'50' 	=> '50',
					'51' 	=> '51',
					'52' 	=> '52',
					'53' 	=> '53',
					'54' 	=> '54',
					'55' 	=> '55',
					'56' 	=> '56',
					'57' 	=> '57',
					'58' 	=> '58',
					'59' 	=> '59',
					'60' 	=> '60',
					'61' 	=> '61',
					'62' 	=> '62',
					'63' 	=> '63',
					'64' 	=> '64',
					'65' 	=> '65',
					'66' 	=> '66',
					'67' 	=> '67',
					'68' 	=> '68',
					'69' 	=> '69',
					'70' 	=> '70',
					'71' 	=> '71',
					'72' 	=> '72',
					'73' 	=> '73',
					'74' 	=> '74',
					'75' 	=> '75',
					'76' 	=> '76',
					'77' 	=> '77',
					'78' 	=> '78',
					'79' 	=> '79',
					'80' 	=> '80',
					'81' 	=> '81',
					'82' 	=> '82',
					'83' 	=> '83',
					'84' 	=> '84',
					'85' 	=> '85',
					'86' 	=> '86',
					'87' 	=> '87',
					'88' 	=> '88',
					'89' 	=> '89',
					'90' 	=> '90',
					'91' 	=> '91',
					'92' 	=> '92',
					'93' 	=> '93',
					'94' 	=> '94',
					'95' 	=> '95',
					'96' 	=> '96',
					'97' 	=> '97',
					'98' 	=> '98',
					'99' 	=> '99',
					'100' 	=> '100',
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'chauffeur' ),
				"param_name"	=> "order",
				"value"			=> array(
					'Newest First' 	=> 'newest',
					'Oldest First' 	=> 'oldest',
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Columns", 'chauffeur' ),
				"param_name"	=> "columns",
				"value"			=> array(
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5',
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Vehicle Type Category Slug (Leave blank to display all)", 'chauffeur' ),
				"param_name"	=> "fleet_type",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_fleet_page_vc' );



// Booking Page
function chauffeur_booking_page_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Booking Page", 'chauffeur' ),
		"description"			=> esc_html__( "Display the booking page", 'chauffeur' ),
		"base"					=> "booking_page",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textarea_html",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Content", 'chauffeur' ),
				"param_name"	=> "content",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_booking_page_vc' );



// Service Rates Page
function chauffeur_service_rates_page_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Service Rates Page", 'chauffeur' ),
		"description"			=> esc_html__( "Display service rates table", 'chauffeur' ),
		"base"					=> "service_rates_page",
		'category'				=> "Content",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'chauffeur' ),
				"param_name"	=> "order",
				"value"			=> array(
					'DESC' 	=> 'DESC',
					'ASC' 	=> 'ASC'
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order By", 'chauffeur' ),
				"param_name"	=> "orderby",
				"value"			=> array(
					'title' => 'title',
					'date' 	=> 'date'
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Column 1 Title", 'chauffeur' ),
				"param_name"	=> "column_1_title",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Column 1 Description", 'chauffeur' ),
				"param_name"	=> "column_1_desc",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Column 2 Title", 'chauffeur' ),
				"param_name"	=> "column_2_title",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Column 2 Description", 'chauffeur' ),
				"param_name"	=> "column_2_desc",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Column 3 Title", 'chauffeur' ),
				"param_name"	=> "column_3_title",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Column 3 Description", 'chauffeur' ),
				"param_name"	=> "column_3_desc",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Call To Action Text", 'chauffeur' ),
				"param_name"	=> "call_to_action_text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Call To Action Button Text", 'chauffeur' ),
				"param_name"	=> "call_to_action_button_text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Call To Action Button URL", 'chauffeur' ),
				"param_name"	=> "call_to_action_button_url",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'chauffeur_service_rates_page_vc' );



/* ----------------------------------------------------------------------------

   Edit VC Row

---------------------------------------------------------------------------- */
vc_remove_param("vc_row", "full_width");
vc_remove_param("vc_row", "full_height");
vc_remove_param("vc_row", "content_placement");
vc_remove_param("vc_row", "video_bg");
vc_remove_param("vc_row", "parallax");
vc_remove_param("vc_row", "el_id");
vc_remove_param("vc_row", "el_class");
vc_remove_param("vc_row", "video_bg_parallax");
vc_remove_param("vc_row", "video_bg_url");
vc_remove_param("vc_row", "parallax_image");
vc_remove_param("vc_row", "css");
vc_remove_param("vc_row", "parallax_speed_video");

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Section Type",
	"param_name" => "type",
	"value" => array(
		"Standard Section" => "standard_section",
		"Full Width Section" => "full_width_section"		
	),
	"group"	=> esc_html__( 'Advanced', 'chauffeur' )
));

vc_add_param("vc_row", array(
	"type" => "attach_image",
	"class" => "",
	"heading" => "Background Image",
	"param_name" => "bg_image",
	"value" => "",
	"description" => "",
	"group"	=> esc_html__( 'Background', 'chauffeur' ),
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Background Repeat",
	"param_name" => "bg_repeat",
	"value" => array(
		"Stretch" => "stretch",
		"No Repeat" => "no-repeat",
		"Repeat" => "repeat"
	),
	"dependency" => Array('element' => "bg_image", 'not_empty' => true),
	"group"	=> esc_html__( 'Background', 'chauffeur' ),
));

vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => "Background Color",
	"param_name" => "bg_color",
	"value" => "",
	"description" => "",
	"group"	=> esc_html__( 'Background', 'chauffeur' ),
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Padding Top",
	"value" => "",
	"param_name" => "top_padding",
	"description" => "Do not include \"px\" in your string. For example: 40",
	"group"	=> esc_html__( 'Advanced', 'chauffeur' ),
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Padding Bottom",
	"value" => "",
	"param_name" => "bottom_padding",
	"description" => "Do not include \"px\" in your string. For example: 40",
	"group"	=> esc_html__( 'Advanced', 'chauffeur' ),
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Margin Top",
	"value" => "",
	"param_name" => "top_margin",
	"description" => "Do not include \"px\" in your string. For example: 40",
	"group"	=> esc_html__( 'Advanced', 'chauffeur' ),
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Margin Bottom",
	"value" => "",
	"param_name" => "bottom_margin",
	"description" => "Do not include \"px\" in your string. For example: 40",
	"group"	=> esc_html__( 'Advanced', 'chauffeur' ),
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Extra Class Name",
	"param_name" => "class",
	"value" => "",
	"group"	=> esc_html__( 'Advanced', 'chauffeur' ),
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Row ID",
	"value" => "",
	"param_name" => "row_id",
	"description" => "Optional: Insert a unique name for that row. You can then link to that row with #rowid (useful for One Page Layouts).",
	"group"	=> esc_html__( 'Advanced', 'chauffeur' ),
));

?>