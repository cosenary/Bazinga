<?php

/**
 * Bazinga bootstrap class
 * Class Documentation:
 * 
 * @author Christian Metz
 * @since 3.01.2012
 * @copyright Christian Metz - MetzWeb Networks
 * @version 1.0
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 */

class Bazinga {

  /**
   * Bootstrap paths
   * 
   * @var array
   */
  private static $_paths = array();

  /**
   * Bazinga instance
   * 
   * @var object
   */
  private static $_instance = null;

  /**
   * Available modes
   * 
   * @var array
   */
  private static $_modes = array('AUTO', 'MANUAL');

  /**
   * Basic path (required for spl autoload)
   * 
   * @var string
   */
  private static $_basicPath = null;

  /**
   * Initialization
   * 
   * @param array $config
   * @return object
   */
  public static function init($config = null) {
    if (is_array($config) && !empty($config)) {
      if (isset($config['config'])) {        
        if (isset($config['config']['mode']) && in_array($config['config']['mode'], self::$_modes)) {
          if ($config['config']['mode'] === 'AUTO') {
            self::_register($config['config']['path']);
          }
        }
        unset($config['config']);
        self::setPath($config);
      }
    }
    return self::getInit();
  }

  /**
   * Path Setter
   * 
   * @param array|string $path
   * @return void
   */
  public static function setPath($path) {
    if (is_array($path)) {
      self::$_paths = array_merge(self::$_paths, $path);
    } elseif (is_string($path)) {
      self::$_paths[] = $path;
    }
    return self::getInit();
  }

  /**
   * Load all defined classes by its paths
   * 
   * @param array $paths
   * @return void
   */
  public static function load() {
    if (!empty(self::$_paths)) {
      foreach(self::$_paths as $path) {
        foreach(glob($path) as $filepath) {
          require_once $filepath;
      	}
      }
    }
  }

  /**
   * Get instance
   * 
   * @return object
   */
  public static function getInit() {
    if (self::$_instance === null) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  /**
   * Autoload method for the spl register
   * 
   * @param string $class
   * @return void
   */
  private static function _autoload($class) {
    $filepath = self::$_basicPath.strtolower($class).'.php';
    if (file_exists($filepath)) {
      require_once $filepath;
    }
  }

  /**
   * Check basic path setup and add local if its null
   * 
   * @param string $path
   * @return void
   */
  private static function _checkBasicPath($path) {
    if (!isset($path)) {
      self::$_basicPath = dirname(__FILE__).'/';
    } else {
      self::$_basicPath = $path;
    }
  }

  /**
   * Register autoload method
   * 
   * @param string $path
   * @return void
   */
  private static function _register($path) {
    self::_checkBasicPath($path);
    spl_autoload_register(array(self, '_autoload'));
  }

}