<?php
/**
 * The template for displaying mentor archives
 */

get_header();
?>

<main class="pt-20">
    <div class="bg-gradient-to-r from-green-400 to-blue-500 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl font-bold mb-4"><?php esc_html_e('Our Mentors', 'shoura'); ?></h1>
                <p class="text-xl opacity-90 max-w-3xl mx-auto">
                    <?php esc_html_e('Connect with experienced professionals who are passionate about helping you grow in your career.', 'shoura'); ?>
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <!-- Filters -->
        <div class="mb-8">
            <form id="mentor-filters" class="grid md:grid-cols-3 gap-4" method="get">
                <?php
                // Get unique expertise areas
                $expertise_terms = array();
                $mentors = get_posts(array('post_type' => 'mentor', 'posts_per_page' => -1));
                foreach ($mentors as $mentor) {
                    $expertise = get_post_meta($mentor->ID, 'mentor_expertise', true);
                    if ($expertise) {
                        $expert_array = array_map('trim', explode(',', $expertise));
                        $expertise_terms = array_merge($expertise_terms, $expert_array);
                    }
                }
                $expertise_terms = array_unique($expertise_terms);
                sort($expertise_terms);
                ?>

                <div>
                    <label for="expertise" class="block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Area of Expertise', 'shoura'); ?>
                    </label>
                    <select name="expertise" id="expertise" class="w-full rounded-lg border-gray-300">
                        <option value=""><?php esc_html_e('All Areas', 'shoura'); ?></option>
                        <?php
                        foreach ($expertise_terms as $term) {
                            $selected = (isset($_GET['expertise']) && $_GET['expertise'] === $term) ? 'selected' : '';
                            echo '<option value="' . esc_attr($term) . '" ' . $selected . '>' . esc_html($term) . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <label for="availability" class="block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Availability', 'shoura'); ?>
                    </label>
                    <select name="availability" id="availability" class="w-full rounded-lg border-gray-300">
                        <option value=""><?php esc_html_e('Any Availability', 'shoura'); ?></option>
                        <option value="available" <?php selected(isset($_GET['availability']) && $_GET['availability'] === 'available'); ?>>
                            <?php esc_html_e('Currently Available', 'shoura'); ?>
                        </option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        <?php esc_html_e('Apply Filters', 'shoura'); ?>
                    </button>
                </div>
            </form>
        </div>

        <?php
        // Query parameters
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'mentor',
            'posts_per_page' => 12,
            'paged' => $paged
        );

        // Add expertise filter
        if (!empty($_GET['expertise'])) {
            $args['meta_query'][] = array(
                'key' => 'mentor_expertise',
                'value' => $_GET['expertise'],
                'compare' => 'LIKE'
            );
        }

        // Add availability filter
        if (!empty($_GET['availability'])) {
            $args['meta_query'][] = array(
                'key' => 'mentor_availability',
                'value' => $_GET['availability'],
                'compare' => '='
            );
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) :
        ?>
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-8">
                <?php
                while ($query->have_posts()) :
                    $query->the_post();
                    ?>
                    <div class="group">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 group-hover:-translate-y-2">
                            <div class="relative">
                                <?php
                                if (has_post_thumbnail()) :
                                    the_post_thumbnail('medium', array('class' => 'w-full h-72 object-cover'));
                                endif;
                                
                                $availability = get_post_meta(get_the_ID(), 'mentor_availability', true);
                                if ($availability) :
                                    $availability_class = ($availability === 'available') ? 'bg-green-500' : 'bg-yellow-500';
                                    $availability_text = ($availability === 'available') ? __('Available', 'shoura') : __('Few Slots', 'shoura');
                                    ?>
                                    <div class="absolute top-4 right-4 <?php echo $availability_class; ?> text-white px-3 py-1 rounded-full text-sm">
                                        <?php echo esc_html($availability_text); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-lg font-bold mb-1"><?php the_title(); ?></h3>
                                        <p class="text-green-600"><?php echo esc_html(get_post_meta(get_the_ID(), 'mentor_position', true)); ?></p>
                                    </div>
                                </div>

                                <div class="space-y-3 mb-4">
                                    <?php
                                    $experience = get_post_meta(get_the_ID(), 'mentor_experience', true);
                                    $session_duration = get_post_meta(get_the_ID(), 'mentor_session_duration', true);
                                    ?>
                                    <?php if ($experience) : ?>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            <?php echo esc_html($experience); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($session_duration) : ?>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <?php echo esc_html($session_duration); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php
                                $expertise = get_post_meta(get_the_ID(), 'mentor_expertise', true);
                                if ($expertise) :
                                    $expertise_array = explode(',', $expertise);
                                    ?>
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        <?php foreach ($expertise_array as $skill) : ?>
                                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">
                                                <?php echo esc_html(trim($skill)); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="flex justify-between items-center">
                                    <a href="<?php the_permalink(); ?>" class="text-blue-600 hover:text-blue-700 font-medium">
                                        <?php esc_html_e('View Profile', 'shoura'); ?>
                                    </a>
                                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                        <?php esc_html_e('Book Session', 'shoura'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
                ?>
            </div>

            <?php
            // Pagination
            $big = 999999999;
            echo '<div class="mt-12 flex justify-center">';
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $query->max_num_pages,
                'prev_text' => '← ' . __('Previous', 'shoura'),
                'next_text' => __('Next', 'shoura') . ' →',
                'type' => 'list',
                'class' => 'pagination'
            ));
            echo '</div>';

            wp_reset_postdata();

        else :
            ?>
            <div class="text-center py-12">
                <p class="text-xl text-gray-600"><?php esc_html_e('No mentors found matching your criteria.', 'shoura'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();