<?php
/**
 * Team section template part
 */

$args = array(
    'post_type' => 'team_member',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
);

$team_query = new WP_Query($args);
?>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold mb-4"><?php echo esc_html(get_theme_mod('team_title', 'The Vision Behind Shoura')); ?></h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                <?php echo esc_html(get_theme_mod('team_description', 'Meet the dedicated team working to make quality mentorship accessible to everyone in the creative and marketing industries.')); ?>
            </p>
        </div>

        <?php if ($team_query->have_posts()) : ?>
            <!-- Core Team -->
            <div class="mb-20">
                <h2 class="text-3xl font-bold text-center mb-12">Our Core Team</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <?php
                    while ($team_query->have_posts()) :
                        $team_query->the_post();
                        $position = get_post_meta(get_the_ID(), 'team_position', true);
                        $linkedin = get_post_meta(get_the_ID(), 'team_linkedin', true);
                        $bio = get_post_meta(get_the_ID(), 'team_bio', true);
                    ?>
                        <div class="team-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', array('class' => 'w-full h-64 object-cover')); ?>
                            <?php endif; ?>
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2"><?php the_title(); ?></h3>
                                <p class="text-green-600 font-medium mb-3"><?php echo esc_html($position); ?></p>
                                <p class="text-gray-600 mb-4"><?php echo esc_html($bio); ?></p>
                                <?php if ($linkedin) : ?>
                                    <div class="flex space-x-3">
                                        <a href="<?php echo esc_url($linkedin); ?>" class="text-gray-400 hover:text-green-600" target="_blank" rel="noopener">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                            </svg>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>

            <!-- Team Quote -->
            <div class="max-w-3xl mx-auto text-center bg-white rounded-xl p-8 shadow-lg">
                <svg class="w-12 h-12 text-green-600 mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                <p class="text-xl text-gray-600 italic mb-6">
                    <?php echo esc_html(get_theme_mod('team_quote', '"Our mission is to democratize access to quality mentorship and empower the next generation of creative professionals. We believe everyone deserves guidance from industry experts who\'ve walked the path before them."')); ?>
                </p>
                <p class="font-semibold text-green-600"><?php echo esc_html(get_theme_mod('team_quote_author', '- The Shoura Team')); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>