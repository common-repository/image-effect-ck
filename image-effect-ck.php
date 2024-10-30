<?php
/**
 * Plugin Name: Image Effect CK
 * Plugin URI: https://www.ceikay.com/plugins/image-effect-ck
 * Description: Image Effect CK allows you to add some nice effects on your images into your editor. You just have to add the needed CSS class on the desired images.
 * Version: 1.1.0
 * Author: Cédric KEIFLIN
 * Author URI: https://www.ceikay.com/
 * License: GPL2
 * Text Domain:image-effect-ck
 * Domain Path: /language
 */

Namespace Imageffectck;

defined('ABSPATH') or die;

if (! defined('CK_LOADED')) define('CK_LOADED', 1);
if (! defined('IMAGEFFECTCK_VERSION')) define('IMAGEFFECTCK_VERSION', '1.1.0');
if (! defined('IMAGEFFECTCK_PLATFORM')) define('IMAGEFFECTCK_PLATFORM', 'wordpress');
if (! defined('IMAGEFFECTCK_PATH')) define('IMAGEFFECTCK_PATH', dirname(__FILE__));
if (! defined('IMAGEFFECTCK_MEDIA_URL')) define('IMAGEFFECTCK_MEDIA_URL', plugins_url('', __FILE__));
if (! defined('IMAGEFFECTCK_SITE_ROOT')) define('IMAGEFFECTCK_SITE_ROOT', ABSPATH);
if (! defined('IMAGEFFECTCK_URI_ROOT')) define('IMAGEFFECTCK_URI_ROOT', site_url());
if (! defined('IMAGEFFECTCK_URI_BASE')) define('IMAGEFFECTCK_URI_BASE', admin_url('', 'relative'));
if (! defined('IMAGEFFECTCK_PLUGIN_NAME')) define('IMAGEFFECTCK_PLUGIN_NAME', 'image-effect-ck');
if (! defined('IMAGEFFECTCK_SETTINGS_FIELD')) define('IMAGEFFECTCK_SETTINGS_FIELD', 'image-effect-ck_options');
if (! defined('IMAGEFFECTCK_WEBSITE')) define('IMAGEFFECTCK_WEBSITE', 'http://www.ceikay.com/plugins/image-effect-ck/');
// global vars
if (! defined('CEIKAY_MEDIA_URL')) define('CEIKAY_MEDIA_URL', 'https://media.ceikay.com');

class Imageffectck {

	private static $instance;

	static function getInstance() { 
		if (!isset(self::$instance))
		{
			self::$instance = new self();
		}

		return self::$instance;
	}

	function init() {
		// load the translation
		add_action('plugins_loaded', array($this, 'load_textdomain'));

		if (is_admin()) {
			// nothing
		} else {
			add_action('wp_head', array( $this, 'load_assets'));
			add_action('init', array( $this, 'load_assets_files'));
		}
		return;
	}

	function load_textdomain() {
		load_plugin_textdomain( 'image-effect-ck', false, dirname( plugin_basename( __FILE__ ) ) . '/language/'  );
	}

	function load_assets_files() {
		wp_enqueue_script('jquery');
		wp_enqueue_style('image-effect-ck', IMAGEFFECTCK_MEDIA_URL . '/assets/imageeffectck.css');
		wp_enqueue_script('image-effect-ck', IMAGEFFECTCK_MEDIA_URL . '/assets/imageeffectck.js');
	}

	function load_assets() {
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$(this).ImageEffectck({
			});
		});
		</script>
	<?php }
}

// load the process
$Imageeffectck = Imageffectck::getInstance();
$Imageeffectck->init();