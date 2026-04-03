<?php

if (!function_exists('mixxcazt_display_comments')) {
    /**
     * Mixxcazt display comments
     *
     * @since  1.0.0
     */
    function mixxcazt_display_comments() {
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || 0 !== intval(get_comments_number())) :
            comments_template();
        endif;
    }
}

if (!function_exists('mixxcazt_comment')) {
    /**
     * Mixxcazt comment template
     *
     * @param array $comment the comment array.
     * @param array $args the comment args.
     * @param int $depth the comment depth.
     *
     * @since 1.0.0
     */
    function mixxcazt_comment($comment, $args, $depth) {
        if ('div' === $args['style']) {
            $tag       = 'div';
            $add_below = 'comment';
        } else {
            $tag       = 'li';
            $add_below = 'div-comment';
        }
        ?>
        <<?php echo esc_attr($tag) . ' '; ?><?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-body">
        <div class="comment-meta commentmetadata">
            <div class="comment-author vcard">
                <?php echo get_avatar($comment, 128); ?>
                <?php printf('<cite class="fn">%s</cite>', get_comment_author_link()); ?>
            </div>
            <?php if ('0' === $comment->comment_approved) : ?>
                <em class="comment-awaiting-moderation"><?php esc_attr_e('Your comment is awaiting moderation.', 'mixxcazt'); ?></em>
                <br/>
            <?php endif; ?>

            <a href="<?php echo esc_url(htmlspecialchars(get_comment_link($comment->comment_ID))); ?>"
               class="comment-date">
                <?php echo '<time datetime="' . get_comment_date('c') . '">' . get_comment_date() . '</time>'; ?>
            </a>
        </div>
        <?php if ('div' !== $args['style']) : ?>
        <div id="div-comment-<?php comment_ID(); ?>" class="comment-content">
    <?php endif; ?>
        <div class="comment-text">
            <?php comment_text(); ?>
        </div>
        <div class="reply">
            <?php
            comment_reply_link(
                array_merge(
                    $args, array(
                        'add_below' => $add_below,
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                    )
                )
            );
            ?>
            <?php edit_comment_link(esc_html__('Edit', 'mixxcazt'), '  ', ''); ?>
        </div>
        </div>
        <?php if ('div' !== $args['style']) : ?>
            </div>
        <?php endif; ?>
        <?php
    }
}

if (!function_exists('mixxcazt_credit')) {
    /**
     * Display the theme credit
     *
     * @return void
     * @since  1.0.0
     */
    function mixxcazt_credit() {
        ?>
        <div class="site-info">
            <?php echo apply_filters('mixxcazt_copyright_text', $content = esc_html__('Coppyright', 'mixxcazt') . ' &copy; ' . date('Y') . ' ' . '<a class="site-url" href="' . esc_url(site_url()) . '">' . esc_html(get_bloginfo('name')) . '</a>' . esc_html__('. All Rights Reserved.', 'mixxcazt')); ?>
        </div><!-- .site-info -->
        <?php
    }
}

if (!function_exists('mixxcazt_social')) {
    function mixxcazt_social() {
        $social_list = mixxcazt_get_theme_option('social_text', []);
        if (empty($social_list)) {
            return;
        }
        ?>
        <div class="mixxcazt-social">
            <ul>
                <?php

                foreach ($social_list as $social_item) {
                    ?>
                    <li><a href="<?php echo esc_url($social_item); ?>"></a></li>
                    <?php
                }
                ?>

            </ul>
        </div>
        <?php
    }
}

if (!function_exists('mixxcazt_site_branding')) {
    /**
     * Site branding wrapper and display
     *
     * @return void
     * @since  1.0.0
     */
    function mixxcazt_site_branding() {
        ?>
        <div class="site-branding">
            <?php echo mixxcazt_site_title_or_logo(); ?>
        </div>
        <?php
    }
}

if (!function_exists('mixxcazt_site_title_or_logo')) {
    /**
     * Display the site title or logo
     *
     * @param bool $echo Echo the string or return it.
     *
     * @return string
     * @since 2.1.0
     */
    function mixxcazt_site_title_or_logo() {
        ob_start();
        the_custom_logo(); ?>
        <div class="site-branding-text">
            <?php if (is_front_page()) : ?>
                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                          rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php else : ?>
                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                         rel="home"><?php bloginfo('name'); ?></a></p>
            <?php endif; ?>

            <?php
            $description = get_bloginfo('description', 'display');

            if ($description || is_customize_preview()) :
                ?>
                <p class="site-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
        </div><!-- .site-branding-text -->
        <?php
        $html = ob_get_clean();
        return $html;
    }
}

if (!function_exists('mixxcazt_primary_navigation')) {
    /**
     * Display Primary Navigation
     *
     * @return void
     * @since  1.0.0
     */
    function mixxcazt_primary_navigation() {
        ?>
        <nav class="main-navigation" role="navigation"
             aria-label="<?php esc_html_e('Primary Navigation', 'mixxcazt'); ?>">
            <?php
            $args = apply_filters('mixxcazt_nav_menu_args', [
                'fallback_cb'     => '__return_empty_string',
                'theme_location'  => 'primary',
                'container_class' => 'primary-navigation',
            ]);
            wp_nav_menu($args);
            ?>
        </nav>
        <?php
    }
}

if (!function_exists('mixxcazt_mobile_navigation')) {
    /**
     * Display Handheld Navigation
     *
     * @return void
     * @since  1.0.0
     */
    function mixxcazt_mobile_navigation() {
        ?>
        <div class="mobile-nav-tabs">
            <ul>
                <?php if (isset(get_nav_menu_locations()['handheld'])) { ?>
                    <li class="mobile-tab-title mobile-pages-title active" data-menu="pages">
                        <span><?php echo esc_html(get_term(get_nav_menu_locations()['handheld'], 'nav_menu')->name); ?></span>
                    </li>
                <?php } ?>
                <?php if (isset(get_nav_menu_locations()['vertical'])) { ?>
                    <li class="mobile-tab-title mobile-categories-title" data-menu="categories">
                        <span><?php echo esc_html(get_term(get_nav_menu_locations()['vertical'], 'nav_menu')->name); ?></span>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <nav class="mobile-menu-tab mobile-navigation mobile-pages-menu active" aria-label="<?php esc_html_e('Mobile Navigation', 'mixxcazt'); ?>">
            <?php
            wp_nav_menu(
                array(
                    'theme_location'  => 'handheld',
                    'container_class' => 'handheld-navigation',
                )
            );
            ?>
        </nav>
        <nav class="mobile-menu-tab mobile-navigation-categories mobile-categories-menu" aria-label="<?php esc_html_e('Mobile Navigation', 'mixxcazt'); ?>">
            <?php
            $args = apply_filters('mixxcazt_nav_menu_args', [
                'fallback_cb'     => '__return_empty_string',
                'theme_location'  => 'vertical',
                'container_class' => 'handheld-navigation',
            ]);

            wp_nav_menu($args);
            ?>
        </nav>
        <?php
    }
}

if (!function_exists('mixxcazt_vertical_navigation')) {
    /**
     * Display Vertical Navigation
     *
     * @return void
     * @since  1.0.0
     */
    function mixxcazt_vertical_navigation() {

        if (isset(get_nav_menu_locations()['vertical'])) {
            $string = get_term(get_nav_menu_locations()['vertical'], 'nav_menu')->name;
            ?>
            <nav class="vertical-navigation" aria-label="<?php esc_html_e('Vertiacl Navigation', 'mixxcazt'); ?>">
                <div class="vertical-navigation-header">
                    <i class="mixxcazt-icon-caret-vertiacl-menu"></i>
                    <span class="vertical-navigation-title"><?php echo esc_html($string); ?></span>
                </div>
                <?php

                $args = apply_filters('mixxcazt_nav_menu_args', [
                    'fallback_cb'     => '__return_empty_string',
                    'theme_location'  => 'vertical',
                    'container_class' => 'vertical-menu',
                ]);

                wp_nav_menu($args);
                ?>
            </nav>
            <?php
        }
    }
}

if (!function_exists('mixxcazt_homepage_header')) {
    /**
     * Display the page header without the featured image
     *
     * @since 1.0.0
     */
    function mixxcazt_homepage_header() {
        edit_post_link(esc_html__('Edit this section', 'mixxcazt'), '', '', '', 'button mixxcazt-hero__button-edit');
        ?>
        <header class="entry-header">
            <?php
            the_title('<h1 class="entry-title">', '</h1>');
            ?>
        </header><!-- .entry-header -->
        <?php
    }
}

if (!function_exists('mixxcazt_page_header')) {
    /**
     * Display the page header
     *
     * @since 1.0.0
     */
    function mixxcazt_page_header() {

        if (is_front_page() || !is_page_template('default')) {
            return;
        }

        ?>
        <header class="entry-header">
            <?php
            if (has_post_thumbnail()) {
                mixxcazt_post_thumbnail('full');
            }
            the_title('<h1 class="entry-title">', '</h1>');
            ?>
        </header><!-- .entry-header -->
        <?php
    }
}

if (!function_exists('mixxcazt_page_content')) {
    /**
     * Display the post content
     *
     * @since 1.0.0
     */
    function mixxcazt_page_content() {
        ?>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php
            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'mixxcazt'),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->
        <?php
    }
}

if (!function_exists('mixxcazt_post_header')) {
    /**
     * Display the post header with a link to the single post
     *
     * @since 1.0.0
     */
    function mixxcazt_post_header() {
        ?>
        <header class="entry-header">
            <?php

            /**
             * Functions hooked in to mixxcazt_post_header_before action.
             */
            do_action('mixxcazt_post_header_before');
            ?>

            <?php
            if (is_single()) {
                mixxcazt_categories_link();
                ?>
                <span class="entry-meta">
                    <?php
                    mixxcazt_post_meta();
                    ?>
                </span>
                <?php
                the_title('<h1 class="alpha entry-title">', '</h1>');
            } else {
                if ('post' == get_post_type()) {
                    ?>
                    <div class="entry-meta">
                        <?php
                        mixxcazt_post_meta();
                        ?>
                    </div>

                    <?php
                }
                the_title(sprintf('<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');

            }
            ?>

            <?php
            do_action('mixxcazt_post_header_after');
            ?>
        </header><!-- .entry-header -->
        <?php
    }
}

if (!function_exists('mixxcazt_post_content')) {
    /**
     * Display the post content with a link to the single post
     *
     * @since 1.0.0
     */
    function mixxcazt_post_content() {
        ?>
        <div class="entry-content">
            <?php

            /**
             * Functions hooked in to mixxcazt_post_content_before action.
             *
             */
            do_action('mixxcazt_post_content_before');


            if (is_single()) {

                the_content(
                    sprintf(
                    /* translators: %s: post title */
                        esc_html__('Read More', 'mixxcazt') . ' %s',
                        '<span class="screen-reader-text">' . get_the_title() . '</span>'
                    )
                );
            } else {
                the_excerpt();
                echo '<a class="more-link" href="' . get_permalink() . '">' . esc_html__('Continue Reading', 'mixxcazt') . '<i class="mixxcazt-icon-long-arrow-right"></i></a>';
            }

            /**
             * Functions hooked in to mixxcazt_post_content_after action.
             *
             */
            do_action('mixxcazt_post_content_after');

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'mixxcazt'),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->
        <?php
    }
}

if (!function_exists('mixxcazt_post_meta')) {
    /**
     * Display the post meta
     *
     * @since 1.0.0
     */
    function mixxcazt_post_meta() {
        if ('post' !== get_post_type()) {
            return;
        }

        // Posted on.
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );

        $posted_on = '<span class="posted-on">' . sprintf('<a href="%1$s" rel="bookmark">%2$s</a>', esc_url(get_permalink()), $time_string) . '</span>';

        // Author.
        $author = sprintf(
            '<span class="post-author"><span>%1$s<a href="%2$s" class="url fn" rel="author">%3$s</a></span></span>',
            esc_html__('By ', 'mixxcazt'),
            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
            esc_html(get_the_author())
        );


        echo wp_kses(
            sprintf('%1$s %2$s', $posted_on, $author), array(
                'span' => array(
                    'class' => array(),
                ),
                'a'    => array(
                    'href'  => array(),
                    'title' => array(),
                    'rel'   => array(),
                ),
                'time' => array(
                    'datetime' => array(),
                    'class'    => array(),
                ),
            )
        );
    }
}

if (!function_exists('mixxcazt_get_allowed_html')) {
    function mixxcazt_get_allowed_html() {
        return apply_filters(
            'mixxcazt_allowed_html',
            array(
                'br'     => array(),
                'i'      => array(),
                'b'      => array(),
                'u'      => array(),
                'em'     => array(),
                'del'    => array(),
                'a'      => array(
                    'href'  => true,
                    'class' => true,
                    'title' => true,
                    'rel'   => true,
                ),
                'strong' => array(),
                'span'   => array(
                    'style' => true,
                    'class' => true,
                ),
            )
        );
    }
}

if (!function_exists('mixxcazt_edit_post_link')) {
    /**
     * Display the edit link
     *
     * @since 2.5.0
     */
    function mixxcazt_edit_post_link() {
        edit_post_link(
            sprintf(
                wp_kses(__('Edit <span class="screen-reader-text">%s</span>', 'mixxcazt'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<div class="edit-link">',
            '</div>'
        );
    }
}

if (!function_exists('mixxcazt_categories_link')) {
    /**
     * Prints HTML with meta information for the current cateogries
     */
    function mixxcazt_categories_link() {

        // Get Categories for posts.
        $categories_list = get_the_category_list(' ');

        if ('post' === get_post_type() && $categories_list) {
            // Make sure there's more than one category before displaying.
            echo '<span class="categories-link"><span class="screen-reader-text">' . esc_html__('Categories', 'mixxcazt') . '</span>' . $categories_list . '</span>';
        }
    }
}

if (!function_exists('mixxcazt_post_taxonomy')) {
    /**
     * Display the post taxonomies
     *
     * @since 2.4.0
     */
    function mixxcazt_post_taxonomy() {
        /* translators: used between list items, there is a space after the comma */

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list('', ', ');
        ?>
        <aside class="entry-taxonomy">
            <?php if ($tags_list) : ?>
                <div class="tags-links">
                    <strong><?php echo esc_html(_n('Tag:', 'Tags:', count(get_the_tags()), 'mixxcazt')); ?></strong>
                    <?php printf('%s', $tags_list); ?>
                </div>
            <?php endif;
            mixxcazt_social_share();
            ?>
        </aside>
        <?php
    }
}

if (!function_exists('mixxcazt_paging_nav')) {
    /**
     * Display navigation to next/previous set of posts when applicable.
     */
    function mixxcazt_paging_nav() {
        global $wp_query;

        $args = array(
            'type'      => 'list',
            'next_text' => _x('NEXT', 'Next post', 'mixxcazt') . '<i class="mixxcazt-icon mixxcazt-icon-chevron-right"></i>',
            'prev_text' => '<i class="mixxcazt-icon mixxcazt-icon-chevron-left"></i>' . _x('PREVIOUS', 'Previous post', 'mixxcazt'),
        );

        the_posts_pagination($args);
    }
}

if (!function_exists('mixxcazt_post_nav')) {
    /**
     * Display navigation to next/previous post when applicable.
     */
    function mixxcazt_post_nav() {


        $args = array(
            'next_text' => '<span class="nav-content"><span class="reader-text">' . esc_html__('NEXT POST', 'mixxcazt') . ' </span>%title' . '</span> ',
            'prev_text' => '<span class="nav-content"><span class="reader-text">' . esc_html__('PREV POST', 'mixxcazt') . ' </span>%title' . '</span> ',
        );

        the_post_navigation($args);

    }
}

if (!function_exists('mixxcazt_posted_on')) {
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     *
     * @deprecated 2.4.0
     */
    function mixxcazt_posted_on() {
        _deprecated_function('mixxcazt_posted_on', '2.4.0');
    }
}

if (!function_exists('mixxcazt_homepage_content')) {
    /**
     * Display homepage content
     * Hooked into the `homepage` action in the homepage template
     *
     * @return  void
     * @since  1.0.0
     */
    function mixxcazt_homepage_content() {
        while (have_posts()) {
            the_post();

            get_template_part('content', 'homepage');

        } // end of the loop.
    }
}

if (!function_exists('mixxcazt_social_icons')) {
    /**
     * Display social icons
     * If the subscribe and connect plugin is active, display the icons.
     *
     * @link http://wordpress.org/plugins/subscribe-and-connect/
     * @since 1.0.0
     */
    function mixxcazt_social_icons() {
        if (class_exists('Subscribe_And_Connect')) {
            echo '<div class="subscribe-and-connect-connect">';
            subscribe_and_connect_connect();
            echo '</div>';
        }
    }
}

if (!function_exists('mixxcazt_get_sidebar')) {
    /**
     * Display mixxcazt sidebar
     *
     * @uses get_sidebar()
     * @since 1.0.0
     */
    function mixxcazt_get_sidebar() {
        get_sidebar();
    }
}

if (!function_exists('mixxcazt_post_thumbnail')) {
    /**
     * Display post thumbnail
     *
     * @param string $size the post thumbnail size.
     *
     * @uses has_post_thumbnail()
     * @uses the_post_thumbnail
     * @var $size thumbnail size. thumbnail|medium|large|full|$custom
     * @since 1.5.0
     */
    function mixxcazt_post_thumbnail($size = 'post-thumbnail') {
        echo '<div class="post-thumbnail">';
        if (has_post_thumbnail()) {
            the_post_thumbnail($size ? $size : 'post-thumbnail');
        }
        if (!is_single()) {
            mixxcazt_categories_link();
        }
        echo '</div>';
    }
}

if (!function_exists('mixxcazt_primary_navigation_wrapper')) {
    /**
     * The primary navigation wrapper
     */
    function mixxcazt_primary_navigation_wrapper() {
        echo '<div class="mixxcazt-primary-navigation"><div class="col-full">';
    }
}

if (!function_exists('mixxcazt_primary_navigation_wrapper_close')) {
    /**
     * The primary navigation wrapper close
     */
    function mixxcazt_primary_navigation_wrapper_close() {
        echo '</div></div>';
    }
}

if (!function_exists('mixxcazt_header_container')) {
    /**
     * The header container
     */
    function mixxcazt_header_container() {
        echo '<div class="col-full">';
    }
}

if (!function_exists('mixxcazt_header_container_close')) {
    /**
     * The header container close
     */
    function mixxcazt_header_container_close() {
        echo '</div>';
    }
}

if (!function_exists('mixxcazt_header_custom_link')) {
    function mixxcazt_header_custom_link() {
        echo mixxcazt_get_theme_option('custom-link', '');
    }

}

if (!function_exists('mixxcazt_header_contact_info')) {
    function mixxcazt_header_contact_info() {
        echo mixxcazt_get_theme_option('contact-info', '');
    }

}

if (!function_exists('mixxcazt_header_account')) {
    function mixxcazt_header_account() {

        if (!mixxcazt_get_theme_option('show_header_account', true)) {
            return;
        }

        if (mixxcazt_is_woocommerce_activated()) {
            $account_link = get_permalink(get_option('woocommerce_myaccount_page_id'));
        } else {
            $account_link = wp_login_url();
        }
        ?>
        <div class="site-header-account">
            <a href="<?php echo esc_html($account_link); ?>">
                <i class="mixxcazt-icon-account"></i>
                <span class="account-content">
                    <?php
                    if (!is_user_logged_in()) {
                        esc_attr_e('Sign in', 'mixxcazt');
                    } else {
                        $user = wp_get_current_user();
                        echo esc_html($user->display_name);
                    }

                    ?>
                </span>
            </a>
            <div class="account-dropdown">

            </div>
        </div>
        <?php
    }

}

if (!function_exists('mixxcazt_template_account_dropdown')) {
    function mixxcazt_template_account_dropdown() {
        if (!mixxcazt_get_theme_option('show_header_account', true)) {
            return;
        }
        ?>
        <div class="account-wrap d-none">
            <div class="account-inner <?php if (is_user_logged_in()): echo "dashboard"; endif; ?>">
                <?php if (!is_user_logged_in()) {
                    mixxcazt_form_login();
                } else {
                    mixxcazt_account_dropdown();
                }
                ?>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('mixxcazt_form_login')) {
    function mixxcazt_form_login() {

        if (mixxcazt_is_woocommerce_activated()) {
            $account_link = get_permalink(get_option('woocommerce_myaccount_page_id'));
        } else {
            $account_link = wp_registration_url();
        }
        ?>
        <div class="login-form-head">
            <span class="login-form-title"><?php esc_attr_e('Sign in', 'mixxcazt') ?></span>
            <span class="pull-right">
                <a class="register-link" href="<?php echo esc_url($account_link); ?>"
                   title="<?php esc_attr_e('Register', 'mixxcazt'); ?>"><?php esc_attr_e('Create an Account', 'mixxcazt'); ?></a>
            </span>
        </div>
        <form class="mixxcazt-login-form-ajax" data-toggle="validator">
            <p>
                <label><?php esc_attr_e('Username or email', 'mixxcazt'); ?> <span class="required">*</span></label>
                <input name="username" type="text" required placeholder="<?php esc_attr_e('Username', 'mixxcazt') ?>">
            </p>
            <p>
                <label><?php esc_attr_e('Password', 'mixxcazt'); ?> <span class="required">*</span></label>
                <input name="password" type="password" required
                       placeholder="<?php esc_attr_e('Password', 'mixxcazt') ?>">
            </p>
            <button type="submit" data-button-action
                    class="btn btn-primary btn-block w-100 mt-1"><?php esc_html_e('Login', 'mixxcazt') ?></button>
            <input type="hidden" name="action" value="mixxcazt_login">
            <?php wp_nonce_field('ajax-mixxcazt-login-nonce', 'security-login'); ?>
        </form>
        <div class="login-form-bottom">
            <a href="<?php echo wp_lostpassword_url(get_permalink()); ?>" class="lostpass-link"
               title="<?php esc_attr_e('Lost your password?', 'mixxcazt'); ?>"><?php esc_attr_e('Lost your password?', 'mixxcazt'); ?></a>
        </div>
        <?php
    }
}

if (!function_exists('mixxcazt_account_dropdown')) {
    function mixxcazt_account_dropdown() { ?>
        <?php if (has_nav_menu('my-account')) : ?>
            <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e('Dashboard', 'mixxcazt'); ?>">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'my-account',
                    'menu_class'     => 'account-links-menu',
                    'depth'          => 1,
                ));
                ?>
            </nav><!-- .social-navigation -->
        <?php else: ?>
            <ul class="account-dashboard">

                <?php if (mixxcazt_is_woocommerce_activated()): ?>
                    <li>
                        <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                           title="<?php esc_html_e('Dashboard', 'mixxcazt'); ?>"><?php esc_html_e('Dashboard', 'mixxcazt'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>"
                           title="<?php esc_html_e('Orders', 'mixxcazt'); ?>"><?php esc_html_e('Orders', 'mixxcazt'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(wc_get_account_endpoint_url('downloads')); ?>"
                           title="<?php esc_html_e('Downloads', 'mixxcazt'); ?>"><?php esc_html_e('Downloads', 'mixxcazt'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-address')); ?>"
                           title="<?php esc_html_e('Edit Address', 'mixxcazt'); ?>"><?php esc_html_e('Edit Address', 'mixxcazt'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>"
                           title="<?php esc_html_e('Account Details', 'mixxcazt'); ?>"><?php esc_html_e('Account Details', 'mixxcazt'); ?></a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo esc_url(get_dashboard_url(get_current_user_id())); ?>"
                           title="<?php esc_html_e('Dashboard', 'mixxcazt'); ?>"><?php esc_html_e('Dashboard', 'mixxcazt'); ?></a>
                    </li>
                <?php endif; ?>
                <li>
                    <a title="<?php esc_html_e('Log out', 'mixxcazt'); ?>" class="tips"
                       href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><?php esc_html_e('Log Out', 'mixxcazt'); ?></a>
                </li>
            </ul>
        <?php endif;

    }
}

if (!function_exists('mixxcazt_header_search_popup')) {
    function mixxcazt_header_search_popup() {
        ?>
        <div class="site-search-popup">
            <div class="site-search-popup-wrap">
                <a href="#" class="site-search-popup-close"><i class="mixxcazt-icon-times-circle"></i></a>
                <?php
                if (mixxcazt_is_woocommerce_activated()) {
                    mixxcazt_product_search();
                } else {
                    ?>
                    <div class="site-search">
                        <?php get_search_form(); ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('mixxcazt_header_search_button')) {
    function mixxcazt_header_search_button() {

        add_action('wp_footer', 'mixxcazt_header_search_popup', 1);
        ?>
        <div class="site-header-search">
            <a href="#" class="button-search-popup"><i class="mixxcazt-icon-search"></i></a>
        </div>
        <?php
    }
}


if (!function_exists('mixxcazt_header_sticky')) {
    function mixxcazt_header_sticky() {
        get_template_part('template-parts/header', 'sticky');
    }
}

if (!function_exists('mixxcazt_mobile_nav')) {
    function mixxcazt_mobile_nav() {
        if (isset(get_nav_menu_locations()['handheld']) || isset(get_nav_menu_locations()['vertical'])) {
            ?>
            <div class="mixxcazt-mobile-nav">
                <div class="menu-scroll-mobile">
                    <a href="#" class="mobile-nav-close"><i class="mixxcazt-icon-times"></i></a>
                    <?php
                    mixxcazt_mobile_navigation();
                    mixxcazt_social();
                    ?>
                </div>
                <?php if (mixxcazt_is_elementor_activated()) mixxcazt_language_switcher_mobile(); ?>
            </div>
            <div class="mixxcazt-overlay"></div>
            <?php
        }
    }
}

if (!function_exists('mixxcazt_mobile_nav_button')) {
    function mixxcazt_mobile_nav_button() {
        if (isset(get_nav_menu_locations()['handheld'])) {
            ?>
            <a href="#" class="menu-mobile-nav-button">
				<span class="toggle-text screen-reader-text"><?php echo esc_attr(apply_filters('mixxcazt_menu_toggle_text', esc_html__('Menu', 'mixxcazt'))); ?></span>
                <i class="mixxcazt-icon-bars"></i>
            </a>
            <?php
        }
    }
}


if (!function_exists('mixxcazt_language_switcher_mobile')) {
    function mixxcazt_language_switcher_mobile() {
        $languages = apply_filters('wpml_active_languages', []);
        if (mixxcazt_is_wpml_activated()) { ?>
            <div class="mixxcazt-language-switcher-mobile">
                <ul class="menu">
                    <li class="item">
                        <div class="language-switcher-head">
                            <img src="<?php echo esc_url($languages[ICL_LANGUAGE_CODE]['country_flag_url']) ?>"
                                 alt="<?php esc_attr($languages[ICL_LANGUAGE_CODE]['default_locale']) ?>">
                        </div>
                    </li>
                    <?php foreach ($languages as $key => $language) {
                        if (ICL_LANGUAGE_CODE === $key) {
                            continue;
                        } ?>
                        <li class="item">
                            <div class="language-switcher-img">
                                <a href="<?php echo esc_url($language['url']) ?>">
                                    <img src="<?php echo esc_url($language['country_flag_url']) ?>"
                                         alt="<?php esc_attr($language['default_locale']) ?>">
                                </a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php }
    }
}

if (!function_exists('mixxcazt_footer_default')) {
    function mixxcazt_footer_default() {
        get_template_part('template-parts/copyright');
    }
}


if (!function_exists('mixxcazt_pingback_header')) {
    /**
     * Add a pingback url auto-discovery header for single posts, pages, or attachments.
     */
    function mixxcazt_pingback_header() {
        if (is_singular() && pings_open()) {
            echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
        }
    }
}


if (!function_exists('mixxcazt_social_share')) {
    function mixxcazt_social_share() {
        get_template_part('template-parts/socials');
    }
}

if (!function_exists('mixxcazt_update_comment_fields')) {
    function mixxcazt_update_comment_fields($fields) {

        $commenter = wp_get_current_commenter();
        $req       = get_option('require_name_email');
        $aria_req  = $req ? "aria-required='true'" : '';

        $fields['author']
            = '<p class="comment-form-author">
			<input id="author" name="author" type="text" placeholder="' . esc_attr__("Your Name *", "mixxcazt") . '" value="' . esc_attr($commenter['comment_author']) .
              '" size="30" ' . $aria_req . ' />
		</p>';

        $fields['email']
            = '<p class="comment-form-email">
			<input id="email" name="email" type="email" placeholder="' . esc_attr__("Email Address *", "mixxcazt") . '" value="' . esc_attr($commenter['comment_author_email']) .
              '" size="30" ' . $aria_req . ' />
		</p>';

        $fields['url']
            = '<p class="comment-form-url">
			<input id="url" name="url" type="url"  placeholder="' . esc_attr__("Your Website", "mixxcazt") . '" value="' . esc_attr($commenter['comment_author_url']) .
              '" size="30" />
			</p>';

        return $fields;
    }
}

add_filter('comment_form_default_fields', 'mixxcazt_update_comment_fields');


