<?php

/* ----------------------------------------------------------------------------

   Theme Setup

---------------------------------------------------------------------------- */
if ( ! isset( $content_width ) ) $content_width = 640;
	add_action( 'after_setup_theme', 'chauffeur_setup' );

if ( ! function_exists( 'chauffeur_setup' ) ):
	function chauffeur_setup() {
		add_theme_support( 'post-thumbnails' );
		
		if ( function_exists( 'add_theme_support' ) ) {
			add_theme_support( 'post-thumbnails' );
	        set_post_thumbnail_size( "100", "100" );  
		}

		if ( function_exists( 'add_image_size' ) ) {
			add_image_size( 'chauffeur-image-style1', 710, 410, true );
			add_image_size( 'chauffeur-image-style2', 710, 350, true );
			add_image_size( 'chauffeur-image-style3', 70, 70, true );
			add_image_size( 'chauffeur-image-style7', 80, 80, true );
			add_image_size( 'chauffeur-image-style8', 500, 300, true );
			add_image_size( 'chauffeur-image-style9', 600, 380, true );
			add_image_size( 'chauffeur-image-style10', 110, 60, true );
			add_image_size( 'chauffeur-image-style11', 9999, 9999, true );
		}
	
		add_theme_support( 'automatic-feed-links' );
		load_theme_textdomain( 'chauffeur', get_template_directory() . '/framework/languages' );
		$locale = get_locale();
		$locale_file = get_template_directory() . "/framework/languages/$locale.php";
		if ( is_readable( $locale_file ) ) require_once( $locale_file );

	}
	
endif;

// Add Title Tag Support
add_theme_support( 'title-tag' );

// Add Admin CSS
function chauffeur_admin_style() {
  wp_enqueue_style('chauffeur_admin_styles', get_template_directory_uri().'/framework/css/admin.css');
}
add_action('admin_enqueue_scripts', 'chauffeur_admin_style');



/* ----------------------------------------------------------------------------

   Required Plugins

---------------------------------------------------------------------------- */
require_once( get_template_directory() . '/framework/inc/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'chauffeur_theme_register_required_plugins' );

function chauffeur_theme_register_required_plugins() {

	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'     				=> esc_html__('Chauffeur Shortcodes & Post Types','chauffeur'), // The plugin name
			'slug'     				=> 'chauffeur-shortcodes-post-types', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/plugins/chauffeur-shortcodes-post-types.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.3.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Redux Framework','chauffeur'), // The plugin name
			'slug'     				=> 'redux-framework', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '3.6.18', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Classic Editor','chauffeur'), // The plugin name
			'slug'     				=> 'classic-editor', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('WP Bakery Page Builder','chauffeur'), // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/plugins/js-composer.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '6.2.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Revolution Slider','chauffeur'), // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/plugins/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '6.2.15', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Contact Form 7','chauffeur'), // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.1.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Newsletter','chauffeur'), // The plugin name
			'slug'     				=> 'newsletter', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '6.5.9', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('WP PageNavi','chauffeur'), // The plugin name
			'slug'     				=> 'wp-pagenavi', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.93.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('WordPress Importer','chauffeur'), // The plugin name
			'slug'     				=> 'wordpress-importer', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '0.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Widget Importer & Exporter','chauffeur'), // The plugin name
			'slug'     				=> 'widget-importer-exporter', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)

	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}



/* ----------------------------------------------------------------------------

   Load Visual Componser Modifications

---------------------------------------------------------------------------- */
if (class_exists('WPBakeryVisualComposerAbstract')) {
	require_once(get_template_directory() . '/framework/inc/visualcomposer/vc_modifications.php');
}



/* ----------------------------------------------------------------------------

   Set Visual Componser Template Directory

---------------------------------------------------------------------------- */
if (class_exists('WPBakeryVisualComposerAbstract')) {
	$dir = get_stylesheet_directory() . '/framework/inc/visualcomposer/vc_templates';
	vc_set_shortcodes_templates_dir( $dir );
}



/* ----------------------------------------------------------------------------

   Comments Template

---------------------------------------------------------------------------- */
if( ! function_exists( 'chauffeur_comments' ) ) {
	function chauffeur_comments($comment, $args, $depth) {
	   $path = get_template_directory_uri();
	   $GLOBALS['comment'] = $comment;
	   ?>
		
	<li <?php comment_class('comment-entry clearfix'); ?> id="comment-<?php comment_ID(); ?>">
		
		<?php $avatar_url = get_template_directory_uri() . '/images/comment.jpg'; ?>
		
		<!-- BEGIN .comment-left -->
		<div class="comment-left">
			<div class="comment-image">
				<?php echo get_avatar( $comment, 70 ); ?>
			</div>
		<!-- END .comment-left -->
		</div>

		<!-- BEGIN .comment-right -->
		<div class="comment-right">
					
			<p class="comment-info"><?php printf( esc_html__( '%s', 'chauffeur' ), sprintf( '%s', get_comment_author_link() ) ); ?> 
				<span><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php printf( esc_html__( '%1$s at %2$s', 'chauffeur' ), get_comment_date(),  get_comment_time() ); ?>
				</a></span>
			</p>
					
			<div class="comment-text">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="comment-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'chauffeur' ); ?></p>
				<?php endif; ?>
				<?php comment_text(); ?>
			</div>
					
			<p class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php edit_comment_link( esc_html__( '(Edit)', 'chauffeur' ), ' ' ); ?>
			</p>

		<!-- END .comment-right -->
		</div>		

	<?php }
}



/* ----------------------------------------------------------------------------

   Options Panel

---------------------------------------------------------------------------- */
if ( !isset( $redux_demo ) && file_exists( get_template_directory() . '/framework/admin/admin-config.php' ) ) {
    require_once( get_template_directory() . '/framework/admin/admin-config.php' );
}



/* ----------------------------------------------------------------------------

   Register Sidebars

---------------------------------------------------------------------------- */
function chauffeur_widgets_init() {

	// Sidebar Widgets
	register_sidebar( array(
		'name' => esc_html__( 'Standard Page Sidebar', 'chauffeur' ),
		'id' => 'primary-widget-area',
		'description' => esc_html__( 'Displayed in the sidebar of all pages except the homepage', 'chauffeur' ),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s"><div class="widget-block"></div>',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	
	// Footer Widgets 1
	register_sidebar( array(
		'name' => esc_html__( 'Footer Area 1', 'chauffeur' ),
		'id' => 'footer-widget-area-1',
		'description' => esc_html__( 'Displayed at the bottom of all pages', 'chauffeur' ),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5><div class="title-block6"></div>',
	) );
	
	// Footer Widgets 2
	register_sidebar( array(
		'name' => esc_html__( 'Footer Area 2', 'chauffeur' ),
		'id' => 'footer-widget-area-2',
		'description' => esc_html__( 'Displayed at the bottom of all pages', 'chauffeur' ),
		'before_widget' => '<div id="%1$s" class=" widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5><div class="title-block6"></div>',
	) );
	
	// Footer Widgets 3
	register_sidebar( array(
		'name' => esc_html__( 'Footer Area 3', 'chauffeur' ),
		'id' => 'footer-widget-area-3',
		'description' => esc_html__( 'Displayed at the bottom of all pages', 'chauffeur' ),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5><div class="title-block6"></div>',
	) );

}

add_action( 'widgets_init', 'chauffeur_widgets_init' );



/* ----------------------------------------------------------------------------

   Register Menu

---------------------------------------------------------------------------- */
if( !function_exists( 'chauffeur_register_menu' ) ) {
	function chauffeur_register_menu() {
		
		global $chauffeur_data; 
		
		register_nav_menus(
		    array(
				'primary' => esc_html__( 'Primary Navigation','chauffeur' )
		    )
		);
		
	}

	add_action('init', 'chauffeur_register_menu');
}



/* ----------------------------------------------------------------------------

   Register Dependant Javascript Files

---------------------------------------------------------------------------- */
add_action('wp_enqueue_scripts', 'chauffeur_load_js');

if( ! function_exists( 'chauffeur_load_js' ) ) {
	function chauffeur_load_js() {

		if ( is_admin() ) {
			// Admin
		}
		
		else {
			
			global $chauffeur_data; 
			
			// Load JS		
			wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/framework/js/jquery.prettyPhoto.js', array( 'jquery' ), '3.1.6', true );
			wp_register_script( 'owlcarousel', get_template_directory_uri() . '/framework/js/owl.carousel.min.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( array( 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-accordion', 'jquery-ui-tabs', 'jquery-effects-core', 'prettyPhoto', 'owlcarousel' ) );
			
			wp_register_script( 'chauffeur_custom_js', get_template_directory_uri() . '/framework/js/scripts.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'chauffeur_custom_js' );
			
			// Load Inline JS
			if ( isset($chauffeur_data['custom_js']) ) { 
				wp_add_inline_script( 'chauffeur_custom_js', $chauffeur_data['custom_js'] );
			}
			
			if( is_single() ) wp_enqueue_script( 'comment-reply' );
			
			// Load Colour CSS
			wp_enqueue_style('chauffeur_color_red', get_template_directory_uri() .'/framework/css/color-red.css');
			
			// Deregister Composer Custom CSS
			wp_deregister_style( 'js_composer_custom_css' );
			
			// Load Main CSS
			wp_enqueue_style('chauffeur_style', get_bloginfo('stylesheet_url'));

			// Set Font Family 1
			if ( isset($chauffeur_data['google_font_name_1']) ) { 
				$google_font_name_1 = $chauffeur_data['google_font_name_1'];
			} else { 
				$google_font_name_1 = "'Source Serif Pro', serif"; 
			}

			// Set Font Family 2
			if ( isset($chauffeur_data['google_font_name_2']) ) { 
				$google_font_name_2 = $chauffeur_data['google_font_name_2'];
			} else { 
				$google_font_name_2 = "'Source Serif Pro', serif";
			}

			// Set Main Color
			if( isset($chauffeur_data['main-color']) ) {
				$main_color = esc_attr($chauffeur_data['main-color']);
			} else {
				$main_color = '#cc4452';
			}
			
			// Set Main Color Overlay
			if( isset($chauffeur_data['main-color-overlay']) ) {
				$main_color_overlay = esc_attr($chauffeur_data['main-color-overlay']);
			} else {
				$main_color_overlay = '#e7aeb4';
			}
			
			// Set Secondary Color
			if( isset($chauffeur_data['secondary-color']) ) {
				$secondary_color = esc_attr($chauffeur_data['secondary-color']);
			} else {
				$secondary_color = '#cc4452';
			}
			
			// Set Secondary Border Color
			if( isset($chauffeur_data['secondary-color-border']) ) {
				$secondary_color_border = esc_attr($chauffeur_data['secondary-color-border']);
			} else {
				$secondary_color_border = '#3b3b3b';
			}
			
			// Set Secondary Text Color
			if( isset($chauffeur_data['secondary-color-text']) ) {
				$secondary_color_text = esc_attr($chauffeur_data['secondary-color-text']);
			} else {
				$secondary_color_text = '#3b3b3b';
			}
			
			// Remove spacing from footer if no widgets added
			if ( !is_active_sidebar('footer-widget-area-1') && !is_active_sidebar('footer-widget-area-2') && !is_active_sidebar('footer-widget-area-3') ) {
				$footer_css = '.footer {
					padding: 0;
				}

				.footer-bottom {
					margin: 0 auto;
				}';
			} else {
				$footer_css = '';
			}
			
			// Output CSS	
			$output = '';
			
			$output .= $footer_css;
			
			if( isset($chauffeur_data['main-color']) ) {
				$output .= '.logo-icon,
				.header-area-1 .topright-button,
				.header-area-2 .topright-button,
				.header-area-1 .navigation li a:hover,
				.header-area-1 .navigation li.current-menu-item > a,
				.header-area-1 .navigation li.current_page_item > a,
				.header-area-2 .navigation li li a:hover,
				.mobile-navigation-wrapper ul li li a:hover,
				.mobile-navigation-wrapper ul li li li a:hover,
				.rev-custom-caption-1 .title-block1,
				.rev-custom-caption-2 .title-block1,
				.slideshow-button,
				.title-block2,
				.title-block3,
				.fleet-block-wrapper .fleet-block-content .fleet-price,
				.header-booking-form-wrapper #booking-tabs ul li.ui-state-active a,
				.widget-booking-form-wrapper #booking-tabs ul li.ui-state-active a,
				.booking-form-1 button,
				#ui-datepicker-div a:hover,
				.owl-theme .owl-dots .owl-dot span,
				#booking-tabs-2 .booking-form-2 button,
				#booking-tabs-2 .booking-form-3 button,
				.widget-block,
				.page-not-found-search-form button,
				.button2,
				.button4,
				.button6,
				.link-arrow,
				.main-content button,
				#submit-button,
				.content-wrapper form .wpcf7-submit,
				.main-content .search-results-form button,
				.accordion h4:before,
				.toggle h4:before,
				.button0,
				.title-block4,
				.call-to-action-2-section .title-block5,
				.newsletter-form button,
				.title-block6,
				.title-block7,
				#booking-tabs-2 .nav li.ui-state-active a,
				.page-pagination li span.current,
				.page-pagination li a:hover,
				.news-read-more,
				.more-link,
				.call-to-action-button,
				.main-content .step-icon-current,
				.view-map-button,
				.main-content p .view-map-button,
				.trip-details-wrapper form button,
				.total-price-display .payment-button,
				.service-rate-wrapper:hover .service-rate-header,
				.wp-pagenavi span.current,
				.wp-pagenavi a:hover,
				.footer table th, 
				.sidebar-content table th,
				.vc_tta-panels .vc_tta-panel-title:before,
				.post-pagination span,
				.post-pagination span:hover,
				.button1:hover,
				.mobile-navigation-wrapper ul a:hover {
					background: ' . $main_color . ';
				}

				.pp_close {
					background: url("' . get_template_directory_uri() . '/framework/images/close.png") no-repeat center ' . $main_color . ';
				}

				.footer .tnp-field input[type="submit"] {
					background-color: ' . $main_color . ';
				}

				.header-area-1 .header-icon i,
				.header-area-2 .header-icon i,
				.content-wrapper ul li:before,
				.latest-news-block-content .news-meta .nm-news-date:before,
				.latest-news-block-content .news-meta .nm-news-comments:before,
				.testimonial-wrapper span.qns-open-quote,
				.testimonial-wrapper span.qns-close-quote,
				.main-content p a,
				.widget ul li:before,
				.main-content ul li:before,
				.main-content blockquote:before,
				.home-icon-wrapper-2 .qns-home-icon,
				.contact-details-list .cdw-address:before,
				.contact-details-list .cdw-phone:before,
				.contact-details-list .cdw-email:before,
				.main-content .social-links li i,
				.main-content .search-results-list li:before,
				.news-block-wrapper .news-meta .nm-news-author:before,
				.news-block-wrapper .news-meta .nm-news-date:before,
				.news-block-wrapper .news-meta .nm-news-category:before,
				.news-block-wrapper .news-meta .nm-news-comments:before,
				.service-rate-section p strong span,
				.vehicle-section p strong,
				.sidebar-content .contact-widget .cw-address:before,
				.sidebar-content .contact-widget .cw-phone:before,
				.sidebar-content .contact-widget .cw-cell:before {
					color: ' . $main_color . ';
				}

				.header-area-2 .navigation li.current-menu-item,
				.header-area-2 .navigation li:hover {
					border-top: ' . $main_color . ' 3px solid;
				}

				.main-content blockquote {
					border-left: ' . $main_color . ' 3px solid;
				}

				.owl-theme .owl-dots .owl-dot span, .owl-theme .owl-dots .owl-dot.active span,
				.home-icon-wrapper-2 .qns-home-icon,
				.total-price-display {
					border: ' . $main_color . ' 3px solid;
				}

				.news-block-wrapper-1-col-listing .sticky {
					border: ' . $main_color . ' 2px solid;
				}

				#booking-tabs-2 .nav li.ui-state-active a,
				.service-rate-wrapper:hover .service-rate-header {
					border-right: ' . $main_color . ' 1px solid;
				}

				.page-pagination li span.current,
				.page-pagination li a:hover,
				.wp-pagenavi span.current,
				.wp-pagenavi a:hover,
				.post-pagination span,
				.post-pagination span:hover {
					border: ' . $main_color . ' 1px solid;
				}

				.header-booking-form-wrapper #booking-tabs ul li.ui-state-active a:after,
				.widget-booking-form-wrapper #booking-tabs ul li.ui-state-active a:after {
					border-top: 15px solid ' . $main_color . ';
				}

				#booking-tabs-2 .nav li.ui-state-active a:after {
					border-left: 17px solid ' . $main_color . ';
				}
				
				@media only screen and (max-width: 1250px) { 

					#booking-tabs-2 .nav li.ui-state-active a:after {
				    	border-bottom: initial !important;
				    	border-left: 15px solid transparent !important;
				    	border-right: 15px solid transparent !important;
				    	border-top: 15px solid ' . $main_color . ' !important;
					}

				}

				#tabs .ui-tabs-nav li.ui-state-active {
					border-top: ' . $main_color . ' 4px solid;
				}
				
				.total-price-inner {
					border-bottom: ' . $main_color . ' 3px solid;
				}

				.service-rate-wrapper:hover .service-rate-header:after {
					border-top: 10px solid ' . $main_color . ';
				}

				.select-vehicle-wrapper .vehicle-section:hover,
				.select-vehicle-wrapper .selected-vehicle {
					border: ' . $main_color . ' 2px solid;
					outline: ' . $main_color . ' 1px solid;
				}

				.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a {
					border-top: ' . $main_color . ' 4px solid !important;
				}
				
				.chauffeur-service-rates-table th:hover {
					border-right: ' . $main_color . ' 1px solid;
					background: ' . $main_color . ';
				}

				.chauffeur-service-rates-table th:hover:after {
					border-top: 10px solid ' . $main_color . ';
				}

				.chauffeur-service-rates-table td p span {
					color: ' . $main_color . ';
				}

				@media only screen and (max-width: 1250px) { 

					#booking-tabs-2 .nav li.ui-state-active a:after {
						border-top: 15px solid ' . $main_color . ';
					}

				}';
			}
			
			if( $chauffeur_data['hide-pricing'] == '1' ) {
				
				$output .= '.fleet-block-content h4 {
					margin: 30px 0 30px 0;
				}
				
				.fleet-4-cols .fleet-block-content h4,
				.fleet-5-cols .fleet-block-content h4 {
					margin: 15px 0 15px 0
				}
				
				.payment-options-section {
				    padding: 35px 30px;
				}';
				
			}
			
			if( isset($chauffeur_data['main-color-overlay']) ) {
			
				$output .= '.service-rate-wrapper:hover .service-rate-header p {
					color: ' . $main_color_overlay . ';
				}
				
				.chauffeur-service-rates-table th:hover p {
					color: ' . $main_color_overlay . ';
				}';
			
			}
			
			if( isset($chauffeur_data['secondary-color']) ) {
				
				$output .= '.header-area-1 #primary-navigation,
				.mobile-navigation-wrapper,
				.mobile-navigation-wrapper ul li li a,
				.mobile-navigation-wrapper ul li li li a,
				.header-booking-form-wrapper,
				.widget-booking-form-wrapper,
				#ui-datepicker-div,
				.about-us-block,
				.footer,
				.body-booking-form-wrapper,
				.main-content table th,
				.page-not-found-search-form,
				.link-blocks .link-block-2,
				.link-blocks .link-block-3,
				.main-content .search-results-form,
				.widget .pricing-options-widget,
				.service-rate-header,
				.call-to-action-small,
				.step-icon,
				.trip-details-wrapper,
				.full-booking-wrapper,
				.lightbox-title {
					background: ' . $secondary_color . ';
				}

				.call-to-action-1-section,
				.testimonials-full-wrapper,
				.paypal-loader {
					background-color: ' . $secondary_color . ';
				}

				#tabs .nav li a {
					color: ' . $secondary_color . ' !important;
				}
				
				.chauffeur-service-rates-table th:after {
					border-top: 10px solid ' . $secondary_color . ';
				}

				.service-rate-header:after {
					border-top: 10px solid ' . $secondary_color . ';
				}';
				
			}
			
			if( isset($chauffeur_data['secondary-color-border']) ) {
				
				$output .= '.mobile-navigation-wrapper ul a,
				.ui-datepicker-calendar thead tr th,
				.footer-bottom {
					border-top: ' . $secondary_color_border . ' 1px solid;
				}
				
				.chauffeur-service-rates-table th {
					border-right: ' . $secondary_color_border . ' 1px solid;
				}

				.header-booking-form-wrapper #booking-tabs ul li a,
				.widget-booking-form-wrapper #booking-tabs ul li a,
				.ui-datepicker-calendar tbody tr td a,
				#ui-datepicker-div .ui-datepicker-calendar tbody tr td span,
				.ui-datepicker-calendar thead tr th,
				.widget .pricing-options-widget ul li,
				.trip-details-wrapper .trip-details-wrapper-1 p,
				.full-booking-wrapper .clearfix .qns-one-half p,
				.footer .widget ul li,
				.footer table td {
					border-bottom: ' . $secondary_color_border . ' 1px solid;
				}

				.ui-datepicker-calendar tbody tr td a,
				#ui-datepicker-div .ui-datepicker-calendar tbody tr td span,
				#booking-tabs-2 .nav li a,
				.service-rate-header,
				.footer table td {
					border-right: ' . $secondary_color_border . ' 1px solid;
				}

				.trip-details-wrapper .trip-details-wrapper-2,
				.passenger-details-wrapper,
				.footer .tagcloud a,
				.footer .widget-booking-form-wrapper {
					border: ' . $secondary_color_border . ' 1px solid;
				}

				.space7 {
					background: ' . $secondary_color_border . ';
				}';
				
			}
			
			if( isset($chauffeur_data['secondary-color-text']) ) {
				
				$output .= '.contact-widget .cw-phone span,
				.contact-widget .cw-cell span,
				.widget .pricing-options-widget,
				.service-rate-header p,
				.service-rate-section p {
					color: ' . $secondary_color_text . ';
				}';
				
			}

			$output .= 'h1, h2, h3, h4, h5, h6, .logo h2, .rev-custom-caption-1 h3, .rev-custom-caption-2 h3, .dropcap, .content-wrapper table th, .footer table th, .vc_tta-tabs .vc_tta-title-text, .chauffeur-block-image .new-icon, .content-wrapper .search-results-list li {
				font-family: ' . $google_font_name_1 . ';
			}';

			$output .= 'body, select, input, button, form textarea, .chauffeur-charter-sale-form h3 span, #reply-title small {
				font-family: ' . $google_font_name_2 . ';
			}';
			
			/* +Flat Rate +Hourly -Distance */
			if ( $chauffeur_data['disable-flat-rate'] == 0 && $chauffeur_data['disable-hourly'] == 0 && $chauffeur_data['disable-distance'] == 1 ) {
				$output .= '#booking-tabs ul li:first-child {
					display: none;
				}
				.header-booking-form-wrapper #booking-tabs ul li a {
					width: calc(50% - 60px);
				}
				.widget-booking-form-wrapper #booking-tabs ul li a {
					width: calc(50% - 30px);
				}
				#booking-tabs-2 ul li:first-child {
					display: none;
				}
				.body-booking-form-wrapper #booking-tabs-2 ul li a {
					padding: 34px 0;
				}
				@media only screen and (max-width: 467px) {
				
					.header-booking-form-wrapper #booking-tabs ul li a {
					    padding: 25px 15px;
					    width: calc(50% - 30px) !important;
					}
				
				}
				@media only screen and (max-width: 1100px) { 

					.sidebar-content .widget-booking-form-wrapper #booking-tabs ul li a {
						padding: 25px 12px;
						width: calc(50% - 24px) !important;
					}
					
				}
				@media only screen and (max-width: 1250px) { 

					#booking-tabs-2 .nav li a {
						width: calc(50%) !important;
					}
				}';
			}
			
			
			
			/* +Distance -Hourly +Flat Rate */
			if ( $chauffeur_data['disable-flat-rate'] == 0 && $chauffeur_data['disable-hourly'] == 1 && $chauffeur_data['disable-distance'] == 0  ) {
				$output .= '#booking-tabs ul li:nth-child(2n) {
					display: none;
				}
				.header-booking-form-wrapper #booking-tabs ul li a {
					width: calc(50% - 60px);
				}
				.widget-booking-form-wrapper #booking-tabs ul li a {
					width: calc(50% - 30px);
				}
				#booking-tabs-2 ul li:nth-child(2n) {
					display: none;
				}
				.body-booking-form-wrapper #booking-tabs-2 ul li a {
					padding: 34px 0;
				}
				@media only screen and (max-width: 467px) {
				
					.header-booking-form-wrapper #booking-tabs ul li a {
					    padding: 25px 15px;
					    width: calc(50% - 30px) !important;
					}
				
				}
				@media only screen and (max-width: 1100px) { 

					.sidebar-content .widget-booking-form-wrapper #booking-tabs ul li a {
						padding: 25px 12px;
						width: calc(50% - 24px) !important;
					}
					
				}
				@media only screen and (max-width: 1250px) { 

					#booking-tabs-2 .nav li a {
						width: calc(50%) !important;
					}
				}';
			}

			
			
			/* +Distance +Hourly -Flat Rate */
			if ( $chauffeur_data['disable-flat-rate'] == 1 && $chauffeur_data['disable-hourly'] == 0 && $chauffeur_data['disable-distance'] == 0  ) {
				$output .= '#booking-tabs ul li:nth-child(3n) {
					display: none;
				}
				.header-booking-form-wrapper #booking-tabs ul li a {
					width: calc(50% - 60px);
				}
				.widget-booking-form-wrapper #booking-tabs ul li a {
					width: calc(50% - 30px);
				}
				#booking-tabs-2 ul li:nth-child(3n) {
					display: none;
				}
				.body-booking-form-wrapper #booking-tabs-2 ul li a {
					padding: 34px 0;
				}
				@media only screen and (max-width: 467px) {
				
					.header-booking-form-wrapper #booking-tabs ul li a {
					    padding: 25px 15px;
					    width: calc(50% - 30px) !important;
					}
				
				}
				@media only screen and (max-width: 1100px) { 

					.sidebar-content .widget-booking-form-wrapper #booking-tabs ul li a {
						padding: 25px 12px;
						width: calc(50% - 24px) !important;
					}
					
				}
				@media only screen and (max-width: 1250px) { 

					#booking-tabs-2 .nav li a {
						width: calc(50%) !important;
					}
				}';
			}
			


			/* +Distance -Hourly -Flat Rate */
			if ( $chauffeur_data['disable-flat-rate'] == 1 && $chauffeur_data['disable-hourly'] == 1 && $chauffeur_data['disable-distance'] == 0  ) {
				$output .= '#booking-tabs ul li:nth-child(3n),
				#booking-tabs ul li:nth-child(2n) {
					display: none;
				}
				.header-booking-form-wrapper #booking-tabs ul li a {
					width: calc(100% - 60px);
				}
				.widget-booking-form-wrapper #booking-tabs ul li a {
					width: calc(100% - 30px);
				}
				#booking-tabs-2 ul li:nth-child(3n),
				#booking-tabs-2 ul li:nth-child(2n) {
					display: none;
				}
				.body-booking-form-wrapper #booking-tabs-2 ul li a {
					padding: 79px 0;
				}
				@media only screen and (max-width: 467px) {
				
					.header-booking-form-wrapper #booking-tabs ul li a {
					    padding: 25px 15px;
					    width: calc(100% - 30px) !important;
					}
				
				}
				@media only screen and (max-width: 1100px) { 

					.sidebar-content .widget-booking-form-wrapper #booking-tabs ul li a {
						padding: 25px 12px;
						width: calc(100% - 24px) !important;
					}
					
				}
				@media only screen and (max-width: 1250px) { 

					#booking-tabs-2 .nav li a {
						width: calc(100%) !important;
					}
					
					.body-booking-form-wrapper #booking-tabs-2 ul li a {
						padding: 25px 0;
					}
					
				}';
			}
			
			
			
			/* +Hourly -Distance -Flat Rate */
			if ( $chauffeur_data['disable-flat-rate'] == 1 && $chauffeur_data['disable-hourly'] == 0 && $chauffeur_data['disable-distance'] == 1  ) {
				$output .= '#booking-tabs ul li:nth-child(3n),
				#booking-tabs ul li:first-child {
					display: none;
				}
				.header-booking-form-wrapper #booking-tabs ul li a {
					width: calc(100% - 60px);
				}
				.widget-booking-form-wrapper #booking-tabs ul li a {
					width: calc(100% - 30px);
				}
				#booking-tabs-2 ul li:nth-child(3n),
				#booking-tabs-2 ul li:first-child {
					display: none;
				}
				.body-booking-form-wrapper #booking-tabs-2 ul li a {
					padding: 79px 0;
				}
				@media only screen and (max-width: 467px) {
				
					.header-booking-form-wrapper #booking-tabs ul li a {
					    padding: 25px 15px;
					    width: calc(100% - 30px) !important;
					}
				
				}
				@media only screen and (max-width: 1100px) { 

					.sidebar-content .widget-booking-form-wrapper #booking-tabs ul li a {
						padding: 25px 12px;
						width: calc(100% - 24px) !important;
					}
					
				}
				@media only screen and (max-width: 1250px) { 

					#booking-tabs-2 .nav li a {
						width: calc(100%) !important;
					}
					
					.body-booking-form-wrapper #booking-tabs-2 ul li a {
						padding: 25px 0;
					}
					
				}';
			}
			
			
			
			/* +Flat Rate -Hourly -Distance */
			if ( $chauffeur_data['disable-flat-rate'] == 0 && $chauffeur_data['disable-hourly'] == 1 && $chauffeur_data['disable-distance'] == 1  ) {
				$output .= '#booking-tabs ul li:nth-child(2n),
				#booking-tabs ul li:first-child {
					display: none;
				}
				.header-booking-form-wrapper #booking-tabs ul li a {
					width: calc(100% - 60px);
				}
				.widget-booking-form-wrapper #booking-tabs ul li a {
					width: calc(100% - 30px);
				}
				#booking-tabs-2 ul li:nth-child(2n),
				#booking-tabs-2 ul li:first-child {
					display: none;
				}
				.body-booking-form-wrapper #booking-tabs-2 ul li a {
					padding: 79px 0;
				}
				@media only screen and (max-width: 467px) {
				
					.header-booking-form-wrapper #booking-tabs ul li a {
					    padding: 25px 15px;
					    width: calc(100% - 30px) !important;
					}
				
				}
				@media only screen and (max-width: 1100px) { 

					.sidebar-content .widget-booking-form-wrapper #booking-tabs ul li a {
						padding: 25px 12px;
						width: calc(100% - 24px) !important;
					}
					
				}
				@media only screen and (max-width: 1250px) { 

					#booking-tabs-2 .nav li a {
						width: calc(100%) !important;
					}
					
					.body-booking-form-wrapper #booking-tabs-2 ul li a {
						padding: 25px 0;
					}
					
				}';
			}
			
			// Load Inline CSS
			wp_add_inline_style( 'chauffeur_style', $output );
			
			// Load Other CSS
			wp_enqueue_style('prettyPhoto', get_template_directory_uri() .'/framework/css/prettyPhoto.css');
			wp_enqueue_style('owlcarousel', get_template_directory_uri() .'/framework/css/owl.carousel.css');
			wp_enqueue_style('chauffeur_responsive', get_template_directory_uri() .'/framework/css/responsive.css');
			wp_enqueue_style('fontawesome', get_template_directory_uri() .'/framework/css/font-awesome/css/font-awesome.min.css');
			
		}
	}
}



/* ----------------------------------------------------------------------------

   Enqueue Fonts

---------------------------------------------------------------------------- */
function chauffeur_fonts_url() {
    $font_url = '';
    
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'chauffeur' ) ) {
		
		global $chauffeur_data;
		
		if ( isset($chauffeur_data['google_font_url_1']) ) {
			$chauffeur_font_1 = esc_attr($chauffeur_data['google_font_url_1']);
		} else {
			$chauffeur_font_1 = 'Montserrat:400,700';
		}
		
		if ( isset($chauffeur_data['google_font_url_2']) ) {
			$chauffeur_font_2 = esc_attr($chauffeur_data['google_font_url_2']);
		} else {
			$chauffeur_font_2 = 'Source Sans Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic';
		}
		
        $font_url = add_query_arg( 'family', urlencode( $chauffeur_font_1 . '|' . $chauffeur_font_2 ), "//fonts.googleapis.com/css" );
    
	}

    return $font_url;

}

function chauffeur_font_scripts() {
    wp_enqueue_style( 'chauffeur_fonts', chauffeur_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'chauffeur_font_scripts' );



/* ----------------------------------------------------------------------------

   Loads Files

---------------------------------------------------------------------------- */

// Post Types
include( get_template_directory() . '/framework/inc/post-types/page.php');
include( get_template_directory() . '/framework/inc/post-types/post.php');

// Widgets
include( get_template_directory() . '/framework/inc/widgets/widget-recent-posts.php');
include( get_template_directory() . '/framework/inc/widgets/widget-contact.php');
include( get_template_directory() . '/framework/inc/widgets/widget-booking.php');



/* ----------------------------------------------------------------------------

   Remove width / height attributes from gallery images

---------------------------------------------------------------------------- */
add_filter('wp_get_attachment_link', 'chauffeur_remove_img_width_height', 10, 1);
add_filter('wp_get_attachment_image_attributes', 'chauffeur_remove_img_width_height', 10, 1);

function chauffeur_remove_img_width_height($html) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}



/* ----------------------------------------------------------------------------

   Remove rel attribute from the category list

---------------------------------------------------------------------------- */
function chauffeur_remove_category_list_rel($output)
{
  $output = str_replace(' rel="category"', '', $output);
  return $output;
}
add_filter('wp_list_categories', 'chauffeur_remove_category_list_rel');
add_filter('the_category', 'chauffeur_remove_category_list_rel');



/* ----------------------------------------------------------------------------

   Excerpt Length

---------------------------------------------------------------------------- */
function chauffeur_print_excerpt($length) {
	global $post;
	$text = $post->post_excerpt;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
	}
	$text = strip_shortcodes($text); 
	$text = strip_tags($text);

	$text = substr($text,0,$length);
	$excerpt = chauffeur_reverse_strrchr($text, '.', 1);
	if( $excerpt ) {
		echo apply_filters('the_excerpt',$excerpt);
	} else {
		echo apply_filters('the_excerpt',$text);
	}
}

function chauffeur_reverse_strrchr($haystack, $needle, $trail) {
    return strrpos($haystack, $needle) ? substr($haystack, 0, strrpos($haystack, $needle) + $trail) : false;
}



/* ----------------------------------------------------------------------------

   Excerpt More Link

---------------------------------------------------------------------------- */
function chauffeur_continue_reading_link() {
		return '';
}

function chauffeur_auto_excerpt_more( $more ) {
	return chauffeur_continue_reading_link();
}
add_filter( 'excerpt_more', 'chauffeur_auto_excerpt_more' );



/* ----------------------------------------------------------------------------

   Main Menu Fallback

---------------------------------------------------------------------------- */
function chauffeur_main_menu_fallback() { ?>

<ul>
	<?php wp_list_pages(array(
		'depth' => 2,
		'exclude' => '',
		'title_li' => '',
		'link_before'  => '',
		'link_after'   => '',
		'sort_column' => 'post_title',
		'sort_order' => 'ASC',
	)); ?>
</ul>

<?php }



/* ----------------------------------------------------------------------------

   Mobile Main Menu Fallback

---------------------------------------------------------------------------- */
function chauffeur_mobile_menu() { ?>

<ul class="mobile-menu">
	<?php wp_list_pages(array(
		'depth' => 2,
		'exclude' => '',
		'title_li' => '',
		'link_before'  => '',
		'link_after'   => '',
		'sort_column' => 'post_title',
		'sort_order' => 'ASC',
	)); ?>
</ul>

<?php }



/* ----------------------------------------------------------------------------

   Password Protected Post Form

---------------------------------------------------------------------------- */
add_filter( 'the_password_form', 'chauffeur_password_form' );

function chauffeur_password_form() {
	
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$form = '<div class="msg fail clearfix"><p class="nopassword">' . esc_html__( 'This post is password protected. To view it please enter your password below', 'chauffeur' ) . '</p></div>
<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post"><label for="' . esc_attr($label) . '">' . esc_html__( 'Password', 'chauffeur' ) . ' </label><input name="post_password" id="' . esc_attr($label) . '" class="text_input" type="password" size="20" /><div class="clearboth"></div><input class="button1" type="submit" value="' . esc_attr__( 'Submit','chauffeur' ) . '" name="submit"></form>';
	return $form;
	
}



/* ----------------------------------------------------------------------------

   Page Header

---------------------------------------------------------------------------- */
function chauffeur_page_header( $image_url ) {
	
	global $chauffeur_data;
	
	if( is_single() || is_front_page() || is_archive() || is_search() ) {
		
		if ( !empty($chauffeur_data['page-header-image']['url'] ) ) {
			$output = 'style="background:url(' . esc_url($chauffeur_data['page-header-image']['url']) . ') top center;"';
		} else {
			$output = 'style="background:#f0f0f0;"';
		}
	
	} else {
		
		if ( !empty($image_url) ) {
			$src = $image_url;
			$output = 'style="background:url(' . esc_url( $src[0] ) . ') top center;"';
		} else {
			
			if ( !empty($chauffeur_data['page-header-image']['url']) ) {
				$output = 'style="background:url(' . esc_url($chauffeur_data['page-header-image']['url']) . ') top center;"';
			} else {
				$output = 'style="background:#f0f0f0;"';
			}
			
		}
		
	}
	
	return $output;	
	
}



/* ----------------------------------------------------------------------------

   Add PrettyPhoto for Attached Images

---------------------------------------------------------------------------- */
add_filter( 'wp_get_attachment_link', 'chauffeur_sant_prettyadd');
function chauffeur_sant_prettyadd ($content) {
     $content = preg_replace("/<a/","<a
data-gal=\"prettyPhoto[slides]\"",$content,1);
     return $content;
}



/* ----------------------------------------------------------------------------

   Allow for plugin detection

---------------------------------------------------------------------------- */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );



/* ----------------------------------------------------------------------------

   Social Icons

---------------------------------------------------------------------------- */
function chauffeur_footer_social_icons() {
	
	global $chauffeur_data;
	
	$output = '';
	
	if($chauffeur_data['social-link-target'] == '1' ) {	
		$social_link_target = "_blank";
	} else {
		$social_link_target = "_parent";
	}
	
	if($chauffeur_data['facebook-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['facebook-icon']) . '"><i class="fa fa-facebook"></i></a>';		
	}
	
	if($chauffeur_data['flickr-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['flickr-icon']) . '"><i class="fa fa-flickr"></i></a>';		
	}
	
	if($chauffeur_data['googleplus-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['googleplus-icon']) . '"><i class="fa fa-google-plus"></i></a>';		
	}
	
	if($chauffeur_data['instagram-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['instagram-icon']) . '"><i class="fa fa-instagram"></i></a>';		
	}
	
	if($chauffeur_data['linkedin-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['linkedin-icon']) . '"><i class="fa fa-linkedin"></i></a>';		
	}
	
	if($chauffeur_data['pinterest-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['pinterest-icon']) . '"><i class="fa fa-pinterest"></i></a>';		
	}
	
	if($chauffeur_data['skype-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['skype-icon']) . '"><i class="fa fa-skype"></i></a>';		
	}
	
	if($chauffeur_data['soundcloud-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['soundcloud-icon']) . '"><i class="fa fa-soundcloud"></i></a>';		
	}
	
	if($chauffeur_data['tripadvisor-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['tripadvisor-icon']) . '"><i class="fa fa-tripadvisor"></i></a>';		
	}
	
	if($chauffeur_data['tumblr-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['tumblr-icon']) . '"><i class="fa fa-tumblr"></i></a>';		
	}
	
	if($chauffeur_data['twitter-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['twitter-icon']) . '"><i class="fa fa-twitter"></i></a>';		
	}
	
	if($chauffeur_data['vimeo-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['vimeo-icon']) . '"><i class="fa fa-vimeo-square"></i></a>';		
	}
	
	if($chauffeur_data['vine-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['vine-icon']) . '"><i class="fa fa-vine"></i></a>';		
	}
	
	if($chauffeur_data['yelp-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['yelp-icon']) . '"><i class="fa fa-yelp"></i></a>';		
	}
	
	if($chauffeur_data['youtube-icon'] != '' ) {	
		$output .= '<a target="' . $social_link_target . '" href="' . esc_url($chauffeur_data['youtube-icon']) . '"><i class="fa fa-youtube-play"></i></a>';		
	}
	
	if ( $chauffeur_data['facebook-icon'] == '' && $chauffeur_data['flickr-icon'] == '' && $chauffeur_data['googleplus-icon'] == '' && $chauffeur_data['instagram-icon'] == '' && $chauffeur_data['linkedin-icon'] == '' && $chauffeur_data['pinterest-icon'] == '' && $chauffeur_data['skype-icon'] == '' && $chauffeur_data['soundcloud-icon'] == '' && $chauffeur_data['tripadvisor-icon'] == '' && $chauffeur_data['tumblr-icon'] == '' && $chauffeur_data['twitter-icon'] == '' && $chauffeur_data['vimeo-icon'] == '' && $chauffeur_data['vine-icon'] == '' && $chauffeur_data['yelp-icon'] == '' && $chauffeur_data['youtube-icon'] == '' ) {
		return '';
	} else {
		return '<div class="footer-social-icons-wrapper">' . $output . '</div>';
	}
	
}



/* ----------------------------------------------------------------------------

   Social Icons Check

---------------------------------------------------------------------------- */
function chauffeur_footer_social_icons_check() {
	
	global $chauffeur_data;
	
	if ( $chauffeur_data['facebook-icon'] == '' && $chauffeur_data['flickr-icon'] == '' && $chauffeur_data['googleplus-icon'] == '' && $chauffeur_data['instagram-icon'] == '' && $chauffeur_data['linkedin-icon'] == '' && $chauffeur_data['pinterest-icon'] == '' && $chauffeur_data['skype-icon'] == '' && $chauffeur_data['soundcloud-icon'] == '' && $chauffeur_data['tripadvisor-icon'] == '' && $chauffeur_data['tumblr-icon'] == '' && $chauffeur_data['twitter-icon'] == '' && $chauffeur_data['vimeo-icon'] == '' && $chauffeur_data['vine-icon'] == '' && $chauffeur_data['yelp-icon'] == '' && $chauffeur_data['youtube-icon'] == '' ) {
		return 'false';
	}
	
}



/* ----------------------------------------------------------------------------

   Remove width/height dimensions from <img> tags

---------------------------------------------------------------------------- */
add_filter( 'post_thumbnail_html', 'chauffeur_remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'chauffeur_remove_thumbnail_dimensions', 10 );

function chauffeur_remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}



/* ----------------------------------------------------------------------------

   Include Breadcrumbs

---------------------------------------------------------------------------- */
require_once( get_template_directory() . '/framework/inc/dimox_breadcrumbs.php');


/* ----------------------------------------------------------------------------

   Sidebar

---------------------------------------------------------------------------- */
function chauffeur_sidebar1($sidebar) {
	
	if ( $sidebar == 'left-sidebar' ) {
		$chauffeur_sidebar = 'main-content main-content-left-sidebar';
	} elseif ( $sidebar == 'right-sidebar' ) {
		$chauffeur_sidebar = 'main-content';
	} elseif ( $sidebar == 'full-width' ) {
		$chauffeur_sidebar = 'main-content main-content-full';
	} elseif ( $sidebar == 'unboxed-full-width' ) {
		$chauffeur_sidebar = 'main-content main-content-full';
	} 
	
	else {
		$chauffeur_sidebar = 'main-content';
	}
	
	return $chauffeur_sidebar;
	
}

function chauffeur_sidebar2($sidebar) {
	
	if ( $sidebar == 'left-sidebar' ) {
		$chauffeur_sidebar = 'sidebar-content sidebar-content-left-sidebar';
	} elseif ( $sidebar == 'right-sidebar' ) {
		$chauffeur_sidebar = 'sidebar-content';
	} elseif ( $sidebar == 'full-width' ) {
		$chauffeur_sidebar = 'columns-full-width';
	} else {
		$chauffeur_sidebar = 'sidebar-content';
	}
	
	return $chauffeur_sidebar;
	
}



/* ----------------------------------------------------------------------------

   Allowed HTML

---------------------------------------------------------------------------- */
$chauffeur_allowed_html_array = array(
    'style' => array(),
	'div' => array(
		'class' => array(),
		'id' => array(),
	),
	'span' => array(
		'class' => array(),
		'id' => array(),
	),
	'a' => array(
	        'href' => array(),
	        'title' => array()
	),
	'h1' => array(
	        'class' => array(),
	        'id' => array()
	),
	'h2' => array(
	        'class' => array(),
	        'id' => array()
	),
	'h3' => array(
	        'class' => array(),
	        'id' => array()
	),
	'h4' => array(
	        'class' => array(),
	        'id' => array()
	),
	'h5' => array(
	        'class' => array(),
	        'id' => array()
	),
	'h6' => array(
	        'class' => array(),
	        'id' => array()
	),
	'i' => array(
	        'class' => array(),
	        'id' => array()
	),
	'p' => array(
	        'class' => array(),
	        'id' => array()
	),
);

global $chauffeur_allowed_html_array;




$chauffeur_allowed_html_array_header = array(
    'style' => array(),
	'div' => array(
		'class' => array(),
		'id' => array(),
	)
);

global $chauffeur_allowed_html_array_header;



/* ----------------------------------------------------------------------------

   Post Type Names

---------------------------------------------------------------------------- */
function chauffeur_post_type_name($post_type) {
	
	if ($post_type == 'post') {
		return esc_html__('Post','chauffeur');
	}
	
	if ($post_type == 'testimonial') {
		return esc_html__('Testimonial','chauffeur');
	}
	
	if ($post_type == 'page') {
		return esc_html__('Page','chauffeur');
	}
	
	if ($post_type == 'fleet') {
		return esc_html__('Vehicle','chauffeur');
	}
	
}



/* ----------------------------------------------------------------------------

   Limit Text

---------------------------------------------------------------------------- */
function chauffeur_limit_text($text, $limit) {
	
	if (str_word_count($text, 0) > $limit) {
		$words = str_word_count($text, 2);
		$pos = array_keys($words);
		$text = substr($text, 0, $pos[$limit]);
	}
	
	return $text;

}