<?php get_header(); ?>

<div id="page-header" <?php echo wp_kses($chauffeur_page_header_image, $chauffeur_allowed_html_array_header); ?>>
	
	<div class="page-header-inner">
		<h1><?php esc_html_e('Search Results','chauffeur')?></h1>
		<div class="title-block3"></div>
		<?php echo dimox_breadcrumbs();?>
	</div>
	
</div>

<!-- BEGIN .content-wrapper-outer -->
<div class="content-wrapper-outer clearfix">
			
	<!-- BEGIN .main-content -->
	<div class="main-content">
		
			<!-- BEGIN .search-results-form -->
			<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-results-form clearfix">
				<input type="text" onblur="if(this.value=='')this.value='<?php esc_html_e('To search, type and hit enter', 'chauffeur'); ?>';" onfocus="if(this.value=='<?php esc_html_e('To search, type and hit enter', 'chauffeur'); ?>')this.value='';" value="<?php esc_html_e('To search, type and hit enter', 'chauffeur'); ?>" name="s" />
				<button type="submit">
					<?php esc_html_e('Search','chauffeur'); ?> <i class="fa fa-search"></i>
				</button>
			<!-- END .search-results-form -->
			</form>
			
			<?php if (have_posts()) : ?>

				<!--BEGIN .search-results-list -->
				<ul class="search-results-list">

					<?php $i = 0;
					while (have_posts()) : the_post(); ?>
						<li><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a> <span>(<?php echo chauffeur_post_type_name(get_post_type());?> / <a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_date(); ?></a>)</span></li>
					<?php endwhile;?>

				<!--END .search-results-list -->
				</ul>

			<?php else : ?>

				<!--BEGIN .search-results-list -->
				<ul class="search-results-list">
					<li><?php esc_html_e( 'No results were found.', 'chauffeur' ); ?></li>
				<!--END .search-results-list -->
				</ul>

			<?php endif; ?>
			
		<!-- END .main-content -->
		</div>

		<!-- BEGIN .sidebar-content -->
		<div class="sidebar-content">

			<?php get_sidebar(); ?>

		<!-- END .sidebar-content -->
		</div>

	<!-- END .content-wrapper-outer -->
	</div>

	<?php get_footer(); ?>