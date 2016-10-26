<?php
/*
Plugin Name: WooCommerce field vendor URL
Plugin URI: https://github.com/Ohar/wc-field-vendor-url
Description:  Add custom field “vendor_url” to the WooCommerce products
Author: Pavel Lysenko aka Ohar
Author URI: http://ohar.name/
Contributors: ohar
Version: 1.0.0
License: MIT
*/

// Inspired by http://www.remicorson.com/mastering-woocommerce-products-custom-fields/

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function woo_add_custom_general_fields() {

  global $woocommerce, $post;

  echo '<div class="options_group">';

	woocommerce_wp_text_input(
		array(
			'id'                => 'vendor_url',
			'label'             => __( 'Vendor URL', 'woocommerce' ),
			'placeholder'       => 'http://example.com/item',
			'description'       => __( 'URL of product on the vendor`s site', 'woocommerce' ),
			'type'              => 'url',
			'data_type'         => 'url'
		)
	);

	echo '</div>';
}

$vendor_url = $_POST['vendor_url'];
	if (!empty( $vendor_url ) ) {
		update_post_meta( $post_id, 'vendor_url', esc_attr( $vendor_url ) );
	}
}
