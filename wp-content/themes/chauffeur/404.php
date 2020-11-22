<?php get_header(); ?>

<?php if ($chauffeur_title_style != 'no_title') { ?>
<div id="page-header" <?php echo wp_kses($chauffeur_page_header_image, $chauffeur_allowed_html_array_header); ?>>
	
	<div class="page-header-inner">
		<h1><?php esc_html_e('Page Not Found', 'chauffeur'); ?></h1>
		<div class="title-block3"></div>
		<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home', 'chauffeur'); ?></a><i class="fa fa-angle-right"></i><?php esc_html_e('Page Not Found', 'chauffeur'); ?></p>
	</div>
	
</div>
<?php } ?>

<!-- BEGIN .content-wrapper-outer -->
<div class="content-wrapper-outer clearfix">
			
	<!-- BEGIN .main-content -->
	<div class="main-content main-content-full">
		
		<p class="page-not-found-text"><?php esc_html_e('Sorry, the requested page could not be found, the page may have been deleted or you may have followed a broken link.', 'chauffeur'); ?></p>

		<!-- BEGIN .page-not-found-search-form -->
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="page-not-found-search-form clearfix" method="get">

			<input type="text" onblur="if(this.value=='')this.value='<?php esc_html_e('Search...', 'chauffeur'); ?>';" onfocus="if(this.value=='<?php esc_html_e('Search...', 'chauffeur'); ?>')this.value='';" value="<?php esc_html_e('Search...', 'chauffeur'); ?>" name="s" />

			<button type="submit">
				<?php esc_html_e('Submit', 'chauffeur'); ?> <i class="fa fa-search"></i>
			</button>

		<!-- END .page-not-found-search-form -->
		</form>

		<hr class="space4" />
		
	<!-- END .main-content -->
	</div>

<!-- END .content-wrapper-outer -->
</div>

<?php get_footer(); ?>