<?php


namespace Artifact\Storage\Adapter;

use Artifact\Storage\StorageInterface;
use Artifact\Storage\AbstractStorage;


class Session extends AbstractStorage implements StorageInterface {

	protected $name;
	protected $ttl;

	protected $stared;

	protected $session;


	public function __construct( array $config ) {

		$this->name = $config[ 'name' ];
		$this->ttl = $config[ 'ttl' ];
		$this->stared = microtime();

		$this->create();
	}

	public function create( ) {
		$this->session = session_start( );
	}


	public function __get( $key ){
		return $this->get( $key );
	}


	public function __set( $key, $value ) {
		$this->set( $key, $value );
	}


	public function set( $key, $value ){
		$_SESSION[ $this->name ][ $key ] = $value;
	}


	public function get( $key ) {
		return $_SESSION[ $this->name ][ $key ];
	}


	public function destroy(){
		session_destroy( $this->session );
	}

	public function clear(){
		session_unset();
	}
}


?>