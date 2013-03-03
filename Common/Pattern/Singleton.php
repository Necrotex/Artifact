<?php

namespace Artifact\Common\Pattern;


abstract Class Singleton {

	protected static $instance = array();

	final protected function __construct(){
		$class = get_called_class( );

		if( method_exists($class, 'init' ) ) {
			call_user_func_array( array( $class, 'init'  ), array( implode( ',', func_get_args() ) ) );
		}

	}

	final protected function __clone(){}

	final public static function get_instance() {
		
		$class = get_called_class();
		$args = implode( ',', func_get_args() );
		
		if( ! array_key_exists( $class, static::$instance ) )
			static::$instance[ $class ] = new $class( $args );

		return static::$instance[ $class ];
	}




}


?>