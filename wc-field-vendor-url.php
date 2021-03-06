<?php
/*
Plugin Name: WooCommerce field vendor URL
Plugin URI: https://github.com/Ohar/wc-field-vendor-url
Description:  Add custom field “vendor_url” to the WooCommerce products
Author: Pavel Lysenko aka Ohar
Author URI: http://ohar.name/
Contributors: ohar
Version: 1.0.7
License: MIT
Text Domain: wc-field-vendor-url
Domain Path: /languages
*/

// Inspired by http://www.remicorson.com/mastering-woocommerce-products-custom-fields/

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'add_custom_woocommerce_general_field_vendor_url' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'save_custom_woocommerce_general_field_vendor_url' );

function add_custom_woocommerce_general_field_vendor_url() {

  global $woocommerce, $post;
	
	$post_id = $post->ID;
	$vendor_url = get_post_meta($post_id, 'vendor_url', true);
	$link = $vendor_url ? " <a target='_blank' href='$vendor_url'>ссылка</a>" : '';

  echo '<div class="options_group">';

	woocommerce_wp_text_input(
		array(
			'id'                => 'vendor_url',
			'label'             => __( 'Vendor URL', 'wc-field-vendor-url' ).$link,
			'placeholder'       => 'http://example.com/item',
			'desc_tip'          => 'true',
			'description'       => __( 'URL of product on the vendor`s site', 'wc-field-vendor-url' ),
			'type'              => 'url',
			'data_type'         => 'url'
		)
	);

	echo '</div>';
}

function save_custom_woocommerce_general_field_vendor_url( $post_id ) {
	update_post_meta( $post_id, 'vendor_url', esc_attr( $_POST['vendor_url'] ) );
}

add_action( 'plugins_loaded', 'load_wc_field_vendor_url_textdomain' );

function load_wc_field_vendor_url_textdomain() {
	load_plugin_textdomain( 'wc-field-vendor-url', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
