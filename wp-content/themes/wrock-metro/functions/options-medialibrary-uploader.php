<?php
/**
 * WooThemes Media Library-driven AJAX File Uploader Module (2010-11-05)
 *
 * Slightly modified for use in the Options Framework.
 */
if (is_admin()) {

    // Load additional css and js for image uploads on the Options Framework page
    $of_page = 'appearance_page_options-framework';
    add_action("admin_print_styles-$of_page", 'optionsframework_mlu_css', 0);
    add_action("admin_print_scripts-$of_page", 'optionsframework_mlu_js', 0);
}




/**
 * Media Uploader Using the WordPress Media Library.
 *
 * Parameters:
 * - string $_id - A token to identify this field (the name).
 * - string $_value - The value of the field, if present.
 * - string $_mode - The display mode of the field.
 * - string $_desc - An optional description of the field.
 * - int $_postid - An optional post id (used in the meta boxes).
 *
 * Dependencies:
 * - optionsframework_mlu_get_silentpost()
 */

    function optionsframework_medialibrary_uploader($_id, $_value, $_mode = 'full', $_desc = '', $_postid = 0, $_name = '') {

        $optionsframework_settings = get_option('optionsframework');

        // Gets the unique option id
        $option_name = $optionsframework_settings['id'];

        $output = '';
        $id = '';
        $class = '';
        $int = '';
        $value = '';
        $name = '';

        $id = strip_tags(strtolower($_id));
        // Change for each field, using a "silent" post. If no post is present, one will be created.
        $int = optionsframework_mlu_get_silentpost($id);

        // If a value is passed and we don't have a stored value, use the value that's passed through.
        if ($_value != '' && $value == '') {
            $value = $_value;
        }

        if ($_name != '') {
            $name = $option_name . '[' . $id . '][' . $_name . ']';
        } else {
            $name = $option_name . '[' . $id . ']';
        }

        if ($value) {
            $class = ' has-file';
        }
        $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" />' . "\n";
      

        if ($_desc != '') {
            $output .= '<span class="of_metabox_desc">' . $_desc . '</span>' . "\n";
        }

        $output .= '<div class="screenshot" id="' . $id . '_image">' . "\n";

        if ($value != '') {
            $remove = '<a href="javascript:(void);" class="mlu_remove button">Remove</a>';
            $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
            if ($image) {
                $output .= '<img src="' . $value . '" alt="" />' . $remove . '';
            } else {
                $parts = explode("/", $value);
                for ($i = 0; $i < sizeof($parts); ++$i) {
                    $title = $parts[$i];
                }
                // No output preview if it's not an image.			
                $output .= '';

                // Standard generic output if it's not an image.	
                $title = __('View File', 'optionsframework');
                $output .= '<div class="no_image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span>' . $remove . '</div>';
            }
        }
        $output .= '</div>' . "\n";
        return $output;
    }


/**
 * Uses "silent" posts in the database to store relationships for images.
 * This also creates the facility to collect galleries of, for example, logo images.
 * 
 * Return: $_postid.
 *
 * If no "silent" post is present, one will be created with the type "optionsframework"
 * and the post_name of "of-$_token".
 *
 * Example Usage:
 * optionsframework_mlu_get_silentpost ( 'of_logo' );
 */


    function optionsframework_mlu_get_silentpost($_token) {

        global $wpdb;
        $_id = 0;

        // Check if the token is valid against a whitelist.
        // $_whitelist = array( 'of_logo', 'of_custom_favicon', 'of_ad_top_image' );
        // Sanitise the token.

        $_token = strtolower(str_replace(' ', '_', $_token));

        // if ( in_array( $_token, $_whitelist ) ) {
        if ($_token) {

            // Tell the function what to look for in a post.

            $_args = array('post_type' => 'optionsframework', 'post_name' => 'of-' . $_token, 'post_status' => 'draft', 'comment_status' => 'closed', 'ping_status' => 'closed');

            // Look in the database for a "silent" post that meets our criteria.
            $query = "SELECT ID FROM $wpdb->posts WHERE post_parent = 0";
            foreach ($_args as $k => $v) {
                $query .= $wpdb->prepare(" AND $k = %s", $v);
            } // End FOREACH Loop

            $query .= ' LIMIT 1';
            $_posts = $wpdb->get_row($query);

            // If we've got a post, loop through and get it's ID.
            if (count($_posts)) {
                $_id = $_posts->ID;
            } else {

                // If no post is present, insert one.
                // Prepare some additional data to go with the post insertion.
                $_words = explode('_', $_token);
                $_title = join(' ', $_words);
                $_title = ucwords($_title);
                $_post_data = array('post_title' => $_title);
                $_post_data = array_merge($_post_data, $_args);
                $_id = wp_insert_post($_post_data);
            }
        }
        return $_id;
    }



/**
 * Triggered inside the Media Library popup to modify the title of the "Gallery" tab.
 */

    function optionsframework_mlu_modify_tabs($tabs) {
        $tabs['gallery'] = str_replace(__('Gallery', 'optionsframework'), __('Previously Uploaded', 'optionsframework'), $tabs['gallery']);
        return $tabs;
    }

