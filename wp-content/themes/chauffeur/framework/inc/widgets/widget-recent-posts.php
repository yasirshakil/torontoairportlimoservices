<?php

// Widget Class
class chauffeur_recent_posts_widget extends WP_Widget {


/* ------------------------------------------------
	Widget Setup
------------------------------------------------ */

	function chauffeur_recent_posts_widget() {
		
		parent::__construct(false, $name = esc_html__('Chauffeur Recent Posts','chauffeur'), array(
			'description' => esc_html__('Display Recent Posts','chauffeur')
		));
	
	}


/* ------------------------------------------------
	Display Widget
------------------------------------------------ */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$post_limit = $instance['post_limit'];

		global $chauffeur_allowed_html_array;
		
		echo wp_kses($before_widget,$chauffeur_allowed_html_array);

		if ( $title ) {
			echo wp_kses($before_title . $title . $after_title,$chauffeur_allowed_html_array);
		 } ?>

			<?php // Set News Limit
			if ( $instance['post_limit'] ) : 
				$news_limit = $instance['post_limit'];
			elseif ( !is_numeric ( $instance['post_limit'] ) )	:
				$news_limit = '8';
			else :
				$news_limit = '8';
			endif;
			?>
			
			<?php $args = array(
				'posts_per_page' => $news_limit,
				'ignore_sticky_posts' => 1,
				'post_type' => 'post',
				'order' => 'DESC',
				'orderby' => 'date'
			);

			$post_query = new WP_Query( $args );
				
			if( $post_query->have_posts() ) : while( $post_query->have_posts() ) : $post_query->the_post(); ?>
				
				<!-- BEGIN .news-widget-wrapper -->
				<div class="news-widget-wrapper clearfix">	
					
					<?php if( has_post_thumbnail() ) { ?>
						
						<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							<?php $thumb_id = get_post_thumbnail_id($post_query->ID);
							$src = wp_get_attachment_image_src($thumb_id, 'chauffeur-image-style3' ); 
							$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
							echo '<img src="' . esc_url( $src[0] ) . '" alt="' . $alt . '" />'; ?>
						</a>

					<?php } ?>
					
					<div class="news-widget-content">
					
						<h4><a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
						<p><?php esc_html_e('Category','chauffeur'); ?>: <?php the_category(', '); ?></p>
					</div>
				
				<!-- END .news-widget-wrapper -->
				</div>
				
			<?php endwhile; endif; ?>	
				
		<?php echo wp_kses($after_widget,$chauffeur_allowed_html_array);
	
	}	
	
	
/* ------------------------------------------------
	Update Widget
------------------------------------------------ */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_limit'] = strip_tags( $new_instance['post_limit'] );
		return $instance;
	}
	
	
/* ------------------------------------------------
	Widget Input Form
------------------------------------------------ */
	 
	function form( $instance ) {
		$defaults = array(
		'title' => 'Recent Posts',
		'post_limit' => '8'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
				
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'chauffeur'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'post_limit' )); ?>"><?php esc_html_e('Post Limit:', 'chauffeur') ?></label>
			<input type="text" size="3" id="<?php echo esc_attr($this->get_field_id('post_limit')); ?>" name="<?php echo esc_attr($this->get_field_name('post_limit')); ?>" value="<?php echo esc_attr($instance['post_limit']); ?>" />
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'chauffeur_recent_posts_widget' );

// Register Widget
function chauffeur_recent_posts_widget() {
	register_widget( 'chauffeur_recent_posts_widget' );
}