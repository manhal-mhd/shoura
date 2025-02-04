<?php
/**
 * Shoura Theme functions and definitions
 */

if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.0');
}

/**
 * Set up theme defaults and registers support for various WordPress features.
 */
function shoura_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'shoura'),
        'footer' => esc_html__('Footer Menu', 'shoura'),
    ));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo.
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));
}
add_action('after_setup_theme', 'shoura_setup');

/**
 * Register Custom Post Types and their meta boxes
 */
function shoura_register_post_types() {
    // Register Mentor post type
    register_post_type('mentor', array(
        'labels' => array(
            'name'               => __('Mentors', 'shoura'),
            'singular_name'      => __('Mentor', 'shoura'),
            'add_new'           => __('Add New', 'shoura'),
            'add_new_item'      => __('Add New Mentor', 'shoura'),
            'edit_item'         => __('Edit Mentor', 'shoura'),
            'new_item'          => __('New Mentor', 'shoura'),
            'view_item'         => __('View Mentor', 'shoura'),
            'search_items'      => __('Search Mentors', 'shoura'),
            'not_found'         => __('No mentors found', 'shoura'),
            'not_found_in_trash'=> __('No mentors found in Trash', 'shoura'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-groups',
        'menu_position'       => 5,
        'show_in_rest'        => true,
        'rewrite'            => array('slug' => 'mentors')
    ));

    // Register Team Member post type
    register_post_type('team_member', array(
        'labels' => array(
            'name'               => __('Team', 'shoura'),
            'singular_name'      => __('Team Member', 'shoura'),
            'add_new'           => __('Add New', 'shoura'),
            'add_new_item'      => __('Add New Team Member', 'shoura'),
            'edit_item'         => __('Edit Team Member', 'shoura'),
            'new_item'          => __('New Team Member', 'shoura'),
            'view_item'         => __('View Team Member', 'shoura'),
            'search_items'      => __('Search Team Members', 'shoura'),
            'not_found'         => __('No team members found', 'shoura'),
            'not_found_in_trash'=> __('No team members found in Trash', 'shoura'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'supports'            => array('title', 'editor', 'thumbnail'),
        'menu_icon'           => 'dashicons-businessperson',
        'menu_position'       => 6,
        'show_in_rest'        => true,
        'rewrite'            => array('slug' => 'team')
    ));
}
add_action('init', 'shoura_register_post_types');

/**
 * Add meta boxes for Mentors and Team Members
 */
function shoura_add_meta_boxes() {
    // Mentor Meta Box
    add_meta_box(
        'mentor_details',
        __('Mentor Details', 'shoura'),
        'shoura_mentor_meta_box_callback',
        'mentor',
        'normal',
        'high'
    );

    // Team Member Meta Box
    add_meta_box(
        'team_member_details',
        __('Team Member Details', 'shoura'),
        'shoura_team_member_meta_box_callback',
        'team_member',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'shoura_add_meta_boxes');

/**
 * Mentor meta box callback
 */
function shoura_mentor_meta_box_callback($post) {
    wp_nonce_field('shoura_mentor_meta_box', 'shoura_mentor_meta_box_nonce');

    $position = get_post_meta($post->ID, 'mentor_position', true);
    $experience = get_post_meta($post->ID, 'mentor_experience', true);
    $expertise = get_post_meta($post->ID, 'mentor_expertise', true);
    $session_duration = get_post_meta($post->ID, 'mentor_session_duration', true);
    $availability = get_post_meta($post->ID, 'mentor_availability', true);
    $linkedin = get_post_meta($post->ID, 'mentor_linkedin', true);
    ?>
    <p>
        <label for="mentor_position"><?php esc_html_e('Position', 'shoura'); ?></label><br>
        <input type="text" id="mentor_position" name="mentor_position" value="<?php echo esc_attr($position); ?>" class="widefat">
    </p>
    <p>
        <label for="mentor_experience"><?php esc_html_e('Experience', 'shoura'); ?></label><br>
        <input type="text" id="mentor_experience" name="mentor_experience" value="<?php echo esc_attr($experience); ?>" class="widefat" placeholder="e.g., 10+ years experience">
    </p>
    <p>
        <label for="mentor_expertise"><?php esc_html_e('Areas of Expertise (comma-separated)', 'shoura'); ?></label><br>
        <input type="text" id="mentor_expertise" name="mentor_expertise" value="<?php echo esc_attr($expertise); ?>" class="widefat" placeholder="e.g., UX Design, Product Strategy, Marketing">
    </p>
    <p>
        <label for="mentor_session_duration"><?php esc_html_e('Session Duration', 'shoura'); ?></label><br>
        <input type="text" id="mentor_session_duration" name="mentor_session_duration" value="<?php echo esc_attr($session_duration); ?>" class="widefat" placeholder="e.g., 60 min session">
    </p>
    <p>
        <label for="mentor_availability"><?php esc_html_e('Availability', 'shoura'); ?></label><br>
        <select id="mentor_availability" name="mentor_availability" class="widefat">
            <option value=""><?php esc_html_e('Select availability', 'shoura'); ?></option>
            <option value="available" <?php selected($availability, 'available'); ?>><?php esc_html_e('Available', 'shoura'); ?></option>
            <option value="limited" <?php selected($availability, 'limited'); ?>><?php esc_html_e('Limited Slots', 'shoura'); ?></option>
        </select>
    </p>
    <p>
        <label for="mentor_linkedin"><?php esc_html_e('LinkedIn Profile URL', 'shoura'); ?></label><br>
        <input type="url" id="mentor_linkedin" name="mentor_linkedin" value="<?php echo esc_url($linkedin); ?>" class="widefat">
    </p>
    <?php
}

/**
 * Team member meta box callback
 */
function shoura_team_member_meta_box_callback($post) {
    wp_nonce_field('shoura_team_member_meta_box', 'shoura_team_member_meta_box_nonce');

    $position = get_post_meta($post->ID, 'team_position', true);
    $linkedin = get_post_meta($post->ID, 'team_linkedin', true);
    $bio = get_post_meta($post->ID, 'team_bio', true);
    ?>
    <p>
        <label for="team_position"><?php esc_html_e('Position', 'shoura'); ?></label><br>
        <input type="text" id="team_position" name="team_position" value="<?php echo esc_attr($position); ?>" class="widefat">
    </p>
    <p>
        <label for="team_bio"><?php esc_html_e('Short Bio', 'shoura'); ?></label><br>
        <textarea id="team_bio" name="team_bio" class="widefat" rows="3"><?php echo esc_textarea($bio); ?></textarea>
    </p>
    <p>
        <label for="team_linkedin"><?php esc_html_e('LinkedIn Profile URL', 'shoura'); ?></label><br>
        <input type="url" id="team_linkedin" name="team_linkedin" value="<?php echo esc_url($linkedin); ?>" class="widefat">
    </p>
    <?php
}

/**
 * Save meta box data
 */
function shoura_save_meta_box_data($post_id) {
    // Check if our nonce is set for either post type
    if (!isset($_POST['shoura_mentor_meta_box_nonce']) && !isset($_POST['shoura_team_member_meta_box_nonce'])) {
        return;
    }

    // Verify the nonce before proceeding
    if (isset($_POST['shoura_mentor_meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['shoura_mentor_meta_box_nonce'], 'shoura_mentor_meta_box')) {
            return;
        }
    }

    if (isset($_POST['shoura_team_member_meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['shoura_team_member_meta_box_nonce'], 'shoura_team_member_meta_box')) {
            return;
        }
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions
    if (isset($_POST['post_type'])) {
        if ($_POST['post_type'] === 'mentor') {
            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
            
            // Save mentor meta fields
            $mentor_fields = array(
                'mentor_position',
                'mentor_experience',
                'mentor_expertise',
                'mentor_session_duration',
                'mentor_availability',
                'mentor_linkedin'
            );

            foreach ($mentor_fields as $field) {
                if (isset($_POST[$field])) {
                    update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
                }
            }
        }
        elseif ($_POST['post_type'] === 'team_member') {
            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
            
            // Save team member meta fields
            $team_fields = array(
                'team_position',
                'team_bio',
                'team_linkedin'
            );

            foreach ($team_fields as $field) {
                if (isset($_POST[$field])) {
                    if ($field === 'team_bio') {
                        update_post_meta($post_id, $field, sanitize_textarea_field($_POST[$field]));
                    } else {
                        update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
                    }
                }
            }
        }
    }
}
add_action('save_post', 'shoura_save_meta_box_data');

/**
 * Enqueue scripts and styles.
 */
// Add cache control headers
function shoura_send_headers() {
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
}
add_action('send_headers', 'shoura_send_headers');

// Define theme version
if (!defined('SHOURA_VERSION')) {
    define('SHOURA_VERSION', wp_get_theme()->get('Version') . '.' . time());
}

function shoura_scripts() {
    try {
        // Remove unwanted scripts
        wp_dequeue_script('wp-embed');
        
        // Enqueue jQuery first
        wp_enqueue_script('jquery');
        
        // Remove all default scripts and styles
        wp_dequeue_script('wp-embed');
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-block-style');
        
        // Enqueue theme's stylesheet
        wp_enqueue_style('shoura-style', get_stylesheet_uri(), array(), SHOURA_VERSION);
        
        // Enqueue theme's JavaScript
        wp_enqueue_script('shoura-script', get_template_directory_uri() . '/js/script.js', array('jquery'), SHOURA_VERSION, true);
        
        // Enqueue theme's custom JavaScript
        wp_enqueue_script('shoura-script', get_template_directory_uri() . '/js/script.js', array('jquery', 'aos-js'), SHOURA_VERSION, true);

        // Clear browser cache with meta tags
        add_action('wp_head', function() {
            echo '<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />';
            echo '<meta http-equiv="Pragma" content="no-cache" />';
            echo '<meta http-equiv="Expires" content="0" />';
        });
        
        // Enqueue theme's custom JavaScript with proper dependency
        wp_enqueue_script('shoura-script', get_template_directory_uri() . '/js/script.js', array('jquery'), _S_VERSION, true);
        
        // Add inline script to handle errors
        wp_add_inline_script('shoura-script', '
            window.addEventListener("error", function(e) {
                console.error("JavaScript error:", e.message);
                return false;
            });
        ');
        
        // Localize the script with new data
        wp_localize_script('shoura-script', 'shouraData', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('shoura-nonce'),
            'isMobile' => wp_is_mobile()
        ));
        
    } catch (Exception $e) {
        error_log('Error in shoura_scripts: ' . $e->getMessage());
    }
}
add_action('wp_enqueue_scripts', 'shoura_scripts');

// Disable WordPress emojis
function disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'disable_emojis');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Register widget area.
 */
function shoura_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'shoura'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here.', 'shoura'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'shoura_widgets_init');