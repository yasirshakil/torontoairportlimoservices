<?php get_header(); ?>

<div id="page-header" <?php echo wp_kses($chauffeur_page_header_image, $chauffeur_allowed_html_array_header); ?>>		
	
	<div class="page-header-inner">
		<h1><?php echo single_cat_title( '', false ); ?></h1>
		<div class="title-block3"></div>
		<?php echo dimox_breadcrumbs();?>
	</div>
	
</div>

<!-- BEGIN .content-wrapper-outer -->
<div class="content-wrapper-outer clearfix">

	<!-- BEGIN .main-content -->
	<div class="main-content">
		
		<?php if ( have_posts() ) : ?>
			
			<?php if ( category_description() ) : ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
				
				<!-- BEGIN .news-block-wrapper -->
				<div class="news-block-wrapper news-block-wrapper-1-col-listing clearfix">
				
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
				
				<!-- END .news-block-wrapper -->
				</div>

			<?php get_template_part( 'loop', 'pagination' ); ?>
			
		<?php endif; ?>
		
	<!-- END .main-content -->
	</div>
	
	<!-- BEGIN .sidebar-content -->
	<div class="sidebar-content">

		<?php get_sidebar(); ?>

	<!-- END .sidebar-content -->
	</div>

<!-- END .content-wrapper -->
</div>

<?php get_footer(); ?>