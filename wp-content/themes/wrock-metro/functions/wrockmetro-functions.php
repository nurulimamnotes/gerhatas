<?php
ob_start();
/* ----------------------------------------------------------------------------------- */
/* Breadcrumbs Plugin
  /*----------------------------------------------------------------------------------- */

function wrockmetro_breadcrumbs() {
    $delimiter = '&raquo;';
    $home = 'Home'; // text for the 'Home' link
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb
    echo '<div id="crumbs">';
    global $post;
    $homeLink = esc_url( home_url());
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
    } elseif (is_day()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo $before . get_the_title() . $after;
        }
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        //$cat = get_the_category($parent->ID); $cat = $cat[0];
        //echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_page() && !$post->post_parent) {
        echo $before . get_the_title() . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo $crumb . ' ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_search()) {
        echo $before . 'Search results for "' . get_search_query() . '"' . $after;
    } elseif (is_tag()) {
        echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . 'Articles posted by ' . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo $before . 'Error 404' . $after;
    }

    if (get_query_var('paged')) {
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ' (';
        echo 'Page' . ' ' . get_query_var('paged');
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ')';
    }

    echo '</div>';
}

/* ----------------------------------------------------------------------------------- */
    /* Custom CSS Styles */
    /* ----------------------------------------------------------------------------------- */

    function wrockmetro_of_head_css() {
        $output = '';
        $custom_css = of_get_option('wrockmetro_customcss');
        if ($custom_css <> '') {
            $output .= $custom_css . "\n";
        }
// Output styles
        if ($output <> '') {
            $output = "<!-- Custom Styling -->\n<style type=\"text/css\">/*<![CDATA[*/\n" . $output . "/*]]>*/</style>\n";
            echo $output;
        }
    }

    add_action('wp_head', 'wrockmetro_of_head_css');

/* ----------------------------------------------------------------------------------- */
/* Function to call first uploaded image in functions file
  /*----------------------------------------------------------------------------------- */

function wrockmetro_main_image() {
    global $post, $posts;
    //This is required to set to Null
    $id = '';
    $the_title = '';
    // Till Here
    $permalink = get_permalink($id);
    $homeLink = get_template_directory_uri();
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (isset($matches [1] [0])) {
        $first_img = $matches [1] [0];
    }
    if (empty($first_img)) { //Defines a default image  
    } else {
        print "<a href='$permalink'><img src='$first_img' width='250px' height='160px' class='postimg wp-post-image' alt='$the_title' /></a>";
    }
}

if ('wrockmetro_comment') :

    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own wrockmetro_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function wrockmetro_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case '' :
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <div id="comment-<?php comment_ID(); ?>">
                        <div class="comment-author vcard"> <?php echo get_avatar($comment, 40); ?> <?php printf('%s <span class="says">says:</span>' . sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?> </div>
                        <!-- .comment-author .vcard -->
                        <?php if ($comment->comment_approved == '0') : ?>
                            <em> <?php echo ('Your comment is awaiting moderation.'); ?> </em> <br />
                        <?php endif; ?>
                        <div class="comment-meta commentmetadata"><a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                <?php
                                /* translators: 1: date, 2: time */
                                printf('%1$s at %2$s' . get_comment_date(), get_comment_time());
                                ?>
                            </a>
                            <?php edit_comment_link('(Edit)', ' ');
                            ?>
                        </div>
                        <!-- .comment-meta .commentmetadata -->
                        <div class="comment-body">
                            <?php comment_text(); ?>
                        </div>
                        <div class="reply">
                            <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </div>
                        <!-- .reply -->
                    </div>
                    <!-- #comment-##  -->
                    <?php
                    break;
                case 'pingback' :
                case 'trackback' :
                    ?>
                <li class="post pingback">
                    <p> <?php echo ('Pingback:'); ?>
                        <?php comment_author_link(); ?>
                        <?php edit_comment_link('(Edit)', ' '); ?>
                    </p>
                    <?php
                    break;
            endswitch;
        }

    endif;

 
/////////Theme Options
    /* ----------------------------------------------------------------------------------- */
    /* Add Favicon
      /*----------------------------------------------------------------------------------- */
    function wrockmetro_childtheme_favicon() {
        if (of_get_option('wrockmetro_favicon') != '') {
            echo '<link rel="shortcut icon" href="' . of_get_option('wrockmetro_favicon') . '"/>' . "\n";
        } 
    }

    add_action('wp_head', 'wrockmetro_childtheme_favicon');
    
    ob_clean();