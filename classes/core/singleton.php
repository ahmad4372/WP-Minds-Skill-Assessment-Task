<?php
namespace Wp_Minds_Skill_Assessment_Task\Core;

// Loaded directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class Singleton {
    private static $instances = [];

    public static function instance() {
        $class = static::class;
        if ( empty( self::$instances[ $class ] ) ) {
            self::$instances[ $class ] = new $class();
        }

        return self::$instances[ $class ];
    }

    final function __construct() {
        if ( ! method_exists( $this, '__run' ) ) {
            throw new \Exception( __( 'Add __run method ', 'wp-minds-skill-assessment-task' ) . static::class );
        }

        $this->__run();
    }
    
    private function __clone() {
        throw new \Exception( __( 'Cannot clone', 'wp-minds-skill-assessment-task' ) );
    }
    
    final public function __wakeup() {
        throw new \Exception( __( 'Cannot unserialize', 'wp-minds-skill-assessment-task' ) );
    }
}