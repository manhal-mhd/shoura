<?php
/**
 * About section template part
 */
?>

<section id="about" class="section flex items-center justify-center bg-white">
    <div class="max-w-6xl mx-auto px-4 py-16">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-6"><?php echo esc_html(get_theme_mod('about_title', 'Why Choose Shoura?')); ?></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto"><?php echo esc_html(get_theme_mod('about_description', 'We\'re more than just a mentorship platform. We\'re a community dedicated to nurturing talent and fostering professional growth through personalized guidance and support.')); ?></p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-16 items-center">
            <div data-aos="fade-right">
                <div class="space-y-8">
                    <?php
                    $features = array(
                        array(
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                            'title' => get_theme_mod('feature_1_title', 'Curated Expert Mentors'),
                            'description' => get_theme_mod('feature_1_description', 'Our mentors are carefully selected industry professionals with proven track records. They undergo a thorough vetting process to ensure they can provide valuable guidance and insights.')
                        ),
                        array(
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                            'title' => get_theme_mod('feature_2_title', 'Structured Mentorship Programs'),
                            'description' => get_theme_mod('feature_2_description', 'Our programs are designed with clear objectives and milestones. Whether you\'re looking to switch careers, advance in your current role, or develop specific skills, we have a program for you.')
                        ),
                        array(
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                            'title' => get_theme_mod('feature_3_title', 'Personalized Growth Path'),
                            'description' => get_theme_mod('feature_3_description', 'Every mentee receives a customized development plan. Your mentor will help you identify goals, overcome challenges, and track your progress through regular feedback and adjustments.')
                        )
                    );

                    foreach ($features as $feature) :
                    ?>
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <?php echo $feature['icon']; ?>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2"><?php echo esc_html($feature['title']); ?></h3>
                                <p class="text-gray-600"><?php echo esc_html($feature['description']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div data-aos="fade-left" class="relative">
                <div class="grid grid-cols-2 gap-4">
                    <?php
                    $benefits = array(
                        array(
                            'bg' => 'bg-green-50',
                            'title' => get_theme_mod('benefit_1_title', 'Free First Session'),
                            'description' => get_theme_mod('benefit_1_description', 'Start with a complimentary session to ensure the right fit')
                        ),
                        array(
                            'bg' => 'bg-blue-50',
                            'title' => get_theme_mod('benefit_2_title', 'Flexible Scheduling'),
                            'description' => get_theme_mod('benefit_2_description', 'Book sessions that fit your timezone and availability')
                        ),
                        array(
                            'bg' => 'bg-yellow-50',
                            'title' => get_theme_mod('benefit_3_title', 'Resource Library'),
                            'description' => get_theme_mod('benefit_3_description', 'Access curated materials and tools')
                        ),
                        array(
                            'bg' => 'bg-purple-50',
                            'title' => get_theme_mod('benefit_4_title', 'Community Events'),
                            'description' => get_theme_mod('benefit_4_description', 'Join workshops and networking sessions')
                        )
                    );

                    $i = 0;
                    foreach ($benefits as $benefit) :
                        $mt = ($i % 2 == 1) ? 'mt-8' : '';
                    ?>
                        <div class="space-y-4 <?php echo $mt; ?>">
                            <div class="<?php echo $benefit['bg']; ?> p-6 rounded-lg">
                                <h4 class="font-semibold mb-2"><?php echo esc_html($benefit['title']); ?></h4>
                                <p class="text-sm text-gray-600"><?php echo esc_html($benefit['description']); ?></p>
                            </div>
                        </div>
                    <?php
                        $i++;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>