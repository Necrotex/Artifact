<?php

namespace Artifact\Common;

class Loader {

	private $_namespace;
	private $_basepath;


	public function __construct( $namespace, $path ) {
		$this->_namespace = $namespace;
		$this->_basepath = $path;

		return $this;
	}

	public function register() {
		spl_autoload_register( array( $this, 'load' ) );

		return $this;
	}

	public function unregister() {
		spl_autoload_unregister( array( $this, 'load' ) );

		return $this;
	}

	public function load( $classname ) {
		 if( $classname === NULL || $this->_namespace . '\\' === substr( $classname, 0, strlen( $this->_namespace . '\\' ) ) ) {
            
            $file = '';
            $ns = '';
            
            if( ( $nspos = strpos( $classname, '\\' ) ) !== FALSE  ) {

                $ns = substr( $classname, 0, $nspos );
                $namespace = substr( $classname, $nspos + 1 );

                $file = str_replace( '\\', DIRECTORY_SEPARATOR, $namespace );
            }
            
            $file = $this->_basepath . DIRECTORY_SEPARATOR . str_replace('_', DIRECTORY_SEPARATOR, $file) . '.php';	
 			
 			if( file_exists( $file ) ) {
 				require_once $file;
 			} else {
 				throw new \Exception( 'Class ' . $namespace . ' not found in ' . $file );
 			}

            	
        }
	}

}

?>