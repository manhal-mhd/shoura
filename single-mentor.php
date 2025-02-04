<?php
/**
 * The template for displaying single mentor profiles
 */

get_header();
?>

<main class="pt-20">
    <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white'); ?>>
        <!-- Mentor Header -->
        <div class="bg-gradient-to-r from-green-400 to-blue-500 py-16">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="w-48 h-48 rounded-full overflow-hidden shadow-xl">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover'));
                        } else {
                            echo '<div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>';
                        }
                        ?>
                    </div>
                    <div class="text-center md:text-left text-white">
                        <h1 class="text-3xl font-bold mb-2"><?php the_title(); ?></h1>
                        <p class="text-xl opacity-90 mb-4"><?php echo esc_html(get_post_meta(get_the_ID(), 'mentor_position', true)); ?></p>
                        <?php
                        $experience = get_post_meta(get_the_ID(), 'mentor_experience', true);
                        if ($experience) :
                        ?>
                            <p class="text-lg opacity-75"><?php echo esc_html($experience); ?> of experience</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mentor Content -->
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="md:col-span-2">
                    <div class="prose max-w-none">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    $expertise = get_post_meta(get_the_ID(), 'mentor_expertise', true);
                    if ($expertise) :
                        $expertise_array = explode(',', $expertise);
                    ?>
                        <div class="mt-8">
                            <h3 class="text-xl font-semibold mb-4">Areas of Expertise</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($expertise_array as $skill) : ?>
                                    <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full">
                                        <?php echo esc_html(trim($skill)); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-xl font-semibold mb-6">Book a Session</h3>
                    
                    <?php
                    $session_duration = get_post_meta(get_the_ID(), 'mentor_session_duration', true);
                    $availability = get_post_meta(get_the_ID(), 'mentor_availability', true);
                    ?>
                    
                    <div class="space-y-4 mb-6">
                        <?php if ($session_duration) : ?>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span><?php echo esc_html($session_duration); ?> session</span>
                            </div>
                        <?php endif; ?>

                        <?php if ($availability) : ?>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>
                                    <?php
                                    echo ($availability === 'available') 
                                        ? esc_html__('Currently Available', 'shoura')
                                        : esc_html__('Limited Availability', 'shoura');
                                    ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button class="w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition-colors">
                        <?php esc_html_e('Schedule Session', 'shoura'); ?>
                    </button>

                    <?php
                    $linkedin = get_post_meta(get_the_ID(), 'mentor_linkedin', true);
                    if ($linkedin) :
                    ?>
                        <a href="<?php echo esc_url($linkedin); ?>" 
                           class="mt-4 w-full flex items-center justify-center text-gray-600 hover:text-blue-600" 
                           target="_blank" 
                           rel="noopener noreferrer">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                            <span><?php esc_html_e('Connect on LinkedIn', 'shoura'); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </article>
</main>

<?php
get_footer();