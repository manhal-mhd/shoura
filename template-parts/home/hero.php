<?php
/**
 * Hero section template part
 */
?>
<?php
// Basic error handling for template part
try {
?>
    <div class="absolute inset-0 opacity-20">
        <div class="w-20 h-20 bg-white rounded-full fixed"></div>
        <div class="w-16 h-16 bg-yellow-300 rounded-full fixed"></div>
        <div class="w-12 h-12 bg-green-300 rounded-full fixed"></div>
    </div>
<?php
} catch (Exception $e) {
    error_log('Error in hero.php: ' . $e->getMessage());
}
?>
<div class="relative text-center text-white z-10 max-w-4xl px-4">
    <h1 class="text-6xl font-bold mb-6"><?php echo esc_html(get_theme_mod('hero_title', 'Welcome to Shoura')); ?></h1>
    <p class="text-xl mb-4"><?php echo esc_html(get_theme_mod('hero_description', 'Shoura connects ambitious young professionals with experienced mentors in creative and marketing industries. Our platform provides personalized guidance to help you navigate your career journey.')); ?></p>
    <p class="text-lg mb-8"><?php echo esc_html(get_theme_mod('hero_subtitle', 'Join over 500+ mentees who have transformed their careers through meaningful mentorship')); ?></p>
    
    <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
        <a href="<?php echo esc_url(get_theme_mod('cta_primary_link', '#mentors')); ?>" 
           class="bg-white text-green-600 px-8 py-3 rounded-lg hover:bg-green-50 transition-colors flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <?php echo esc_html(get_theme_mod('cta_primary_text', 'Find a Mentor')); ?>
        </a>
        <a href="<?php echo esc_url(get_theme_mod('cta_secondary_link', '#join')); ?>" 
           class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg hover:bg-white/10 transition-colors flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            <?php echo esc_html(get_theme_mod('cta_secondary_text', 'Become a Mentor')); ?>
        </a>
    </div>

    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
        <?php
        $stats = array(
            array(
                'number' => get_theme_mod('stat_1_number', '50+'),
                'label' => get_theme_mod('stat_1_label', 'Active Mentors')
            ),
            array(
                'number' => get_theme_mod('stat_2_number', '1000+'),
                'label' => get_theme_mod('stat_2_label', 'Mentorship Hours')
            ),
            array(
                'number' => get_theme_mod('stat_3_number', '95%'),
                'label' => get_theme_mod('stat_3_label', 'Satisfaction Rate')
            )
        );

        foreach ($stats as $stat) :
        ?>
            <div class="bg-white/10 backdrop-blur-md rounded-lg p-4">
                <h3 class="text-3xl font-bold"><?php echo esc_html($stat['number']); ?></h3>
                <p class="text-sm"><?php echo esc_html($stat['label']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>