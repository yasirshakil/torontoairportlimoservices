<?php

// Set Global Variables
global $chauffeur_data;
global $chauffeur_page_layout;
global $chauffeur_page_header_image;
global $chauffeur_title_style;

$chauffeur_page_layout_var = get_post_meta(get_the_ID(), 'chauffeur_page_layout', true);

// Get Page Layout
if( empty($chauffeur_page_layout_var) ) {
	
	if ( empty($chauffeur_data['site-layout-style']) ) {
		$chauffeur_page_layout = 'right-sidebar';
	} else {
		$chauffeur_page_layout = esc_html($chauffeur_data['site-layout-style']);
	}

} else {
	$chauffeur_page_layout = get_post_meta(get_the_ID(), 'chauffeur_page_layout', true);
}

// Get Page Header Image
if ( is_404() ) {
	$chauffeur_page_header_image = chauffeur_page_header('');
} elseif ( is_search() ) {
	$chauffeur_page_header_image = chauffeur_page_header('');
} else {
	$chauffeur_page_header_image = chauffeur_page_header(wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'chauffeur-image-style11' ));
}

// Get Page Title Style
$chauffeur_title_style = get_post_meta(get_the_ID(), 'chauffeur_title_style', true);

// Reset Query
wp_reset_postdata();

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<!-- BEGIN head -->
<head>
	
	<!--Meta Tags-->
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php wp_head(); ?>
	
<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>
	
	<!-- BEGIN .outer-wrapper -->
	<div class="outer-wrapper">

		<?php if ($chauffeur_data['site-header-style'] == 'chauffeur-header-center-align') { ?>
			
			<!-- BEGIN .header-area-2 -->
			<div class="header-area-2">

				<!-- BEGIN .top-bar-wrapper -->
				<div class="top-bar-wrapper">

					<!-- BEGIN .top-bar -->
					<div class="top-bar clearfix">

						<!-- BEGIN .top-bar-left -->
						<div class="top-bar-left">
							
							<?php if( $chauffeur_data['top-left-text'] ) { ?>
								<p><?php echo esc_attr($chauffeur_data['top-left-text']); ?></p>		
							<?php } ?>
							
						<!-- END .top-bar-left -->
						</div>

						<!-- BEGIN .top-bar-right -->
						<div class="top-bar-right">
							
							<?php if($chauffeur_data['top-right-link-text1'] || $chauffeur_data['top-right-link-text2'] || $chauffeur_data['top-right-link-text3']) { ?>
								
								<ul>
									
									<?php if($chauffeur_data['top-right-link-text1']) { ?>
										<li><a href="<?php if($chauffeur_data['top-right-link-url1']) {echo $chauffeur_data['top-right-link-url1'];} ?>"><?php echo $chauffeur_data['top-right-link-text1']; ?></a></li>
									<?php } ?>
									
									<?php if($chauffeur_data['top-right-link-text2']) { ?>
										<li><a href="<?php if($chauffeur_data['top-right-link-url2']) {echo $chauffeur_data['top-right-link-url2'];} ?>"><?php echo $chauffeur_data['top-right-link-text2']; ?></a></li>
									<?php } ?>
									
									<?php if($chauffeur_data['top-right-link-text3']) { ?>
										<li><a href="<?php if($chauffeur_data['top-right-link-url3']) {echo $chauffeur_data['top-right-link-url3'];} ?>"><?php echo $chauffeur_data['top-right-link-text3']; ?></a></li>
									<?php } ?>
									
								</ul>
								
							<?php } ?>
			
							<a href="<?php echo esc_url($chauffeur_data['top-right-button-url']); ?>" class="topright-button" <?php if ( !empty($chauffeur_data['top-right-button-link-target']) ) { ?>target="_blank"<?php } ?>><span><?php echo esc_attr($chauffeur_data['top-right-button-text']); ?></span></a>

						<!-- END .top-bar-right -->
						</div>

					<!-- END .top-bar -->
					</div>

				<!-- END .top-bar-wrapper -->
				</div>

				<!-- BEGIN .header-content -->
				<div class="header-content">

					<!-- BEGIN .logo -->
					<div class="logo">

						<?php if ( !empty($chauffeur_data['logo-image']['url'] ) ) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($chauffeur_data['logo-image']['url']); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
						<?php } else { ?>
							<h2><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="logo-icon"><i class="fa fa-car" aria-hidden="true"></i></span><?php bloginfo( 'name' ); ?></a></h2>
						<?php } ?>

					<!-- END .logo -->
					</div>

					<!-- BEGIN #primary-navigation -->
					<nav id="primary-navigation" class="navigation-wrapper fixed-navigation clearfix">

						<!-- BEGIN .navigation-inner -->
						<div class="navigation-inner">

							<!-- BEGIN .navigation -->
							<div class="navigation">

								<?php wp_nav_menu( array(
									'theme_location' => 'primary',
									'container' => false,
									'items_wrap' => '<ul>%3$s</ul>',
									'fallback_cb' => 'chauffeur_main_menu_fallback',
									'echo' => true,
									'before' => '',
									'after' => '',
									'link_before' => '',
									'link_after' => '',
									'depth' => 0 )
							 	); ?>

							<!-- END .navigation -->
							</div>

							<a href="#search-lightbox" data-gal="prettyPhoto"><i class="fa fa-search"></i></a>

							<!-- BEGIN #search-lightbox -->
							<div id="search-lightbox">

								<!-- BEGIN .search-lightbox-inner -->
								<div class="search-lightbox-inner">

									<form name="s" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
										<input class="menu-search-field" type="text" onblur="if(this.value=='')this.value='<?php esc_html_e('To search, type and hit enter', 'chauffeur'); ?>';" onfocus="if(this.value=='<?php esc_html_e('To search, type and hit enter', 'chauffeur'); ?>')this.value='';" value="<?php esc_html_e('To search, type and hit enter', 'chauffeur'); ?>" name="s" />
									</form>

								<!-- END .search-lightbox-inner -->
								</div>

							<!-- END #search-lightbox -->
							</div>

						<!-- END .navigation-inner -->
						</div>

					<!-- END #primary-navigation -->
					</nav>

					<div id="mobile-navigation">
						<a href="#search-lightbox" data-gal="prettyPhoto"><i class="fa fa-search"></i></a>
						<a href="#" id="mobile-navigation-btn"><i class="fa fa-bars"></i></a>
					</div>

					<div class="clearboth"></div>

					<!-- BEGIN .mobile-navigation-wrapper -->
					<div class="mobile-navigation-wrapper">	

						<?php wp_nav_menu( array(
							'theme_location' => 'primary',
							'container' => false,
							'items_wrap' => '<ul>%3$s</ul>',
							'fallback_cb' => 'chauffeur_main_menu_fallback',
							'echo' => true,
							'before' => '',
							'after' => '',
							'link_before' => '',
							'link_after' => '',
							'depth' => 0 )
					 	); ?>

					<!-- END .mobile-navigation-wrapper -->
					</div>

				<!-- END .header-content -->
				</div>

			<!-- END .header-area-2 -->
			</div>
			
		<?php } else { ?>

		<!-- BEGIN .header-area-1 -->
		<div class="header-area-1">
			
			<!-- BEGIN .top-bar-wrapper -->
			<div class="top-bar-wrapper">

				<!-- BEGIN .top-bar -->
				<div class="top-bar clearfix">

					<!-- BEGIN .top-bar-left -->
					<div class="top-bar-left">
						
						<?php if( $chauffeur_data['top-left-text'] ) { ?>
							<p><?php echo esc_attr($chauffeur_data['top-left-text']); ?></p>	
						<?php } ?>
						
					<!-- END .top-bar-left -->
					</div>

					<!-- BEGIN .top-bar-right -->
					<div class="top-bar-right">
						
						<?php if($chauffeur_data['top-right-link-text1'] || $chauffeur_data['top-right-link-text2'] || $chauffeur_data['top-right-link-text3']) { ?>
							
							<ul>
								
								<?php if($chauffeur_data['top-right-link-text1']) { ?>
									<li><a href="<?php if($chauffeur_data['top-right-link-url1']) {echo $chauffeur_data['top-right-link-url1'];} ?>"><?php echo $chauffeur_data['top-right-link-text1']; ?></a></li>
								<?php } ?>
								
								<?php if($chauffeur_data['top-right-link-text2']) { ?>
									<li><a href="<?php if($chauffeur_data['top-right-link-url2']) {echo $chauffeur_data['top-right-link-url2'];} ?>"><?php echo $chauffeur_data['top-right-link-text2']; ?></a></li>
								<?php } ?>
								
								<?php if($chauffeur_data['top-right-link-text3']) { ?>
									<li><a href="<?php if($chauffeur_data['top-right-link-url3']) {echo $chauffeur_data['top-right-link-url3'];} ?>"><?php echo $chauffeur_data['top-right-link-text3']; ?></a></li>
								<?php } ?>
								
							</ul>
							
						<?php } ?>
						
					<!-- END .top-bar-right -->
					</div>

				<!-- END .top-bar -->
				</div>

			<!-- END .top-bar-wrapper -->
			</div>

			<!-- BEGIN .header-content -->
			<div class="header-content">
				
				<!-- BEGIN .logo -->
				<div class="logo">

					<?php if ( !empty($chauffeur_data['logo-image']['url'] ) ) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($chauffeur_data['logo-image']['url']); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } else { ?>
						<h2><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="logo-icon"><i class="fa fa-car" aria-hidden="true"></i></span><?php bloginfo( 'name' ); ?></a></h2>
					<?php } ?>

				<!-- END .logo -->
				</div>
				
				<!-- BEGIN .header-icons-wrapper -->
				<div class="header-icons-wrapper clearfix">
					
					<?php if( $chauffeur_data['top-right-button-text'] ) { ?>
						<a href="<?php echo esc_url($chauffeur_data['top-right-button-url']); ?>" class="topright-button" <?php if ( !empty($chauffeur_data['top-right-button-link-target']) ) { ?>target="_blank"<?php } ?>><span><?php echo esc_attr($chauffeur_data['top-right-button-text']); ?></span></a>
					<?php } ?>

					<!-- BEGIN .header-icons-inner -->
					<div class="header-icons-inner clearfix">
						
						<?php if( $chauffeur_data['header-text-title-1'] ) { ?>
						<!-- BEGIN .header-icon -->
						<div class="header-icon">
							<p><i class="fa fa-check-square-o" aria-hidden="true"></i><strong><?php echo esc_attr($chauffeur_data['header-text-title-1']); ?></strong></p>
							<p class="header-icon-text"><?php echo esc_attr($chauffeur_data['header-text-1']); ?></p>
						<!-- END .header-icon -->
						</div>
						<?php } ?>
						
						<?php if( $chauffeur_data['header-text-title-2'] ) { ?>
						<!-- BEGIN .header-icon -->
						<div class="header-icon">
							<p><i class="fa fa-check-square-o" aria-hidden="true"></i><strong><?php echo esc_attr($chauffeur_data['header-text-title-2']); ?></strong></p>
							<p class="header-icon-text"><?php echo esc_attr($chauffeur_data['header-text-2']); ?></p>
						<!-- END .header-icon -->
						</div>
						<?php } ?>
						
						<?php if( $chauffeur_data['header-text-title-3'] ) { ?>
						<!-- BEGIN .header-icon -->
						<div class="header-icon">
							<p><i class="fa fa-check-square-o" aria-hidden="true"></i><strong><?php echo esc_attr($chauffeur_data['header-text-title-3']); ?></strong></p>
							<p class="header-icon-text"><?php echo esc_attr($chauffeur_data['header-text-3']); ?></p>
						<!-- END .header-icon -->
						</div>
						<?php } ?>

					<!-- END .header-icons-inner -->
					</div>

				<!-- END .header-icons-wrapper -->
				</div>

				<div id="mobile-navigation">
					<a href="#search-lightbox" data-gal="prettyPhoto"><i class="fa fa-search"></i></a>
					<a href="#" id="mobile-navigation-btn"><i class="fa fa-bars"></i></a>
				</div>

				<div class="clearboth"></div>

				<!-- BEGIN .mobile-navigation-wrapper -->
				<div class="mobile-navigation-wrapper">	

					<?php wp_nav_menu( array(
						'theme_location' => 'primary',
						'container' => false,
						'items_wrap' => '<ul>%3$s</ul>',
						'fallback_cb' => 'chauffeur_main_menu_fallback',
						'echo' => true,
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0 )
				 	); ?>

				<!-- END .mobile-navigation-wrapper -->
				</div>

			<!-- END .header-content -->
			</div>

			<!-- BEGIN #primary-navigation -->
			<nav id="primary-navigation" class="navigation-wrapper fixed-navigation clearfix">

				<!-- BEGIN .navigation-inner -->
				<div class="navigation-inner">

					<!-- BEGIN .navigation -->
					<div class="navigation">

						<?php wp_nav_menu( array(
							'theme_location' => 'primary',
							'container' => false,
							'items_wrap' => '<ul>%3$s</ul>',
							'fallback_cb' => 'chauffeur_main_menu_fallback',
							'echo' => true,
							'before' => '',
							'after' => '',
							'link_before' => '',
							'link_after' => '',
							'depth' => 0 )
					 	); ?>

					<!-- END .navigation -->
					</div>

					<a href="#search-lightbox" data-gal="prettyPhoto"><i class="fa fa-search"></i></a>

					<!-- BEGIN #search-lightbox -->
					<div id="search-lightbox">

						<!-- BEGIN .search-lightbox-inner -->
						<div class="search-lightbox-inner">

							<form name="s" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
								<input class="menu-search-field" type="text" onblur="if(this.value=='')this.value='<?php esc_html_e('To search, type and hit enter', 'chauffeur'); ?>';" onfocus="if(this.value=='<?php esc_html_e('To search, type and hit enter', 'chauffeur'); ?>')this.value='';" value="<?php esc_html_e('To search, type and hit enter', 'chauffeur'); ?>" name="s" />
							</form>

						<!-- END .search-lightbox-inner -->
						</div>

					<!-- END #search-lightbox -->
					</div>

				<!-- END .navigation-inner -->
				</div>

			<!-- END #primary-navigation -->
			</nav>

		<!-- END .header-area-1 -->
		</div>
		
		<?php } ?>