<?php

// Widget Class
class chauffeur_contact_widget extends WP_Widget {


/* ------------------------------------------------
	Widget Setup
------------------------------------------------ */

	function chauffeur_contact_widget() {
		
		parent::__construct(false, $name = esc_html__('Chauffeur Contact Details','chauffeur'), array(
			'description' => esc_html__('Display Contact Details','chauffeur')
		));
	
	}


/* ------------------------------------------------
	Display Widget
------------------------------------------------ */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$contact_address = apply_filters('contact_address', $instance['contact_address'] );
		$contact_phone_1 = apply_filters('contact_phone_1', $instance['contact_phone_1'] );
		$contact_phone_2 = apply_filters('contact_phone_2', $instance['contact_phone_2'] );
		$contact_email_1 = apply_filters('contact_email_1', $instance['contact_email_1'] );
		$contact_email_2 = apply_filters('contact_email_2', $instance['contact_email_2'] );
		
		global $chauffeur_allowed_html_array;
		
		echo wp_kses($before_widget,$chauffeur_allowed_html_array);

		if ( $title ) {
			echo wp_kses($before_title . $title . $after_title,$chauffeur_allowed_html_array);
		 } ?>
		
		<ul class="contact-widget">
			<?php if ($contact_address != '') {echo '<li class="cw-address">'. esc_textarea($instance['contact_address']) . '</li>';} ?>
			<?php if ($contact_phone_1 != '') {echo '<li class="cw-phone"><a href="tel:' . esc_textarea($instance['contact_phone_1']) . '">'. esc_textarea($instance['contact_phone_1']) . '</a><span>'. esc_textarea($instance['contact_phone_2']) . '</span></li>';} ?>
			<?php if ($contact_email_1 != '') {echo '<li class="cw-cell"><a href="mailto:'. esc_textarea($instance['contact_email_1']) . '">'. esc_textarea($instance['contact_email_1']) . '</a><span>'. esc_textarea($instance['contact_email_2']) . '</span></li>';} ?>
		</ul>
		
		<?php
		
		echo wp_kses($after_widget,$chauffeur_allowed_html_array);
	}	
	
	
/* ------------------------------------------------
	Update Widget
------------------------------------------------ */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['contact_address'] = strip_tags( $new_instance['contact_address'] );
		$instance['contact_phone_1'] = strip_tags( $new_instance['contact_phone_1'] );
		$instance['contact_phone_2'] = strip_tags( $new_instance['contact_phone_2'] );
		$instance['contact_email_1'] = strip_tags( $new_instance['contact_email_1'] );
		$instance['contact_email_2'] = strip_tags( $new_instance['contact_email_2'] );
		return $instance;
	}
	
	
/* ------------------------------------------------
	Widget Input Form
------------------------------------------------ */

	function form( $instance ) {
		$defaults = array(
		'title' => 'Contact Details',
		'contact_address' => '700 5th Avenue, New York City, United States',
		'contact_phone_1' => '1800-1111-2222',
		'contact_phone_2' => 'Mon - Fri, 9.00am until 6.30pm',
		'contact_email_1' => 'booking@example.com',
		'contact_email_2' => 'We reply within 24 hrs'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'chauffeur'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'contact_address' )); ?>"><?php esc_html_e('Address/Location:', 'chauffeur') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_address')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_address')); ?>" value="<?php echo esc_attr($instance['contact_address']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'contact_phone_1' )); ?>"><?php esc_html_e('Phone Number Line 1:', 'chauffeur') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_phone_1')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_phone_1')); ?>" value="<?php echo esc_attr($instance['contact_phone_1']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'contact_phone_2' )); ?>"><?php esc_html_e('Phone Number Line 2:', 'chauffeur') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_phone_2')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_phone_2')); ?>" value="<?php echo esc_attr($instance['contact_phone_2']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'contact_email_1' )); ?>"><?php esc_html_e('Email Address Line 1:', 'chauffeur') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_email_1')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_email_1')); ?>" value="<?php echo esc_attr($instance['contact_email_1']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'contact_email_2' )); ?>"><?php esc_html_e('Email Address Line 2:', 'chauffeur') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_email_2')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_email_2')); ?>" value="<?php echo esc_attr($instance['contact_email_2']); ?>" />
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'chauffeur_contact_widget' );

// Register Widget
function chauffeur_contact_widget() {
	register_widget( 'chauffeur_contact_widget' );
}