<?php
/**
 * The template for displaying the front page
 */

get_header();
?>

<div class="debug-info" style="display: none;">
    <!-- Debug information -->
    <?php
    global $wp_scripts, $wp_styles;
    error_log('Loaded Scripts: ' . print_r($wp_scripts->queue, true));
    error_log('Loaded Styles: ' . print_r($wp_styles->queue, true));
    ?>
</div>

<div>
    <!-- Hero Section -->
    <section id="hero" class="section min-h-screen flex items-center justify-center bg-gradient-to-br from-green-400 to-blue-500">
        <?php
        try {
            get_template_part('template-parts/home/hero');
        } catch (Exception $e) {
            error_log('Error loading hero section: ' . $e->getMessage());
        }
        ?>
    </section>

    <!-- About Section -->
    <section id="about" class="section bg-white py-20">
        <?php
        try {
            get_template_part('template-parts/home/about');
        } catch (Exception $e) {
            error_log('Error loading about section: ' . $e->getMessage());
        }
        ?>
    </section>

    <!-- Mentors Section -->
    <?php
    $args = array(
        'post_type' => 'mentor',
        'posts_per_page' => 4,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    );
    $mentors_query = new WP_Query($args);
    
    if ($mentors_query->have_posts()) :
    ?>
        <section id="mentors" class="section bg-gray-50 py-20">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold mb-6"><?php echo esc_html(get_theme_mod('mentors_title', 'Meet Our Expert Mentors')); ?></h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto"><?php echo esc_html(get_theme_mod('mentors_description', 'Connect with industry leaders who are passionate about sharing their knowledge and helping you grow in your career.')); ?></p>
                </div>

                <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-8">
                    <?php
                    while ($mentors_query->have_posts()) :
                        $mentors_query->the_post();
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
                                    <?php get_template_part('template-parts/content/mentor-card'); ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>

                <div class="text-center mt-12">
                    <a href="<?php echo esc_url(get_post_type_archive_link('mentor')); ?>" class="inline-flex items-center space-x-2 bg-white text-green-600 border-2 border-green-600 px-8 py-3 rounded-lg hover:bg-green-50 transition-colors">
                        <span><?php esc_html_e('View All Mentors', 'shoura'); ?></span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Team Section -->
    <section id="team" class="section bg-gray-50">
        <?php get_template_part('template-parts/home/team'); ?>
    </section>
</div>

<?php get_footer(); ?>