<?php
/**
 * Template part for displaying mentor card content
 */
?>

<div class="flex justify-between items-start mb-4">
    <div>
        <h3 class="text-lg font-bold mb-1"><?php the_title(); ?></h3>
        <p class="text-green-600"><?php echo esc_html(get_post_meta(get_the_ID(), 'mentor_position', true)); ?></p>
    </div>
    <?php
    $linkedin = get_post_meta(get_the_ID(), 'mentor_linkedin', true);
    if ($linkedin) :
    ?>
        <a href="<?php echo esc_url($linkedin); ?>" class="text-gray-400 hover:text-blue-500" target="_blank" rel="noopener noreferrer">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
            </svg>
        </a>
    <?php endif; ?>
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