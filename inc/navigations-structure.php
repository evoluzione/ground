<?php

/**
 * Filters a menu item’s starting output.
 * HOW TO USE : Useful to handle each node of the menu.
 *
 * @param string $item_output The menu item's starting HTML output.
 * @param WP_Post $item Menu item data object
 * @param int $depth Depth of menu item. Used for padding.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return void
 */
function ground_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) 
{

    /**
     * Apply changes only to header-primary
     */
    if( $args->theme_location !== 'header-primary' ){
        return $item_output;
    }

    // Get ACF of the menu item
    $image  = class_exists('ACF') ? get_field('image', $item) : '';
    $button  = class_exists('ACF') ? get_field('button', $item) : '';

    // Capture card content using ob_start 
    $card = '';
    ob_start();
    ?>

    <li class="navigation__item--image">
        
        <?php if ($button) : ?>
            <a class="no-underline" href="<?php echo $button['url']; ?>">
        <?php endif; ?>

                <figure class="media aspect-w-16 aspect-h-9">
                    <img 
                        class="object-cover w-full rounded-theme"
                        src="<?php echo $image['sizes']['16-9-large']; ?>" 
                        alt=""
                        loading="lazy"
                    >
                </figure>

        <?php if ($button) : ?>
                <h2 class="text-lg lg:text-xl py-6"> <?php echo $button['title']; ?> </h2>
            </a>
        <?php endif; ?>
    </li>

    <?php
    $card = ob_get_clean();

    $item_output .= $image ? ('<ul class="navigation__image list-none">' . $card . '</ul>') : null;
 
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'ground_walker_nav_menu_start_el', 10, 4 );

/**
 * Filters the HTML content for navigation menus.
 * HOW TO USE : Useful to handle what sorround the menu.
 *
 * @param string $nav_menu The HTML content for the navigation menu.
 * @param stdClass $args An object containing wp_nav_menu() arguments.
 * @return void
 */
function ground_nav_menu($nav_menu, $args)
{
    return $nav_menu;

    /**
     * Exanple of usage to use menu ACF 
     */

    /**
     * Apply changes only to a specific theme_location
     */
    if( $args->theme_location !== 'header-primary' ){
        return $nav_menu;
    }

	// Get menu object
	$menu = wp_get_nav_menu_object($args->menu);

    // Get ACF of the menu
    $primary_cta = class_exists('ACF') ? get_field('primary_call_to_action', $menu) : '';
    $primary_cta_title = $primary_cta['title'];
    $primary_cta_url = $primary_cta['url'];

    /**
     * Heredoc syntax
     * Documentation: https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc
     */

    $output = <<<SNIPPET

    <div class="header header-mega-menu bg-gray-300">
        <nav class="navigation navigation--primary relative lg:static">
            $nav_menu
        </nav>
        <div class="text-3xl">
            <a href="$primary_cta_url">
                $primary_cta_title
            </a>
        </div>
    </div>

    SNIPPET;

    return $output;

}
add_filter('wp_nav_menu','ground_nav_menu', 10, 2);

/**
 * Filters the arguments used to display a navigation menu.
 *
 * @param array $args Array of wp_nav_menu() arguments.
 * @return void
 */
function ground_nav_menu_args( $args ) { return $args; }
add_filter( 'wp_nav_menu_args', 'ground_nav_menu_args' );

/**
 *  Filters the sorted list of menu item objects before generating the menu’s HTML.
 *
 * @param stdClass $args An object containing wp_nav_menu() arguments.
 * @return void
 */
function ground_nav_menu_objects($args) { return $args; }
add_filter( 'wp_nav_menu_objects', 'ground_nav_menu_objects' );

/**
 * Filters the HTML list content for navigation menus.
 *
 * @param string $items The HTML list content for the menu items
 * @param stdClass $args An object containing wp_nav_menu() arguments.
 * @return void
 * 
 * ACF guide: https://www.advancedcustomfields.com/resources/adding-fields-menus/
 * For a specific menu you can use also the filter wp_nav_menu_{$menu->slug}_items
 */
function ground_nav_menu_items($items, $args) { return $items; }
add_filter('wp_nav_menu_items', 'ground_nav_menu_items', 10, 2 );
