<?php

function create_post_type_fleet() {
	
	register_post_type('fleet', 
		array(
			'labels' => array(
				'name' => esc_html__( 'Fleet', 'chauffeur' ),
                'singular_name' => esc_html__( 'Fleet', 'chauffeur' ),
				'add_new' => esc_html__('Add Vehicle', 'chauffeur' ),
				'add_new_item' => esc_html__('Add New Vehicle' , 'chauffeur' )
			),
		'public' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-admin-post',
		'rewrite' => array(
			'slug' => esc_html__('fleet','chauffeur')
		), 
		'supports' => array( 'title','editor','thumbnail')
	));
}

add_action( 'init', 'create_post_type_fleet' );


function fleet_type() {	
    register_taxonomy( esc_html__('fleet-type','chauffeur'), 'fleet', array( 'hierarchical' => true, 'label' => esc_html__('Vehicle Type','chauffeur'), 'query_var' => true, 'rewrite' => true ) );
}
add_action( 'init', 'fleet_type' );



/* -------------------------------------------------------------

	Vehicle Details
	
------------------------------------------------------------- */

// Add the Meta Box  
function add_fleet1_meta_box() {  
    add_meta_box(  
        'fleet1_meta_box', // $id  
        esc_html__('Vehicle Details','chauffeur'), // $title  
        'show_fleet1_meta_box', // $callback  
        'fleet', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_fleet1_meta_box');



// Field Array  
$prefix = 'chauffeur_';  
$fleet1_meta_fields = array(  	
	array(  
        'label'=> esc_html__('Short Description','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'fleet_short_description',  
        'type'  => 'textarea'
    ),
	array(  
        'label'=> esc_html__('Passenger Capacity','chauffeur'),  
        'desc'  => 'e.g. 2',  
        'id'    => $prefix.'fleet_passenger_capacity',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Bag Capacity','chauffeur'),  
        'desc'  => 'e.g. 2',  
        'id'    => $prefix.'fleet_bag_capacity',  
        'type'  => 'text'
    )
);



// The Callback  
function show_fleet1_meta_box() {
	global $fleet1_meta_fields, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="fleet1_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

	foreach ($fleet1_meta_fields as $field) {
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
function save_fleet1_meta($post_id) {  
    global $fleet1_meta_fields;  
  	
	$post_data = '';
	
	if(isset($_POST['fleet1_meta_box_nonce'])) {
		$post_data = $_POST['fleet1_meta_box_nonce'];
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
    foreach ($fleet1_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_fleet1_meta');



/* -------------------------------------------------------------

	Sidebar Content
	
------------------------------------------------------------- */

// Add the Meta Box  
function add_fleet4_meta_box() {  
    add_meta_box(  
        'fleet4_meta_box', // $id  
        esc_html__('Sidebar Content','chauffeur'), // $title  
        'show_fleet4_meta_box', // $callback  
        'fleet', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_fleet4_meta_box');



// Field Array  
$prefix = 'chauffeur_';  
$fleet4_meta_fields = array(  	
	array(  
        'label'=> esc_html__('Sidebar Section Icon 1','chauffeur'),  
        'desc'  => esc_html__('Please use Font Awesome icon codes e.g. "fa-calendar": http://fontawesome.io/cheatsheet/', 'chauffeur'),  
        'id'    => $prefix.'fleet_sidebar_icon_1',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Sidebar Section Title 1','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'fleet_sidebar_title_1',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Sidebar Section Content 1','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'fleet_sidebar_content_1',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Sidebar Section Icon 2','chauffeur'),  
        'desc'  => esc_html__('Please use Font Awesome icon codes e.g. "fa-calendar": http://fontawesome.io/cheatsheet/', 'chauffeur'),  
        'id'    => $prefix.'fleet_sidebar_icon_2',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Sidebar Section Title 2','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'fleet_sidebar_title_2',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Sidebar Section Content 2','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'fleet_sidebar_content_2',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Sidebar Section Icon 3','chauffeur'),  
        'desc'  => esc_html__('Please use Font Awesome icon codes e.g. "fa-calendar": http://fontawesome.io/cheatsheet/', 'chauffeur'),  
        'id'    => $prefix.'fleet_sidebar_icon_3',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Sidebar Section Title 3','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'fleet_sidebar_title_3',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Sidebar Section Content 3','chauffeur'),  
        'desc'  => '',  
        'id'    => $prefix.'fleet_sidebar_content_3',  
        'type'  => 'text'
    ),
);



// The Callback  
function show_fleet4_meta_box() {
	global $fleet4_meta_fields, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="fleet4_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

	foreach ($fleet4_meta_fields as $field) {
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
function save_fleet4_meta($post_id) {  
    global $fleet4_meta_fields;  
  	
	$post_data = '';
	
	if(isset($_POST['fleet4_meta_box_nonce'])) {
		$post_data = $_POST['fleet4_meta_box_nonce'];
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
    foreach ($fleet4_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_fleet4_meta');



/* -------------------------------------------------------------

	Price Details
	
------------------------------------------------------------- */

// Add the Meta Box  
function add_fleet2_meta_box() {  
    add_meta_box(  
        'fleet2_meta_box', // $id  
        esc_html__('Hourly &amp; Distance Pricing','chauffeur'), // $title  
        'show_fleet2_meta_box', // $callback  
        'fleet', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_fleet2_meta_box');



// Field Array  
$prefix = 'chauffeur_';  
$fleet2_meta_fields = array(  	
	array(  
        'label'=> esc_html__('"From" Price','chauffeur'),  
        'desc'  => 'Only enter numerical values, e.g. 10.00 for $10.00 - This is the lowest price the vehicle can be hired for',  
        'id'    => $prefix.'fleet_price_from',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Price Per Kilometer or Mile (choose km or miles in Theme Options > Payments in the "Distance Measurement Unit" field)','chauffeur'),  
        'desc'  => 'Only enter numerical values, e.g. 10.00 for $10.00',  
        'id'    => $prefix.'fleet_price_per_mile',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Price Per Hour','chauffeur'),  
        'desc'  => 'Only enter numerical values, e.g. 10.00 for $10.00',  
        'id'    => $prefix.'fleet_price_per_hour',  
        'type'  => 'text'
    ),
	array(  
        'label'=> esc_html__('Price Per Day','chauffeur'),  
        'desc'  => 'Only enter numerical values, e.g. 10.00 for $10.00',  
        'id'    => $prefix.'fleet_price_per_day',  
        'type'  => 'text'
    ),
);



// The Callback  
function show_fleet2_meta_box() {
	global $fleet2_meta_fields, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="fleet2_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

	foreach ($fleet2_meta_fields as $field) {
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
function save_fleet2_meta($post_id) {  
    global $fleet2_meta_fields;  
  	
	$post_data = '';
	
	if(isset($_POST['fleet2_meta_box_nonce'])) {
		$post_data = $_POST['fleet2_meta_box_nonce'];
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
    foreach ($fleet2_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_fleet2_meta');



/* -------------------------------------------------------------

	Flat Price Details
	
------------------------------------------------------------- */

// Add the Meta Box  
function add_fleet3_meta_box() {  
    add_meta_box(  
        'fleet3_meta_box', // $id  
        esc_html__('Flat Rate Pricing','chauffeur'), // $title  
        'show_fleet3_meta_box', // $callback  
        'fleet', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_fleet3_meta_box');



// Create price meta box fields array
function create_price_meta_box_fields() {
	
	global $post;
	global $wp_query;
	global $fleet3_meta_fields;

	$args = array(
	'post_type' => 'flat_rate_trips',
	'posts_per_page' => '9999',
	'order' => 'ASC',
	'orderby' => 'title'
	);
	
	$prefix = 'chauffeur_'; 
	$fleet3_meta_fields = array();
	$count = -1;
	
	$myposts1 = get_posts( $args );
	foreach ( $myposts1 as $post1 ) : setup_postdata( $post1 );
		
		$count++;
		
		$chauffeur_flat_rate_trips_pick_up_name = get_post_meta( $post1->ID, 'chauffeur_flat_rate_trips_pick_up_name', true );
		$chauffeur_flat_rate_trips_drop_off_name = get_post_meta( $post1->ID, 'chauffeur_flat_rate_trips_drop_off_name', true );

		$fleet3_meta_fields[$count]['label'] = esc_html__('Price For','chauffeur') . ' ' . $chauffeur_flat_rate_trips_pick_up_name . ' > ' . $chauffeur_flat_rate_trips_drop_off_name;
		$fleet3_meta_fields[$count]['desc'] = esc_html__('Only enter numerical values, e.g. 10.00 for $10.00','chauffeur');
		$fleet3_meta_fields[$count]['id'] =  $prefix . $post1->ID;
		$fleet3_meta_fields[$count]['type'] = 'text';
		
	endforeach; 
	wp_reset_postdata();
	
}



// The Callback  
function show_fleet3_meta_box() {
	
	create_price_meta_box_fields();
	
	global $fleet3_meta_fields;
	global $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="fleet3_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

	foreach ($fleet3_meta_fields as $field) {
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
function save_fleet3_meta($post_id) { 
	
	create_price_meta_box_fields();
	
    global $fleet3_meta_fields;  
  	
	$post_data = '';
	
	if(isset($_POST['fleet3_meta_box_nonce'])) {
		$post_data = $_POST['fleet3_meta_box_nonce'];
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
    foreach ($fleet3_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_fleet3_meta');

?>