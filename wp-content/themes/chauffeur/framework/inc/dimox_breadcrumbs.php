<?php
/*
 * WordPress Breadcrumbs
 * author: Dimox
 * version: 2015.09.14
 * license: MIT
*/
function dimox_breadcrumbs() {
	
	global $chauffeur_allowed_html_array;
	
	/* === OPTIONS === */
	$text['home']     = esc_html__('Home','chauffeur'); // text for the 'Home' link
	$text['category'] = esc_html__('Archive by Category "%s"','chauffeur'); // text for a category page
	$text['search']   = esc_html__('Search Results for "%s" Query','chauffeur'); // text for a search results page
	$text['tag']      = esc_html__('Posts Tagged "%s"','chauffeur'); // text for a tag page
	$text['author']   = esc_html__('Articles Posted by %s','chauffeur'); // text for an author page
	$text['404']      = esc_html__('Error 404','chauffeur'); // text for the 404 page
	$text['page']     = esc_html__('Page %s','chauffeur'); // text 'Page N'
	$text['cpage']    = esc_html__('Comment Page %s','chauffeur'); // text 'Comment Page N'
	$wrap_before    = wp_kses('<p>',$chauffeur_allowed_html_array); // the opening wrapper tag
	$wrap_after     = wp_kses('</p>',$chauffeur_allowed_html_array); // the closing wrapper tag
	$sep            = wp_kses('<i class="fa fa-angle-right"></i>',$chauffeur_allowed_html_array); // separator between crumbs
	$sep_before     = wp_kses('<span class="sep">',$chauffeur_allowed_html_array); // tag before separator
	$sep_after      = wp_kses('</span>',$chauffeur_allowed_html_array); // tag after separator
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_on_home   = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_current   = 1; // 1 - show current page title, 0 - don't show
	$before         = wp_kses('<span class="current">',$chauffeur_allowed_html_array); // tag before the current crumb
	$after          = wp_kses('</span>',$chauffeur_allowed_html_array); // tag after the current crumb
	/* === END OF OPTIONS === */
	global $post;
	$home_link      = home_url('/');
	$link_before    = wp_kses('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">',$chauffeur_allowed_html_array);
	$link_after     = wp_kses('</span>',$chauffeur_allowed_html_array);
	$link_attr      = wp_kses(' ',$chauffeur_allowed_html_array);
	$link_in_before = wp_kses('<span itemprop="title">',$chauffeur_allowed_html_array);
	$link_in_after  = wp_kses('</span>',$chauffeur_allowed_html_array);
	$link           = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
	$frontpage_id   = get_option('page_on_front');
	
	if( is_search() ) {
		$parent_id      = '';
	} else {
		$parent_id      = $post->post_parent;
	}
	
	$sep            = ' ' . $sep_before . $sep . $sep_after . ' ';
	if (is_home() || is_front_page()) {
		if ($show_on_home) echo wp_kses($wrap_before,$chauffeur_allowed_html_array) . '<a href="' . wp_kses($home_link,$chauffeur_allowed_html_array) . '">' . wp_kses($text['home'],$chauffeur_allowed_html_array) . '</a>' . wp_kses($wrap_after,$chauffeur_allowed_html_array);
	} else {
		echo wp_kses($wrap_before,$chauffeur_allowed_html_array);
		if ($show_home_link) echo sprintf($link, $home_link, $text['home']);
		if ( is_category() ) {
			$cat = get_category(get_query_var('cat'), false);
			if ($cat->parent != 0) {
				$cats = get_category_parents($cat->parent, TRUE, $sep);
				$cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
				$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
				if ($show_home_link) echo wp_kses($sep,$chauffeur_allowed_html_array);
				echo wp_kses($cats,$chauffeur_allowed_html_array);
			}
			if ( get_query_var('paged') ) {
				$cat = $cat->cat_ID;
				echo wp_kses($sep,$chauffeur_allowed_html_array) . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			} else {
				if ($show_current) echo wp_kses($sep,$chauffeur_allowed_html_array) . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
			}
		} elseif ( is_search() ) {
			if (have_posts()) {
				if ($show_home_link && $show_current) echo wp_kses($sep,$chauffeur_allowed_html_array);
				if ($show_current) echo wp_kses($before,$chauffeur_allowed_html_array) . sprintf($text['search'], get_search_query()) . $after;
			} else {
				if ($show_home_link) echo wp_kses($sep,$chauffeur_allowed_html_array);
				echo wp_kses($before,$chauffeur_allowed_html_array) . sprintf($text['search'], get_search_query()) . $after;
			}
		} elseif ( is_day() ) {
			if ($show_home_link) echo wp_kses($sep,$chauffeur_allowed_html_array);
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
			echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
			if ($show_current) echo wp_kses($sep,$chauffeur_allowed_html_array) . $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			if ($show_home_link) echo wp_kses($sep,$chauffeur_allowed_html_array);
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
			if ($show_current) echo wp_kses($sep,$chauffeur_allowed_html_array) . $before . get_the_time('F') . $after;
		} elseif ( is_year() ) {
			if ($show_home_link && $show_current) echo wp_kses($sep,$chauffeur_allowed_html_array);
			if ($show_current) echo wp_kses($before,$chauffeur_allowed_html_array) . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ($show_home_link) echo wp_kses($sep,$chauffeur_allowed_html_array);
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				
				global $chauffeur_data;
				
				if ($slug['slug'] == 'fleet') {
					
					if ( empty($chauffeur_data['fleet_slug']) ) {
						$slug_show = $slug['slug'];
					} else {
						$slug_show = esc_html($chauffeur_data['fleet_slug']);
					}
					
				} elseif ($slug['slug'] == 'testimonials') {
					
					if ( empty($chauffeur_data['testimonials_slug']) ) {
						$slug_show = $slug['slug'];
					} else {
						$slug_show = esc_html($chauffeur_data['testimonials_slug']);
					}
					
				} else {
					$slug_show = $slug['slug'];
				}
				
				printf($link, $home_link . '/' . $slug_show . '/', $post_type->labels->singular_name);
				if ($show_current) echo wp_kses($sep,$chauffeur_allowed_html_array) . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $sep);
				if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
				$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
				echo wp_kses($cats,$chauffeur_allowed_html_array);
				if ( get_query_var('cpage') ) {
					echo wp_kses($sep,$chauffeur_allowed_html_array) . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
				} else {
					if ($show_current) echo wp_kses($before,$chauffeur_allowed_html_array) . get_the_title() . $after;
				}
			}
		// custom post type
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			if ( get_query_var('paged') ) {
				echo wp_kses($sep,$chauffeur_allowed_html_array) . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			} else {
				if ($show_current) echo wp_kses($sep,$chauffeur_allowed_html_array) . $before . $post_type->label . $after;
			}
		} elseif ( is_attachment() ) {
			if ($show_home_link) echo wp_kses($sep,$chauffeur_allowed_html_array);
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			if ($cat) {
				$cats = get_category_parents($cat, TRUE, $sep);
				$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
				echo wp_kses($cats,$chauffeur_allowed_html_array);
			}
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current) echo wp_kses($sep,$chauffeur_allowed_html_array) . $before . get_the_title() . $after;
		} elseif ( is_page() && !$parent_id ) {
			if ($show_current) echo wp_kses($sep,$chauffeur_allowed_html_array) . $before . get_the_title() . $after;
		} elseif ( is_page() && $parent_id ) {
			if ($show_home_link) echo wp_kses($sep,$chauffeur_allowed_html_array);
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo wp_kses($breadcrumbs[$i],$chauffeur_allowed_html_array);
					if ($i != count($breadcrumbs)-1) echo wp_kses($sep,$chauffeur_allowed_html_array);
				}
			}
			if ($show_current) echo wp_kses($sep,$chauffeur_allowed_html_array) . $before . get_the_title() . $after;
		} elseif ( is_tag() ) {
			if ( get_query_var('paged') ) {
				$tag_id = get_queried_object_id();
				$tag = get_tag($tag_id);
				echo wp_kses($sep,$chauffeur_allowed_html_array) . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			} else {
				if ($show_current) echo wp_kses($sep,$chauffeur_allowed_html_array) . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
			}
		} elseif ( is_author() ) {
			global $author;
			$author = get_userdata($author);
			if ( get_query_var('paged') ) {
				if ($show_home_link) echo wp_kses($sep,$chauffeur_allowed_html_array);
				echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			} else {
				if ($show_home_link && $show_current) echo wp_kses($sep,$chauffeur_allowed_html_array);
				if ($show_current) echo wp_kses($before,$chauffeur_allowed_html_array) . sprintf($text['author'], $author->display_name) . $after;
			}
		} elseif ( is_404() ) {
			if ($show_home_link && $show_current) echo wp_kses($sep,$chauffeur_allowed_html_array);
			if ($show_current) echo wp_kses($before,$chauffeur_allowed_html_array) . $text['404'] . $after;
		} elseif ( has_post_format() && !is_singular() ) {
			if ($show_home_link) echo wp_kses($sep,$chauffeur_allowed_html_array);
			echo get_post_format_string( get_post_format() );
		}
		echo wp_kses($wrap_after,$chauffeur_allowed_html_array);
	}
} // end of dimox_breadcrumbs()