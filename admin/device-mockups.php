<?php

add_action( 'admin_head', 'device_mockups_tinymce_button' );

function device_mockups_tinymce_button() {
	// check user permissions
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}

	// check if WYSIWYG is enabled
	if ( get_user_option( 'rich_editing' ) == 'true' ) {
		add_filter( "mce_external_plugins", "device_mockups_add_tinymce_plugin" );
		add_filter( 'mce_buttons', 'device_mockups_register_my_tc_button' );
	}
}

function device_mockups_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['device_mockups_tc_button'] = plugins_url( 'device-mockups.js', __FILE__ );

	return $plugin_array;
}

function device_mockups_register_my_tc_button( $buttons ) {
	array_push( $buttons, "device_mockups_tc_button" );

	return $buttons;
}

function add_device_mockups_admin() {
	wp_register_style( 'device-mockups-admin', DEVICE_MOCKUPS_URL . '/admin/device-mockups.css', false, DEVICE_MOCKUPS_VERSION );
	wp_enqueue_style( 'device-mockups-admin' );
}

add_action( 'admin_enqueue_scripts', 'add_device_mockups_admin' );