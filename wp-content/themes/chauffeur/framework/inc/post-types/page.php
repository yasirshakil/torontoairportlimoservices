<?php



// Add the Meta Box  
function add_page_meta_box() {  
    add_meta_box(  
        'page_meta_box', // $id  
        'Page Options', // $title  
        'show_page_meta_box', // $callback  
        'page', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_page_meta_box');



// Field Array  
$prefix = 'chauffeur_';  
$page_meta_fields = array(  
	array(  
        'label'=> esc_html__('Sidebar Layout','chauffeur'), 
        'desc'  => '',  
        'id'    => $prefix.'page_layout',  
        'type'  => 'select',  
        'options' => array(
			'1' => array(  
                'label' => 'Right Sidebar',  
                'value' => 'right-sidebar'  
            ),
            '3' => array(  
                'label' => 'Full Width',  
                'value' => 'full-width'  
            ),
			'4' => array(  
                'label' => 'Unboxed Full Width',  
                'value' => 'unboxed-full-width'  
            )
        )
	),
	array(  
    	'label'=> esc_html__('Title Style','chauffeur'), 
    	'desc'  => '',  
    	'id'    => $prefix.'title_style',  
    	'type'  => 'select',  
    	'options' => array(  
			'1' => array(
            	'label' => 'Standard Title',  
            	'value' => 'standard_title',  
        	),
			'3' => array(  
            	'label' => 'No Title',  
            	'value' => 'no_title'  
        	)
    	)  
	)
);



// The Callback  
function show_page_meta_box() {  
global $page_meta_fields, $post;  
// Use nonce for verification  
echo '<input type="hidden" name="page_meta_box_nonce" value="'.wp_create_nonce(get_template_directory()).'" />';  
  
    foreach ($page_meta_fields as $field) {  
        // get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);  
        
		echo '<div class="section">';

        echo '<h3 class="heading">'.esc_attr($field['label']).'</h3>';  
                switch($field['type']) {  
					
					// text  
					case 'text':  
					    echo '<div class="control-area"><input type="text" name="'.esc_attr($field['id']).'" id="'.esc_attr($field['id']).'" value="'.esc_attr($meta).'" size="30" /></div>
					        <div class="label-area">'.esc_attr($field['desc']).'</div>
							<div class="clearboth"></div>';  
					break;

					// textarea  
					case 'textarea':  
					    echo '<div class="control-area"><textarea name="'.esc_attr($field['id']).'" id="'.esc_attr($field['id']).'" cols="60" rows="4">'.esc_attr($meta).'</textarea></div>
					        <div class="label-area">'.esc_attr($field['desc']).'</div>
							<div class="clearboth"></div>';  
					break;

					// checkbox  
					case 'checkbox':  
					    echo '<div class="control-area"><input type="checkbox" name="'.esc_attr($field['id']).'" id="'.esc_attr($field['id']).'" ',esc_attr($meta) ? ' checked="checked"' : '','/></div>
					        <div class="label-area">'.esc_attr($field['desc']).'</div>
							<div class="clearboth"></div>';  
					break;

					// select  
					case 'select':  
					    echo '<div class="control-area">
					<div class="select_wrapper"><select name="'.esc_attr($field['id']).'" id="'.esc_attr($field['id']).'">';  
					    foreach ($field['options'] as $option) {  
					        echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.esc_attr($option['value']).'">'.esc_attr($option['label']).'</option>';  
					    }  
					    echo '</select></div></div>
					<div class="label-area">'.esc_attr($field['desc']).'</div>
					<div class="clearboth"></div>';  
					break;
					
					// date
					case 'date':
						echo '<div class="control-area"><input type="text" class="datepicker" name="'.esc_attr($field['id']).'" id="'.esc_attr($field['id']).'" value="'.esc_attr($meta).'" size="30" /></div>
								<div class="label-area">'.esc_attr($field['desc']).'</div>
								<div class="clearboth"></div>';
					break;
					
			
                
			} //end switch  
			
			echo '</div>';
			
    } // end foreach  
	
	echo '<div class="clearboth admin-bottom"></div>';
}



// Save the Data  
function save_page_meta($post_id) {  
    global $page_meta_fields;  
  	
	$post_data = '';
	
	if(isset($_POST['page_meta_box_nonce'])) {
		$post_data = $_POST['page_meta_box_nonce'];
	}

    // verify nonce  
    if (!wp_verify_nonce($post_data, get_template_directory()))  
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
    foreach ($page_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_page_meta');



?>