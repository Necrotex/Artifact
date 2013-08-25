<?php 

namespace Artifact\Utils;

use \Artifact\Common\ArtifactStaticObject;

class Validator extends ArtifactStaticObject {

	protected static $_rules = NULL;

	public static function init(){

		static::$_rules = array(
			'alphanum' => '/^[a-zA-Z0-9_]*$/',
			'date' => function( $var ){
							$s = explode('.', $var );
							return checkdate( $s[1], $s[0], $s[3] );
						},
			'time' => '/(2[0-3]|[01][0-9]):[0-5][0-9]/',
			'decimal' => function( $var ){ return is_numeric( $var ) && floor( $val ) != $var; },
			'numberic' => function( $var ){ return is_numeric( $var ); },
			'email' => '/[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/',
			'url' => function( $var) { return filter_var( $var, FILTER_VALIDATE_URL ); },
			'bool' => function( $var ) { return is_bool( $var ); },
			'phone' => '/^[ +0-9/()]+$/',
			'zipcode' => '/[0-9]{5}$/'
		);
	}

	public static function add_custom_rule( $name, $rule ) {
		static::$_rules[ $name ] = $rule;
	}

	private static function _rule_date( $var ) {

	}


	protected static function check( $string, $rule ) {
	
		if( ! $string instanceof \Artifact\Utils\String ) {
			$string = new \Artifact\Utils\String( $string );
		}

		if( ! is_callable( $rule ) )
			return $string->match( $rule );
		else
			return call_user_func_array( $rule , array( $string->__toString() ) );

	}

	public static function __callStatic( $method, $param = array() ) {

		if( array_key_exists( $method , static::$_rules ) )
			return static::check( current( $param ) , static::$_rules[ $method ] );
		else
			throw new \Exception( $method . ' is not a valid rule!' );
	}

}


?>