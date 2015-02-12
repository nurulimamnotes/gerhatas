<?php
/*
  Plugin Name: Options Framework
  Plugin URI: http://www.wptheming.com
  Description: A framework for building theme options.
  Version: 0.8
  Author: Devin Price
  Author URI: http://www.wptheming.com
  License: GPLv2
 */
/*
  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/* If the user can't edit theme options, no use running this plugin */
add_action('init', 'wrockmetro_optionsframework_rolescheck');

function wrockmetro_optionsframework_rolescheck() {
    if (current_user_can('edit_theme_options')) {
        // If the user can edit theme options, let the fun begin!
        add_action('admin_menu', 'wrockmetro_optionsframework_add_page');
        add_action('admin_init', 'wrockmetro_optionsframework_init');
        add_action('admin_init', 'optionsframework_mlu_init');
    }
}

/* Loads the file for option sanitization */
add_action('init', 'wrockmetro_optionsframework_load_sanitization');

function wrockmetro_optionsframework_load_sanitization() {
    require_once dirname(__FILE__) . '/options-sanitize.php';
}

/*
 * Creates the settings in the database by looping through the array
 * we supplied in options.php.  This is a neat way to do it since
 * we won't have to save settings for headers, descriptions, or arguments.
 *
 * Read more about the Settings API in the WordPress codex:
 * http://codex.wordpress.org/Settings_API
 *
 */

function wrockmetro_optionsframework_init() {
    // Include the required files
    require_once dirname(__FILE__) . '/options-interface.php';
    require_once dirname(__FILE__) . '/options-medialibrary-uploader.php';
    // Loads the options array from the theme
    if ($optionsfile = locate_template(array('theme-options.php'))) {
        require_once dirname(__FILE__) . '/theme-options.php';
    } else if (file_exists(dirname(__FILE__) . '/theme-options.php')) {
        require_once dirname(__FILE__) . '/theme-options.php';
    }
    $optionsframework_settings = get_option('optionsframework');
    // Updates the unique option id in the database if it has changed
    optionsframework_option_name();
    // Gets the unique id, returning a default if it isn't defined
    if (isset($optionsframework_settings['id'])) {
        $option_name = $optionsframework_settings['id'];
    } else {
        $option_name = 'optionsframework';
    }
    // If the option has no saved data, load the defaults
    if (!get_option($option_name)) {
        wrockmetro_optionsframework_setdefaults();
    }
    // Registers the settings fields and callback
    register_setting('optionsframework', $option_name, 'wrockmetro_optionsframework_validate');
}

/*
 * Adds default options to the database if they aren't already present.
 * May update this later to load only on plugin activation, or theme
 * activation since most people won't be editing the options.php
 * on a regular basis.
 *
 * http://codex.wordpress.org/Function_Reference/add_option
 *
 */

function wrockmetro_optionsframework_setdefaults() {
    $optionsframework_settings = get_option('optionsframework');
    // Gets the unique option id
    $option_name = $optionsframework_settings['id'];
    /*
     * Each theme will hopefully have a unique id, and all of its options saved
     * as a separate option set.  We need to track all of these option sets so
     * it can be easily deleted if someone wishes to remove the plugin and
     * its associated data.  No need to clutter the database.  
     *
     */
    if (isset($optionsframework_settings['knownoptions'])) {
        $knownoptions = $optionsframework_settings['knownoptions'];
        if (!in_array($option_name, $knownoptions)) {
            array_push($knownoptions, $option_name);
            $optionsframework_settings['knownoptions'] = $knownoptions;
            update_option('optionsframework', $optionsframework_settings);
        }
    } else {
        $newoptionname = array($option_name);
        $optionsframework_settings['knownoptions'] = $newoptionname;
        update_option('optionsframework', $optionsframework_settings);
    }
    // Gets the default options data from the array in options.php
    $options = optionsframework_options();
    // If the options haven't been added to the database yet, they are added now
    $values = wrockmetro_of_get_default_values();
    if (isset($values)) {
        add_option($option_name, $values); // Add option with default settings
    }
}

/* Add a subpage called "Theme Options" to the appearance menu. */

    function wrockmetro_optionsframework_add_page() {
        $of_page = add_theme_page('Wrock Metro', 'Wrock Metro', 'edit_theme_options', 'metro-options', 'wrockmetro_optionsframework_page');
        // Adds actions to hook in the required css and javascript
        add_action("admin_print_styles-$of_page", 'wrockmetro_optionsframework_load_styles');
        add_action("admin_print_scripts-$of_page", 'wrockmetro_optionsframework_load_scripts');
    }


/* Loads the CSS */

function wrockmetro_optionsframework_load_styles() {
    wp_enqueue_style('admin-style', OPTIONS_FRAMEWORK_DIRECTORY . 'css/admin-style.css');
 }

/* Loads the javascript */

function wrockmetro_optionsframework_load_scripts() {
    // Inline scripts from options-interface.php
    add_action('admin_head', 'wrockmetro_of_admin_head');
    // Enqueued scripts
    wp_enqueue_script('jquery-ui-core');
    
    wp_enqueue_script('options-custom', OPTIONS_FRAMEWORK_DIRECTORY . 'js/options-custom.js', array('jquery'));
}

function wrockmetro_of_admin_head() {
    // Hook to add custom scripts
    do_action('optionsframework_custom_scripts');
}

/*
 * Builds out the options panel.
 *
 * If we were using the Settings API as it was likely intended we would use
 * do_settings_sections here.  But as we don't want the settings wrapped in a table,
 * we'll call our own custom optionsframework_fields.  See options-interface.php
 * for specifics on how each individual field is generated.
 *
 * Nonces are provided using the settings_fields()
 *
 */

    function wrockmetro_optionsframework_page() {
        $return = optionsframework_fields();
        settings_errors();
        ?>
		  <?php get_template_part('/includes/wrock'); ?>
        <div class="wrap"> 
		
            <?php $options = get_option('of_template');
            $themename = get_option('of_themename');
            ?>
            <div id="header">
                <div class="logo">
                    <h2><?php echo $themename; ?>&nbsp;<?php _e('Options', 'wrockmetro'); ?></h2>
                </div>
                <a href="<?php echo esc_url( __( 'http://www.wrock.org/wrock-metro', 'wrockmetro' ) ); ?>" target="_new">
                    <div class="icon-option"> </div>
                </a>   
            </div>
            <div class="metabox-holder">
                <div id="optionsframework">
                    <form action="options.php" method="post">
                        <ul class="nav-tab-wrapper">
        <?php echo $return[1]; ?>
                        </ul>
                        <div class="content">
                            <?php settings_fields('optionsframework'); ?>
        <?php echo $return[0]; /* Settings */ ?>
                        </div>
                        <div id="optionsframework-submit">
                            <input type="submit" class="button-primary" name="update" value="<?php esc_attr_e('Save Options'); ?>" />
                            <input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e('Restore Defaults'); ?>" onclick="return confirm( '<?php print esc_js('Click OK to reset. Any theme settings will be lost!'); ?>' );" />
                            <div class="clear"></div>
                        </div>
                    </form>
                </div> <!-- / #container -->
            </div>
        </div> <!-- / .wrap -->
        <?php
    }

/**
 * Validate Options.
 *
 * This runs after the submit/reset button has been clicked and
 * validates the inputs.
 *
 * @uses $_POST['reset']
 * @uses $_POST['update']
 */
function wrockmetro_optionsframework_validate($input) {
    /*
     * Restore Defaults.
     *
     * In the event that the user clicked the "Restore Defaults"
     * button, the options defined in the theme's options.php
     * file will be added to the option for the active theme.
     */
    if (isset($_POST['reset'])) {
        add_settings_error('options-framework', 'restore_defaults', 'Default options restored.', 'updated fade');
        return wrockmetro_of_get_default_values();
    }
    /*
     * Udpdate Settings.
     */
    if (isset($_POST['update'])) {
        $clean = array();
        $options = optionsframework_options();
        foreach ($options as $option) {
            if (!isset($option['id'])) {
                continue;
            }
            if (!isset($option['type'])) {
                continue;
            }
            $id = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($option['id']));
            // Set checkbox to false if it wasn't sent in the $_POST
            if ('checkbox' == $option['type'] && !isset($input[$id])) {
                $input[$id] = '0';
            }
            // Set each item in the multicheck to false if it wasn't sent in the $_POST
            if ('multicheck' == $option['type'] && !isset($input[$id])) {
                foreach ($option['options'] as $key => $value) {
                    $input[$id][$key] = '0';
                }
            }
            // For a value to be submitted to database it must pass through a sanitization filter
            if (has_filter('of_sanitize_' . $option['type'])) {
                $clean[$id] = apply_filters('of_sanitize_' . $option['type'], $input[$id], $option);
            }
        }
        add_settings_error('options-framework', 'save_options', 'Options saved.', 'updated fade');
        return $clean;
    }
    /*
     * Request Not Recognized.
     */
    return wrockmetro_of_get_default_values();
}

/**
 * Format Configuration Array.
 *
 * Get an array of all default values as set in
 * options.php. The 'id','std' and 'type' keys need
 * to be defined in the configuration array. In the
 * event that these keys are not present the option
 * will not be included in this function's output.
 *
 * @return    array     Rey-keyed options configuration array.
 *
 * @access    private
 */
function wrockmetro_of_get_default_values() {
    $output = array();
    $config = optionsframework_options();
    foreach ((array) $config as $option) {
        if (!isset($option['id'])) {
            continue;
        }
        if (!isset($option['std'])) {
            continue;
        }
        if (!isset($option['type'])) {
            continue;
        }
        if (has_filter('of_sanitize_' . $option['type'])) {
            $output[$option['id']] = apply_filters('of_sanitize_' . $option['type'], $option['std'], $option);
        }
    }
    return $output;
}

/**
 * Add Theme Options menu item to Admin Bar.
 */
add_action('wp_before_admin_bar_render', 'wrockmetro_optionsframework_adminbar');

function wrockmetro_optionsframework_adminbar() {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu(array(
        'parent' => 'appearance',
        'id' => 'of_theme_options',
        'title' => 'Wrock Metro',
        'href' => admin_url('themes.php?page=metro-options')
    ));
}

if ('of_get_option') {


    /**
     * Get Option.
     *
     * Helper function to return the theme option value.
     * If no value has been saved, it returns $default.
     * Needed because options are saved as serialized strings.
     */
    function of_get_option($name, $default = false) {
        $config = get_option('optionsframework');
        if (!isset($config['id'])) {
            return $default;
        }
        $options = get_option($config['id']);
        if (isset($options[$name])) {
            return $options[$name];
        }
        return $default;
    }

}