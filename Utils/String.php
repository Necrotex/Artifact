<?php

namespace Artifact\Utils;

use \Artifact\Common\ArtifactObject;

use \Closure;
use \Exception;


class String extends ArtifactObject {

	protected $_string;

	public function init( $string = '' ) {
		$this->_string = $string;
	}

	public function __toString(){
		return $this->_string;
	}

	public function replace( $needle, $replace ) {
		$this->_string = preg_replace( $needle, $replace, $this->_string );
		return $this;
	}

	public function match( $needle ) {
		return ( preg_match( $needle, $this->_string ) === 0 ) ? FALSE : TRUE ;
	}

	public function match_all( $needle ) {
		$matches = array();
		preg_match_all( $needle, $this->_string, $matches );
		
		return $matches;
	}

	public function split( $index, $offset = NULL  ) {
		if( is_null( $offset ) )
			return new String( substr( $this->_string, $index ) );
		else 
			return new String( substr( $this->_string, $index, $offset ) );
	}

	public function hash( $algo = 'sha512', $key = NULL, $raw = FALSE ){
		if( is_null( $key ) ) {
			return hash_hmac( $algo, $this->_string, $key, $raw );
		} else {
			return hash( $algo, $this->_string, $raw );
		}
	}

	public function interpolate( array $replace = array() ) {
		$out = array();
		
		foreach( $replace as $key => $val )
			$out[ '{:' . $key . '}' ] = $val;

		$this->_string = strtr( $this->_string, $replace );

		return $this;
	}
	
	public function escape( ) {
		$this->_string = mysql_real_escape_string( $this->_string );

		return $this;
	}

	public function _calback( $function ) {
		return $function ( $this->_string );
	}

	public function _load_form_file( $path ) {
		if ( file_exists( $path ) ) {	
			$this->_string = file_get_contents( $path );
		} else {
			throw new \Exception( 'File ' . $path . ' does not exist.' );
		}
		return $this;
	}

}

?>