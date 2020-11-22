<?php

function create_post_type_payment() {
	
	register_post_type('payment', 
		array(
			'labels' => array(
				'name' => esc_html__( 'Bookings', 'chauffeur' ),
                'singular_name' => esc_html__( 'Booking', 'chauffeur' ),
				'add_new' => esc_html__('Add Booking', 'chauffeur' ),
				'add_new_item' => esc_html__('Add New Booking' , 'chauffeur' )
			),
		'public' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-admin-post',
		'rewrite' => array(
			'slug' => esc_html__('payment','chauffeur')
		), 
		'supports' => array( 'title')
	));
}

add_action( 'init', 'create_post_type_payment' );

// Add the Meta Box  
function add_payment_meta_box() {  
    add_meta_box(  
        'payment_meta_box', // $id  
        esc_html__('Booking Details','chauffeur'), // $title  
        'show_payment_meta_box', // $callback  
        'payment', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_payment_meta_box');

// Field Array  
$prefix = 'chauffeur_';  
$payment_meta_fields = array(
	array(  
        'label'=> esc_html__('Payment Status','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_status',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Payment Amount','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_amount',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Payment Method Selected','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_method',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Trip Type','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_trip_type',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Return','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_return_journey',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Vehicle Type Requested','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_item_name',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Pickup Address','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_pickup_address',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Full Pickup Address','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_full_pickup_address',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Pickup Instructions','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_pickup_instructions',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Dropoff Address','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_dropoff_address',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Full Dropoff Address','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_full_dropoff_address',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Dropoff Instructions','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_dropoff_instructions',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Pickup Date','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_pickup_date',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Pickup Time','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_pickup_time',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Number Hours','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_num_hours',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Number of Passengers','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_num_passengers',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Number of Bags','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_num_bags',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('First Name','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_first_name',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Last Name','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_last_name',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Email','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_email',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Phone Number','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_phone_num',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Estimated Trip Distance','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_trip_distance',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Estimated Trip Time','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_trip_time',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Flight Number','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_flight_number',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Additional Info','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'payment_additional_info',  
        'type'  => 'textarea'
    )
);



// The Callback  
function show_payment_meta_box() {
	global $payment_meta_fields, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="payment_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

	foreach ($payment_meta_fields as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field['id'], true);

		switch($field['type']) {
			
			// text
			case 'text':
?><div class="chauffeur-field-wrapper field-padding clearfix">
	<div class="one-fifth"><label><?php echo $field['label']; ?></label></div>
	<div class="four-fifths"><input type="text" name="<?php echo $field['id']; ?>" id="<?php echo $field['id']; ?>" value="<?php echo !empty($meta) ? $meta : ''; ?>"><p class="description"><?php echo $field['desc']; ?></p></div>
</div>
<hr class="space1"><?php
			break;
			
			case 'textarea':
?><div class="chauffeur-field-wrapper field-padding clearfix">
	<div class="one-fifth"><label><?php echo $field['label']; ?></label></div>
	<div class="four-fifths"><textarea rows="10" name="<?php echo $field['id']; ?>" id="<?php echo $field['id']; ?>"><?php echo !empty($meta) ? $meta : ''; ?></textarea><p class="description"><?php echo $field['desc']; ?></p></div>
</div>
<hr class="space1"><?php
			break;
			
		} //end switch
   } // end foreach
}



// Save the Data  
function save_payment_meta($post_id) {  
    global $payment_meta_fields;  
  	
	$post_data = '';
	
	if(isset($_POST['payment_meta_box_nonce'])) {
		$post_data = $_POST['payment_meta_box_nonce'];
	}

    // verify nonce  
    if (!wp_verify_nonce($post_data, basename(__FILE__)))  
        return $post_id;

    // check autosave  
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;

    // check permissions  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
  
    // loop through fields and save the data  
    foreach ($payment_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_payment_meta');


?>