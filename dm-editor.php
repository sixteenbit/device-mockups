<?php

add_action( 'init', 'DM_buttons' );
function DM_buttons() {
    add_filter( "mce_external_plugins", "DM_add_buttons" );
    add_filter( 'mce_buttons', 'DM_register_buttons' );
}
function DM_add_buttons( $plugin_array ) {
    $plugin_array['wptuts'] = get_template_directory_uri() . '/wptuts-editor-buttons/wptuts-plugin.js';
    return $plugin_array;
}
function DM_register_buttons( $buttons ) {
    array_push( $buttons, 'dropcap', 'showrecent' ); // dropcap', 'recentposts
    return $buttons;
}