<?php

namespace Artifact\Logger;

use \Artifact\Common\ArtifactObject;
use \Artifact\Logger\LoggerInterface;
use \Artifact\Logger\LogLevel;


abstract class AbstractLogger extends ArtifactObject {

	protected $_config = array();

	public function init( array $config = array() ) {
		$this->_config = $config;
	}

	public function emergency( $message, array $context = array() ){
		return $this->log( LogLevel::EMERGENCY, $message, $context );
	}

	public function alert( $message, array $context = array() ){
		return $this->log( LogLevel::ALERT, $message, $context );
	}

	public function critical( $message, array $context = array() ){
		return $this->log( LogLevel::CRITICAL, $message, $context );
	}

	public function error( $message, array $context = array() ){
		return $this->log( LogLevel::ERROR, $message, $context );
	}

	public function warning( $message, array $context = array() ){
		return $this->log( LogLevel::WARNING, $message, $context );
	}

	public function notice( $message, array $context = array() ){
		return $this->log( LogLevel::NOTICE, $message, $context );
	}

	public function info( $message, array $context = array() ){
		return $this->log( LogLevel::INFO, $message, $context );
	}

	public function debug( $message, array $context = array() ){
		return $this->log( LogLevel::DEBUG, $message, $context );
	}

	public function interpolate( $message, array $context = array() ) {
		$replace = array();

		foreach( $context as $key => $val )
			$replace[ '{:' . $key . '}' ] = $val;

		return strtr( $message, $replace );
	}
}

?>