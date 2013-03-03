<?php

namespace Artifact\Common;

// Last time we need to include something without our Loader
require 'Pattern' . DIRECTORY_SEPARATOR  . 'Singleton.php';
require '..' . DIRECTORY_SEPARATOR . 'Utils' . DIRECTORY_SEPARATOR . 'Collection.php';
require 'Loader.php';


class Manager extends \Artifact\Common\Pattern\Singleton {

	protected static $LoaderContainer;

	public static function init( ){
		static::$LoaderContainer = new \Artifact\Utils\Collection();
	}

	public static function add( $namespace, $location ) {
		if( ! isset( static::$LoaderContainer->$namespace ) ) {
			
			static::$LoaderContainer->{$namespace} = new \Artifact\Common\Loader( $namespace, $location );
			static::$LoaderContainer->{$namespace}->register();
		}
	}

	public static function remove( $namespace ){

		if( ! isset( static::$LoaderContainer->{$namespace} ) ) {
			
			static::$LoaderContainer->{$namespace}->unregister();
			unset( static::$LoaderContainer->{$namespace} );
		}
	}
}


?>