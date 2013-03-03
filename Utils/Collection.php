<?php

namespace Artifact\Utils;

class Collection implements \Iterator, \ArrayAccess, \Countable {

	protected $_frozen;

	protected $_data = array();

	public function __construct( array $data = NULL, $frozen = FALSE ){
		if( is_null( $data ) ) 
			$this->_data = array();
		else
			$this->_data = $data;

		$this->_frozen = $frozen;
	}

	public function __get( $key ) {
		return $this->_data[ $key ];
	}

	public function __set( $key, $val ) {

		if( $this->_frozen ) return FASLE;

		return $this->_data[ $key ] = $val;
	}


	public function __unset( $key ) {
		
		if( $this->_frozen ) return FASLE;

		unset( $this->_data[ $key ] );

	}

	public function __isset( $key ){
		return isset( $this->_data[ $key ] );
	}


	public function is_frozen(){
		return $this->_frozen;
	}

	public function freeze(){
		$this->_frozen = TRUE;
	}

	public function unfreeze(){
		$this->_frozen = FALSE;
	}

	public function toArray() {
		return $this->_data;
	}

	public function map( $filter, array $options ) {
		$defaults = array( 'collect' => true );
		$options += $defaults;

		$data = array_map( $filter, $this->_data );

		if( $option[ 'collect' ] ) {
			$class = get_class( $this );
			return new $class( compact( 'data' ) );
		}
		
		return $data;
	}

	public function keys() {
		return array_keys( $this->_data );
	}

	public function pop() {
		if( $this->_frozen ) return FASLE;
		return array_pop( $this->_data );
	}

	public function push( $val ) {
		if( $this->_frozen ) return FASLE;
		return array_push( $this->_data, $val );
	}


	// Iteraor Implements
	// 
	public function rewind(){
		rewind( $this->_data );
		return current( $this->_data );
	}

	public function current(){
		return current( $this->_data );
	}

	public function key( ){
		return key( $this->_data );
	}

	public function next(){
		return next( $this->_data );
	}

	public function prev(){
		return prev( $this->_data );
	}

	public function valid(){
		return key( $this->_data ) !== NULL;
	}

	public function end() {
		return end( $this->_data );
	}

	// ArrayAccess Implements
	
	public function offsetExists( $offset ) {
		return array_key_exists( $offset, $this->_data );
	}

	public function offsetSet( $offset, $val ) {
		if( $this->_frozen ) return FASLE;

		if( is_null( $offset ) ) 
			return $this->_data[] = $val;
		else
			return $this->_data[ $offset ] = $val;
	}

	public function offsetGet( $offset ) {
		return $this->_data[ $offset ];
	}

	public function offsetUnset( $offset ) {
		if( $this->_frozen ) return FASLE;	
		unset( $this->_data[ $offset ] );
	}

	//Countable implements
	
	public function count() {
		$count =  iterator_count( $this );
		$this->rewind();
		return $count;
	}

}

?>