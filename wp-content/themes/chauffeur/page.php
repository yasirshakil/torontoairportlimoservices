<?php get_header(); ?>

<?php if ($chauffeur_title_style != 'no_title') { ?>
<div id="page-header" <?php echo wp_kses($chauffeur_page_header_image, $chauffeur_allowed_html_array_header); ?>>
	
	<div class="page-header-inner">
		<h1><?php the_title(); ?></h1>
		<div class="title-block3"></div>
		<?php echo dimox_breadcrumbs();?>
	</div>
	
</div>
<?php } ?>

<!-- BEGIN .content-wrapper-outer -->
<div class="content-wrapper-outer <?php if( $chauffeur_page_layout == 'unboxed-full-width' ) {echo 'content-wrapper-full';} ?> clearfix">
			
	<!-- BEGIN .main-content -->
	<div class="<?php echo wp_kses(chauffeur_sidebar1($chauffeur_page_layout), $chauffeur_allowed_html_array); ?>">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>			
			<?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages:', 'chauffeur').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>			
			<?php if ( comments_open() ) : comments_template(); endif; ?>
		<?php endwhile;endif; ?>
		
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