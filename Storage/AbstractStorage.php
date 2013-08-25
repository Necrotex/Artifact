<?php

namespace Artifact\Storage;



abstract class AbstractStorage {


	private $frozen;
	
	protected $ttl;
	protected $started;


	public function freeze() {
		$this->frozen = TRUE;
	}

	public function unfreeze() {
		$this->frozen = FALSE;
	}

	public function is_frozen() {
		return $this->frozen;
	}

	public function get_ttl(){
		if( $this->is_frozen( ) )
			return;

		if( ! $this->is_dead() )
			return ( microtime() - $this->strated ) - $this->ttl;

		return false;
	}


	public function add_ttl( $time ){
		if( $this->is_frozen( ) )
			return;

		$this->ttl += $time;

		return $this->ttl;
	}

	public function remove_ttl( $time ) {
		if( $this->is_frozen( ) )
			return;

		$this->ttl -= $time;
	}

	public function set_ttl( $time ) {
		if( $this->is_frozen( ) )
			return;

		$this->ttl = $time;
	}

	public function is_dead(){
		if( $this->is_frozen( ) )
			return;

		return ( microtime() - $this->started ) >= $this->ttl;
	}

}

?>