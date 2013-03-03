<?php

namespace Artifact\Common\Pattern;

use Artifact\Common\ArtifactStaticObject;

abstract class Adaptable extends ArtifactStaticObject {

	protected static $_adapter = array();
	protected static $_available_adapters = array();

	
	public static function add_adapter( array $adapters = array() ){
		static::$_available_adapters += $adapters;
	}


	public static function __callStatic( $method, array $param = array() ) {

		if( array_key_exists( $method, static::$_available_adapters ) ) {

			if( ! array_key_exists( $method, static::$_adapter ) ) {
				$config = array();
				$config += static::$_available_adapters[ $method ][ 'config' ];
				$config += $param;


				static::$_adapter[ $method ] = new static::$_available_adapters[ $method ][ 'class' ] ( $config );
			}

			return static::$_adapter[ $method ];
		}

	}

}

?>