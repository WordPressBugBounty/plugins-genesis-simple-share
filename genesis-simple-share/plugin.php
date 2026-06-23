<?php
/**
 * Plugin Name: Genesis Simple Share
 * Plugin URI: https://wordpress.org/plugins/genesis-simple-share/
 * Description: A simple sharing plugin using the Share script.
 * Version: 1.2.6
 * Author: OsomPress
 * Author URI: https://www.osompress.com
 *
 * Text Domain: genesis-simple-share
 * Domain Path /languages/
 *
 * @package genesis-simple-share
 */

if (!defined("ABSPATH")) {
	die(
		esc_html__(
			"Sorry, you are not allowed to access this page directly.",
			"genesis-simple-share",
		)
	);
}

define("GENESIS_SIMPLE_SHARE_VERSION", "1.2.6");
define("GENESIS_SIMPLE_SHARE_PATH", plugin_dir_path(__FILE__));
define("GENESIS_SIMPLE_SHARE_INC", plugin_dir_path(__FILE__) . "/includes/");
define("GENESIS_SIMPLE_SHARE_URL", plugins_url("", __FILE__));

add_action("init", "genesis_simple_share_translations_init", 1);
add_action("init", "genesis_simple_share_init", 99);
/**
 * Loads plugin required files.
 *
 * @since 0.1.0
 * changed on version 1.2.4
 * @uses GENESIS_SIMPLE_SHARE_INC
 */
function genesis_simple_share_init()
{
	// Genesis Simple Share depends on Genesis framework functions.
	if (!function_exists("genesis_get_option")) {
		return;
	}

	if (is_admin() && class_exists("Genesis_Admin_Boxes")) {
		require_once GENESIS_SIMPLE_SHARE_INC .
			"class-genesis-simple-share-boxes.php";
		require_once GENESIS_SIMPLE_SHARE_INC .
			"class-genesis-simple-share-entry-meta.php";
	} else {
		require_once GENESIS_SIMPLE_SHARE_INC .
			"class-genesis-simple-share-front-end.php";
	}
}

/**
 * Loads plugin text domain. Uses init instead of genesis_init to avoid loading too early.
 *
 * @since 0.1.0
 * changed on version 1.2.4
 * @uses GENESIS_SIMPLE_SHARE_PATH
 */
function genesis_simple_share_translations_init()
{
	load_plugin_textdomain(
		"genesis-simple-share",
		false,
		dirname(plugin_basename(__FILE__)) . "/languages",
	);
}
