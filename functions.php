<?php
/**
 * wet-boew functions and definitions
 *
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage wet-boew
 * @since wet-boew 1.0
 */

require __DIR__ . '/shortcodes.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run wet_boew_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'wet_boew_setup' );

if ( ! function_exists( 'wet_boew_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override wet_boew_setup() in a child theme, add your own wet_boew_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since wet-boew 1.0
 */
function wet_boew_setup() {
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'wet-boew', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

    // If the mega-menu doesn't exist, let's create it.
    $menu_name = 'mega-menu';
    if( ! wp_get_nav_menu_object( $menu_name )){
        $menu_id = wp_create_nav_menu($menu_name);
    }

    update_option( 'date_format', 'Y-m-d', true );
    update_option( 'time_format', 'g:i A', true );
    update_option( 'start_of_week', '0', true );

	// This theme uses wp_nav_menu() in one location.
	// register_nav_menus( array(
		// 'primary' => __( 'Primary navigation', 'wet-boew' ),
	// ) );
}
endif;


// TO remove when megamenu work fine
function get_site_menu(){

	$out = "";
	$preOut = '<nav role="navigation" id="wb-sm"';

	$cats = get_categories( array (
			'orderby' => 'slug'
		) );

	$catsMenu = array();
	$catsSubMenu = array();

	foreach( $cats as $cat ) {
		if ( $cat->category_parent === 0 ) {
			$catsMenu[ $cat->term_id ] =  array(  $cat->slug, $cat->name );

		} else {
			if ( !isset($catsSubMenu[ $cat->category_parent ] ) ) {

				$catsSubMenu[ $cat->category_parent ] =  array( array( $cat->slug, $cat->name ) );

			} else {
				array_push( $catsSubMenu[ $cat->category_parent ], array( $cat->slug, $cat->name ) );
			}
		}
	}

	$out .= '<ul class="list-inline menu" role="menubar">';
	foreach( $catsMenu as $key => $value) {

		$out .= '<li><a class="item" href="/index.php/category/' . $value[0];
		$out .= '">' . $value[1] . '</a>';

		if ( isset($catsSubMenu[ $key ] ) ) {
			$out .= '<ul class="sm list-unstyled" role="menu">';

			foreach( $catsSubMenu[ $key ] as $value2) {
				$out .= '<li><a href="/index.php/category/' . $value2[0];
				$out .= '">' . $value2[1] . '</a></li>';
			}

			$out .= '</ul>';
		}

		$out .= '</li>';
	}
	$out .= '</ul>';

	$out = $preOut . ' class="wb-menu visible-md visible-lg" data-trgt="mb-pnl" typeof="SiteNavigationElement"><div class="pnl-strt container visible-md visible-lg nvbar"><h2>' .
		__( "Topics menu", "wet-boew" ) . '</h2><div class="row">' .
		$out .
		'</div></div></nav>';

	echo( $out );
}


/*
 * Build the website menu based on the categorie with articles
 *
 */
function get_site_megamenu(){

	$menu_name = 'mega-menu';
	$locations = get_nav_menu_locations();

	if ( !isset( $locations[ $menu_name ] ) ) {
		return;
	}

	$out = "";
	$preOut = '<nav role="navigation" id="wb-sm"';


	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

	$menu_items = wp_get_nav_menu_items($menu->term_id);

	$out = '<ul class="list-inline menu" role="menubar">';

	foreach ( $menu_items as $menu_item ) {
		if ( $menu_item->menu_item_parent == 0 ) {

			$out .= '<li><a class="item" href="' . $menu_item->url . '">' . $menu_item->title . '</a>';

			$parent = $menu_item->ID;
			$submenu_html = "";
			foreach( $menu_items as $submenu ) {
				if( $submenu->menu_item_parent == $parent ) {
					$submenu_html .= '<li><a href="' . $submenu->url . '">' . $submenu->title . '</a></li>';
				}
			}

			if ( strlen( $submenu_html ) ) {
				$out .= '<ul class="sm list-unstyled" role="menu">';
				$out .=  $submenu_html;
				$out .= '</ul>';
			}

			$out .= '</li>';

		}
	}

	$out .= '</ul>';


	$out = $preOut . ' class="wb-menu visible-md visible-lg" data-trgt="mb-pnl" typeof="SiteNavigationElement"><div class="pnl-strt container visible-md visible-lg nvbar"><h2>' .
		__( "Topics menu", "wet-boew" ) . '</h2><div class="row">' .
		$out .
		'</div></div></nav>';

	echo( $out );
}

add_action( 'init', 'register_wetboew4_mega_menu' );

function register_wetboew4_mega_menu() {
	register_nav_menu( 'mega-menu', __( 'Mega menu', 'wet-boew' ) );
}

function wet_boew_auto_excerpt_more( $more ) {
	return ' ' . __("[…]", "wet-boew" );
}
add_filter( 'excerpt_more', 'wet_boew_auto_excerpt_more' );

function the_breadcrumb($post) {
    $home_crumb = get_the_title( get_option('page_on_front') );
    if ($home_crumb != the_title('', '', false)) {
        echo '<ol class="breadcrumb">';
        echo '<li><a href="';
        bloginfo('url');
        echo '/">';
        echo $home_crumb;
        echo "</a></li>";
        if (!is_home()) {
            if (is_category() || is_single()) {
                echo '<li>';
                the_category(' </li><li> ');
                if (is_single()) {
                    echo "</li><li>";
                    the_title();
                    echo '</li>';
                }
            } elseif (is_page()) {
                if($post->post_parent){
                    $anc = get_post_ancestors( $post->ID );
                    foreach ( $anc as $ancestor ) {
                        //wp_cache_delete($post->ID, 'posts');
                        $output = '<li><a href="'. get_permalink($ancestor) .'">'.get_the_title($ancestor).'</a></li>'.$output;
                    }
                    echo $output;
                    echo '<li>';
                    the_title();
                    echo '</li>';
                } else {
                    echo '<li>';
                    the_title();
                    echo '</li>';
                }
            }
        }
        elseif (is_tag()) {single_tag_title();}
        elseif (is_day()) {echo "<li>" . __('Archive for', 'wet-boew') . ' ' . the_time('F jS, Y', false) . '</li>';}
        elseif (is_month()) {echo "<li>" . __('Archive for', 'wet-boew') . ' ' . the_time('F, Y', false) . '</li>';}
        elseif (is_year()) {echo "<li>" . __('Archive for', 'wet-boew') . ' ' . the_time('Y', false) .'</li>';}
        elseif (is_author()) {echo "<li>" . __('Author archive', 'wet-boew') . '</li>';}
        elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>" . __('Blog archives', 'wet-boew') . '</li>';}
        elseif (is_search()) {echo "<li>" . __("Search results", 'wet-boew') . '</li>';}
        echo '</ol>';
	}
}


function front_page_StickyPost(){

	$recentPosts = new WP_Query();
	$sticky = get_option('sticky_posts');

	if ( isset($sticky[0]) ) {
		rsort( $sticky );
		$sticky = array_slice( $sticky, 0, 5 );
		$args = array(
			'post__in' => $sticky,
			'ignore_sticky_posts' => 1
		);

		$recentPosts->query($args);

		$postIndex = 0;

		while ($recentPosts->have_posts()) {
			$recentPosts->the_post();

			if ( !$postIndex ) {
				echo( '<h2 class="wb-inv">' . __( "Highlighted articles", "wet-boew" ) . '</h2>' );
			}

			if ( $postIndex ) {
				echo( '<div class="clearfix"></div>' );
				echo( '<div class="row">' );
				echo( '<div class="col-sm-12">' );
			}

			echo( '<a class="list-articles" href="' );
			the_permalink();
			echo( '">' );
			echo( '<figure class="lead">' );
			echo( '<figcaption class="' . ($i_iterator ? "h3": "h2 mrgn-tp-sm" ) . '">' );
			the_title();
			echo( '</figcaption>' );

			if ( $postIndex ) {
				echo( '<div class="row">' );
			}

			if ( has_post_thumbnail() ) {
				if ( $postIndex ) {
					echo( '<div class="col-sm-3">' );
				}

				echo( '<img class="img-responsive mrgn-rght-sm mrgn-bttm-sm col-sm-12" src="' );
				echo( wp_get_attachment_image_src( get_post_thumbnail_id( $post ), 'medium' )[ 0 ] );
				echo( '" alt="" />' );

				if ( $postIndex ) {
					echo( '</div>' );
					echo( '<div class="col-sm-8">' );
					the_excerpt();
					echo( '</div>' );
				} else {
					// the_excerpt(10);
				}

			} else {
				if ( $postIndex ) {
					echo( '<div class="col-sm-11">' );
					the_excerpt();
					echo( '</div>' );
				} else {
					the_excerpt(25);
				}
			}

			if ( $postIndex ) {
				echo( '</div>' );
			}

			echo( '</figure>' );
			echo( '</a>' );
			echo( '</div>' );
			echo( '</div>' );

			$postIndex += 1;
		}


		if ($postIndex) {
			echo( '<div class="row">' );
			echo( '<div class="col-sm-12">' );
		}
	}
}



function theme_wet_boew_customize( $wp_customize ) {
	// $wp_customize->add_panel();
	// $wp_customize->get_panel();
	// $wp_customize->remove_panel();

	// $wp_customize->add_section();
	// $wp_customize->get_section();
	// $wp_customize->remove_section();

	// $wp_customize->add_setting();
	// $wp_customize->get_setting();
	// $wp_customize->remove_setting();

	// $wp_customize->add_control();
	// $wp_customize->get_control();
	// $wp_customize->remove_control();


	$wp_customize->add_setting( 'wet_boew_theme', array(
		'type' => 'theme_mod',
		'default' => 'theme-wet-boew'
	) );

	$wp_customize->add_control( 'wet_boew_theme', array(
		'type' => 'text',
		'settings' => 'wet_boew_theme',
		'section' => 'title_tagline',
		'label' => __( 'Name of the WET-BOEW theme', 'wet-boew' ),
		'description' => __( 'Name of the folder containing the theme. Example: theme-wet-boew, GCWeb, theme-gc-intranet', 'wet-boew' )
	) );
}
add_action('customize_register','theme_wet_boew_customize');


if ( ! function_exists( 'wet_boew_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in wet_boew_setup().
 *
 * @since wet-boew 1.0
 */
function wet_boew_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since wet-boew 1.0
 */
function wet_boew_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'wet_boew_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since wet-boew 1.0
 * @return int
 */
 /*
function wet_boew_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'wet_boew_excerpt_length' );
*/
/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since wet-boew 1.0
 * @return string "Continue Reading" link
 */
/*
function wet_boew_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading', 'wet-boew' ) . ' <span class="meta-nav">&rarr;</span></a>';
}
*/
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and wet_boew_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since wet-boew 1.0
 * @return string An ellipsis
 */
/*
function wet_boew_auto_excerpt_more( $more ) {
	return ' &hellip;' . wet_boew_continue_reading_link();
}
add_filter( 'excerpt_more', 'wet_boew_auto_excerpt_more' );
*/



/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since wet-boew 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
/*function wet_boew_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= wet_boew_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'wet_boew_custom_excerpt_more' );
*/
/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in wet-boew's style.css.
 *
 * @since wet-boew 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function wet_boew_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'wet_boew_remove_gallery_css' );

if ( ! function_exists( 'wet_boew_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wet_boew_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since wet-boew 1.0
 */
function wet_boew_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( '%s', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( ' Your comment is awaiting moderation.', 'wet-boew' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			Date : <?php comment_date(get_option('date_format')) ?> <?php _e( 'at', 'wet-boew' ); ?> <?php comment_time(get_option('time_format')) ?></a><?php edit_comment_link( '(' . __( 'Edit', 'wet-boew' ) . ')', ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->


		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'wet-boew' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( '(' . __('Edit', 'wet-boew') . ')', ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override wet_boew_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since wet-boew 1.0
 * @uses register_sidebar
 */
function wet_boew_widgets_init() {

    // *** Top of page ***

    register_sidebar( array(
        'name' => __( 'Language Selection Widget Area', 'wet-boew' ),
        'id' => 'language-selection-widget-area',
        'description' => __( 'Widget area for language selection.', 'wet-boew' ),
        'before_widget' => '<section id="wb-lng" class="visible-md visible-lg"><h2>' . __('Language selection', 'wet-boew') . '</h2>',
        'after_widget' => '</section>',
        'before_title' => '<li>',
        'after_title' => '</li>',
    ) );

	// *** The sidebar Widget Area ***

    register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'wet-boew' ),
		'id' => 'sidebar-widget-area',
		'description' => __( 'The sidebar widget area', 'wet-boew' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

    // *** Footer Widget Area ***

    // First (left) footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'First Footer Widget Area', 'wet-boew' ),
        'id' => 'first-footer-widget-area',
        'description' => __( 'The first footer widget area', 'wet-boew' ),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Second (middle-left). Empty by default.
    register_sidebar( array(
        'name' => __( 'Second Footer Widget Area', 'wet-boew' ),
        'id' => 'second-footer-widget-area',
        'description' => __( 'The second footer widget area', 'wet-boew' ),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Third (middle-right). Empty by default.
    register_sidebar( array(
        'name' => __( 'Third Footer Widget Area', 'wet-boew' ),
        'id' => 'third-footer-widget-area',
        'description' => __( 'The third footer widget area', 'wet-boew' ),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Fourth (right). Empty by default.
    register_sidebar( array(
        'name' => __( 'Fourth Footer Widget Area', 'wet-boew' ),
        'id' => 'fourth-footer-widget-area',
        'description' => __( 'The fourth footer widget area', 'wet-boew' ),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

	// Bottom Footer Widget Area.
	register_sidebar( array(
		'name' => __( 'Bottom Footer Widget Area', 'wet-boew' ),
		'id' => 'bottom-footer-widget-area',
		'description' => __( 'Footer', 'wet-boew' ),
		'before_widget' => '<p>',
		'after_widget' => '</p>',
		'before_title' => '',
		'after_title' => '',
	) );

}
/** Register sidebars by running wet_boew_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'wet_boew_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since wet-boew 1.0
 */
function wet_boew_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'wet_boew_remove_recent_comments_style' );

if ( ! function_exists( 'wet_boew_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since wet-boew 1.0
 */
function wet_boew_posted_on() {
	printf( '<span class="%1$s">' . __( 'Posted on', 'wet-boew' ) . '</span> %2$s <span class="meta-sep">' . __('by', 'wet-boew') . '</span> %3$s',
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'wet-boew' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'wet_boew_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since wet-boew 1.0
 */
function wet_boew_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'wet-boew' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'wet-boew' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'wet-boew' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


// /**
 // * Customizes CSS parameters according to options selected.
 // *
 // * @since wet-boew 1.0
 // */
// function wet_boew_css_options() {
	// echo '<style type="text/css"> #cn-banner, #cn-banner-eng, #cn-banner-fra { float: left; width: 100%; min-height: 80px; margin-top: -35px; text-align: center; background-color: ';
	// echo get_option('accent_colour');
	// echo '; background-repeat: no-repeat; background-image: url(';
	// echo esc_url(header_image());
	// echo '); } #cn-skip-head a:hover, #cn-skip-head a:focus, #cn-skip-head a:active {background-color: ';
	// echo get_option('accent_colour');
	// echo ';}' . '#cn-banner, #cn-banner-eng, #cn-banner-fra {background-color: ';
	// echo get_option('accent_colour');
	// echo ';} .cn-left-col-default h3 {background-color: ';
	// echo get_option('accent_colour');
	// echo ';}' . '.cn-left-col-default #cn-search-box #cn-search {border: 1px solid ';
	// echo get_option('accent_colour');
	// echo ';}' . '.cn-left-col-default #cn-search-box #cn-search-submit {background-color: ';
	// echo get_option('accent_colour');
	// echo ';}' . '.cn-left-col-default li {border-top: 1px solid ';
	// echo get_option('accent_colour');
	// echo ';} #cn-pd-ul {border-top: 15px solid ';
	// echo get_option('accent_colour');
	// echo ';} .cn-right-col-default h3 {background-color: ';
	// echo get_option('accent_colour');
	// echo ';} #cn-in-pd {border-top: 15px solid ';
	// echo get_option('accent_colour');
	// echo ';} #cn-left-col-inner, #cn-left-col-gap {background-color: ';
	// echo get_option('secondary_colour');
	// echo ';} .cn-right-col-default a:focus, .cn-right-col-default a:active {color: ';
	// echo get_option('secondary_colour');
	// echo ';} </style>';
// }


// /**
 // * wet-boew Options
 // *
 // * @since wet-boew 1.0
 // */

// $options = array (

    // array(  "name" => "Accent Colour",
            // "id" => "accent_colour",
            // "std" => "#363",
            // "type" => "text",
            // "desc" => "This is used to colour the menu headings background and footer bar."),

    // array(  "name" => "Secondary Colour",
            // "id" => "secondary_colour",
            // "std" => "#CC9",
            // "type" => "text",
            // "desc" => "This is used to colour the menu items background."),

// );

// function mytheme_add_admin() {
    // global $options;

    // if ( $_GET['page'] == basename(__FILE__) ) {

        // if ( 'save' == $_REQUEST['action'] ) {

                // foreach ($options as $value) {
                  // if ($value['type'] == check) {
                  // for($x = 0; $x < count($value['options']); $x++) {
                    // update_option( $value['values'][$x], $_REQUEST[ $value['values'][$x] ] ); }
                  // }
                  // else {
                    // update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
                  // }

                // foreach ($options as $value) {
                    // if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                // header("Location: themes.php?page=functions.php&saved=true");
                // die;

        // } elseif ( 'reset' == $_REQUEST['action'] ) {

            // foreach ($options as $value) {
                // delete_option( $value['id'] ); }

            // header("Location: themes.php?page=functions.php&reset=true");
            // die;

        // }
    // }

    // add_theme_page("wet-boew Options", "wet-boew Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
// }

// function mytheme_admin() {
    // global $options;
    // if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>Your settings have been saved.</strong></p></div>';
    // if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>Your settings have been reset.</strong></p></div>';
// }
// add_action('admin_menu', 'mytheme_add_admin');


/*
 * Modify TinyMCE editor to remove H1.
 */
function tiny_mce_remove_unused_formats($init) {
	// Add block format elements you want to show in dropdown
	$init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Address=address;Pre=pre';
	return $init;
}
add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats' );

// Replace Howdy Greeting.

function replace_howdy_greeting( $wp_admin_bar ) {
  $my_account=$wp_admin_bar->get_node('my-account');
  $newtitle = str_replace( 'Howdy', __('Welcome'), $my_account->title );
  $newtitle = str_replace('Hi,', '', $newtitle );
  $wp_admin_bar->add_node( array(
    'id' => 'my-account',
    'title' => $newtitle,
  ) );
}
add_filter( 'admin_bar_menu', 'replace_howdy_greeting', 12 );

// Replace WP logo.

function my_login_logo() { ?>
<style type="text/css">
    #login h1 a, .login h1 a {
        background-image: url(<?php bloginfo('template_directory'); ?>/wet-boew/assets/favicon-mobile.png);
        height:144px;
        width:144px;
        background-size: 144px 144px;
        background-repeat: no-repeat;
        padding-bottom: 0px;
    }
    body {
        background-color: #ffffff!important;
    }
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return __(get_bloginfo('name'));
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );