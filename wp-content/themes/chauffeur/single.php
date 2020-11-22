<?php get_header(); ?>

<div id="page-header" <?php echo wp_kses($chauffeur_page_header_image, $chauffeur_allowed_html_array_header); ?>>	
	
	<div class="page-header-inner">
		<h1><?php esc_html_e('Latest News','chauffeur'); ?></h1>
		<div class="title-block3"></div>
		<?php echo dimox_breadcrumbs();?>
	</div>
	
</div>

<!-- BEGIN .content-wrapper-outer -->
<div class="content-wrapper-outer clearfix">
			
	<!-- BEGIN .main-content -->
	<div class="main-content">
			
		<?php if ( post_password_required() ) {
			echo chauffeur_password_form();
		} else { ?>
				
			<!-- BEGIN .news-block-wrapper -->
			<div class="news-block-wrapper news-block-wrapper-1-col-listing news-single clearfix">
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
				<!-- BEGIN .news-block -->
				<div id="post-<?php the_ID(); ?>" class="news-block">

					<h3><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

					<!-- BEGIN .news-meta -->
					<div class="news-meta clearfix">
						<span class="nm-news-date"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_date(); ?></a></span>
						<span class="nm-news-author"><?php esc_html_e( 'By', 'chauffeur' ); ?> <?php the_author_posts_link(); ?></span>
						<span class="nm-news-category"><?php the_category(', '); ?></span>
						<span class="nm-news-comments"><?php comments_popup_link(esc_html__( 'No Comments', 'chauffeur' ),esc_html__( '1 Comment', 'chauffeur' ),esc_html__( '% Comments', 'chauffeur' ),'',esc_html__( 'Comments Off','chauffeur')); ?></span>
					<!-- END .news-meta -->
					</div>

					<?php if( has_post_thumbnail() ) { ?>

						<div class="news-block-image">
							<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php $thumb_id = get_post_thumbnail_id($post->ID);
								$src = wp_get_attachment_image_src($thumb_id, 'chauffeur-image-style2' ); 
								$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
								echo '<img src="' . esc_url( $src[0] ) . '" alt="' . $alt . '" />'; ?>
							</a>
						</div>

					<?php } ?>

						<?php the_content(); ?>
						
						<?php
						 	$defaults = array(
								'before'           => '<div class="post-pagination">',
								'after'            => '</div>',
								'link_before'      => '<span>',
								'link_after'       => '</span>',
								'next_or_number'   => 'number',
								'separator'        => ' ',
								'nextpagelink'     => esc_html__( 'Next page','chauffeur' ),
								'previouspagelink' => esc_html__( 'Previous page','chauffeur' ),
								'pagelink'         => '%',
								'echo'             => 1
							);

						        wp_link_pages( $defaults );

							?>
						
						<p class="post-tags"><?php the_tags( esc_html__('Tags: ','chauffeur'), ', ', '' ); ?></p>
						
				<!-- END .news-block -->
				</div>
					
			<!-- END .news-block-wrapper -->
			</div>	
					
			<?php endwhile; ?>
			<?php endif; ?>
			
			<?php 
				comments_template();
		 	?>

			<?php } ?>
		
	<!-- END .main-content -->
	</div>

	<!-- BEGIN .sidebar-content -->
	<div class="sidebar-content">

		<?php get_sidebar(); ?>

	<!-- END .sidebar-content -->
	</div>

<!-- BEGIN .content-wrapper-outer -->
</div>

<?php get_footer(); ?>