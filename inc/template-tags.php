<?php
/**
 * Custom template tags for this theme
 */

if (!function_exists('shoura_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function shoura_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        echo '<span class="posted-on">' . $time_string . '</span>';
    }
endif;

if (!function_exists('shoura_posted_by')) :
    /**
     * Prints HTML with meta information about theme author.
     */
    function shoura_posted_by() {
        echo '<span class="byline">' . 
             sprintf(
                 esc_html_x('by %s', 'post author', 'shoura'),
                 '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
             ) . '</span>';
    }
endif;

if (!function_exists('shoura_entry_footer')) :
    /**
     * Prints HTML with meta information for categories, tags and comments.
     */
    function shoura_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'shoura'));
            if ($categories_list) {
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'shoura') . '</span>', $categories_list);
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'shoura'));
            if ($tags_list) {
                printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'shoura') . '</span>', $tags_list);
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'shoura'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'shoura'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

if (!function_exists('shoura_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     */
    function shoura_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('full', array('class' => 'rounded-lg')); ?>
            </div>
        <?php else : ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'post-thumbnail',
                    array(
                        'alt' => the_title_attribute(array('echo' => false)),
                        'class' => 'rounded-lg'
                    )
                );
                ?>
            </a>
        <?php
        endif;
    }
endif;

if (!function_exists('shoura_mentor_meta')) :
    /**
     * Display mentor meta information
     */
    function shoura_mentor_meta($post_id) {
        $experience = get_post_meta($post_id, 'mentor_experience', true);
        $position = get_post_meta($post_id, 'mentor_position', true);
        $expertise = get_post_meta($post_id, 'mentor_expertise', true);
        
        if ($position || $experience || $expertise) {
            echo '<div class="mentor-meta">';
            
            if ($position) {
                echo '<div class="position">' . esc_html($position) . '</div>';
            }
            
            if ($experience) {
                echo '<div class="experience">' . esc_html($experience) . '</div>';
            }
            
            if ($expertise) {
                $expertise_array = explode(',', $expertise);
                echo '<div class="expertise">';
                foreach ($expertise_array as $skill) {
                    echo '<span class="skill">' . esc_html(trim($skill)) . '</span>';
                }
                echo '</div>';
            }
            
            echo '</div>';
        }
    }
endif;