<?php
namespace Wp_Minds_Skill_Assessment_Task\Core;

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Singleton class
 *
 * @package Wp_Minds_Skill_Assessment_Task\Core
 */
abstract class Singleton {
    /**
     * Store instances of classes.
     *
     * @var array
     */
    private static $instances = [];

    /**
     * Get class instance.
     *
     * @return static
     */
    public static function instance() {
        $class = static::class;
        if ( empty( self::$instances[ $class ] ) ) {
            self::$instances[ $class ] = new static();
        }

        return self::$instances[ $class ];
    }

    /**
     * Constructor
     * 
     * @return void
     * @throws \Exception If __run method not found.
     */
    final protected function __construct() {
        if ( ! method_exists( $this, '__run' ) ) {
            throw new \Exception( 'Add __run method ' . static::class );
        }

        $this->__run();
    }
    
    /**
     * Clone
     * 
     * @return void
     * @throws \Exception
     */
    private function __clone() {
        throw new \Exception( 'Cannot clone' );
    }
    
    /**
     * Wakeup
     * 
     * @return void
     * @throws \Exception
     */
    final public function __wakeup() {
        throw new \Exception( 'Cannot unserialize' );
    }
}