<?php 

namespace Artifact\Utils;

use \Artifact\Common\ArtifactStaticObject;

class Validator extends ArtifactStaticObject {

	protected static $_rules = array(
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

	public static function add_custom_rule( $name, $rule ) {
		static::$_rules[ $name ] = $rule;
	}

	protected static function check( $string, $rule ) {

	}

	public static function __callStatic( $method, $param = array() ) {

	}

}


?>