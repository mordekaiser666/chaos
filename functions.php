<?php

// Register scripts and styles
function add_theme_scripts() {
    // Register Styles
    wp_register_style( 'main-style', get_template_directory_uri() . '/public/assets/css/styles.css', null, null, 'all' );
    // Register Scripts
    wp_register_script( 'main-script', get_template_directory_uri() . '/public/assets/js/main.min.js', array ( 'jquery' ), null, true );
    // Include Styles
    wp_enqueue_style( 'main-style' );
    // Include Scripts
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'main-script' );
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );


// Add theme support
if ( function_exists( 'add_theme_support' ) ) {
    add_post_type_support( 'page', 'excerpt' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'excerpt' );
    add_theme_support( 'widgets' );
    set_post_thumbnail_size( 120, 80, true ); // default Post Thumbnail dimensions (cropped)
    // additional image sizes
    // add_image_size( 'post380x380', 380, 380, true );
    // add_image_size( 'post380x380', 380, 380, true );
    // add_image_size( 'post600x600', 600, 600, true );
    // add_image_size( 'post830x465', 830, 465, true );
}


// add svg file type to upload
function add_file_types_to_uploads( $file_types ) {
    $new_filetypes = array();
    $new_filetypes[ 'svg' ] = 'image/svg+xml';
    $file_types = array_merge( $file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');


// Register Sidebars
function register_sidebars_top5() {
    $args = array(
        'id'            => 'left_sidebar',
        'class'         => 'left_sidebar',
        'name'          => __( 'Left sidebar', 'text_domain' ),
        'description'   => __( 'left sidebar for widgets', 'text_domain' ),
    );
    register_sidebar( $args );
    $args = array(
        'id'            => 'right_sidebar',
        'class'         => 'right_sidebar',
        'name'          => __( 'Right sidebar', 'text_domain' ),
        'description'   => __( 'Right sidebar for widgets', 'text_domain' ),
    );
    register_sidebar( $args );

}
add_action( 'widgets_init', 'register_sidebars_top5' );


// custom excerpt
function excerpt( $limit ) {
    $excerpt = explode( ' ', get_the_excerpt(), $limit );
    if ( count( $excerpt ) >= $limit ) {
        array_pop( $excerpt );
        $excerpt = implode( " ", $excerpt ) . '...';
    } else {
        $excerpt = implode( " ", $excerpt );
    } 
    $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

    return $excerpt;
}


// // add class to menu link
// function add_menu_link_class( $atts, $item, $args ) {
//     // check for footer menu
//     if( $args->menu == 'Footer menu' ) {
//         // add class to footer menu link
//         $atts['class'] = 'footer-menu__link';
//     }

//     // return all attributes, we have added class attribute
//     return $atts;
// }
// add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );


// yoast breadcrumb edit
// function ss_breadcrumb_single_link( $link_output, $link ) {
//     return str_replace('<a', '<a class="breadcrumbs__link"', $link_output);
// }
// add_filter( 'wpseo_breadcrumb_single_link', 'ss_breadcrumb_single_link', 10, 2 );

// yoast breadcrumb remove archive link
// function timersys_remove_companies( $link_output, $link ) {
//     if( $link['text'] == 'Review' ) {
//         $link_output = '';
//     }
 
//     return $link_output;
// }
// add_filter('wpseo_breadcrumb_single_link' ,'timersys_remove_companies', 10 ,2);

// acf options page
if( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page();
}


// include files
include get_parent_theme_file_path( '/includes/cpt.php' );