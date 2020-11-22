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
	<div class="<?php echo wp_kses(chauffeur_sidebar1($chauffeur_page_layout), $chauffeur_allowed_html_array); ?>">
		
		<?php if(get_option('posts_per_page')) {
			$posts_per_page = esc_attr(get_option('posts_per_page'));
		} else {
			$posts_per_page = '10';
		} ?>
		
		<!-- BEGIN .news-block-wrapper -->
		<div class="news-block-wrapper news-block-wrapper-1-col-listing clearfix">
			
			<?php $count = 0; ?>
			<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
			<?php query_posts( "post_type=post&paged=" . $paged . "&posts_per_page=" . $posts_per_page ); ?>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
			
					<!-- BEGIN .news-block -->
					<div id="post-<?php the_ID(); ?>" <?php post_class("news-block"); ?>>

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

						<!-- BEGIN .news-description -->
						<div class="news-description">

							<?php global $more;$more = 0;?>
							<?php the_content(esc_html__('Read More','chauffeur') . ' <i class="fa fa-angle-right"></i>'); ?>

						<!-- END .news-description -->
						</div>

					<!-- END .news-block -->
					</div>
			
				<?php endwhile; ?>
			<?php endif; ?>
		
		<!-- END .news-block-wrapper -->
		</div>
		
		<?php get_template_part( 'loop', 'pagination' ); ?>
		
	<!-- END .main-content -->
	</div>
		
	<?php if ( $chauffeur_page_layout != 'full-width' ) { ?>
	<?php if ( $chauffeur_page_layout != 'unboxed-full-width' ) { ?>
	
	<!-- BEGIN .sidebar-content -->
	<div class="<?php echo chauffeur_sidebar2($chauffeur_page_layout); ?>">
		
		<?php get_sidebar(); ?>
		
	<!-- END .sidebar-content -->
	</div>
	
	<?php } ?>
	<?php } ?>

<!-- END .content-wrapper-outer -->
</div>

<?php get_footer(); ?>