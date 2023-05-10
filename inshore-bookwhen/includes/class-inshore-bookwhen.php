<?php

/**
 * InShore_Bookwhen
 *
 * @package InShore_Bookwhen
 * @since 1.0
 */

if ( ! function_exists( 'add_filter' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit();
}

/**
 * Main InShore_Bookwhens Class.
 *
 * @class InShore_Bookwhens
 */
class InShore_Bookwhen
{

    /**
     * RestroPress version.
     *
     * @var string
     */
    public $version = '1.0';

    /**
     * The single instance of the class.
     *
     * @var InShore_Bookwhens
     * @since 1.0
     */
    protected static $instance = null;

    protected $pluginName = 'inshore-bookwhen';
    protected static $options = null;

    /**
     * InShore_Bookwhens Constructor.
     */
    public function __construct()
    {
        $this->defineConstants();
        $this->includes();
        $this->admin_hooks();
        $this->init_hooks();
    }

    /**
     * Main InShore_Bookwhens Instance.
     *
     * Ensures only one instance of InShore_Bookwhens is loaded or can be loaded.
     *
     * @since 1.0
     * @static
     * @return InShore_Bookwhens - Main instance.
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Define constant if not already set.
     *
     * @param string      $name  Constant name.
     * @param bool|string $value Constant value.
     * @since 1.0
     */
    private function define($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }
    
    /**
     * @since 1.0
     */
    private function defineConstants() 
    {
        $this->define('INSHORE_BOOKWHEN_VERSION', $this->version);
        $this->define('INSHORE_BOOKWHEN_PLUGIN_DIR', plugin_dir_path(INSHORE_BOOKWHEN_FILE));
        $this->define('INSHORE_BOOKWHEN_PLUGIN_URL', plugin_dir_url(INSHORE_BOOKWHEN_FILE));
        $this->define('INSHORE_BOOKWHEN_BASE', plugin_basename(INSHORE_BOOKWHEN_FILE));
    }
    
       
    /**
     * Include required files for settings
     *
     * @since 1.0
     */
    private function includes()
    {
        require_once INSHORE_BOOKWHEN_PLUGIN_DIR . 'vendor-scoped/autoload.php';
        require_once INSHORE_BOOKWHEN_PLUGIN_DIR . 'includes/admin/class-inshore-bookwhen-settings.php';
    }
    
    private function admin_hooks() {
        $plugin_admin = new InShore_Bookwhen_Settings( 'inshore-bookwhen' );
        wp_enqueue_script('admin-inshore-bookwhen-tailwind-css', 'https://cdn.tailwindcss.com>'); //@todo check admin only
    }
    
    /**
     * Hook into actions and filters.
     *
     * @since 1.0
     */
    private function init_hooks()
    {   
        add_filter('plugin_action_links_' . INSHORE_BOOKWHEN_BASE, [$this, 'inshore_bookwhen_settings_link']);
    }
    
    
    /**
     * Add settings link for the plugin
     *
     * @since 1.0
     */
    public function inshore_bookwhen_settings_link($links)
    {
        $link = admin_url('admin.php?page=bookwhen');
        $settings_link = sprintf(__('<a href="%1$s">Settings</a>', 'inshore-bookwhen'), esc_url($link));
        array_unshift($links, $settings_link);
        return $links;
    }
}