<?php
/**
 * The main template file
 */

get_header();
?>

<main class="pt-20">
    <div class="container mx-auto px-4 py-12">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('mb-12'); ?>>
                    <header class="entry-header mb-4">
                        <?php
                        if (is_singular()) :
                            the_title('<h1 class="entry-title text-3xl font-bold">', '</h1>');
                        else :
                            the_title('<h2 class="entry-title text-2xl font-bold"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                        endif;
                        ?>
                    </header>

                    <div class="entry-content prose max-w-none">
                        <?php
                        if (is_singular()) :
                            the_content();
                        else :
                            the_excerpt();
                            ?>
                            <a href="<?php echo esc_url(get_permalink()); ?>" class="text-green-600 hover:text-green-700">
                                <?php esc_html_e('Read more', 'shoura'); ?> →
                            </a>
                            <?php
                        endif;
                        ?>
                    </div>
                </article>
                <?php
            endwhile;

            the_posts_navigation(array(
                'prev_text' => '← ' . __('Older posts', 'shoura'),
                'next_text' => __('Newer posts', 'shoura') . ' →',
            ));

        else :
            ?>
            <p><?php esc_html_e('No posts found.', 'shoura'); ?></p>
            <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer();