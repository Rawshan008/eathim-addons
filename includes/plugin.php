<?php 
  namespace Eathim_Addon;

  if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
  }

  final class Plugin {
    /**
     * Eathim Addons Version
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

    /**
     * Minimum PHP Version
     */
    const MINIMUM_PHP_VERSION = '7.3';

    /**
     * Instance
    */
    private static $_instance = null;


    /**
     * Instance
     */
    public static function instance() {

      if ( is_null( self::$_instance ) ) {
        self::$_instance = new self();
      }
      return self::$_instance;
    }

    /**
     * Constructor
     */
     public function __construct() {
      if ( $this->is_compatible() ) {
        add_action( 'elementor/init', [ $this, 'init' ] );
      }
     }

    /**
	  * Compatibility Checks
	  */
    public function is_compatible() {
      // Check if Elementor installed and activated
      if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', [ $this, 'eathim_admin_notice_missing_main_plugin' ] );
        return false;
      }

      // Check for required Elementor version
      if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
        add_action( 'admin_notices', [ $this, 'eathim_admin_notice_minimum_elementor_version' ] );
        return false;
      }

      // Check for required PHP version
      if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
        add_action( 'admin_notices', [ $this, 'eathim_admin_notice_minimum_php_version' ] );
        return false;
      }

      return true;

    }

    /**
     * Main Plugin is missing
     */

     public function eathim_admin_notice_missing_main_plugin() {
      if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
          $notice_title = __( 'Activate Elementor', 'eathim-addons' );
          $notice_url = wp_nonce_url( 'plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php' );
      }else{
          $notice_title = __( 'Install Elementor', 'eathim-addons' );
          $notice_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
      }

  

      $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Elementor installation Link */
        esc_html__( '%1$s %2$s', 'eathim-addons' ),
        '<p>' . esc_html__( 'Ops! Eathim Plugin is not Work Because you need Elementor Plugins install', 'eathim-addons' ) . '</p>',
        '<p><a class="button-primary block" href="' . esc_url( $notice_url ) . '">' . $notice_title . '</a></p>'
      );
  
      printf( '<div class="notice error is-dismissible"><p>%1$s</p></div>', $message );


     }

     /**
      * Minimum Elmentor Version
      */
     public function eathim_admin_notice_minimum_elementor_version() {
      if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

      $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
        esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'eathim-addons' ),
        '<strong>' . esc_html__( 'Eathim Addons', 'eathim-addons' ) . '</strong>',
        '<strong>' . esc_html__( 'Elementor', 'eathim-addons' ) . '</strong>',
        self::MINIMUM_ELEMENTOR_VERSION
      );

      printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
     * Minimum PHP Version
     */

    public function eathim_admin_notice_minimum_php_version() {

      if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
  
      $message = sprintf(
        /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
        esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'eathim-addons' ),
        '<strong>' . esc_html__( 'Elementor Test Addon', 'eathim-addons' ) . '</strong>',
        '<strong>' . esc_html__( 'PHP', 'eathim-addons' ) . '</strong>',
         self::MINIMUM_PHP_VERSION
      );
  
      printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
  
    }


     /**
      * Init Methos
      */
    public function init() {
      add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
      add_action( 'elementor/elements/categories_registered', [ $this, 'eathim_elementor_widget_categories' ] );
      add_action( 'elementor/frontend/after_register_scripts', [ $this, 'eathim_enqueue_scripts' ] );
      add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'eathim_enqueue_styles' ] );
    }

    /**
     * Elementor Category Register
     */
    public function eathim_elementor_widget_categories($elements_manager) {
      $elements_manager->add_category(
        'eathim-addons',
        [
          'title' => esc_html__( 'Eathim Addons', 'eathim-addons' ),
          'icon' => 'fa fa-plug',
        ]
      );
    }

  /**
   * Enqueue Script
   */
    public function eathim_enqueue_scripts() {
      /**
       * Lib files
       */
      wp_register_script( 'justifiedGallery', EATHIM_ADDONS_ASSETS .'lib/justifiedGallery/js/jquery.justifiedGallery.min.js', ['jquery'], EATHIM_ADDONS_VERSION, true );
      wp_register_script( 'isotope', EATHIM_ADDONS_ASSETS .'lib/isotope/js/isotope.pkgd.min.js', ['jquery'], EATHIM_ADDONS_VERSION, true );
      wp_register_script( 'magnific-popup', EATHIM_ADDONS_ASSETS .'lib/magnificPopup/js/jquery.magnific-popup.min.js', ['jquery'], EATHIM_ADDONS_VERSION, true );
      

      /**
       * Custom Files
       */
      wp_register_script( 'eathim-image-slider', EATHIM_ADDONS_ASSETS .'js/eathim-image-slider.js' );
      wp_register_script( 'eathim-justified-gallery', EATHIM_ADDONS_ASSETS .'js/eathim-justified-gallery.js', ['jquery'], time(), true );
      wp_register_script( 'eathim-filter-gallery', EATHIM_ADDONS_ASSETS .'js/eathim-filter-gallery.js', ['jquery'], time(), true );
    }

    /**
     * Addons Style
     */
    public function eathim_enqueue_styles() {
      /**
       * Lib CSS
       */
      wp_enqueue_style('eathim-addons', EATHIM_ADDONS_ASSETS .'css/eathim-addons.css' );
      wp_register_style('justifiedGallery', EATHIM_ADDONS_ASSETS .'lib/justifiedGallery/css/justifiedGallery.min.css' );
      wp_register_style('magnific-popup', EATHIM_ADDONS_ASSETS .'lib/magnificPopup/css/magnific-popup.css' );

      /**
       * Custom CSS
       */

    }

    /**
     * Elementor Control
     */
    public function register_widgets( $widgets_manager ) {

      require_once( __DIR__ . '/widgets/eathim-image-slider-widget.php' );
      require_once( __DIR__ . '/widgets/eathim-justified-gallery-widget.php' );
      require_once( __DIR__ . '/widgets/eathim-filter-gallery-widget.php' );
  
      $widgets_manager->register( new \Eathim_Image_Slider\Eathim_Image_Slider_Widget() );
      $widgets_manager->register( new \Eathim_Justified_Gallery\Eathim_Justified_Gallery_Widget() );
      $widgets_manager->register( new \Eathim_Filter_Gallery\Eathim_Filter_Gallery_Widget() );
  
    }

  }

?>