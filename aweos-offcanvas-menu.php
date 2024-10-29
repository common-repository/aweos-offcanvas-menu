<?php
/*
Plugin Name: AWEOS Offcanvas Menu for Divi
Plugin URI:  https://developer.wordpress.org/plugins/aweos-offcanvas-menu/
Description: Displays an offcanvas menu
Version:     1.4.2
Author:      AWEOS GmbH
Author URI:  https://aweos.de
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: aweos-offcanvas-menu
Domain Path: /languages
*/

require_once(__DIR__.'/vendor/autoload.php');

use MatthiasMullie\Minify;

function awoc_register_offcanvas_menu()
{
    register_nav_menu('offcanvas-menu', __('Offcanvas Menu'));
}
add_action('init', 'awoc_register_offcanvas_menu');

add_action('wp_enqueue_scripts', 'awoc_offcanvas_asset');
function awoc_offcanvas_asset()
{
    wp_enqueue_style('awoc_offcanvas_style', plugin_dir_url(__FILE__) . 'public/css/app.css', null, '12' . time());
    if (! is_customize_preview()) {
        wp_enqueue_script('awoc_offcanvas_script', plugin_dir_url(__FILE__) . 'public/js/app.js', ['jquery'], '12' . time(), true);
    }
}

add_action('customize_preview_init', 'awoc_enqueue_offcanvas_refresh_js');
function awoc_enqueue_offcanvas_refresh_js()
{
    wp_enqueue_script('awoc_offcanvas_customize', plugin_dir_url(__FILE__).'public/js/customize.js', array( 'jquery','customize-preview' ));
    if (is_customize_preview()) {
        wp_enqueue_script('awoc_offcanvas_script', plugin_dir_url(__FILE__).'public/js/app.js', ['jquery'], '', true);
    }
}

//---------------------------------- Settings -----------------------------------
function awoc_offcanvas_customizer($wp_customize)
{
    $colorControlClass = class_exists(ET_Divi_Customize_Color_Alpha_Control::class)
        ? ET_Divi_Customize_Color_Alpha_Control::class
        : WP_Customize_Color_Control
    ;

    $wp_customize->add_section('awoc_offcanvas_section', [
        'title' => __('Off-Canvas-Menu', 'awoc_offcanvas'),
        'panel' => 'et_divi_header_panel'
    ]);
    $wp_customize->add_setting('awoc_offcanvas_background_color_setting', array(
        'title'      => __('Background Color', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => '#000000',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new $colorControlClass($wp_customize, 'awoc_offcanvas_background_color_control', array(
        'label'      => __('Background Color', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_background_color_setting',
    )));

    $wp_customize->add_setting('awoc_offcanvas_border_color_setting', array(
        'title'      => __('Border-Color between links', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => '#c5c5c5',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new $colorControlClass($wp_customize, 'awoc_offcanvas_border_color_control', array(
        'label'      => __('Border-Color between links', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_border_color_setting',
    )));

    $wp_customize->add_setting('awoc_offcanvas_font_color_setting', array(
        'title'      => __('Font Color', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => '#222',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new $colorControlClass($wp_customize, 'awoc_offcanvas_font_color_control', array(
        'label'      => __('Font Color', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_font_color_setting',
    )));

    $wp_customize->add_setting('awoc_offcanvas_border_right_color_setting', array(
        'title'      => __('Right border color', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => '#ffffff',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new $colorControlClass($wp_customize, 'awoc_offcanvas_border_right_color_control', array(
        'label'      => __('Right border color', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_border_right_color_setting',
    )));

    $wp_customize->add_setting('awoc_offcanvas_open_font_setting', array(
        'title'      => __('Font color for open item', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => '#444444',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new $colorControlClass($wp_customize, 'awoc_offcanvas_open_font_control', array(
        'label'      => __('Font color for open item', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_open_font_setting',
    )));

    $wp_customize->add_setting('awoc_offcanvas_open_background_setting', array(
        'title'      => __('Background color for open item', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => 'orange',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new $colorControlClass($wp_customize, 'awoc_offcanvas_open_background_control', array(
        'label'      => __('Background color for open item', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_open_background_setting',
    )));

    $wp_customize->add_setting('awoc_offcanvas_display_border_setting', array(
        'title' => __('Display right border', 'awoc_offcanvas'),
        'priority' => 30,
        'default' => 0,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('awoc_offcanvas_display_border_control', array(
        'type' => 'checkbox',
        'label' => __('Display right border', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_display_border_setting'
    ));

    $wp_customize->add_setting('awoc_offcanvas_submenu_background_setting', array(
        'title'      => __('Background for submenu', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => '#dddddd',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new $colorControlClass($wp_customize, 'awoc_offcanvas_submenu_background_control', array(
        'label'      => __('Background for submenu', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_submenu_background_setting',
    )));

    $wp_customize->add_setting('awoc_offcanvas_right_arrow_background_setting', array(
        'title'      => __('Background for right arrow on main elements', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => '#000',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new $colorControlClass($wp_customize,
        'awoc_offcanvas_right_arrow_background_control', array(
        'label'      => __('Background for right arrow on main elements', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_right_arrow_background_setting',
    )));

    $wp_customize->add_setting('awoc_offcanvas_submenu_right_arrow_background_setting', array(
        'title'      => __('Background for right arrow on submenu elements', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => '#333',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new $colorControlClass($wp_customize,
        'awoc_offcanvas_submenu_right_arrow_background_control', array(
        'label'      => __('Background for right arrow on submenu elements', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_submenu_right_arrow_background_setting',
    )));

    $wp_customize->add_setting('awoc_offcanvas_right_arrow_font_color_setting', array(
        'title'      => __('Font color for right arrow', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => '#333',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new $colorControlClass($wp_customize,
        'awoc_offcanvas_right_arrow_font_color_setting', array(
        'label'      => __('Font color for right arrow', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_right_arrow_font_color_setting',
    )));

    $wp_customize->add_setting('awoc_offcanvas_scrollbar_thumb_setting', array(
        'title'      => __('Scrollbar thumb color', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => '#ffffff',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new $colorControlClass($wp_customize, 'awoc_offcanvas_scrollbar_thumb_control', array(
        'label'      => __('Scrollbar thumb color', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_scrollbar_thumb_setting',
    )));

    /* Close button */
    $wp_customize->add_setting('awoc_offcanvas_close_background_setting', array(
        'title'      => __('Close button background', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => '#222',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new $colorControlClass($wp_customize, 'awoc_offcanvas_close_background_control', array(
        'label'      => __('Close button background', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_close_background_setting',
    )));

    $wp_customize->add_setting('awoc_offcanvas_close_color_setting', array(
        'title'      => __('Close button color', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => '#222',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new $colorControlClass($wp_customize, 'awoc_offcanvas_close_color_control', array(
        'label'      => __('Close button color', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_close_color_setting',
    )));

    /* Max Width */
    $wp_customize->add_setting('awoc_offcanvas_max_width_setting', array(
        'title'      => __('Max width', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => '768',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('awoc_offcanvas_max_width_control', array(
        'type' => 'text',
        'label' => __('Max width', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_max_width_setting'
    ));

    $wp_customize->add_setting('awoc_offcanvas_always_active_setting', array(
        'title'      => __('Always active', 'awoc_offcanvas'),
        'priority'   => 30,
        'default' => false,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('awoc_offcanvas_always_active', array(
        'type' => 'checkbox',
        'label' => __('Always active', 'awoc_offcanvas'),
        'section' => 'awoc_offcanvas_section',
        'settings' => 'awoc_offcanvas_always_active_setting'
    ));
}
add_action('customize_register', 'awoc_offcanvas_customizer', 1, 100);

add_action('wp_head', 'awoc_offcanvas_inline_style');
function awoc_offcanvas_inline_style()
{
    $loader = new Twig_Loader_Filesystem(__DIR__);
    $twig = new Twig_Environment($loader);

    $css = $twig->render('aweos-offcanvas-menu.css', [
        'displayBorder' => get_theme_mod('awoc_offcanvas_display_border_setting', true),
        'borderRightColor' => get_theme_mod('awoc_offcanvas_border_right_color_setting', '#000033'),
        'borderColor' => get_theme_mod('awoc_offcanvas_border_color_setting', '#c5c5c5'),
        'backgroundColor' => get_theme_mod('awoc_offcanvas_background_color_setting', '#333'),
        'submenuBackground' => get_theme_mod('awoc_offcanvas_submenu_background_setting', '#ddd'),
        'maxWidth' => get_theme_mod('awoc_offcanvas_max_width_setting', 980),
        'alwaysActive' => get_theme_mod('awoc_offcanvas_always_active_setting', false),
        'scrollbarThumb' => get_theme_mod('awoc_offcanvas_scrollbar_thumb_setting', '#000066'),
        'fontColor' => get_theme_mod('awoc_offcanvas_font_color_setting', '#222'),
        'closeColor' => get_theme_mod('awoc_offcanvas_close_color_setting', '#222'),
        'closeBackground' => get_theme_mod('awoc_offcanvas_close_background_setting', '#eee'),
        'openFont' => get_theme_mod('awoc_offcanvas_open_font_setting', '#eee'),
        'openBackground' => get_theme_mod('awoc_offcanvas_open_background_setting', '#228ADA'),
        'rightArrowBackground' => get_theme_mod('awoc_offcanvas_submenu_right_arrow_background_setting', '#000000'),
        'rightArrowFontColor' => get_theme_mod('awoc_offcanvas_right_arrow_font_color_setting', '#ffffff'),
    ]);

    $minifier = new Minify\CSS();
    $minifier->add($css);

    echo '<style type="text/css">';
    echo $minifier->minify();
    echo '</style>';
}

add_action('wp_footer', 'awoc_display_offcanvas_menu');
function awoc_display_offcanvas_menu()
{
    echo '<div id="offcanvas_container" data-max="'.((!get_theme_mod('awoc_offcanvas_always_active_setting', false)) ? get_theme_mod('awoc_offcanvas_max_width_setting', 980) : 'false').'">';
    echo '<div class="close-sidebar-inner"><span>Schließen</span><span class="fa fa-close"></span></div>';
    echo wp_nav_menu([
        'theme_location' => 'offcanvas-menu',
        'container' => '',
        'fallback_cb' => '',
        'menu_class' => 'menu',
        'menu_id' => 'offcanvas_menu_inner',
        'echo' => false
    ]);
    dynamic_sidebar('offcanvas-inner-widget');
    echo '</div>';
    echo '<div class="offcanvas-menu-background"></div>';
}

add_action('widgets_init', 'awoc_offcanvas_add_bottom_sidebar');
function awoc_offcanvas_add_bottom_sidebar()
{
    register_sidebar([
        'name' => __('Below Offcanvas Menu', 'awoc_offcanvas'),
        'id' => 'offcanvas-inner-widget',
        'description' => __('Displays in the offcanvas mobile menu below the menu items', 'awoc_offcanvas'),
        'before_widget' => '<div class="widget-content">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ]);
}
