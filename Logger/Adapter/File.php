<?php

namespace Artifact\Logger\Adapter;

use Artifact\Logger\AbstractLogger;
use Artifact\Logger\LogLevel;


class File extends AbstractLogger {

	public function log( $level, $message , array $context = array() ) {
		$msg = array();

		$msg[ 'message' ] = $this->interpolate( $message, $context );
		$msg[ 'timestamp' ] = date( $this->_config[ 'timestamp' ] );
		$msg[ 'level' ] = $level;

		$this->_write( $this->interpolate( $this->_config[ 'format' ], $msg ) );
		
	}

	private function _write( $message ){
		file_put_contents( $this->_config[ 'file' ], $message, FILE_APPEND | LOCK_EX );		
	}
}

?>