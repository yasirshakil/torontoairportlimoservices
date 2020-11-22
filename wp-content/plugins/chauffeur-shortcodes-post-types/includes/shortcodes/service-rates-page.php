<?php

function rates_page_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'column_1_title' => '',
		'column_1_desc' => '',
		'column_2_title' => '',
		'column_2_desc' => '',
		'column_3_title' => '',
		'column_3_desc' => '',
		'call_to_action_text' => '',
		'call_to_action_button_text' => '',
		'call_to_action_button_url' => '',
		'order' => '',
		'orderby' => ''
	), $atts ) );
	
	ob_start(); ?>
	
	<div class="mobile-rate-table-msg msg default"><p><?php esc_html_e('Mobile users, please swipe left/right to view prices','chauffeur'); ?></p></div>
	
	<div class="chauffeur-service-rates-table-wrapper">
		
		 <table class="chauffeur-service-rates-table">
			 <tr>
				 <th></th>
				 <th>
					 <p><strong><?php echo $column_1_title; ?></strong> <?php echo $column_1_desc; ?></p>
				 </th>
				 <th>
					 <p><strong><?php echo $column_2_title; ?></strong> <?php echo $column_2_desc; ?></p>
				 </th>
				 <th>
					 <p><strong><?php echo $column_3_title; ?></strong> <?php echo $column_3_desc; ?></p>
				 </th>
			 </tr>
			 
			 <?php 
			 
		 	$ids = get_posts(array(
		 	    'fields'          => 'ids',
		 	    'posts_per_page'  => -1,
		 		'post_type' => 'rates',
				'order' => $order,
				'orderby' => $orderby,
		 	));
			 
			 foreach($ids as $id) {
				 
				 echo '<tr>';
				 
			 		echo '<td>';
					if( has_post_thumbnail($id) ) {	
						$thumb_id = get_post_thumbnail_id($id);
						$src = wp_get_attachment_image_src($thumb_id, 'chauffeur-image-style7' ); 
						$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
						echo '<img src="' . esc_url( $src[0] ) . '" alt="' . $alt . '" />';
					}
					echo '<p><strong>' . get_the_title($id) . '</strong></p>';
					echo '</td>';
				
					echo '<td>';
						 echo '<p><strong><span>' . get_post_meta($id,'chauffeur_rates_currency_unit',TRUE) . get_post_meta($id,'chauffeur_rates_col_1_price',TRUE) . '</span> ' . get_post_meta($id,'chauffeur_rates_col_1_unit',TRUE) . '</strong> ' . get_post_meta($id,'chauffeur_rates_col_1_description',TRUE) . '</p>';
					echo '</td>';
					
					echo '<td>';
						 echo '<p><strong><span>' . get_post_meta($id,'chauffeur_rates_currency_unit',TRUE) . get_post_meta($id,'chauffeur_rates_col_2_price',TRUE) . '</span> ' . get_post_meta($id,'chauffeur_rates_col_2_unit',TRUE) . '</strong> ' . get_post_meta($id,'chauffeur_rates_col_2_description',TRUE) . '</p>';
					echo '</td>';
					
					echo '<td>';
						 echo '<p><strong><span>' . get_post_meta($id,'chauffeur_rates_currency_unit',TRUE) . get_post_meta($id,'chauffeur_rates_col_3_price',TRUE) . '</span> ' . get_post_meta($id,'chauffeur_rates_col_3_unit',TRUE) . '</strong> ' . get_post_meta($id,'chauffeur_rates_col_3_description',TRUE) . '</p>';
					echo '</td>';
				
				echo '</tr>';
				
		 	} ?>
			 
		 </table>
		
	</div>
	
	<div class="call-to-action-small clearfix">
		<h4><?php echo $call_to_action_text; ?></h4>
		<a href="<?php echo $call_to_action_button_url; ?>" class="call-to-action-button"><?php echo $call_to_action_button_text; ?></a>
	</div>
		
	<?php return ob_get_clean();

}

add_shortcode( 'service_rates_page', 'rates_page_shortcode' );

?>