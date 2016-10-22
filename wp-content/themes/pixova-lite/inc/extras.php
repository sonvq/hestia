<?php

if( !function_exists( 'pixova_lite_body_classes' ) ) {
    /**
     * Adds custom classes to the array of body classes.
     *
     * @param array $classes Classes for the body element.
     * @return array
     */

    function pixova_lite_body_classes($classes)
    {

        // Adds a class of group-blog to blogs with more than 1 published author.

        if (is_multi_author()) {
            $classes[] = 'group-blog';
        }

        return $classes;

    }

    add_filter('body_class', 'pixova_lite_body_classes');
}

if( !function_exists( 'pixova_lite_wp_title' ) ) {
    /**
     * Filters wp_title to print a neat <title> tag based on what is being viewed.
     *
     * @param string $title Default title text for current view.
     * @param string $sep Optional separator.
     * @return string The filtered title.
     */

    function pixova_lite_wp_title($title, $sep)
    {

        if (is_feed()) {

            return $title;

        }

        global $page, $paged;

        // Add the blog name
        $title .= get_bloginfo('name', 'display');

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page())) {
            $title .= " $sep $site_description";

        }

        // Add a page number if necessary:

        if ($paged >= 2 || $page >= 2) {
            $title .= " $sep " . sprintf(__('Page %s', 'pixova-lite'), max($paged, $page));
        }

        return $title;

    }

    add_filter('wp_title', 'pixova_lite_wp_title', 10, 2);
}

if( !function_exists( 'pixova_lite_setup_author' ) ) {
    /**
     * Sets the authordata global when viewing an author archive.
     *
     * This provides backwards compatibility with
     * http://core.trac.wordpress.org/changeset/25574
     *
     * It removes the need to call the_post() and rewind_posts() in an author
     * template to print information about the author.
     *
     * @global WP_Query $wp_query WordPress Query object.
     * @return void
     */

    function pixova_lite_setup_author()
    {

        global $wp_query;

        if ($wp_query->is_author() && isset($wp_query->post)) {
            $GLOBALS['authordata'] = get_userdata($wp_query->post->post_author);

        }

    }

    add_action('wp', 'pixova_lite_setup_author');
}

if( !function_exists( 'pixova_lite_prefix_upsell_notice' ) ) {
    /**
     * Display upgrade notice on customizer page
     */
    function pixova_lite_prefix_upsell_notice()
    {

        // Enqueue the script
        wp_enqueue_script(
            'pixova-lite-customizer-upsell',
            get_template_directory_uri() . '/layout/js/upsell/upsell.js',
            array(), '1.0.1',
            true
        );

        // Localize the script
        wp_localize_script(
            'pixova-lite-customizer-upsell',
            'prefixL10n',
            array(

                # Upsell URL
                'prefixUpsellURL' => esc_url('http://www.machothemes.com/themes/pixova/'),
                'prefixUpsellLabel' => __('View PRO version', 'pixova-lite'),

                # Documentation URLs
                'prefixDocURL' => esc_url('http://www.faq.machothemes.com/pixova-lite/'),
                'prefixDocLabel' => __('Theme Documentation', 'pixova-lite'),

                # Rate US URL
                'prefixRateURL' => esc_url('https://wordpress.org/support/view/theme-reviews/pixova-lite#postform'),
                'prefixRateLabel' => __('If you like it, rate it !', 'pixova-lite'),

            )
        );

    }

    add_action('customize_controls_enqueue_scripts', 'pixova_lite_prefix_upsell_notice');
}


// Function to convert hex color codes to rgba 

if( !function_exists( 'pixova_lite_hex2rgba' ) ) {
    function pixova_lite_hex2rgba($color, $opacity = false)
    {

        $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if (empty($color))
            return $default;

        //Sanitize $color if "#" is provided
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif (strlen($color) == 3) {
            $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb = array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if ($opacity) {
            if (abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
        } else {
            $output = 'rgb(' . implode(",", $rgb) . ')';
        }

        //Return rgb(a) color string
        return $output;
    }
}

if ( ! function_exists( 'pixova_lite_post_nav' ) ) {

	/**
	 * Display navigation to next/previous post when applicable.
	 */

	function pixova_lite_post_nav()
	{

		// Don't print empty markup if there's nowhere to navigate.
		$previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
		$next = get_adjacent_post(false, '', false);

		if (!$next && !$previous) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e('Post navigation', 'pixova-lite'); ?></h1>

			<div class="nav-links">
				<?php

				previous_post_link('<div class="nav-previous">%link</div>', _x('<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'pixova-lite'));
				next_post_link('<div class="nav-next">%link</div>', _x('%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'pixova-lite'));

				?>
			</div>
			<!-- .nav-links -->
		</nav><!-- .navigation -->

		<?php

	}
}

if ( ! function_exists( 'pixova_lite_content_nav' ) ) {
	/**
	 * Display navigation to next/previous pages when applicable
	 */
	function pixova_lite_content_nav($nav_id)
	{
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if (is_single()) {
			$previous = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
			$next = get_adjacent_post(false, '', false);

			if (!$next && !$previous)
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ($wp_query->max_num_pages < 2 && (is_home() || is_archive() || is_search()))
			return;

		$nav_class = (is_single()) ? 'post-navigation' : 'paging-navigation';
		?>
		<nav role="navigation" id="<?php echo esc_attr($nav_id); ?>" class="<?php echo $nav_class; ?>">
			<h1 class="screen-reader-text"><?php _e('Post navigation', 'pixova-lite'); ?></h1>

			<?php if (is_single()) : // navigation links for single posts ?>

				<?php previous_post_link('<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'pixova-lite') . '</span> %title'); ?>
				<?php next_post_link('<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'pixova-lite') . '</span>'); ?>

			<?php elseif ($wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search())) : // navigation links for home, archive, and search pages ?>

				<?php if (get_next_posts_link()) : ?>
					<div
						class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'pixova-lite')); ?></div>
				<?php endif; ?>

				<?php if (get_previous_posts_link()) : ?>
					<div
						class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'pixova-lite')); ?></div>
				<?php endif; ?>

			<?php endif; ?>
			<div class="clear"></div>
		</nav><!-- #<?php echo esc_html($nav_id); ?> -->
		<?php
	}
}

if( ! function_exists( 'pixova_lite_breadcrumbs' ) ) {
    /**
     * Render the breadcrumbs with help of class-breadcrumbs.php
     *
     * @return void
     */
    function pixova_lite_breadcrumbs() {
        $breadcrumbs = new Pixova_Lite_Breadcrumbs();
        $breadcrumbs->get_breadcrumbs();
    }
}

if( !function_exists( 'pixova_lite_fix_responsive_videos' ) ) {
    /*
    /* Add responsive container to embeds
    */
    function pixova_lite_fix_responsive_videos($html)
    {
        return '<div class="pixova-lite-video-container">' . $html . '</div>';
    }

    add_filter('embed_oembed_html', 'pixova_lite_fix_responsive_videos', 10, 3);
    add_filter('video_embed_html', 'pixova_lite_fix_responsive_videos'); // Jetpack
}

if( !function_exists( 'pixova_lite_get_number_of_comments' ) ) {
    /**
     * Simple function used to return the number of comments a post has.
     */
    function pixova_lite_get_number_of_comments($post_id) {

        $num_comments = get_comments_number($post_id); // get_comments_number returns only a numeric value

        if ( comments_open() ) {
            if ( $num_comments == 0 ) {
                $comments = __('No Comments', 'pixova-lite');
            } elseif ( $num_comments > 1 ) {
                $comments = $num_comments . __(' Comments', 'pixova-lite');
            } else {
                $comments = __('1 Comment', 'pixova-lite');
            }
            $write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
        } else {
            $write_comments =  __('Comments are off for this post.', 'pixova-lite');
        }

        return $write_comments;

    }
}

if( !function_exists( 'pixova_lite_javascript_detection' ) ) {
    /**
     * JavaScript Detection.
     *
     * Adds a `js` class to the root `<html>` element when JavaScript is detected.
     *
     * @since Pixova Lite 1.16
     */
    function pixova_lite_javascript_detection()
    {
        echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
    }

    add_action('wp_head', 'pixova_lite_javascript_detection', 0);
}


if ( !function_exists( 'pixova_lite_pagination' ) ) {
    /**
     * Custom pagination function
     *
     * @since Pixova Lite 1.09
     */
    function pixova_lite_pagination() {

        $prev_arrow = is_rtl() ? '&rarr;' : '&larr;';
        $next_arrow = is_rtl() ? '&larr;' : '&rarr;';

        global $wp_query;
        $total = $wp_query->max_num_pages;
        $big = 999999999; // need an unlikely integer
        if( $total > 1 )  {
            if( !$current_page = get_query_var('paged') )
                $current_page = 1;
            if( get_option('permalink_structure') ) {
                $format = 'page/%#%/';
            } else {
                $format = '&paged=%#%';
            }
            echo paginate_links(array(
                'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'		=> $format,
                'current'		=> max( 1, get_query_var('paged') ),
                'total' 		=> $total,
                'mid_size'		=> 3,
                'type' 			=> 'list',
                'prev_text'		=> $prev_arrow,
                'next_text'		=> $next_arrow,
            ) );
        }
    }
}

#
# More Themes Functionality
#


if( !function_exists( 'pixova_lite_more_themes_styles' ) ) {
    /**
     *
     */
    function pixova_lite_more_themes_styles() {
        wp_enqueue_style('more-theme-style', get_template_directory_uri() . '/layout/css/more-themes.min.css');
    }
}

# Add upsell page to the menu.
if( !function_exists( 'pixova_lite_add_upsell' ) ) {
    /**
     *
     */
    function pixova_lite_lite_add_upsell() {

        $page = add_theme_page(
            __( 'More Themes', 'pixova-lite' ),
            __( 'More Themes', 'pixova-lite' ),
            'administrator',
            'macho-themes',
            'pixova_lite_display_upsell'
        );

        add_action( 'admin_print_styles-' . $page, 'pixova_lite_more_themes_styles' );
    }

    add_action( 'admin_menu', 'pixova_lite_lite_add_upsell', 11 );
}


# Define markup for the upsell page.
if( !function_exists( 'pixova_lite_display_upsell' ) ) {
    function pixova_lite_display_upsell() {

        // Set template directory uri
        $directory_uri = get_template_directory_uri();
        ?>
        <div class="wrap">
            <div class="container-fluid">
                <div id="upsell_container">
                    <div class="row">
                        <div id="upsell_header" class="col-md-12">

                            <a href="http://www.machothemes.com/" target="_blank">
                                <img
                                    src="<?php echo get_template_directory_uri(); ?>/layout/images/upsell/macho-themes-logo.png"/>
                            </a>

                            <h3><?php printf( __( 'Simple. Powerful. Flexible. That\'s how we at %s build all of our themes.', 'pixova-lite' ), sprintf( '<a href="http://www.machothemes.com" target="_blank" rel="nofollow">%s</a>', __( 'Macho Themes' ) ) ); ?></h3>

                        </div>
                    </div>
                    <div id="upsell_themes" class="row">
                        <?php

                        // Set the argument array with author name.
                        $args = array(
                            'author' => 'cristianraiber-1',
                        );

                        // Set the $request array.
                        $request = array(
                            'body' => array(
                                'action'  => 'query_themes',
                                'request' => serialize( (object) $args )
                            )
                        );

                        $themes       = pixova_lite_get_themes( $request );
                        $active_theme = wp_get_theme()->get( 'Name' );
                        $counter      = 1;

                        // For currently active theme.
                        foreach ( $themes->themes as $theme ) {
                            if ( $active_theme == $theme->name ) { ?>

                                <div id="<?php echo $theme->slug; ?>" class="theme-container col-md-6 col-lg-4">
                                    <div class="image-container">
                                        <img class="theme-screenshot" src="<?php echo $theme->screenshot_url ?>"/>

                                        <div class="theme-description">
                                            <p><?php echo $theme->description; ?></p>
                                        </div>
                                    </div>
                                    <div class="theme-details active">
											<span
                                                class="theme-name"><?php echo $theme->name . ':' . __( ' Current theme', 'pixova-lite' ); ?></span>
                                        <a class="button button-secondary customize right" target="_blank"
                                           href="<?php echo get_site_url() . '/wp-admin/customize.php' ?>">Customize</a>
                                    </div>
                                </div>

                                <?php
                                $counter ++;
                                break;
                            }
                        }

                        // For all other themes.
                        foreach ( $themes->themes as $theme ) {
                            if ( $active_theme != $theme->name ) {

                                // Set the argument array with author name.
                                $args = array(
                                    'slug' => $theme->slug,
                                );

                                // Set the $request array.
                                $request = array(
                                    'body' => array(
                                        'action'  => 'theme_information',
                                        'request' => serialize( (object) $args )
                                    )
                                );

                                $theme_details = pixova_lite_get_themes( $request );
                                ?>

                                <div id="<?php echo $theme->slug; ?>"
                                     class="theme-container col-md-6 col-lg-4 <?php echo $counter % 3 == 1 ? 'no-left-megin' : ""; ?>">
                                    <div class="image-container">
                                        <img class="theme-screenshot" src="<?php echo $theme->screenshot_url ?>"/>

                                        <div class="theme-description">
                                            <p><?php echo $theme->description; ?></p>
                                        </div>
                                    </div>
                                    <div class="theme-details">
                                        <span class="theme-name"><?php echo $theme->name; ?></span>

                                        <!-- Check if the theme is installed -->
                                        <?php if ( wp_get_theme( $theme->slug )->exists() ) { ?>

                                            <!-- Activate Button -->
                                            <a class="button button-primary activate right"
                                               href="<?php echo wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=' . urlencode( $theme->slug ) ), 'switch-theme_' . $theme->slug ); ?>">Activate</a>
                                        <?php } else {

                                            // Set the install url for the theme.
                                            $install_url = add_query_arg( array(
                                                'action' => 'install-theme',
                                                'theme'  => $theme->slug,
                                            ), self_admin_url( 'update.php' ) );
                                            ?>
                                            <!-- Install Button -->
                                            <a data-toggle="tooltip" data-placement="bottom"
                                               title="<?php echo 'Downloaded ' . number_format( $theme_details->downloaded ) . ' times'; ?>"
                                               class="button button-primary install right"
                                               href="<?php echo esc_url( wp_nonce_url( $install_url, 'install-theme_' . $theme->slug ) ); ?>"><?php _e( 'Install Now', 'pixova-lite' ); ?></a>
                                        <?php } ?>

                                        <!-- Preview button -->
                                        <a class="button button-secondary preview right" target="_blank"
                                           href="<?php echo $theme->preview_url; ?>"><?php _e( 'Live Preview', 'pixova-lite' ); ?></a>
                                    </div>
                                </div>
                                <?php
                                $counter ++;
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>


        <?php
    }
}

# Get all Macho Themes themes by using WP API.
if( !function_exists( 'pixova_lite_get_themes' ) ) {
    function pixova_lite_get_themes( $request ) {

        // Generate a cache key that would hold the response for this request:
        $key = 'pixova-lite_' . md5( serialize( $request ) );

        // Check transient. If it's there - use that, if not re fetch the theme
        if ( false === ( $themes = get_transient( $key ) ) ) {

            // Transient expired/does not exist. Send request to the API.
            $response = wp_remote_post( 'http://api.wordpress.org/themes/info/1.0/', $request );

            // Check for the error.
            if ( ! is_wp_error( $response ) ) {

                $themes = unserialize( wp_remote_retrieve_body( $response ) );


                if ( ! is_object( $themes ) && ! is_array( $themes ) ) {

                    // Response body does not contain an object/array
                    return new WP_Error( 'theme_api_error', 'An unexpected error has occurred' );
                }

                // Set transient for next time... keep it for 24 hours should be good
                set_transient( $key, $themes, 60 * 60 * 24 );
            } else {
                // Error object returned
                return $response;
            }
        }

        return $themes;
    }
}

# Check if it's an IIS powered server
if( !function_exists( 'pixova_lite_on_iis' ) ){
    /**
     * @return bool
     */
    function pixova_lite_on_iis() {
        $sSoftware = strtolower( $_SERVER["SERVER_SOFTWARE"] );
        if ( strpos($sSoftware, "microsoft-iis") !== false )
            return true;
        else
            return false;
    }
}

#
#   Get the page ID of the page using the blog template
#
#   We can't rely on the name, maybe they'll name it something other than 'Blog' ?
#
if( !function_exists( 'pixova_lite_get_page_id_by_template' ) ) {
    function pixova_lite_get_page_id_by_template( $page_template = NULL ) {

        # default args array
        # page template defaults to blog-template.php
        $args = array(
            'post_type' => 'page',
            'fields' => 'ids',
            'nopaging' => true,
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/blog-template.php'
        );

        $pages = get_posts( $args );
        $pages_which_use_template = '';

        if( is_array( $pages ) ) {
            foreach ( $pages as $page ) {
                $pages_which_use_template[] = $page;
            }
        } else if( !is_array( $pages ) ) {
            $pages_which_use_template = $pages;
        } else {
            $pages_which_use_template = '';
        }

        return $pages_which_use_template;

    }
}

#
# Custom Excerpt Length
#
function pixova_lite_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'pixova_lite_excerpt_length', 999 );

#
# Custom Read More
#
function pixova_lite_excerpt_more( $more ) {
    //return ' <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More', 'pixova-lite' ) . '</a>';

    $return_string = '<div class="text-center">';
    $return_string .= '<a href="'.esc_url( get_the_permalink() ).'" class="btn btn-read-more" role="button">'.__('Read more','pixova-lite').'</a>';
    $return_string .= '</div><!--/.text-center-->';

    return $return_string;

}
add_filter('excerpt_more', 'pixova_lite_excerpt_more');



