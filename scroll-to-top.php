<?php
    /**
     * Plugin Name:       IK WP Scroll To Top
     * Plugin URI:        https://wordpress.org/plugins/ik-wp-scroll-to-top/
     * Description:       IK WP scroll to top plugin will help you to enable back to top button to your WordPress Website.
     * Version:           1.0.0
     * Requires at least: 5.2
     * Requires PHP:      7.2
     * Author:            Imran Khan
     * Author URI:        https://github.com/imrankhanwebdeveloper
     * License:           GPLv3
     * License URI:       http://www.gnu.org/licenses/gpl.html
     * Update URI:        https://github.com/imrankhanwebdeveloper
     * Text Domain:       iwstt
     */

     // Including CSS
     function iwstt_enqueue_style(){
        wp_enqueue_style('iwstt-style', plugins_url('css/iwstt-style.css', __FILE__));
     }
     add_action( "wp_enqueue_scripts", "iwstt_enqueue_style" );

    // Including Javascript
    function iwstt_enqueue_scripts(){
        wp_enqueue_script('jquery');
        wp_enqueue_script('iwstt-plugin-script', plugins_url('js/iwstt-plugin.js', __FILE__), array(), '1.0.0', 'true');
    }
    add_action( "wp_enqueue_scripts", "iwstt_enqueue_scripts" );

    // jQuery Plugin Setting Activation
    function iwstt_scroll_script(){
    ?>
        <script>
            jQuery(document).ready(function () {
                jQuery.scrollUp();
            });
        </script>
    <?php 
}
add_action( "wp_footer", "iwstt_scroll_script" );

//Plugin Customization Settings
add_action( "customize_register", "iwstt_scroll_to_top" );
function iwstt_scroll_to_top($wp_customize){
    $wp_customize-> add_section('iwstt_scroll_top_section', array(
        'title' => __('Scroll To Top', 'imrankhan'),
        'description' => 'IK WP scroll to top plugin will help you to enable back to top button to your WordPress Website.',      
    ));

    $wp_customize-> add_setting('iwstt_default_color', array(
         'default' => '#000000',      
    ));
    $wp_customize-> add_control('iwstt_default_color', array(
        'label' => 'Background Color',
        'section' => 'iwstt_scroll_top_section',      
        'type' => 'color',
    ));

    // Adding Rouded Corner
    
    $wp_customize-> add_setting('iwstt_rounded_corner', array(
        'default' => '5px',
        'description' => 'If you need fully rounded or circular then use 25px here.',
            
   ));
   $wp_customize-> add_control('iwstt_rounded_corner', array(
       'label' => 'Rounded Corner',
       'section' => 'iwstt_scroll_top_section',      
       'type' => 'text',
   ));
}

// Theme CSS Customization
function iwstt_theme_color_cus(){
    ?>
    <style>
    #scrollUp {
    background-color: <?php print get_theme_mod(iwstt_default_color); ?>;
    border-radius: <?php print get_theme_mod(iwstt_rounded_corner); ?>;
}    

    </style>
    <?php
}
add_action( "wp_head", "iwstt_theme_color_cus" );
?> 