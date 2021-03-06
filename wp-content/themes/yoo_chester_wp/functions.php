<?php
/**
* @package   Avanti
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// check compatibility
if (version_compare(PHP_VERSION, '5.3', '>=')) {

    // bootstrap warp
    require(__DIR__.'/warp.php');
}



add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

   
    unset( $tabs['reviews'] ); 	

    return $tabs;

}

add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {


	$tabs['additional_information']['title'] = __( 'Specifications' );	// Rename the additional information tab
	
	$tabs['description']['priority'] = 5;			// Reviews first

	$tabs['additional_information']['priority'] = 10;
	$tabs['contact_form7']['priority'] = 20;


	return $tabs;

}

if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Check if WooCommerce is active
 **/
if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    return;
}
// let's add a filter to woocommerce_product_tabs to add our additional tab..
add_filter('woocommerce_product_tabs','woocommerce_product_tabs_contact_form7',10,1);
function woocommerce_product_tabs_contact_form7($tabs){
	
	$tabs['contact_form7'] = array(
		'title'    => __( 'Enquire', 'woocommerce' ),
		'priority' => 20,
		'callback' => 'woocommerce_product_contact_form7_tab'
	);
	
	return $tabs;
}
// our tab's callback...
function woocommerce_product_contact_form7_tab(){
	// do the thing zhu li! Let's echo our shortcode for contact form 7
	echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true"]');
}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 48;' ), 20 );

//https://contactform7.com/configuration-validator-faq/#from-email-in-site-domain
add_filter( 'wpcf7_validate_configuration', '__return_false' );


/** add filter to customize the sale icon at product image */

add_filter('woocommerce_sale_flash','woocommerce_sale_flash_customize');
function woocommerce_sale_flash_customize($html)
{
    $html = '<span class="onsale">' . __( 'Sale', 'woocommerce' ) . '</span>';

    return $html;
}