<?php
/**
 * The header for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <?php wp_head(); ?>
    <style>
        :root {
            --mint-green: #7EBEA3;
            --yellow: #FFB800;
        }
        body {
            font-family: system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #f0fdf4 0%, #eff6ff 100%);
        }
        .nav-fixed {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
        }
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header>
    <nav class="nav-fixed bg-white/80 backdrop-blur-md shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="text-2xl font-bold text-green-600">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo esc_html(get_bloginfo('name'));
                    }
                    ?>
                </div>
                
                <div class="hidden md:flex space-x-8">
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'menu_class' => 'flex space-x-8',
                            'fallback_cb' => false,
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'link_before' => '<span class="text-gray-700 hover:text-green-600">',
                            'link_after' => '</span>'
                        ));
                    } else {
                        // Fallback menu
                        echo '<ul class="flex space-x-8">
                            <li><a href="' . esc_url(home_url('/')) . '"><span class="text-gray-700 hover:text-green-600">Home</span></a></li>
                            <li><a href="#about"><span class="text-gray-700 hover:text-green-600">About</span></a></li>
                            <li><a href="#mentors"><span class="text-gray-700 hover:text-green-600">Mentors</span></a></li>
                        </ul>';
                    }
                    ?>
                </div>

                <!-- Mobile menu button -->
                <button class="md:hidden text-gray-700 hover:text-green-600" id="mobile-menu-button" aria-label="Mobile menu" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden hidden absolute top-full left-0 right-0 bg-white shadow-lg z-50" id="mobile-menu">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'py-4 space-y-2',
                    'fallback_cb' => false,
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'link_before' => '<span class="block text-gray-700 hover:text-green-600 px-4 py-2">',
                    'link_after' => '</span>'
                ));
                ?>
            </div>
        </div>
    </nav>
</header>

<main>